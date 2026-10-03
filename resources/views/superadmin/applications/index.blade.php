@extends('layouts.superadmin')

@section('title', 'Kelola Aplikasi - Super Admin')

@push('styles')
<style>
    .apps-page {
        --brand-900: #2d4a37;
        --brand-700: #3b5d44;
        --brand-500: #5b8266;
        --brand-100: #d2e3d7;
        --brand-50: #eef5f0;
        --ink: #172033;
        --muted: #64748b;
        --line: #e5eaf0;
        --danger: #dc2626;
        --danger-bg: #fee2e2;

        width: 100%;
        min-height: calc(100vh - 50px);
        padding: 24px 28px 40px;
        background: #f4f7f5;
    }


    /* =========================
       HEADER HALAMAN
    ========================= */

    .page-head {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 20px;
    }

    .page-head h1 {
        margin-bottom: 4px;
        font-size: 24px;
        font-weight: 700;
        color: var(--ink);
    }

    .page-head p {
        font-size: 13px;
        color: var(--muted);
    }

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
        display: inline-flex;
        align-items: center;
        gap: 8px;
        height: 40px;
        padding: 0 16px;
        border: 0;
        border-radius: 10px;
        background: var(--brand-700);
        color: #ffffff;
        font: inherit;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        white-space: nowrap;
        cursor: pointer;
        transition: background-color .2s ease;
    }

    .btn-primary:hover {
        background: var(--brand-900);
    }


    /* =========================
       KARTU & TOOLBAR
    ========================= */

    .card {
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid var(--line);
        overflow: hidden;
    }

    .toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        padding: 14px 16px;
        border-bottom: 1px solid var(--line);
    }

    .status-tabs {
        display: inline-flex;
        gap: 2px;
        padding: 3px;
        border-radius: 10px;
        background: #f1f5f3;
    }

    .status-tabs button {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        height: 32px;
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

    .status-tabs button:hover {
        color: var(--ink);
    }

    .status-tabs button.is-active {
        background: #ffffff;
        color: var(--brand-700);
        font-weight: 600;
        box-shadow: 0 1px 3px rgba(15, 23, 42, .12);
    }

    .tab-count {
        min-width: 20px;
        height: 18px;
        padding: 0 6px;
        border-radius: 999px;
        background: #e2e8f0;
        color: #475569;
        font-size: 10px;
        font-weight: 700;
        line-height: 18px;
        text-align: center;
    }

    .status-tabs button.is-active .tab-count {
        background: var(--brand-100);
        color: var(--brand-900);
    }

    .toolbar-right {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .search-box {
        position: relative;
        display: flex;
        align-items: center;
        width: 280px;
    }

    .search-box .icon {
        position: absolute;
        left: 12px;
        color: #94a3b8;
        pointer-events: none;
    }

    .search-box input {
        width: 100%;
        height: 38px;
        padding: 0 34px 0 38px;
        border: 1px solid var(--line);
        border-radius: 10px;
        background: #ffffff;
        color: var(--ink);
        font: inherit;
        font-size: 13px;
        outline: none;
        -webkit-appearance: none;
        appearance: none;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    .search-box input::-webkit-search-cancel-button {
        -webkit-appearance: none;
    }

    .search-box input:focus {
        border-color: var(--brand-500);
        box-shadow: 0 0 0 3px rgba(91, 130, 102, .18);
    }

    .search-kbd {
        position: absolute;
        right: 9px;
        min-width: 20px;
        height: 20px;
        padding: 0 5px;
        border: 1px solid var(--line);
        border-bottom-width: 2px;
        border-radius: 5px;
        background: #f8fafc;
        color: #94a3b8;
        font: inherit;
        font-size: 11px;
        line-height: 17px;
        text-align: center;
        pointer-events: none;
    }

    .search-box input:focus + .search-kbd,
    .search-box.has-value .search-kbd {
        display: none;
    }

    .search-clear {
        position: absolute;
        right: 6px;
        display: none;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border: 0;
        border-radius: 6px;
        background: transparent;
        color: var(--muted);
        cursor: pointer;
    }

    .search-clear:hover {
        background: #f1f5f9;
    }

    .search-box.has-value .search-clear {
        display: inline-flex;
    }

    .sort-select {
        height: 38px;
        padding: 0 30px 0 12px;
        border: 1px solid var(--line);
        border-radius: 10px;
        background: #ffffff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E") right 10px center / 14px no-repeat;
        color: var(--ink);
        font: inherit;
        font-size: 12px;
        cursor: pointer;
        -webkit-appearance: none;
        appearance: none;
    }

    .sort-select:focus {
        outline: none;
        border-color: var(--brand-500);
        box-shadow: 0 0 0 3px rgba(91, 130, 102, .18);
    }


    /* =========================
       TABEL
    ========================= */

    .table-container {
        width: 100%;
        overflow-x: auto;
    }

    .apps-table {
        width: 100%;
        border-collapse: collapse;
    }

    .apps-table th {
        height: 42px;
        padding: 0 16px;
        background: #f8faf9;
        border-bottom: 1px solid var(--line);
        color: var(--muted);
        font-size: 11px;
        font-weight: 600;
        letter-spacing: .04em;
        text-align: left;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .apps-table td {
        padding: 12px 16px;
        border-bottom: 1px solid #f0f3f6;
        color: var(--ink);
        font-size: 13px;
        vertical-align: middle;
    }

    .apps-table tbody tr.app-row {
        transition: background-color .15s ease;
    }

    /* Pastikan baris yang difilter tetap tersembunyi (termasuk tampilan kartu di HP) */
    .apps-table tr[hidden] {
        display: none !important;
    }

    .apps-table tbody tr.app-row:hover {
        background: #fafcfb;
    }

    .apps-table tbody tr.app-row.is-inactive .app-logo,
    .apps-table tbody tr.app-row.is-inactive .app-meta {
        opacity: .55;
    }

    .apps-table .col-num {
        text-align: right;
        width: 110px;
    }

    .apps-table .col-status {
        width: 150px;
    }

    .apps-table .col-actions {
        width: 110px;
        text-align: right;
    }

    .app-cell {
        display: flex;
        align-items: center;
        gap: 12px;
        min-width: 240px;
    }

    .app-logo {
        width: 44px;
        height: 44px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border-radius: 12px;
        background: #f6f8fa;
        border: 1px solid var(--line);
        color: var(--brand-700);
        font-size: 17px;
        font-weight: 700;
        transition: opacity .2s ease;
    }

    .app-logo img {
        width: 82%;
        height: 82%;
        object-fit: contain;
    }

    .app-meta {
        min-width: 0;
        transition: opacity .2s ease;
    }

    .app-name {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: 600;
        color: var(--ink);
    }

    .app-desc {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        max-width: 340px;
        margin-top: 2px;
        font-size: 12px;
        color: var(--muted);
    }

    .app-desc.is-empty {
        font-style: italic;
        color: #a0aec0;
    }

    .notif-badge {
        flex-shrink: 0;
        padding: 1px 7px;
        border-radius: 999px;
        background: #dff5ef;
        color: #0a6f5c;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .03em;
    }

    .notif-badge.update {
        background: #e0ecff;
        color: #1d4ed8;
    }

    .app-url {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        max-width: 260px;
        color: var(--muted);
        font-size: 12px;
        text-decoration: none;
    }

    .app-url span {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .app-url .icon {
        width: 13px;
        height: 13px;
        opacity: 0;
        transition: opacity .15s ease;
    }

    .app-url:hover {
        color: var(--brand-700);
        text-decoration: underline;
    }

    .app-url:hover .icon,
    .app-row:hover .app-url .icon {
        opacity: 1;
    }

    .visits {
        font-weight: 600;
        font-variant-numeric: tabular-nums;
    }

    .visits.is-zero {
        color: #a0aec0;
        font-weight: 500;
    }


    /* ---------- SAKLAR STATUS ---------- */

    .status-form {
        margin: 0;
    }

    .switch {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 4px 2px;
        border: 0;
        background: transparent;
        color: var(--muted);
        font: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .switch-track {
        position: relative;
        width: 36px;
        height: 20px;
        flex-shrink: 0;
        border-radius: 999px;
        background: #cbd5e1;
        transition: background-color .2s ease;
    }

    .switch-thumb {
        position: absolute;
        top: 2px;
        left: 2px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(15, 23, 42, .3);
        transition: transform .2s ease;
    }

    .switch[aria-checked="true"] {
        color: #15803d;
    }

    .switch[aria-checked="true"] .switch-track {
        background: #22a35a;
    }

    .switch[aria-checked="true"] .switch-thumb {
        transform: translateX(16px);
    }

    .switch:focus-visible {
        outline: 2px solid var(--brand-500);
        outline-offset: 2px;
        border-radius: 6px;
    }

    .switch.is-loading {
        opacity: .6;
        pointer-events: none;
    }


    /* ---------- TOMBOL AKSI ---------- */

    .action-wrapper {
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .delete-form {
        margin: 0;
    }

    .icon-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 34px;
        height: 34px;
        border: 1px solid transparent;
        border-radius: 9px;
        background: transparent;
        color: var(--muted);
        text-decoration: none;
        cursor: pointer;
        transition: background-color .15s ease, color .15s ease, border-color .15s ease;
    }

    .icon-button:hover {
        background: var(--brand-50);
        border-color: var(--brand-100);
        color: var(--brand-700);
    }

    .icon-button.is-danger:hover {
        background: var(--danger-bg);
        border-color: #fecaca;
        color: var(--danger);
    }


    /* ---------- KOSONG / FOOTER TABEL ---------- */

    .no-result td {
        padding: 36px 16px;
        text-align: center;
        color: var(--muted);
        font-size: 13px;
    }

    .link-button {
        margin-left: 4px;
        padding: 0;
        border: 0;
        background: none;
        color: var(--brand-700);
        font: inherit;
        font-weight: 600;
        text-decoration: underline;
        cursor: pointer;
    }

    .table-foot {
        padding: 12px 16px;
        font-size: 12px;
        color: var(--muted);
    }

    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        padding: 56px 20px;
        text-align: center;
    }

    .empty-state-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        margin-bottom: 6px;
        border-radius: 50%;
        background: var(--brand-50);
        color: var(--brand-700);
    }

    .empty-state-icon .icon {
        width: 26px;
        height: 26px;
    }

    .empty-state h2 {
        font-size: 17px;
        color: var(--ink);
    }

    .empty-state p {
        max-width: 360px;
        margin-bottom: 8px;
        font-size: 13px;
        color: var(--muted);
    }


    /* =========================
       TOAST NOTIFIKASI
    ========================= */

    .toast-stack {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 10000;
        display: flex;
        flex-direction: column;
        gap: 8px;
        max-width: calc(100vw - 40px);
    }

    .toast {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        width: 360px;
        max-width: 100%;
        padding: 12px 12px 12px 14px;
        border-radius: 12px;
        background: var(--ink);
        color: #ffffff;
        font-size: 13px;
        line-height: 1.45;
        box-shadow: 0 16px 32px -12px rgba(15, 23, 42, .5);
        animation: toast-in .25s ease;
    }

    .toast.is-leaving {
        opacity: 0;
        transform: translateY(8px);
        transition: opacity .2s ease, transform .2s ease;
    }

    .toast .icon {
        margin-top: 1px;
        color: #4ade80;
    }

    .toast.is-error .icon {
        color: #f87171;
    }

    .toast-text {
        flex: 1;
    }

    .toast-close {
        display: flex;
        padding: 2px;
        border: 0;
        border-radius: 6px;
        background: transparent;
        color: rgba(255, 255, 255, .6);
        cursor: pointer;
    }

    .toast-close:hover {
        color: #ffffff;
    }

    @keyframes toast-in {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: none; }
    }


    /* =========================
       MODAL HAPUS
    ========================= */

    .delete-modal {
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 20px;
        background: rgba(15, 23, 42, .55);
        backdrop-filter: blur(4px);
        -webkit-backdrop-filter: blur(4px);
    }

    .delete-modal.show {
        display: flex;
    }

    .delete-modal-card {
        width: 100%;
        max-width: 400px;
        padding: 26px;
        border-radius: 18px;
        background: #ffffff;
        box-shadow: 0 25px 60px rgba(0, 0, 0, .25);
        text-align: center;
        animation: toast-in .2s ease;
    }

    .delete-modal-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 54px;
        height: 54px;
        margin: 0 auto 16px;
        border-radius: 50%;
        background: var(--danger-bg);
        color: var(--danger);
    }

    .delete-modal-icon .icon {
        width: 26px;
        height: 26px;
    }

    .delete-modal-title {
        margin-bottom: 8px;
        font-size: 18px;
        font-weight: 700;
        color: var(--ink);
    }

    .delete-modal-text {
        font-size: 13px;
        line-height: 1.6;
        color: var(--muted);
    }

    .delete-modal-text strong {
        color: var(--ink);
        word-break: break-word;
    }

    .delete-modal-note {
        margin-top: 12px;
        padding: 10px 12px;
        border-radius: 10px;
        background: #fff7ed;
        color: #9a3412;
        font-size: 12px;
        line-height: 1.5;
        text-align: left;
    }

    .delete-modal-actions {
        display: flex;
        gap: 10px;
        margin-top: 22px;
    }

    .delete-modal-button {
        flex: 1;
        height: 42px;
        border: 0;
        border-radius: 10px;
        font: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color .2s ease;
    }

    .delete-modal-cancel {
        background: #f1f5f9;
        color: #475569;
    }

    .delete-modal-cancel:hover {
        background: #e2e8f0;
    }

    .delete-modal-confirm {
        background: var(--danger);
        color: #ffffff;
    }

    .delete-modal-confirm:hover {
        background: #b91c1c;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 1000px) {

        .toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .toolbar-right {
            width: 100%;
        }

        .search-box {
            flex: 1;
            width: auto;
            min-width: 180px;
        }

    }

    /* Layar kecil: tabel berubah menjadi kartu */
    @media (max-width: 720px) {

        .apps-page {
            min-height: calc(100vh - 108px);
            padding: 16px 14px 32px;
        }

        .page-head .btn-primary {
            width: 100%;
            justify-content: center;
        }

        .status-tabs {
            display: flex;
        }

        .status-tabs button {
            flex: 1;
            justify-content: center;
        }

        .apps-table thead {
            display: none;
        }

        .apps-table,
        .apps-table tbody {
            display: block;
        }

        .apps-table tr.app-row {
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 8px 12px;
            padding: 14px 16px;
            border-bottom: 1px solid var(--line);
        }

        .apps-table tr.app-row td {
            display: block;
            padding: 0;
            border: 0;
        }

        .apps-table td.col-app {
            grid-column: 1 / -1;
        }

        .app-cell {
            min-width: 0;
        }

        .app-desc {
            max-width: none;
        }

        .apps-table td.col-url {
            grid-column: 1 / -1;
        }

        .app-url {
            max-width: 100%;
        }

        .app-url .icon {
            opacity: 1;
        }

        .apps-table td.col-num {
            grid-column: 1 / -1;
            text-align: left;
            font-size: 12px;
            color: var(--muted);
        }

        .apps-table td.col-num::before {
            content: "Kunjungan: ";
        }

        .apps-table td.col-status,
        .apps-table td.col-actions {
            width: auto;
            align-self: center;
        }

        .apps-table tr.no-result {
            display: block;
        }

        .apps-table tr.no-result td {
            display: block;
        }

        .toast-stack {
            right: 12px;
            left: 12px;
            bottom: 12px;
            max-width: none;
        }

        .toast {
            width: 100%;
        }

    }

    @media (max-width: 480px) {

        .delete-modal-actions {
            flex-direction: column-reverse;
        }

    }
</style>
@endpush

@section('content')

@php
    $activeCount = $applications->where('is_active', true)->count();
    $inactiveCount = $applications->count() - $activeCount;
@endphp

<div class="apps-page">


    {{-- =========================================================
         HEADER
    ========================================================= --}}

    <div class="page-head">

        <div>
            <h1>Kelola Aplikasi</h1>
            <p>Tambah, ubah, dan atur aplikasi yang tampil di portal.</p>
        </div>

        <a href="{{ route('superadmin.applications.create') }}" class="btn-primary">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Tambah Aplikasi
        </a>

    </div>



    <div class="card">

        @if ($applications->isEmpty())

            {{-- BELUM ADA APLIKASI SAMA SEKALI --}}
            <div class="empty-state">
                <span class="empty-state-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                        <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                    </svg>
                </span>

                <h2>Belum ada aplikasi</h2>

                <p>Tambahkan aplikasi pertama agar bisa diakses pengguna dari portal.</p>

                <a href="{{ route('superadmin.applications.create') }}" class="btn-primary">
                    Tambah Aplikasi
                </a>
            </div>

        @else


            {{-- =====================================================
                 TOOLBAR
            ===================================================== --}}

            <div class="toolbar">

                <div class="status-tabs" role="group" aria-label="Filter status">
                    <button type="button" data-filter="all" class="is-active" aria-pressed="true">
                        Semua <span class="tab-count" data-count="all">{{ $applications->count() }}</span>
                    </button>

                    <button type="button" data-filter="active" aria-pressed="false">
                        Aktif <span class="tab-count" data-count="active">{{ $activeCount }}</span>
                    </button>

                    <button type="button" data-filter="inactive" aria-pressed="false">
                        Nonaktif <span class="tab-count" data-count="inactive">{{ $inactiveCount }}</span>
                    </button>
                </div>

                <div class="toolbar-right">

                    <div class="search-box {{ $search !== '' ? 'has-value' : '' }}" id="searchBox">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="11" cy="11" r="7"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>

                        <input
                            type="search"
                            id="applicationSearch"
                            value="{{ $search }}"
                            placeholder="Cari nama, URL, atau deskripsi..."
                            autocomplete="off"
                            aria-label="Cari aplikasi"
                        >

                        <kbd class="search-kbd" title="Tekan / untuk mencari">/</kbd>

                        <button type="button" class="search-clear" id="searchClear" aria-label="Hapus pencarian">
                            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </button>
                    </div>

                    <select class="sort-select" id="applicationSort" aria-label="Urutkan aplikasi">
                        <option value="name">Nama A–Z</option>
                        <option value="visits">Kunjungan terbanyak</option>
                        <option value="updated">Terakhir diperbarui</option>
                    </select>

                </div>

            </div>



            {{-- =====================================================
                 TABEL
            ===================================================== --}}

            <div class="table-container">

                <table class="apps-table">

                    <thead>
                        <tr>
                            <th>Aplikasi</th>
                            <th>URL</th>
                            <th class="col-num">Kunjungan</th>
                            <th class="col-status">Status</th>
                            <th class="col-actions">Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="applicationTableBody">

                        @foreach ($applications as $application)

                            @php
                                $initial = mb_strtoupper(mb_substr($application->name, 0, 1));

                                $host = parse_url($application->url, PHP_URL_HOST) ?: $application->url;
                                $path = rtrim((string) parse_url($application->url, PHP_URL_PATH), '/');
                                $displayUrl = $host . $path;

                                $notification = $application->hasActiveNotification()
                                    ? $application->notification_type
                                    : null;
                            @endphp

                            <tr
                                class="app-row {{ $application->is_active ? '' : 'is-inactive' }}"
                                data-name="{{ mb_strtolower($application->name) }}"
                                data-search="{{ mb_strtolower($application->name . ' ' . $application->url . ' ' . $application->description) }}"
                                data-status="{{ $application->is_active ? 'active' : 'inactive' }}"
                                data-visits="{{ $application->visits_count }}"
                                data-updated="{{ $application->updated_at?->timestamp ?? 0 }}"
                            >

                                <td class="col-app">
                                    <div class="app-cell">

                                        <span class="app-logo" data-initial="{{ $initial }}">
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

                                        <div class="app-meta">
                                            <div class="app-name">
                                                {{ $application->name }}

                                                @if ($notification === 'new')
                                                    <span class="notif-badge" title="Badge aktif di portal">NEW</span>
                                                @elseif ($notification === 'updated')
                                                    <span class="notif-badge update" title="Badge aktif di portal">UPDATE</span>
                                                @endif
                                            </div>

                                            @if ($application->description)
                                                <div class="app-desc" title="{{ $application->description }}">
                                                    {{ $application->description }}
                                                </div>
                                            @else
                                                <div class="app-desc is-empty">Belum ada deskripsi</div>
                                            @endif
                                        </div>

                                    </div>
                                </td>

                                <td class="col-url">
                                    <a
                                        href="{{ $application->url }}"
                                        class="app-url"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        title="{{ $application->url }}"
                                    >
                                        <span>{{ $displayUrl }}</span>

                                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                                            <polyline points="15 3 21 3 21 9"></polyline>
                                            <line x1="10" y1="14" x2="21" y2="3"></line>
                                        </svg>
                                    </a>
                                </td>

                                <td class="col-num">
                                    <span class="visits {{ $application->visits_count === 0 ? 'is-zero' : '' }}">
                                        {{ number_format($application->visits_count, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="col-status">
                                    <form
                                        action="{{ route('superadmin.applications.toggle-status', $application) }}"
                                        method="POST"
                                        class="status-form"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            class="switch"
                                            role="switch"
                                            aria-checked="{{ $application->is_active ? 'true' : 'false' }}"
                                            aria-label="Tampilkan {{ $application->name }} di portal"
                                            title="Klik untuk {{ $application->is_active ? 'menonaktifkan' : 'mengaktifkan' }}"
                                        >
                                            <span class="switch-track"><span class="switch-thumb"></span></span>
                                            <span class="switch-label">{{ $application->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                                        </button>
                                    </form>
                                </td>

                                <td class="col-actions">
                                    <div class="action-wrapper">

                                        <a
                                            href="{{ route('superadmin.applications.edit', $application) }}"
                                            class="icon-button"
                                            title="Edit {{ $application->name }}"
                                            aria-label="Edit {{ $application->name }}"
                                        >
                                            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                                                <path d="M12 20h9"></path>
                                                <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4z"></path>
                                            </svg>
                                        </a>

                                        <form
                                            action="{{ route('superadmin.applications.destroy', $application) }}"
                                            method="POST"
                                            class="delete-form"
                                            data-application-name="{{ $application->name }}"
                                            data-visits="{{ $application->visits_count }}"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="icon-button is-danger"
                                                title="Hapus {{ $application->name }}"
                                                aria-label="Hapus {{ $application->name }}"
                                            >
                                                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
                                                    <path d="M10 11v6"></path>
                                                    <path d="M14 11v6"></path>
                                                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
                                                </svg>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>

                        @endforeach

                        <tr class="no-result" id="noSearchResult" hidden>
                            <td colspan="5">
                                Tidak ada aplikasi yang cocok dengan filter ini.
                                <button type="button" class="link-button" id="resetFilters">Reset filter</button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <div class="table-foot" id="resultInfo" aria-live="polite">
                Menampilkan {{ $applications->count() }} aplikasi
            </div>

        @endif

    </div>

</div>



{{-- =========================================================
     TOAST
========================================================= --}}

<div class="toast-stack" id="toastStack" aria-live="polite"></div>



{{-- =========================================================
     MODAL HAPUS
========================================================= --}}

<div class="delete-modal" id="deleteModal" aria-hidden="true">

    <div
        class="delete-modal-card"
        role="alertdialog"
        aria-modal="true"
        aria-labelledby="deleteModalTitle"
        aria-describedby="deleteModalText"
    >

        <div class="delete-modal-icon">
            <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M12 9v4"></path>
                <path d="M12 17h.01"></path>
                <path d="M10.3 3.6L2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.6a2 2 0 0 0-3.4 0z"></path>
            </svg>
        </div>

        <h2 class="delete-modal-title" id="deleteModalTitle">
            Hapus aplikasi?
        </h2>

        <p class="delete-modal-text" id="deleteModalText">
            Aplikasi <strong id="deleteModalAppName"></strong> akan dihapus permanen dan tidak tampil lagi di portal.
        </p>

        <p class="delete-modal-note" id="deleteModalNote" hidden></p>

        <div class="delete-modal-actions">
            <button type="button" class="delete-modal-button delete-modal-cancel" id="deleteModalCancel">
                Batal
            </button>

            <button type="button" class="delete-modal-button delete-modal-confirm" id="deleteModalConfirm">
                Ya, hapus
            </button>
        </div>

    </div>

</div>

@endsection



@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const ICON_CHECK = '<svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
        const ICON_ALERT = '<svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
        const ICON_CLOSE = '<svg class="icon" viewBox="0 0 24 24" aria-hidden="true"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';


        /*
        |--------------------------------------------------------------------------
        | TOAST
        |--------------------------------------------------------------------------
        */

        const toastStack = document.getElementById('toastStack');

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `toast${type === 'error' ? ' is-error' : ''}`;
            toast.setAttribute('role', type === 'error' ? 'alert' : 'status');
            toast.innerHTML = `${type === 'error' ? ICON_ALERT : ICON_CHECK}<span class="toast-text"></span><button type="button" class="toast-close" aria-label="Tutup">${ICON_CLOSE}</button>`;
            toast.querySelector('.toast-text').textContent = message;

            const remove = () => {
                toast.classList.add('is-leaving');
                setTimeout(() => toast.remove(), 200);
            };

            toast.querySelector('.toast-close').addEventListener('click', remove);
            setTimeout(remove, 4500);

            toastStack.append(toast);
        }

        @if (session('success'))
            showToast(@json(session('success')));
        @endif

        @if (session('error'))
            showToast(@json(session('error')), 'error');
        @endif


        const tableBody = document.getElementById('applicationTableBody');

        if (!tableBody) {
            return;
        }


        /*
        |--------------------------------------------------------------------------
        | FILTER, PENCARIAN & URUTAN
        |--------------------------------------------------------------------------
        */

        const searchInput = document.getElementById('applicationSearch');
        const searchBox = document.getElementById('searchBox');
        const searchClear = document.getElementById('searchClear');
        const sortSelect = document.getElementById('applicationSort');
        const filterButtons = document.querySelectorAll('.status-tabs [data-filter]');
        const noResultRow = document.getElementById('noSearchResult');
        const resultInfo = document.getElementById('resultInfo');
        const resetFiltersButton = document.getElementById('resetFilters');

        const rows = () => Array.from(tableBody.querySelectorAll('tr.app-row'));

        const params = new URLSearchParams(window.location.search);

        const state = {
            status: ['all', 'active', 'inactive'].includes(params.get('status')) ? params.get('status') : 'all',
            keyword: searchInput.value.trim().toLowerCase(),
            sort: ['name', 'visits', 'updated'].includes(params.get('sort')) ? params.get('sort') : 'name',
        };

        sortSelect.value = state.sort;

        // Simpan filter di URL supaya tetap sama setelah hapus / refresh
        function syncUrl() {
            const url = new URL(window.location.href);

            const setParam = (key, value, defaultValue) => {
                if (value && value !== defaultValue) {
                    url.searchParams.set(key, value);
                } else {
                    url.searchParams.delete(key);
                }
            };

            setParam('search', searchInput.value.trim(), '');
            setParam('status', state.status, 'all');
            setParam('sort', state.sort, 'name');

            history.replaceState(null, '', url);
        }

        function updateCounts() {
            const allRows = rows();
            const active = allRows.filter(row => row.dataset.status === 'active').length;

            document.querySelector('[data-count="all"]').textContent = allRows.length;
            document.querySelector('[data-count="active"]').textContent = active;
            document.querySelector('[data-count="inactive"]').textContent = allRows.length - active;
        }

        function sortRows() {
            const sorted = rows().sort((a, b) => {
                if (state.sort === 'visits') {
                    return Number(b.dataset.visits) - Number(a.dataset.visits)
                        || a.dataset.name.localeCompare(b.dataset.name, 'id');
                }

                if (state.sort === 'updated') {
                    return Number(b.dataset.updated) - Number(a.dataset.updated);
                }

                return a.dataset.name.localeCompare(b.dataset.name, 'id');
            });

            sorted.forEach(row => tableBody.insertBefore(row, noResultRow));
        }

        function applyFilters() {
            const allRows = rows();
            let visible = 0;

            allRows.forEach(row => {
                const matchStatus = state.status === 'all' || row.dataset.status === state.status;
                const matchKeyword = !state.keyword || row.dataset.search.includes(state.keyword);
                const isVisible = matchStatus && matchKeyword;

                row.hidden = !isVisible;

                if (isVisible) {
                    visible++;
                }
            });

            noResultRow.hidden = visible > 0;

            resultInfo.textContent = visible === allRows.length
                ? `Menampilkan ${allRows.length} aplikasi`
                : `Menampilkan ${visible} dari ${allRows.length} aplikasi`;

            filterButtons.forEach(button => {
                const isActive = button.dataset.filter === state.status;

                button.classList.toggle('is-active', isActive);
                button.setAttribute('aria-pressed', isActive ? 'true' : 'false');
            });

            searchBox.classList.toggle('has-value', searchInput.value !== '');

            syncUrl();
        }

        searchInput.addEventListener('input', function () {
            state.keyword = this.value.trim().toLowerCase();
            applyFilters();
        });

        searchClear.addEventListener('click', function () {
            searchInput.value = '';
            state.keyword = '';
            applyFilters();
            searchInput.focus();
        });

        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                state.status = button.dataset.filter;
                applyFilters();
            });
        });

        sortSelect.addEventListener('change', function () {
            state.sort = this.value;
            sortRows();
            syncUrl();
        });

        resetFiltersButton.addEventListener('click', function () {
            searchInput.value = '';
            state.keyword = '';
            state.status = 'all';
            applyFilters();
        });

        // Pintasan: "/" untuk fokus ke pencarian, Esc untuk menghapus
        document.addEventListener('keydown', function (event) {
            const isTyping = event.target.matches('input, textarea, select, [contenteditable="true"]');

            if (event.key === '/' && !isTyping && !deleteModal.classList.contains('show')) {
                event.preventDefault();
                searchInput.focus();
                searchInput.select();
            }

            if (event.key === 'Escape' && event.target === searchInput && searchInput.value) {
                searchClear.click();
            }
        });

        sortRows();
        applyFilters();


        /*
        |--------------------------------------------------------------------------
        | UBAH STATUS TANPA RELOAD
        |--------------------------------------------------------------------------
        */

        tableBody.querySelectorAll('.status-form').forEach(form => {
            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                const button = form.querySelector('.switch');
                const row = form.closest('tr');

                button.classList.add('is-loading');

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                        body: new FormData(form),
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP ${response.status}`);
                    }

                    const data = await response.json();

                    button.setAttribute('aria-checked', data.is_active ? 'true' : 'false');
                    button.title = `Klik untuk ${data.is_active ? 'menonaktifkan' : 'mengaktifkan'}`;
                    button.querySelector('.switch-label').textContent = data.is_active ? 'Aktif' : 'Nonaktif';

                    row.dataset.status = data.is_active ? 'active' : 'inactive';
                    row.classList.toggle('is-inactive', !data.is_active);

                    updateCounts();
                    applyFilters();

                    showToast(data.message);

                } catch (error) {
                    console.error('Gagal mengubah status:', error);

                    showToast('Status gagal diubah. Muat ulang halaman lalu coba lagi.', 'error');
                } finally {
                    button.classList.remove('is-loading');
                }
            });
        });


        /*
        |--------------------------------------------------------------------------
        | MODAL HAPUS
        |--------------------------------------------------------------------------
        */

        const deleteModal = document.getElementById('deleteModal');
        const modalAppName = document.getElementById('deleteModalAppName');
        const modalNote = document.getElementById('deleteModalNote');
        const cancelButton = document.getElementById('deleteModalCancel');
        const confirmButton = document.getElementById('deleteModalConfirm');

        let selectedForm = null;
        let lastFocused = null;

        function openDeleteModal(form) {
            selectedForm = form;
            lastFocused = document.activeElement;

            modalAppName.textContent = form.dataset.applicationName || 'ini';

            const visits = Number(form.dataset.visits || 0);

            modalNote.hidden = visits === 0;
            modalNote.textContent = `Riwayat ${visits.toLocaleString('id-ID')} kunjungan aplikasi ini juga akan ikut terhapus. Jika hanya ingin menyembunyikannya dari portal, nonaktifkan saja.`;

            deleteModal.classList.add('show');
            deleteModal.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';

            cancelButton.focus();
        }

        function closeDeleteModal() {
            deleteModal.classList.remove('show');
            deleteModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';

            selectedForm = null;

            if (lastFocused) {
                lastFocused.focus();
            }
        }

        tableBody.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function (event) {
                event.preventDefault();
                openDeleteModal(form);
            });
        });

        cancelButton.addEventListener('click', closeDeleteModal);

        confirmButton.addEventListener('click', function () {
            if (!selectedForm) {
                return;
            }

            const formToSubmit = selectedForm;

            confirmButton.disabled = true;
            confirmButton.textContent = 'Menghapus...';

            HTMLFormElement.prototype.submit.call(formToSubmit);
        });

        deleteModal.addEventListener('click', function (event) {
            if (event.target === deleteModal) {
                closeDeleteModal();
            }
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && deleteModal.classList.contains('show')) {
                closeDeleteModal();
            }
        });

    });
</script>
@endpush
