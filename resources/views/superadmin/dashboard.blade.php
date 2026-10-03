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

    .chart-scroll {
        position: relative;
        overflow-x: auto;
    }

    .trend-chart {
        display: block;
        width: 100%;
        height: auto;
        min-width: 480px;
    }

    .trend-chart .grid-line {
        stroke: #edf1f4;
        stroke-width: 1;
    }

    .trend-chart .axis-label {
        fill: #94a3b8;
        font-size: 12px;
    }

    .trend-chart .month-label {
        fill: var(--muted);
        font-size: 13px;
        font-weight: 500;
    }

    .trend-chart .month-label.is-current {
        fill: var(--brand-700);
        font-weight: 700;
    }

    .trend-chart .area {
        fill: url(#trendAreaFill);
    }

    .trend-chart .line {
        fill: none;
        stroke: var(--brand-500);
        stroke-width: 3;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .trend-chart .point {
        fill: #ffffff;
        stroke: var(--brand-500);
        stroke-width: 3;
    }

    .trend-chart .point.is-current {
        fill: var(--brand-500);
    }

    .trend-chart .point-value {
        fill: var(--ink);
        font-size: 13px;
        font-weight: 700;
    }

    .chart-empty {
        position: absolute;
        inset: 0 0 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
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

    $trendIcons = [
        'up' => '<polyline points="18 15 12 9 6 15"></polyline>',
        'down' => '<polyline points="6 9 12 15 18 9"></polyline>',
        'same' => '<line x1="6" y1="12" x2="18" y2="12"></line>',
    ];

    $lastPointIndex = count($chart['points']) - 1;
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
                <span class="trend-chip {{ $usageTrend }}">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">{!! $trendIcons[$usageTrend] !!}</svg>
                    {{ $usageTrend === 'same' ? '0%' : abs($usageChange) . '%' }}
                </span>
                vs bulan lalu
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
                    <h2 class="panel-title">Tren Kunjungan</h2>
                    <p class="panel-subtitle">Jumlah aplikasi dibuka dari portal, 6 bulan terakhir</p>
                </div>

                <div class="panel-stat">
                    <strong>{{ number_format($sixMonthTotal, 0, ',', '.') }}</strong>
                    <span>total kunjungan</span>
                </div>
            </div>


            <div class="chart-scroll">

                <svg
                    class="trend-chart"
                    viewBox="0 0 {{ $chart['width'] }} {{ $chart['height'] }}"
                    role="img"
                    aria-label="Grafik kunjungan 6 bulan terakhir"
                >
                    <defs>
                        <linearGradient id="trendAreaFill" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#5b8266" stop-opacity=".28"></stop>
                            <stop offset="100%" stop-color="#5b8266" stop-opacity="0"></stop>
                        </linearGradient>
                    </defs>

                    @foreach ($chart['grid'] as $grid)
                        <line
                            class="grid-line"
                            x1="{{ $chart['left'] }}"
                            x2="{{ $chart['right'] }}"
                            y1="{{ $grid['y'] }}"
                            y2="{{ $grid['y'] }}"
                        ></line>

                        <text
                            class="axis-label"
                            x="{{ $chart['left'] - 10 }}"
                            y="{{ $grid['y'] + 4 }}"
                            text-anchor="end"
                        >{{ $grid['value'] }}</text>
                    @endforeach

                    <polygon class="area" points="{{ $chart['area'] }}"></polygon>

                    <polyline class="line" points="{{ $chart['line'] }}"></polyline>

                    @foreach ($chart['points'] as $index => $point)
                        @php
                            $isCurrent = $index === $lastPointIndex;
                        @endphp

                        <g>
                            <title>{{ $point['full_label'] }}: {{ $point['total'] }} kunjungan</title>

                            <circle
                                class="point {{ $isCurrent ? 'is-current' : '' }}"
                                cx="{{ $point['x'] }}"
                                cy="{{ $point['y'] }}"
                                r="{{ $isCurrent ? 6 : 5 }}"
                            ></circle>

                            <text
                                class="point-value"
                                x="{{ $point['x'] }}"
                                y="{{ $point['y'] - 14 }}"
                                text-anchor="middle"
                            >{{ $point['total'] }}</text>

                            <text
                                class="month-label {{ $isCurrent ? 'is-current' : '' }}"
                                x="{{ $point['x'] }}"
                                y="{{ $chart['bottom'] + 24 }}"
                                text-anchor="middle"
                            >{{ $point['label'] }}</text>
                        </g>
                    @endforeach
                </svg>

                @if ($sixMonthTotal === 0)
                    <div class="chart-empty">
                        <span>Belum ada kunjungan dalam 6 bulan terakhir</span>
                    </div>
                @endif

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
                        <div class="summary-label">Rata-rata per bulan</div>
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
                                        class="trend-chip {{ $application->usage_trend }}"
                                        title="Bulan ini vs bulan lalu"
                                    >
                                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">{!! $trendIcons[$application->usage_trend] !!}</svg>
                                        {{ abs($application->usage_change) }}%
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
