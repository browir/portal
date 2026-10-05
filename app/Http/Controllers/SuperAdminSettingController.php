<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuperAdminSettingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | HALAMAN PENGATURAN
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return view('superadmin.settings', [
            'logoUrl' => Setting::logoUrl(),
            'hasCustomLogo' => Setting::customLogoPath() !== null,
            'defaultLogoUrl' => asset(Setting::DEFAULT_LOGO),
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPLOAD / GANTI LOGO PORTAL
    |--------------------------------------------------------------------------
    |
    | SVG sengaja tidak diizinkan karena bisa berisi script.
    |
    */

    public function updateLogo(Request $request)
    {
        $request->validate(
            [
                'logo' => [
                    'required',
                    'image',
                    'mimes:png,jpg,jpeg,webp',
                    'max:2048',
                ],
            ],
            [
                'logo.required' => 'Pilih file logo terlebih dahulu.',
                'logo.image' => 'File harus berupa gambar.',
                'logo.mimes' => 'Format logo harus PNG, JPG, atau WEBP.',
                'logo.max' => 'Ukuran logo maksimal 2 MB.',
            ]
        );

        $oldPath = Setting::customLogoPath();

        $path = $request
            ->file('logo')
            ->store('branding', 'public');

        Setting::set(Setting::PORTAL_LOGO, $path);

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        AppIconController::clearCache();

        return redirect()
            ->route('superadmin.settings')
            ->with('success', 'Logo portal berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | KEMBALIKAN KE LOGO BAWAAN
    |--------------------------------------------------------------------------
    */

    public function resetLogo()
    {
        $oldPath = Setting::customLogoPath();

        Setting::forget(Setting::PORTAL_LOGO);

        if ($oldPath) {
            Storage::disk('public')->delete($oldPath);
        }

        AppIconController::clearCache();

        return redirect()
            ->route('superadmin.settings')
            ->with('success', 'Logo portal dikembalikan ke logo bawaan.');
    }
}
