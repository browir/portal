<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Throwable;

/*
|--------------------------------------------------------------------------
| IKON APLIKASI & PWA
|--------------------------------------------------------------------------
|
| Favicon, apple-touch-icon, dan ikon PWA dibuat otomatis dari logo portal
| (Pengaturan > Logo). Logo diletakkan di tengah kanvas persegi berlatar
| putih, lalu hasilnya di-cache di storage/app/app-icons.
|
*/

class AppIconController extends Controller
{
    /**
     * nama ikon => [ukuran px, padding (rasio dari sisi kanvas)]
     *
     * Ikon maskable butuh padding lebih besar supaya logo tetap di dalam
     * "safe zone" (lingkaran 80%) saat dipotong oleh launcher Android.
     */
    public const ICONS = [
        'favicon-32' => [32, 0.04],
        'apple-touch-icon' => [180, 0.10],
        'icon-192' => [192, 0.08],
        'icon-512' => [512, 0.08],
        'maskable-512' => [512, 0.20],
    ];

    private const BACKGROUND = [255, 255, 255];

    public function icon(string $name)
    {
        abort_unless(isset(self::ICONS[$name]), 404);

        [$size, $padding] = self::ICONS[$name];

        $source = Setting::logoFilePath();
        $target = self::cacheDir() . '/' . Setting::logoVersion() . "-{$name}.png";

        if (! is_file($target) && ! $this->generate($source, $target, $size, $padding)) {
            // GD tidak tersedia / gambar gagal dibaca: pakai logo apa adanya.
            return redirect(Setting::logoUrl());
        }

        return response()->file($target, [
            'Content-Type' => 'image/png',
            'Cache-Control' => 'public, max-age=604800',
        ]);
    }

    public function manifest()
    {
        $version = Setting::logoVersion();

        $icon = fn (string $name, string $purpose) => [
            'src' => route('app-icon', $name) . '?v=' . $version,
            'sizes' => self::ICONS[$name][0] . 'x' . self::ICONS[$name][0],
            'type' => 'image/png',
            'purpose' => $purpose,
        ];

        return response()->json([
            'id' => route('applications.index'),
            'name' => 'Portal Aplikasi RSU Syifa Medika',
            'short_name' => 'Portal Syifa',
            'description' => 'Pusat akses terpadu seluruh aplikasi Syifa Global Group.',
            'lang' => 'id',
            'start_url' => route('applications.index'),
            'scope' => url('/') . '/',
            'display' => 'standalone',
            'background_color' => '#ffffff',
            'theme_color' => '#3b5d44',
            'icons' => [
                $icon('icon-192', 'any'),
                $icon('icon-512', 'any'),
                $icon('maskable-512', 'maskable'),
            ],
        ], 200, [
            'Content-Type' => 'application/manifest+json',
            'Cache-Control' => 'no-cache',
        ], JSON_UNESCAPED_SLASHES);
    }

    /**
     * Hapus semua ikon hasil generate (dipanggil saat logo diganti/di-reset).
     */
    public static function clearCache(): void
    {
        File::deleteDirectory(self::cacheDir());
    }

    private static function cacheDir(): string
    {
        return storage_path('app/app-icons');
    }

    private function generate(string $source, string $target, int $size, float $padding): bool
    {
        if (! function_exists('imagecreatefromstring') || ! is_file($source)) {
            return false;
        }

        try {
            $logo = @imagecreatefromstring(file_get_contents($source));

            if (! $logo) {
                return false;
            }

            $logoWidth = imagesx($logo);
            $logoHeight = imagesy($logo);

            // Skala logo agar muat di area dalam kanvas, pertahankan rasio.
            $inner = $size * (1 - 2 * $padding);
            $scale = min($inner / $logoWidth, $inner / $logoHeight);
            $width = max(1, (int) round($logoWidth * $scale));
            $height = max(1, (int) round($logoHeight * $scale));

            $canvas = imagecreatetruecolor($size, $size);
            imagefill($canvas, 0, 0, imagecolorallocate($canvas, ...self::BACKGROUND));
            imagealphablending($canvas, true);

            imagecopyresampled(
                $canvas,
                $logo,
                (int) (($size - $width) / 2),
                (int) (($size - $height) / 2),
                0,
                0,
                $width,
                $height,
                $logoWidth,
                $logoHeight
            );

            File::ensureDirectoryExists(dirname($target));

            $ok = imagepng($canvas, $target);

            imagedestroy($canvas);
            imagedestroy($logo);

            return $ok;
        } catch (Throwable) {
            return false;
        }
    }
}
