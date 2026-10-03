<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class SuperAdminApplicationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | KELOLA APLIKASI
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | SEARCH APLIKASI
        |--------------------------------------------------------------------------
        |
        | Pencarian (nama, URL, deskripsi), filter status, dan urutan
        | dilakukan di browser. ?search= hanya dipakai sebagai nilai awal
        | kolom pencarian, jadi semua aplikasi tetap dikirim ke halaman
        | supaya jumlah di tab filter selalu benar.
        |
        */

        $search = trim(
            $request->input('search', '')
        );

        $applications = Application::query()
            ->withCount('visits')
            ->orderBy('name')
            ->get();

        return view(
            'superadmin.applications.index',
            compact(
                'applications',
                'search'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SEMUA APLIKASI
    |--------------------------------------------------------------------------
    */

    public function allApplications(Request $request)
    {
        $search = trim(
            $request->input('search', '')
        );

        $totalApplications = Application::count();

        $activeApplications = Application::where(
            'is_active',
            true
        )->count();

        $inactiveApplications = Application::where(
            'is_active',
            false
        )->count();

        $applications = Application::query()
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where(
                        'name',
                        'like',
                        '%' . $search . '%'
                    )
                    ->orWhere(
                        'description',
                        'like',
                        '%' . $search . '%'
                    );
                });
            })
            ->orderBy('name')
            ->get();

        return view(
            'superadmin.applications.all',
            compact(
                'applications',
                'search',
                'totalApplications',
                'activeApplications',
                'inactiveApplications'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | TAMBAH APLIKASI
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        return view(
            'superadmin.applications.create'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | SIMPAN APLIKASI
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'url' => [
                'required',
                'url',
                'max:2048'
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'icon' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048'
            ],

            'is_active' => [
                'nullable',
                'boolean'
            ],
        ]);

        $validated['is_active'] =
            $request->has('is_active');

        /*
        |--------------------------------------------------------------------------
        | APLIKASI BARU
        |--------------------------------------------------------------------------
        |
        | Aplikasi baru mendapatkan badge NEW
        | selama 7 hari.
        |
        */

        $validated['notification_type'] = 'new';

        $validated['notification_expires_at'] =
            Carbon::now()->addDays(7);

        /*
        |--------------------------------------------------------------------------
        | UPLOAD LOGO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon')) {
            $validated['icon'] =
                $request
                    ->file('icon')
                    ->store(
                        'applications',
                        'public'
                    );
        }

        Application::create($validated);

        return redirect()
            ->route(
                'superadmin.applications.index'
            )
            ->with(
                'success',
                'Aplikasi "' . $validated['name'] . '" berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT APLIKASI
    |--------------------------------------------------------------------------
    */

    public function edit(Application $application)
    {
        return view(
            'superadmin.applications.edit',
            compact('application')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE APLIKASI
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Application $application
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255'
            ],

            'url' => [
                'required',
                'url',
                'max:2048'
            ],

            'description' => [
                'nullable',
                'string',
                'max:1000'
            ],

            'icon' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,svg',
                'max:2048'
            ],

            'is_active' => [
                'nullable',
                'boolean'
            ],

            'notification_type' => [
                'nullable',
                'in:new,updated'
            ],
        ]);

        $validated['is_active'] =
            $request->has('is_active');

        /*
        |--------------------------------------------------------------------------
        | PEMBERITAHUAN
        |--------------------------------------------------------------------------
        */

        $notificationType =
            $request->input(
                'notification_type'
            );

        if (
            $notificationType === 'new'
            || $notificationType === 'updated'
        ) {
            $validated['notification_type'] =
                $notificationType;

            $validated['notification_expires_at'] =
                Carbon::now()->addDays(7);
        } else {
            $validated['notification_type'] = null;

            $validated['notification_expires_at'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | UPLOAD LOGO BARU
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('icon')) {
            if ($application->icon) {
                Storage::disk('public')->delete(
                    $application->icon
                );
            }

            $validated['icon'] =
                $request
                    ->file('icon')
                    ->store(
                        'applications',
                        'public'
                    );
        }

        $application->update($validated);

        return redirect()
            ->route(
                'superadmin.applications.index'
            )
            ->with(
                'success',
                'Aplikasi "' . $application->name . '" berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS APLIKASI
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Application $application
    ) {
        if ($application->icon) {
            Storage::disk('public')->delete(
                $application->icon
            );
        }

        $application->delete();

        // Kembali ke halaman sebelumnya supaya filter/pencarian tidak hilang
        return redirect()
            ->back(fallback: route('superadmin.applications.index'))
            ->with(
                'success',
                'Aplikasi "' . $application->name . '" berhasil dihapus.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | TOGGLE STATUS
    |--------------------------------------------------------------------------
    |
    | Dipanggil lewat fetch (JSON) dari halaman Kelola Aplikasi supaya
    | tidak reload. Tanpa JavaScript tetap bekerja lewat submit form biasa.
    |
    */

    public function toggleStatus(
        Request $request,
        Application $application
    ) {
        $application->update([
            'is_active' => ! $application->is_active,
        ]);

        $message = $application->is_active
            ? 'Aplikasi "' . $application->name . '" diaktifkan dan tampil di portal.'
            : 'Aplikasi "' . $application->name . '" dinonaktifkan dan disembunyikan dari portal.';

        if ($request->expectsJson()) {
            return response()->json([
                'is_active' => $application->is_active,
                'message' => $message,
            ]);
        }

        return redirect()
            ->back(fallback: route('superadmin.applications.index'))
            ->with('success', $message);
    }
}
