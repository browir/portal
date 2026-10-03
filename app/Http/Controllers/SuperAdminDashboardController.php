<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationVisit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
{
    public function dashboard()
    {
        $now = Carbon::now();

        $totalApplications = Application::count();

        $activeApplications = Application::where(
            'is_active',
            true
        )->count();

        $inactiveApplications = $totalApplications - $activeApplications;

        $currentMonthStart = $now->copy()->startOfMonth();

        $currentMonthEnd = $now->copy()->endOfMonth();

        $lastMonthStart = $now->copy()
            ->subMonthNoOverflow()
            ->startOfMonth();

        $lastMonthEnd = $now->copy()
            ->subMonthNoOverflow()
            ->endOfMonth();

        $sixMonthStart = $now->copy()
            ->subMonthsNoOverflow(5)
            ->startOfMonth();

        /*
        |--------------------------------------------------------------------------
        | KUNJUNGAN BULAN INI VS BULAN LALU
        |--------------------------------------------------------------------------
        */

        $currentMonthVisits = ApplicationVisit::whereBetween(
            'visited_at',
            [
                $currentMonthStart,
                $currentMonthEnd
            ]
        )->count();

        $lastMonthUsage = ApplicationVisit::whereBetween(
            'visited_at',
            [
                $lastMonthStart,
                $lastMonthEnd
            ]
        )->count();

        [$usageChange, $usageTrend] = $this->calculateTrend(
            $currentMonthVisits,
            $lastMonthUsage
        );

        $usedApplications = Application::whereHas(
            'visits'
        )->count();

        /*
        |--------------------------------------------------------------------------
        | TREN PER BULAN (DEFAULT 6 BULAN TERAKHIR)
        |--------------------------------------------------------------------------
        |
        | Rentang lain dimuat lewat endpoint visitsTrend() oleh filter di grafik.
        |
        */

        $trend = $this->buildMonthlyTrend(
            $sixMonthStart,
            $currentMonthEnd
        );

        $sixMonthTotal = $trend['total'];

        $averagePerMonth = $trend['average'];

        /*
        |--------------------------------------------------------------------------
        | PENGGUNAAN PER APLIKASI
        |--------------------------------------------------------------------------
        |
        | Semua hitungan diambil dalam satu query (tanpa query per aplikasi).
        |
        */

        $applicationUsage = Application::withCount([
            'visits' => fn ($query) => $query->whereBetween(
                'visited_at',
                [$sixMonthStart, $currentMonthEnd]
            ),
            'visits as current_month_visits' => fn ($query) => $query->whereBetween(
                'visited_at',
                [$currentMonthStart, $currentMonthEnd]
            ),
            'visits as last_month_visits' => fn ($query) => $query->whereBetween(
                'visited_at',
                [$lastMonthStart, $lastMonthEnd]
            ),
        ])
            ->orderByDesc('visits_count')
            ->orderBy('name')
            ->get();

        foreach ($applicationUsage as $application) {
            [$applicationChange, $applicationTrend] = $this->calculateTrend(
                $application->current_month_visits,
                $application->last_month_visits
            );

            $application->usage_change = $applicationChange;

            $application->usage_trend = $applicationTrend;
        }

        $veryActiveApplications = $applicationUsage
            ->sortByDesc('visits_count')
            ->take(5)
            ->values();

        $rarelyUsedApplications = $applicationUsage
            ->sortBy('visits_count')
            ->take(5)
            ->values();

        $mostActiveCount = $veryActiveApplications->max(
            'visits_count'
        ) ?? 0;

        return view(
            'superadmin.dashboard',
            compact(
                'totalApplications',
                'activeApplications',
                'inactiveApplications',
                'currentMonthVisits',
                'lastMonthUsage',
                'usageChange',
                'usageTrend',
                'usedApplications',
                'trend',
                'sixMonthTotal',
                'averagePerMonth',
                'veryActiveApplications',
                'rarelyUsedApplications',
                'mostActiveCount'
            )
        );
    }

    /**
     * Data tren kunjungan per bulan untuk filter rentang waktu (JSON).
     *
     * Parameter:
     * - range = 3 | 6 | 12 | ytd
     * - atau from & to dengan format YYYY-MM (rentang kustom, maks. 24 bulan)
     */
    public function visitsTrend(Request $request)
    {
        $validated = $request->validate([
            'range' => ['nullable', 'in:3,6,12,ytd'],
            'from' => ['nullable', 'required_with:to', 'date_format:Y-m'],
            'to' => ['nullable', 'required_with:from', 'date_format:Y-m'],
        ]);

        $now = Carbon::now();

        $end = $now->copy()->endOfMonth();

        if (!empty($validated['from'])) {
            // "!" mereset tanggal ke 1 (tanpa itu tanggal 31 bisa meluber ke bulan berikutnya)
            $start = Carbon::createFromFormat('!Y-m', $validated['from'])->startOfMonth();

            $end = Carbon::createFromFormat('!Y-m', $validated['to'])->endOfMonth();

            if ($start->greaterThan($end)) {
                [$start, $end] = [
                    $end->copy()->startOfMonth(),
                    $start->copy()->endOfMonth(),
                ];
            }

            // Batasi 24 bulan supaya grafik tetap terbaca
            if ($start->diffInMonths($end) >= 24) {
                $start = $end->copy()->subMonthsNoOverflow(23)->startOfMonth();
            }
        } elseif (($validated['range'] ?? null) === 'ytd') {
            $start = $now->copy()->startOfYear();
        } else {
            $months = (int) ($validated['range'] ?? 6);

            $start = $now->copy()
                ->subMonthsNoOverflow($months - 1)
                ->startOfMonth();
        }

        return response()->json(
            $this->buildMonthlyTrend($start, $end)
        );
    }

    /**
     * Jumlah kunjungan per bulan dalam rentang [$start, $end].
     *
     * Diambil dengan satu query yang dikelompokkan per bulan,
     * bulan tanpa kunjungan tetap ditampilkan dengan nilai 0.
     */
    private function buildMonthlyTrend(Carbon $start, Carbon $end): array
    {
        $monthExpression = DB::connection()->getDriverName() === 'sqlite'
            ? "strftime('%Y-%m', visited_at)"
            : "DATE_FORMAT(visited_at, '%Y-%m')";

        $totals = ApplicationVisit::query()
            ->whereBetween('visited_at', [$start, $end])
            ->selectRaw("{$monthExpression} as month_key, COUNT(*) as total")
            ->groupBy('month_key')
            ->pluck('total', 'month_key');

        $spansMultipleYears = $start->year !== $end->year;

        $currentMonthKey = Carbon::now()->format('Y-m');

        $months = [];

        $cursor = $start->copy()->startOfMonth();

        while ($cursor->lessThanOrEqualTo($end)) {
            $key = $cursor->format('Y-m');

            $localized = $cursor->copy()->locale('id');

            $months[] = [
                'key' => $key,
                'label' => $spansMultipleYears
                    ? $localized->translatedFormat("M 'y")
                    : $localized->translatedFormat('M'),
                'full_label' => $localized->translatedFormat('F Y'),
                'total' => (int) ($totals[$key] ?? 0),
                'is_current' => $key === $currentMonthKey,
            ];

            $cursor->addMonthNoOverflow();
        }

        $total = array_sum(array_column($months, 'total'));

        return [
            'months' => $months,
            'total' => $total,
            'average' => count($months) > 0
                ? (int) round($total / count($months))
                : 0,
            'from' => $start->format('Y-m'),
            'to' => $end->format('Y-m'),
            'period_label' => $start->copy()->locale('id')->translatedFormat('F Y')
                . ' – '
                . $end->copy()->locale('id')->translatedFormat('F Y'),
        ];
    }

    /**
     * Persentase perubahan dan arah tren.
     *
     * Tren: up / down / same, atau "new" jika bulan lalu 0 dan bulan ini
     * ada kunjungan (persentase tidak bermakna untuk kasus ini).
     */
    private function calculateTrend(int $current, int $previous): array
    {
        if ($previous === 0) {
            return $current > 0
                ? [null, 'new']
                : [0, 'same'];
        }

        $change = round(
            (($current - $previous) / $previous) * 100,
            1
        );

        $trend = match (true) {
            $change > 0 => 'up',
            $change < 0 => 'down',
            default => 'same',
        };

        return [$change, $trend];
    }
}
