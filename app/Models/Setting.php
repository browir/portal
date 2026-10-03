<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Throwable;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    private const CACHE_KEY = 'settings.all';

    public const PORTAL_LOGO = 'portal_logo';

    public const DEFAULT_LOGO = 'images/logo-new.png';

    /**
     * Ambil nilai pengaturan. Semua pengaturan di-cache sekaligus.
     *
     * Jika tabel belum ada (migration belum dijalankan), kembalikan default
     * supaya halaman tetap tampil.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        try {
            $settings = Cache::rememberForever(
                self::CACHE_KEY,
                fn () => static::query()->pluck('value', 'key')->all()
            );
        } catch (Throwable) {
            return $default;
        }

        return $settings[$key] ?? $default;
    }

    public static function set(string $key, mixed $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        Cache::forget(self::CACHE_KEY);
    }

    public static function forget(string $key): void
    {
        static::query()->where('key', $key)->delete();

        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Path logo custom di disk public, atau null jika memakai logo bawaan.
     */
    public static function customLogoPath(): ?string
    {
        $path = static::get(self::PORTAL_LOGO);

        return $path && Storage::disk('public')->exists($path)
            ? $path
            : null;
    }

    /**
     * URL logo portal yang dipakai di header halaman publik & admin.
     */
    public static function logoUrl(): string
    {
        $path = static::customLogoPath();

        return $path
            ? asset('storage/' . $path)
            : asset(self::DEFAULT_LOGO);
    }
}
