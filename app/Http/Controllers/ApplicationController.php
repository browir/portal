<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $search = trim(
            $request->input('search', '')
        );

        $applications = Application::query()
            ->where('is_active', true)
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

        /*
        |--------------------------------------------------------------------------
        | PEMBERITAHUAN AKTIF
        |--------------------------------------------------------------------------
        |
        | Badge hanya boleh muncul jika:
        |
        | 1. notification_type ada
        | 2. notification_expires_at belum lewat
        |
        */

        foreach ($applications as $application) {
            if (
                !$application->hasActiveNotification()
            ) {
                $application->notification_type = null;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | APLIKASI POPULER
        |--------------------------------------------------------------------------
        */

        $popularApplications = Application::query()
            ->where('is_active', true)
            ->withCount('visits')
            ->orderByDesc('visits_count')
            ->orderBy('name')
            ->take(3)
            ->get();

        foreach ($popularApplications as $application) {
            if (
                !$application->hasActiveNotification()
            ) {
                $application->notification_type = null;
            }
        }

        return view(
            'applications.index',
            compact(
                'applications',
                'popularApplications',
                'search'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | LIVE SEARCH
    |--------------------------------------------------------------------------
    |
    | Endpoint ini digunakan oleh JavaScript ketika user mengetik
    | pada kolom pencarian.
    |
    */

    public function search(Request $request)
    {
        $search = trim(
            $request->input('search', '')
        );

        /*
        |--------------------------------------------------------------------------
        | Jika pencarian kosong
        |--------------------------------------------------------------------------
        */

        if ($search === '') {
            return response()->json([]);
        }

        /*
        |--------------------------------------------------------------------------
        | Cari aplikasi berdasarkan nama atau deskripsi
        |--------------------------------------------------------------------------
        */

        $applications = Application::query()
            ->where('is_active', true)
            ->where(function ($query) use ($search) {
                $query->where(
                    'name',
                    'like',
                    '%' . $search . '%'
                )
                ->orWhere(
                    'description',
                    'like',
                    '%' . $search . '%'
                );
            })
            ->orderBy('name')
            ->get([
                'id',
                'name',
                'description',
                'icon',
                'notification_type',
                'notification_expires_at',
            ]);

        /*
        |--------------------------------------------------------------------------
        | HANYA TAMPILKAN BADGE YANG MASIH BERLAKU
        |--------------------------------------------------------------------------
        */

        foreach ($applications as $application) {
            if (
                !$application->hasActiveNotification()
            ) {
                $application->notification_type = null;
            }
        }

        return response()->json(
            $applications
        );
    }

    /*
    |--------------------------------------------------------------------------
    | APLIKASI POPULER
    |--------------------------------------------------------------------------
    */

    public function popular()
    {
        $applications = Application::query()
            ->where('is_active', true)
            ->withCount('visits')
            ->orderByDesc('visits_count')
            ->orderBy('name')
            ->take(3)
            ->get([
                'id',
                'name',
                'description',
                'icon',
                'notification_type',
                'notification_expires_at',
            ]);

        /*
        |--------------------------------------------------------------------------
        | HANYA TAMPILKAN BADGE YANG MASIH BERLAKU
        |--------------------------------------------------------------------------
        */

        foreach ($applications as $application) {
            if (
                !$application->hasActiveNotification()
            ) {
                $application->notification_type = null;
            }
        }

        return response()->json(
            $applications
        );
    }
}
