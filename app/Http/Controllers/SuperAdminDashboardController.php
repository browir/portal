<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\ApplicationVisit;
use Carbon\Carbon;

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
        | TREN 6 BULAN TERAKHIR
        |--------------------------------------------------------------------------
        */

        $months = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = $now->copy()->subMonthsNoOverflow($i);

            $months[] = [
                'label' => $month->locale('id')->translatedFormat('M'),
                'full_label' => $month->locale('id')->translatedFormat('F Y'),
                'total' => ApplicationVisit::whereBetween(
                    'visited_at',
                    [
                        $month->copy()->startOfMonth(),
                        $month->copy()->endOfMonth()
                    ]
                )->count(),
            ];
        }

        $sixMonthTotal = array_sum(
            array_column($months, 'total')
        );

        $averagePerMonth = (int) round($sixMonthTotal / 6);

        $chart = $this->buildChart($months);

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
            [$change, $trend] = $this->calculateTrend(
                $application->current_month_visits,
                $application->last_month_visits
            );

            $application->usage_change = $change;

            $application->usage_trend = $trend;
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
                'months',
                'sixMonthTotal',
                'averagePerMonth',
                'chart',
                'veryActiveApplications',
                'rarelyUsedApplications',
                'mostActiveCount'
            )
        );
    }

    /**
     * Persentase perubahan dan arah tren (up / down / same).
     */
    private function calculateTrend(int $current, int $previous): array
    {
        if ($previous > 0) {
            $change = round(
                (($current - $previous) / $previous) * 100,
                1
            );
        } elseif ($current > 0) {
            $change = 100;
        } else {
            $change = 0;
        }

        $trend = match (true) {
            $change > 0 => 'up',
            $change < 0 => 'down',
            default => 'same',
        };

        return [$change, $trend];
    }

    /**
     * Koordinat grafik garis untuk SVG (viewBox 640 x 240).
     */
    private function buildChart(array $months): array
    {
        $width = 640;
        $height = 240;
        $paddingLeft = 40;
        $paddingRight = 20;
        $paddingTop = 28;
        $paddingBottom = 34;

        $maxValue = max(array_column($months, 'total') ?: [0]);

        // Bulatkan batas atas sumbu Y ke kelipatan 4 supaya label gridnya rapi
        $yMax = max(4, (int) ceil($maxValue / 4) * 4);

        $plotWidth = $width - $paddingLeft - $paddingRight;
        $plotHeight = $height - $paddingTop - $paddingBottom;
        $bottom = $paddingTop + $plotHeight;

        $step = count($months) > 1
            ? $plotWidth / (count($months) - 1)
            : 0;

        $points = [];

        foreach ($months as $index => $month) {
            $points[] = [
                'x' => round($paddingLeft + ($index * $step), 2),
                'y' => round($bottom - (($month['total'] / $yMax) * $plotHeight), 2),
                'total' => $month['total'],
                'label' => $month['label'],
                'full_label' => $month['full_label'],
            ];
        }

        $gridLines = [];

        for ($i = 0; $i <= 4; $i++) {
            $gridLines[] = [
                'y' => round($bottom - (($i / 4) * $plotHeight), 2),
                'value' => (int) ($yMax * $i / 4),
            ];
        }

        $line = collect($points)
            ->map(fn ($point) => $point['x'] . ',' . $point['y'])
            ->implode(' ');

        $first = $points[0] ?? ['x' => $paddingLeft];
        $last = end($points) ?: ['x' => $paddingLeft];

        $area = $line
            . ' ' . $last['x'] . ',' . $bottom
            . ' ' . $first['x'] . ',' . $bottom;

        return [
            'width' => $width,
            'height' => $height,
            'left' => $paddingLeft,
            'right' => $width - $paddingRight,
            'bottom' => $bottom,
            'points' => $points,
            'grid' => $gridLines,
            'line' => $line,
            'area' => $area,
        ];
    }
}
