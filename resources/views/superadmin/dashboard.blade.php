@extends('layouts.superadmin')

@section('title', 'Dashboard - Super Admin')

@push('styles')
<style>
    .dashboard-page {
        --brand-900: #2d4a37;
        --brand-700: #3b5d44;
        --brand-500: #5b8266;
        --brand-100: #d2e3d7;
        --brand-50: #eef5f0;
        --accent: #0d8a72;
        --ink: #172033;
        --muted: #64748b;
        --line: #e5eaf0;
        --up: #15803d;
        --up-bg: #dcfce7;
        --down: #b91c1c;
        --down-bg: #fee2e2;

        width: 100%;
        min-height: calc(100vh - 50px);
        padding: 24px 28px 40px;
        background: #f4f7f5;
    }


    /* =========================
       HERO
    ========================= */

    .dashboard-hero {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 20px;
        padding: 28px 30px 64px;
        border-radius: 20px;
        color: #ffffff;
        background:
            linear-gradient(115deg, rgba(45, 74, 55, .96) 0%, rgba(59, 93, 68, .90) 45%, rgba(91, 130, 102, .70) 100%),
            url("{{ asset('images/rs.jpeg') }}") center 35% / cover no-repeat;
    }

    .hero-date {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 10px;
        font-size: 12px;
        font-weight: 500;
        color: rgba(255, 255, 255, .8);
    }

    .dashboard-hero h1 {
        margin-bottom: 6px;
        font-size: 26px;
        line-height: 1.2;
        font-weight: 700;
    }

    .dashboard-hero p {
        font-size: 14px;
        color: rgba(255, 255, 255, .85);
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: 40px;
        padding: 0 16px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        transition: background-color .2s ease, transform .2s ease;
    }

    .btn svg,
    .icon {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .btn-primary {
        background: #ffffff;
        color: var(--brand-900);
    }

    .btn-primary:hover {
        background: var(--brand-50);
    }

    .btn-ghost {
        background: rgba(255, 255, 255, .14);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, .3);
    }

    .btn-ghost:hover {
        background: rgba(255, 255, 255, .24);
    }


    /* =========================
       KARTU KPI
    ========================= */

    .kpi-grid {
        position: relative;
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin: -40px 18px 22px;
    }

    .kpi-card {
        display: flex;
        flex-direction: column;
        gap: 12px;
        padding: 18px;
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid var(--line);
        box-shadow: 0 10px 24px -14px rgba(15, 23, 42, .25);
    }

    .kpi-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .kpi-label {
        font-size: 13px;
        font-weight: 500;
        color: var(--muted);
    }

    .kpi-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 11px;
        background: var(--brand-50);
        color: var(--brand-700);
    }

    .kpi-icon .icon {
        width: 19px;
        height: 19px;
    }

    .kpi-icon.is-blue   { background: #e0ecff; color: #1d4ed8; }
    .kpi-icon.is-gray   { background: #f1f5f9; color: #475569; }
    .kpi-icon.is-accent { background: #dff5ef; color: var(--accent); }
    .kpi-icon.is-warn   { background: #fef3c7; color: #b45309; }

    .kpi-value {
        font-size: 32px;
        line-height: 1;
        font-weight: 700;
        color: var(--ink);
    }

    .kpi-foot {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
        font-size: 12px;
        color: var(--muted);
    }

    .kpi-link {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        color: var(--accent);
        font-weight: 600;
        text-decoration: none;
    }

    .kpi-link:hover {
        text-decoration: underline;
    }

    .kpi-link .icon {
        width: 14px;
        height: 14px;
    }

    .meter {
        width: 100%;
        height: 6px;
        overflow: hidden;
        border-radius: 999px;
        background: #edf1f4;
    }

    .meter span {
        display: block;
        height: 100%;
        border-radius: inherit;
        background: var(--brand-500);
    }


    /* ---------- CHIP TREN ---------- */

    .trend-chip {
        display: inline-flex;
        align-items: center;
        gap: 3px;
        height: 22px;
        padding: 0 8px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    .trend-chip .icon {
        width: 12px;
        height: 12px;
        stroke-width: 2.5;
    }

    .trend-chip.up   { background: var(--up-bg); color: var(--up); }
    .trend-chip.down { background: var(--down-bg); color: var(--down); }
    .trend-chip.same { background: #f1f5f9; color: #475569; }


    /* =========================
       PANEL
    ========================= */

    .dashboard-row {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(0, 1fr);
        gap: 18px;
        margin-bottom: 18px;
    }

    .dashboard-row.is-half {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .panel {
        min-width: 0;
        padding: 20px;
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid var(--line);
    }

    .panel-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 16px;
    }

    .panel-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--ink);
    }

    .panel-subtitle {
        margin-top: 2px;
        font-size: 12px;
        color: var(--muted);
    }

    .panel-stat {
        text-align: right;
    }

    .panel-stat strong {
        display: block;
        font-size: 20px;
        line-height: 1.1;
        color: var(--ink);
    }

    .panel-stat span {
        font-size: 11px;
        color: var(--muted);
    }


    /* ---------- GRAFIK ---------- */

    .chart-wrap {
        position: relative;
    }

    .trend-chart {
        width: 100%;
        height: 250px;
    }

    .trend-chart svg {
        display: block;
        width: 100%;
        height: 100%;
        overflow: visible;
    }

    .trend-chart .grid-line {
        stroke: #edf1f4;
        stroke-width: 1;
    }

    .trend-chart .axis-label {
        fill: #94a3b8;
        font-size: 11px;
    }

    .trend-chart .month-label {
        fill: var(--muted);
        font-size: 12px;
        font-weight: 500;
    }

    .trend-chart .bar {
        fill: #b9d3c1;
        transition: fill .15s ease;
    }

    .trend-chart .bar.is-current {
        fill: var(--brand-500);
    }

    .trend-chart .bar-hover {
        fill: #f1f5f3;
        opacity: 0;
        transition: opacity .15s ease;
    }

    .trend-chart .hit-area {
        fill: transparent;
        cursor: pointer;
    }

    .trend-chart .is-hovered .bar {
        fill: var(--brand-700);
    }

    .trend-chart .is-hovered .bar-hover {
        opacity: 1;
    }

    .trend-chart .bar-value {
        fill: var(--ink);
        font-size: 12px;
        font-weight: 600;
    }

    .chart-wrap.is-loading .trend-chart {
        opacity: .4;
        transition: opacity .2s ease;
    }


    /* ---------- FILTER RENTANG WAKTU ---------- */

    .chart-filter {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .segmented {
        display: inline-flex;
        flex-wrap: wrap;
        gap: 2px;
        padding: 3px;
        border-radius: 10px;
        background: #f1f5f3;
    }

    .segmented button {
        height: 30px;
        padding: 0 12px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: var(--muted);
        font: inherit;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        transition: background-color .15s ease, color .15s ease;
    }

    .segmented button:hover {
        color: var(--ink);
    }

    .segmented button.is-active {
        background: #ffffff;
        color: var(--brand-700);
        font-weight: 600;
        box-shadow: 0 1px 3px rgba(15, 23, 42, .12);
    }

    .custom-range {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
    }

    .custom-range[hidden] {
        display: none;
    }

    .custom-range label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: var(--muted);
    }

    .custom-range input {
        height: 34px;
        padding: 0 8px;
        border: 1px solid var(--line);
        border-radius: 8px;
        background: #ffffff;
        color: var(--ink);
        font: inherit;
        font-size: 12px;
    }

    .custom-range input:focus {
        outline: none;
        border-color: var(--brand-500);
        box-shadow: 0 0 0 3px rgba(91, 130, 102, .18);
    }

    .btn-apply {
        height: 34px;
        padding: 0 14px;
        border: 0;
        border-radius: 8px;
        background: var(--brand-700);
        color: #ffffff;
        font: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-apply:hover {
        background: var(--brand-900);
    }

    .chart-error {
        margin-bottom: 10px;
        font-size: 12px;
        color: var(--down);
    }

    .chart-error[hidden] {
        display: none;
    }

    .chart-tooltip {
        position: absolute;
        z-index: 2;
        padding: 7px 11px;
        border-radius: 8px;
        background: var(--ink);
        color: #ffffff;
        font-size: 12px;
        line-height: 1.35;
        white-space: nowrap;
        pointer-events: none;
        transform: translate(-50%, calc(-100% - 12px));
        box-shadow: 0 8px 20px -8px rgba(15, 23, 42, .5);
    }

    .chart-tooltip strong {
        display: block;
        font-size: 13px;
    }

    .trend-chart .month-label.is-current {
        fill: var(--brand-700);
        font-weight: 700;
    }

    .chart-empty {
        position: absolute;
        inset: 0 0 28px 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
    }

    .chart-empty[hidden] {
        display: none;
    }

    .chart-empty span {
        padding: 8px 14px;
        border-radius: 999px;
        background: #ffffff;
        border: 1px solid var(--line);
        font-size: 12px;
        color: var(--muted);
    }


    /* ---------- RINGKASAN ---------- */

    .summary-list {
        display: flex;
        flex-direction: column;
    }

    .summary-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 14px 0;
        border-bottom: 1px solid #f0f3f6;
    }

    .summary-item:first-child {
        padding-top: 0;
    }

    .summary-item:last-child {
        padding-bottom: 0;
        border-bottom: 0;
    }

    .summary-item .kpi-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
    }

    .summary-info {
        flex: 1;
        min-width: 0;
    }

    .summary-label {
        font-size: 12px;
        color: var(--muted);
    }

    .summary-value {
        font-size: 18px;
        font-weight: 700;
        color: var(--ink);
    }

    .summary-value small {
        font-size: 12px;
        font-weight: 500;
        color: var(--muted);
    }

    .summary-item .meter {
        margin-top: 6px;
    }


    /* ---------- DAFTAR AKTIVITAS ---------- */

    .activity-list {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .activity-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        margin: 0 -10px;
        border-radius: 12px;
        text-decoration: none;
        color: inherit;
        transition: background-color .2s ease;
    }

    .activity-item:hover {
        background: #f6f9f7;
    }

    .activity-rank {
        width: 22px;
        flex-shrink: 0;
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        color: #94a3b8;
    }

    .activity-logo {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 11px;
        background: #f6f8fa;
        border: 1px solid var(--line);
        font-size: 16px;
        font-weight: 700;
        color: var(--brand-700);
    }

    .activity-logo img {
        width: 80%;
        height: 80%;
        object-fit: contain;
    }

    .activity-info {
        flex: 1;
        min-width: 0;
    }

    .activity-name-row {
        display: flex;
        align-items: center;
        gap: 6px;
        min-width: 0;
    }

    .activity-name {
        font-size: 13px;
        font-weight: 600;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .status-tag {
        flex-shrink: 0;
        padding: 1px 7px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #64748b;
        font-size: 10px;
        font-weight: 600;
    }

    .activity-item .meter {
        height: 5px;
        margin-top: 7px;
    }

    .meter.is-muted span {
        background: #a5b4c3;
    }

    .activity-meta {
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 4px;
    }

    .activity-count {
        font-size: 13px;
        font-weight: 700;
        color: var(--ink);
    }

    .activity-count small {
        font-size: 11px;
        font-weight: 500;
        color: var(--muted);
    }

    .panel-empty {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 28px 16px;
        border: 1.5px dashed var(--line);
        border-radius: 12px;
        text-align: center;
        font-size: 13px;
        color: var(--muted);
    }

    .panel-empty .icon {
        width: 24px;
        height: 24px;
        color: #94a3b8;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1180px) {

        .kpi-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }

    @media (max-width: 1000px) {

        .dashboard-row,
        .dashboard-row.is-half {
            grid-template-columns: minmax(0, 1fr);
        }

    }

    @media (max-width: 768px) {

        .dashboard-page {
            min-height: calc(100vh - 108px);
            padding: 16px 14px 32px;
        }

        .dashboard-hero {
            padding: 22px 20px 58px;
            border-radius: 16px;
        }

        .dashboard-hero h1 {
            font-size: 21px;
        }

        .dashboard-hero p {
            font-size: 13px;
        }

        .kpi-grid {
            gap: 12px;
            margin: -40px 8px 16px;
        }

        .kpi-card {
            padding: 14px;
        }

        .kpi-value {
            font-size: 26px;
        }

        .panel {
            padding: 16px;
        }

        .trend-chart {
            height: 220px;
        }

    }

    @media (max-width: 420px) {

        .hero-actions,
        .hero-actions .btn {
            width: 100%;
        }

        .hero-actions .btn {
            justify-content: center;
        }

        .kpi-icon {
            width: 32px;
            height: 32px;
        }

        .kpi-label {
            font-size: 12px;
        }

    }
</style>
@endpush

@section('content')

@php
    $adminName = auth()->user()?->name ?? 'Super Admin';

    $activePercentage = $totalApplications > 0
        ? round(($activeApplications / $totalApplications) * 100)
        : 0;

    $usedPercentage = $totalApplications > 0
        ? round(($usedApplications / $totalApplications) * 100)
        : 0;

    $notUsedApplications = max(0, $totalApplications - $usedApplications);

    $trendIcons = [
        'up' => '<polyline points="18 15 12 9 6 15"></polyline>',
        'new' => '<polyline points="18 15 12 9 6 15"></polyline>',
        'down' => '<polyline points="6 9 12 15 18 9"></polyline>',
        'same' => '<line x1="6" y1="12" x2="18" y2="12"></line>',
    ];

    // Teks chip tren: "Baru" jika bulan lalu 0, selain itu persentase
    $trendText = fn ($trend, $change) => match ($trend) {
        'new' => 'Baru',
        'same' => '0%',
        default => abs($change) . '%',
    };
@endphp

<div class="dashboard-page">


    {{-- =========================================================
         HERO
    ========================================================= --}}

    <section class="dashboard-hero">

        <div>
            <span class="hero-date">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="3" y="4" width="18" height="18" rx="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
                {{ now()->locale('id')->translatedFormat('l, d F Y') }}
            </span>

            <h1>Selamat datang, {{ $adminName }}</h1>

            <p>Pantau dan kelola penggunaan aplikasi Portal Syifa Global Group.</p>
        </div>

        <div class="hero-actions">

            <a
                href="{{ route('applications.index') }}"
                class="btn btn-ghost"
                target="_blank"
                rel="noopener"
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                    <polyline points="15 3 21 3 21 9"></polyline>
                    <line x1="10" y1="14" x2="21" y2="3"></line>
                </svg>
                Lihat Portal
            </a>

            <a
                href="{{ route('superadmin.applications.create') }}"
                class="btn btn-primary"
            >
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Tambah Aplikasi
            </a>

        </div>

    </section>



    {{-- =========================================================
         KPI
    ========================================================= --}}

    <div class="kpi-grid">

        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Total Aplikasi</span>

                <span class="kpi-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                        <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                    </svg>
                </span>
            </div>

            <div class="kpi-value">{{ $totalApplications }}</div>

            <div class="kpi-foot">
                <a href="{{ route('superadmin.applications.index') }}" class="kpi-link">
                    Kelola aplikasi
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </div>
        </div>


        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Aplikasi Aktif</span>

                <span class="kpi-icon is-accent">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                </span>
            </div>

            <div class="kpi-value">{{ $activeApplications }}</div>

            <div>
                <div class="meter" title="{{ $activePercentage }}% aktif">
                    <span style="width: {{ $activePercentage }}%;"></span>
                </div>

                <div class="kpi-foot" style="margin-top: 6px;">
                    {{ $activePercentage }}% tampil di portal
                </div>
            </div>
        </div>


        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Aplikasi Nonaktif</span>

                <span class="kpi-icon is-gray">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                        <line x1="1" y1="1" x2="23" y2="23"></line>
                    </svg>
                </span>
            </div>

            <div class="kpi-value">{{ $inactiveApplications }}</div>

            <div class="kpi-foot">
                Disembunyikan dari portal
            </div>
        </div>


        <div class="kpi-card">
            <div class="kpi-top">
                <span class="kpi-label">Kunjungan Bulan Ini</span>

                <span class="kpi-icon is-blue">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline>
                    </svg>
                </span>
            </div>

            <div class="kpi-value">{{ number_format($currentMonthVisits, 0, ',', '.') }}</div>

            <div class="kpi-foot">
                @if ($usageTrend === 'new')
                    Bulan lalu belum ada kunjungan
                @else
                    <span class="trend-chip {{ $usageTrend }}">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">{!! $trendIcons[$usageTrend] !!}</svg>
                        {{ $trendText($usageTrend, $usageChange) }}
                    </span>
                    vs bulan lalu ({{ number_format($lastMonthUsage, 0, ',', '.') }})
                @endif
            </div>
        </div>

    </div>



    {{-- =========================================================
         GRAFIK & RINGKASAN
    ========================================================= --}}

    <div class="dashboard-row">

        <section class="panel">

            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Tren Kunjungan per Bulan</h2>
                    <p class="panel-subtitle" id="trendPeriod">{{ $trend['period_label'] }}</p>
                </div>

                <div class="panel-stat">
                    <strong id="trendTotal">{{ number_format($trend['total'], 0, ',', '.') }}</strong>
                    <span>
                        total &middot; rata-rata
                        <span id="trendAverage">{{ number_format($trend['average'], 0, ',', '.') }}</span>/bulan
                    </span>
                </div>
            </div>


            {{-- FILTER RENTANG WAKTU --}}
            <div class="chart-filter">

                <div class="segmented" role="group" aria-label="Rentang waktu">
                    <button type="button" data-range="3">3 Bulan</button>
                    <button type="button" data-range="6" class="is-active" aria-pressed="true">6 Bulan</button>
                    <button type="button" data-range="12">12 Bulan</button>
                    <button type="button" data-range="ytd">Tahun Ini</button>
                    <button type="button" data-range="custom">Kustom</button>
                </div>

                <form class="custom-range" id="customRangeForm" hidden>
                    <label>
                        Dari
                        <input
                            type="month"
                            name="from"
                            value="{{ $trend['from'] }}"
                            max="{{ now()->format('Y-m') }}"
                            placeholder="YYYY-MM"
                            required
                        >
                    </label>

                    <label>
                        Sampai
                        <input
                            type="month"
                            name="to"
                            value="{{ $trend['to'] }}"
                            max="{{ now()->format('Y-m') }}"
                            placeholder="YYYY-MM"
                            required
                        >
                    </label>

                    <button type="submit" class="btn-apply">Terapkan</button>
                </form>

            </div>

            <p class="chart-error" id="trendError" hidden>
                Data grafik gagal dimuat. Coba lagi.
            </p>


            <div class="chart-wrap" id="trendChartWrap">

                {{-- Digambar oleh JavaScript sesuai lebar kontainer (lihat @push scripts) --}}
                <div
                    class="trend-chart"
                    id="trendChart"
                    role="img"
                    aria-label="Grafik kunjungan per bulan"
                ></div>

                <div class="chart-tooltip" id="trendChartTooltip" hidden></div>

                <div class="chart-empty" id="trendEmpty" @if ($trend['total'] > 0) hidden @endif>
                    <span>Belum ada kunjungan pada rentang ini</span>
                </div>

            </div>

        </section>


        <section class="panel">

            <div class="panel-head">
                <div>
                    <h2 class="panel-title">Ringkasan</h2>
                    <p class="panel-subtitle">Perbandingan dan cakupan penggunaan</p>
                </div>
            </div>

            <div class="summary-list">

                <div class="summary-item">
                    <span class="kpi-icon is-gray">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                        </svg>
                    </span>

                    <div class="summary-info">
                        <div class="summary-label">Kunjungan bulan lalu</div>
                        <div class="summary-value">{{ number_format($lastMonthUsage, 0, ',', '.') }}</div>
                    </div>
                </div>

                <div class="summary-item">
                    <span class="kpi-icon is-blue">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                    </span>

                    <div class="summary-info">
                        <div class="summary-label">Rata-rata per bulan (6 bulan terakhir)</div>
                        <div class="summary-value">
                            {{ number_format($averagePerMonth, 0, ',', '.') }}
                            <small>kunjungan</small>
                        </div>
                    </div>
                </div>

                <div class="summary-item">
                    <span class="kpi-icon is-accent">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                    </span>

                    <div class="summary-info">
                        <div class="summary-label">Aplikasi pernah dibuka</div>
                        <div class="summary-value">
                            {{ $usedApplications }}
                            <small>dari {{ $totalApplications }} aplikasi</small>
                        </div>

                        <div class="meter" title="{{ $usedPercentage }}%">
                            <span style="width: {{ $usedPercentage }}%;"></span>
                        </div>
                    </div>
                </div>

                <div class="summary-item">
                    <span class="kpi-icon is-warn">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                    </span>

                    <div class="summary-info">
                        <div class="summary-label">Belum pernah dibuka</div>
                        <div class="summary-value">
                            {{ $notUsedApplications }}
                            <small>aplikasi</small>
                        </div>
                    </div>

                    @if ($notUsedApplications > 0)
                        <a href="{{ route('superadmin.applications.index') }}" class="kpi-link">
                            Tinjau
                            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>
                    @endif
                </div>

            </div>

        </section>

    </div>



    {{-- =========================================================
         AKTIVITAS APLIKASI
    ========================================================= --}}

    <div class="dashboard-row is-half">

        @foreach ([
            [
                'title' => 'Paling Sering Digunakan',
                'subtitle' => 'Kunjungan terbanyak, 6 bulan terakhir',
                'items' => $veryActiveApplications,
                'muted' => false,
            ],
            [
                'title' => 'Jarang Digunakan',
                'subtitle' => 'Kunjungan paling sedikit, 6 bulan terakhir',
                'items' => $rarelyUsedApplications,
                'muted' => true,
            ],
        ] as $group)

            <section class="panel">

                <div class="panel-head">
                    <div>
                        <h2 class="panel-title">{{ $group['title'] }}</h2>
                        <p class="panel-subtitle">{{ $group['subtitle'] }}</p>
                    </div>
                </div>

                <div class="activity-list">

                    @forelse ($group['items'] as $application)

                        @php
                            $percentage = $mostActiveCount > 0
                                ? min(100, ($application->visits_count / $mostActiveCount) * 100)
                                : 0;
                        @endphp

                        <a
                            href="{{ route('superadmin.applications.edit', $application) }}"
                            class="activity-item"
                            title="Edit {{ $application->name }}"
                        >

                            <span class="activity-rank">{{ $loop->iteration }}</span>

                            @php
                                $initial = mb_strtoupper(mb_substr($application->name, 0, 1));
                            @endphp

                            <span class="activity-logo" data-initial="{{ $initial }}">
                                @if ($application->icon)
                                    <img
                                        src="{{ asset('storage/' . $application->icon) }}"
                                        alt=""
                                        loading="lazy"
                                        onerror="this.parentElement.textContent = this.parentElement.dataset.initial;"
                                    >
                                @else
                                    {{ $initial }}
                                @endif
                            </span>

                            <span class="activity-info">

                                <span class="activity-name-row">
                                    <span class="activity-name">{{ $application->name }}</span>

                                    @unless ($application->is_active)
                                        <span class="status-tag">Nonaktif</span>
                                    @endunless
                                </span>

                                <span class="meter {{ $group['muted'] ? 'is-muted' : '' }}" style="display: block;">
                                    <span style="width: {{ $percentage }}%;"></span>
                                </span>

                            </span>

                            <span class="activity-meta">

                                <span class="activity-count">
                                    {{ number_format($application->visits_count, 0, ',', '.') }}
                                    <small>kali</small>
                                </span>

                                @if ($application->current_month_visits > 0 || $application->last_month_visits > 0)
                                    <span
                                        class="trend-chip {{ $application->usage_trend === 'new' ? 'up' : $application->usage_trend }}"
                                        title="Bulan ini: {{ $application->current_month_visits }}, bulan lalu: {{ $application->last_month_visits }}"
                                    >
                                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">{!! $trendIcons[$application->usage_trend] !!}</svg>
                                        {{ $trendText($application->usage_trend, $application->usage_change) }}
                                    </span>
                                @endif

                            </span>

                        </a>

                    @empty

                        <div class="panel-empty">
                            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                                <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                                <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                                <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                                <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                            </svg>
                            Belum ada aplikasi.
                            <a href="{{ route('superadmin.applications.create') }}" class="kpi-link">Tambah aplikasi pertama</a>
                        </div>

                    @endforelse

                </div>

            </section>

        @endforeach

    </div>

</div>

@endsection


@push('scripts')
<script>
    /*
    |--------------------------------------------------------------------------
    | GRAFIK TREN KUNJUNGAN PER BULAN + FILTER RENTANG WAKTU
    |--------------------------------------------------------------------------
    |
    | Grafik batang digambar sesuai ukuran asli kontainer supaya teks tidak
    | ikut membesar. Filter memuat data lewat endpoint visits-trend tanpa
    | reload halaman.
    |
    */

    (function () {

        const trendUrl = @json(route('superadmin.dashboard.visits-trend'));

        let trend = @json($trend);

        const wrap = document.getElementById('trendChartWrap');
        const container = document.getElementById('trendChart');
        const tooltip = document.getElementById('trendChartTooltip');
        const emptyState = document.getElementById('trendEmpty');
        const errorText = document.getElementById('trendError');
        const periodText = document.getElementById('trendPeriod');
        const totalText = document.getElementById('trendTotal');
        const averageText = document.getElementById('trendAverage');
        const rangeButtons = document.querySelectorAll('.segmented [data-range]');
        const customForm = document.getElementById('customRangeForm');

        if (!container) {
            return;
        }

        const NS = 'http://www.w3.org/2000/svg';

        const formatNumber = value => Number(value).toLocaleString('id-ID');

        function el(tag, attributes = {}, text = null) {
            const node = document.createElementNS(NS, tag);

            Object.entries(attributes).forEach(([key, value]) => {
                node.setAttribute(key, value);
            });

            if (text !== null) {
                node.textContent = text;
            }

            return node;
        }

        // Batas atas sumbu Y yang rapi (1, 2, 5 x 10^n per garis)
        function getScale(maxValue) {
            if (maxValue <= 4) {
                const yMax = Math.max(maxValue, 1);

                return { yMax, ticks: yMax };
            }

            const rawStep = maxValue / 4;
            const magnitude = 10 ** Math.floor(Math.log10(rawStep));
            const normalized = rawStep / magnitude;
            const niceStep = (normalized <= 1 ? 1 : normalized <= 2 ? 2 : normalized <= 5 ? 5 : 10) * magnitude;

            return { yMax: niceStep * 4, ticks: 4 };
        }

        function showTooltip(month, x, y) {
            tooltip.replaceChildren();

            const strong = document.createElement('strong');
            strong.textContent = `${formatNumber(month.total)} kunjungan`;

            tooltip.append(strong, month.full_label);
            tooltip.style.left = `${x}px`;
            tooltip.style.top = `${y}px`;
            tooltip.hidden = false;
        }

        function hideTooltip() {
            tooltip.hidden = true;
        }


        /*
        |--------------------------------------------------------------------------
        | GAMBAR GRAFIK BATANG
        |--------------------------------------------------------------------------
        */

        function render() {
            const months = trend.months || [];
            const width = container.clientWidth;
            const height = container.clientHeight;

            if (!width || !height || !months.length) {
                container.replaceChildren();
                return;
            }

            const padding = { top: 24, right: 8, bottom: 30, left: 38 };
            const maxValue = Math.max(0, ...months.map(month => month.total));
            const { yMax, ticks } = getScale(maxValue);

            const plotWidth = width - padding.left - padding.right;
            const plotHeight = height - padding.top - padding.bottom;
            const bottom = padding.top + plotHeight;
            const slot = plotWidth / months.length;
            const barWidth = Math.max(6, Math.min(44, slot * 0.6));

            // Label bulan & angka dijarangkan jika kolom terlalu sempit
            const labelEvery = Math.ceil(42 / slot);
            const showValues = slot >= 30;

            const svg = el('svg', {
                width,
                height,
                viewBox: `0 0 ${width} ${height}`,
                'aria-hidden': 'true',
            });

            // Garis grid & label sumbu Y
            for (let tick = 0; tick <= ticks; tick++) {
                const value = (yMax / ticks) * tick;
                const y = bottom - ((value / yMax) * plotHeight);

                svg.append(
                    el('line', { class: 'grid-line', x1: padding.left, x2: width - padding.right, y1: y, y2: y }),
                    el('text', { class: 'axis-label', x: padding.left - 10, y: y + 4, 'text-anchor': 'end' }, formatNumber(Math.round(value)))
                );
            }

            months.forEach((month, index) => {
                const center = padding.left + (slot * index) + (slot / 2);
                const barHeight = (month.total / yMax) * plotHeight;
                const barTop = bottom - barHeight;
                const group = el('g');

                group.append(
                    el('rect', {
                        class: 'bar-hover',
                        x: center - (slot / 2) + 2,
                        y: padding.top - 8,
                        width: Math.max(0, slot - 4),
                        height: plotHeight + 8,
                        rx: 8,
                    })
                );

                if (month.total > 0) {
                    group.append(
                        el('rect', {
                            class: `bar${month.is_current ? ' is-current' : ''}`,
                            x: center - (barWidth / 2),
                            y: barTop,
                            width: barWidth,
                            height: Math.max(barHeight, 2),
                            rx: Math.min(6, barWidth / 3),
                        })
                    );

                    if (showValues) {
                        group.append(
                            el('text', { class: 'bar-value', x: center, y: barTop - 7, 'text-anchor': 'middle' }, formatNumber(month.total))
                        );
                    }
                }

                const isLast = index === months.length - 1;

                if (index % labelEvery === 0 || isLast) {
                    group.append(
                        el('text', {
                            class: `month-label${month.is_current ? ' is-current' : ''}`,
                            x: center,
                            y: bottom + 20,
                            'text-anchor': 'middle',
                        }, month.label)
                    );
                }

                // Area hover/tap selebar satu kolom bulan
                const hitArea = el('rect', {
                    class: 'hit-area',
                    x: center - (slot / 2),
                    y: 0,
                    width: slot,
                    height,
                });

                hitArea.addEventListener('mouseenter', () => {
                    group.classList.add('is-hovered');
                    showTooltip(month, center, Math.min(barTop, bottom - 4));
                });

                hitArea.addEventListener('mouseleave', () => {
                    group.classList.remove('is-hovered');
                    hideTooltip();
                });

                group.append(hitArea);
                svg.append(group);
            });

            container.replaceChildren(svg);

            container.setAttribute(
                'aria-label',
                'Grafik kunjungan per bulan: ' + months
                    .map(month => `${month.full_label} ${month.total}`)
                    .join(', ')
            );
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER RENTANG WAKTU
        |--------------------------------------------------------------------------
        */

        function updateSummary() {
            periodText.textContent = trend.period_label;
            totalText.textContent = formatNumber(trend.total);
            averageText.textContent = formatNumber(trend.average);
            emptyState.hidden = trend.total > 0;
        }

        function setActiveButton(range) {
            rangeButtons.forEach(button => {
                const isActive = button.dataset.range === range;

                button.classList.toggle('is-active', isActive);
                button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });
        }

        let requestId = 0;

        async function loadTrend(params) {
            const currentRequest = ++requestId;

            wrap.classList.add('is-loading');
            errorText.hidden = true;
            hideTooltip();

            try {
                const response = await fetch(
                    `${trendUrl}?${new URLSearchParams(params)}`,
                    { headers: { 'Accept': 'application/json' } }
                );

                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}`);
                }

                const data = await response.json();

                // Abaikan respons lama jika filter sudah diganti lagi
                if (currentRequest !== requestId) {
                    return;
                }

                trend = data;

                updateSummary();
                render();

            } catch (error) {
                console.error('Gagal memuat tren kunjungan:', error);

                if (currentRequest === requestId) {
                    errorText.hidden = false;
                }
            } finally {
                if (currentRequest === requestId) {
                    wrap.classList.remove('is-loading');
                }
            }
        }

        rangeButtons.forEach(button => {
            button.addEventListener('click', () => {
                const range = button.dataset.range;

                setActiveButton(range);

                if (range === 'custom') {
                    customForm.hidden = false;
                    customForm.querySelector('input[name="from"]').focus();
                    return;
                }

                customForm.hidden = true;

                loadTrend({ range });
            });
        });

        customForm.addEventListener('submit', event => {
            event.preventDefault();

            const formData = new FormData(customForm);

            loadTrend({
                from: formData.get('from'),
                to: formData.get('to'),
            });
        });


        let frame = null;

        new ResizeObserver(() => {
            cancelAnimationFrame(frame);
            frame = requestAnimationFrame(render);
        }).observe(container);

        render();

    })();
</script>
@endpush
