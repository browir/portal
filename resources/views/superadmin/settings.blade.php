@extends('layouts.superadmin')

@section('title', 'Pengaturan - Super Admin')

@push('styles')
<style>
    .settings-page {
        --brand-900: #2d4a37;
        --brand-700: #3b5d44;
        --brand-500: #5b8266;
        --brand-100: #d2e3d7;
        --brand-50: #eef5f0;
        --ink: #172033;
        --muted: #64748b;
        --line: #e5eaf0;
        --danger: #dc2626;

        width: 100%;
        min-height: calc(100vh - 50px);
        padding: 24px 28px 40px;
        background: #f4f7f5;
    }

    .page-head {
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

    .card {
        max-width: 880px;
        padding: 22px;
        border-radius: 16px;
        background: #ffffff;
        border: 1px solid var(--line);
    }

    .card-head {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }

    .card-title {
        font-size: 16px;
        font-weight: 700;
        color: var(--ink);
    }

    .card-subtitle {
        margin-top: 2px;
        font-size: 12px;
        color: var(--muted);
    }

    .logo-status {
        flex-shrink: 0;
        padding: 3px 10px;
        border-radius: 999px;
        background: #f1f5f9;
        color: #475569;
        font-size: 11px;
        font-weight: 600;
    }

    .logo-status.is-custom {
        background: var(--brand-50);
        color: var(--brand-700);
    }


    /* ---------- PREVIEW HEADER ---------- */

    .preview-label {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-size: 12px;
        font-weight: 600;
        color: var(--muted);
    }

    .preview-tag {
        display: none;
        padding: 1px 8px;
        border-radius: 999px;
        background: #fef3c7;
        color: #92400e;
        font-size: 10px;
        font-weight: 700;
    }

    .preview-label.is-new .preview-tag {
        display: inline-block;
    }

    .mock-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        height: 72px;
        padding: 0 20px;
        border: 1px solid var(--line);
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 6px 16px -10px rgba(15, 23, 42, .25);
    }

    .mock-header img {
        display: block;
        height: 54px;
        max-width: 220px;
        object-fit: contain;
        object-position: left center;
    }

    .mock-nav {
        display: flex;
        gap: 6px;
    }

    .mock-nav span {
        width: 64px;
        height: 26px;
        border-radius: 999px;
        background: #f1f5f9;
    }

    .mock-nav span:first-child {
        background: #0d8a72;
    }


    /* ---------- AREA UPLOAD ---------- */

    .upload-form {
        margin-top: 20px;
    }

    .dropzone {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        padding: 28px 20px;
        border: 2px dashed #cbd5e1;
        border-radius: 14px;
        background: #fafcfb;
        text-align: center;
        cursor: pointer;
        transition: border-color .2s ease, background-color .2s ease;
    }

    .dropzone:hover,
    .dropzone.is-dragover {
        border-color: var(--brand-500);
        background: var(--brand-50);
    }

    .dropzone:focus-within {
        border-color: var(--brand-500);
        box-shadow: 0 0 0 3px rgba(91, 130, 102, .18);
    }

    .dropzone input {
        position: absolute;
        width: 1px;
        height: 1px;
        opacity: 0;
    }

    .dropzone-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        margin-bottom: 4px;
        border-radius: 50%;
        background: #ffffff;
        border: 1px solid var(--line);
        color: var(--brand-700);
    }

    .dropzone-icon .icon {
        width: 20px;
        height: 20px;
    }

    .dropzone strong {
        font-size: 14px;
        color: var(--ink);
    }

    .dropzone strong span {
        color: var(--brand-700);
        text-decoration: underline;
    }

    .dropzone small {
        font-size: 12px;
        color: var(--muted);
    }

    .file-info {
        display: none;
        align-items: center;
        gap: 10px;
        margin-top: 12px;
        padding: 10px 12px;
        border-radius: 10px;
        background: #f8fafc;
        border: 1px solid var(--line);
        font-size: 12px;
        color: var(--ink);
    }

    .file-info.is-visible {
        display: flex;
    }

    .file-info .icon {
        color: var(--brand-700);
    }

    .file-info-name {
        flex: 1;
        min-width: 0;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
        font-weight: 600;
    }

    .file-info-meta {
        color: var(--muted);
    }

    .form-error {
        display: none;
        align-items: center;
        gap: 6px;
        margin-top: 10px;
        font-size: 12px;
        color: var(--danger);
    }

    .form-error.is-visible {
        display: flex;
    }

    .tips {
        margin-top: 14px;
        padding: 12px 14px;
        border-radius: 10px;
        background: #f8fafc;
        font-size: 12px;
        line-height: 1.7;
        color: var(--muted);
    }

    .tips strong {
        color: var(--ink);
    }

    .tips ul {
        margin: 4px 0 0 18px;
    }

    .form-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
        padding-top: 18px;
        border-top: 1px solid var(--line);
    }

    .form-actions-right {
        display: flex;
        gap: 8px;
        margin-left: auto;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 40px;
        padding: 0 16px;
        border-radius: 10px;
        font: inherit;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: background-color .2s ease, opacity .2s ease;
    }

    .btn:disabled {
        opacity: .45;
        cursor: not-allowed;
    }

    .btn-primary {
        border: 0;
        background: var(--brand-700);
        color: #ffffff;
    }

    .btn-primary:not(:disabled):hover {
        background: var(--brand-900);
    }

    .btn-secondary {
        border: 1px solid var(--line);
        background: #ffffff;
        color: #475569;
    }

    .btn-secondary:not(:disabled):hover {
        background: #f1f5f9;
    }

    .btn-danger-ghost {
        border: 1px solid transparent;
        background: transparent;
        color: var(--danger);
    }

    .btn-danger-ghost:hover {
        background: #fef2f2;
        border-color: #fecaca;
    }

    .reset-form {
        margin: 0;
    }


    /* ---------- TOAST ---------- */

    .toast {
        position: fixed;
        right: 20px;
        bottom: 20px;
        z-index: 10000;
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: calc(100vw - 40px);
        padding: 12px 16px;
        border-radius: 12px;
        background: var(--ink);
        color: #ffffff;
        font-size: 13px;
        box-shadow: 0 16px 32px -12px rgba(15, 23, 42, .5);
        animation: toast-in .25s ease;
    }

    .toast .icon {
        color: #4ade80;
    }

    @keyframes toast-in {
        from { opacity: 0; transform: translateY(8px); }
        to { opacity: 1; transform: none; }
    }

    @media (max-width: 768px) {

        .settings-page {
            min-height: calc(100vh - 108px);
            padding: 16px 14px 32px;
        }

        .card {
            padding: 16px;
        }

        .mock-nav {
            display: none;
        }

        .form-actions-right,
        .form-actions-right .btn {
            flex: 1;
        }

    }
</style>
@endpush

@section('content')

<div class="settings-page">

    <div class="page-head">
        <h1>Pengaturan</h1>
        <p>Atur tampilan portal.</p>
    </div>


    <section class="card">

        <div class="card-head">
            <div>
                <h2 class="card-title">Logo Portal</h2>
                <p class="card-subtitle">Tampil di header halaman portal dan halaman admin.</p>
            </div>

            <span class="logo-status {{ $hasCustomLogo ? 'is-custom' : '' }}">
                {{ $hasCustomLogo ? 'Logo custom' : 'Logo bawaan' }}
            </span>
        </div>


        {{-- PREVIEW: menampilkan logo di header seperti aslinya --}}
        <div class="preview-label" id="previewLabel">
            Tampilan di header
            <span class="preview-tag">Preview, belum disimpan</span>
        </div>

        <div class="mock-header" aria-hidden="true">
            <img
                src="{{ $logoUrl }}"
                alt=""
                id="logoPreview"
                data-current="{{ $logoUrl }}"
            >

            <div class="mock-nav">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>


        {{-- FORM UPLOAD --}}
        <form
            method="POST"
            action="{{ route('superadmin.settings.logo.update') }}"
            enctype="multipart/form-data"
            class="upload-form"
            id="logoForm"
        >
            @csrf

            <label class="dropzone" id="dropzone">
                <input
                    type="file"
                    name="logo"
                    id="logoInput"
                    accept="image/png,image/jpeg,image/webp"
                >

                <span class="dropzone-icon">
                    <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                    </svg>
                </span>

                <strong>Seret logo ke sini atau <span>pilih file</span></strong>
                <small>PNG, JPG, atau WEBP &middot; maksimal 2 MB</small>
            </label>

            <div class="file-info" id="fileInfo">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <rect x="3" y="3" width="18" height="18" rx="2"></rect>
                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                    <polyline points="21 15 16 10 5 21"></polyline>
                </svg>
                <span class="file-info-name" id="fileName"></span>
                <span class="file-info-meta" id="fileMeta"></span>
            </div>

            <p class="form-error {{ $errors->has('logo') ? 'is-visible' : '' }}" id="logoError" role="alert">
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span id="logoErrorText">{{ $errors->first('logo') }}</span>
            </p>

            <div class="tips">
                <strong>Tips agar logo tampil rapi:</strong>
                <ul>
                    <li>Gunakan latar transparan (PNG/WEBP), karena header berwarna putih.</li>
                    <li>Bentuk melebar (landscape), sekitar 3 : 1, misalnya 600 &times; 200 piksel.</li>
                    <li>Potong ruang kosong di sekitar logo supaya tidak terlihat kecil.</li>
                </ul>
            </div>
        </form>


        <div class="form-actions">

            @if ($hasCustomLogo)
                <form
                    method="POST"
                    action="{{ route('superadmin.settings.logo.reset') }}"
                    class="reset-form"
                    onsubmit="return confirm('Kembalikan ke logo bawaan? Logo custom akan dihapus.');"
                >
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger-ghost">
                        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                            <polyline points="1 4 1 10 7 10"></polyline>
                            <path d="M3.51 15a9 9 0 1 0 2.13-9.36L1 10"></path>
                        </svg>
                        Gunakan logo bawaan
                    </button>
                </form>
            @endif

            <div class="form-actions-right">
                <button type="button" class="btn btn-secondary" id="cancelButton" disabled>
                    Batal
                </button>

                <button type="submit" form="logoForm" class="btn btn-primary" id="saveButton" disabled>
                    Simpan logo
                </button>
            </div>

        </div>

    </section>

</div>


@if (session('success'))
    <div class="toast" role="status" id="toast">
        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
            <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        {{ session('success') }}
    </div>
@endif

@endsection


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const MAX_SIZE = 2 * 1024 * 1024;
        const ALLOWED_TYPES = ['image/png', 'image/jpeg', 'image/webp'];

        const form = document.getElementById('logoForm');
        const input = document.getElementById('logoInput');
        const dropzone = document.getElementById('dropzone');
        const preview = document.getElementById('logoPreview');
        const previewLabel = document.getElementById('previewLabel');
        const fileInfo = document.getElementById('fileInfo');
        const fileName = document.getElementById('fileName');
        const fileMeta = document.getElementById('fileMeta');
        const errorBox = document.getElementById('logoError');
        const errorText = document.getElementById('logoErrorText');
        const saveButton = document.getElementById('saveButton');
        const cancelButton = document.getElementById('cancelButton');
        const toast = document.getElementById('toast');

        let objectUrl = null;

        if (toast) {
            setTimeout(() => toast.remove(), 4500);
        }

        function showError(message) {
            errorText.textContent = message;
            errorBox.classList.add('is-visible');
        }

        function clearError() {
            errorText.textContent = '';
            errorBox.classList.remove('is-visible');
        }

        function formatSize(bytes) {
            return bytes >= 1024 * 1024
                ? `${(bytes / 1024 / 1024).toFixed(1)} MB`
                : `${Math.round(bytes / 1024)} KB`;
        }

        function resetSelection() {
            input.value = '';

            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
                objectUrl = null;
            }

            preview.src = preview.dataset.current;
            previewLabel.classList.remove('is-new');
            fileInfo.classList.remove('is-visible');
            saveButton.disabled = true;
            cancelButton.disabled = true;
        }

        // Validasi di browser lalu tampilkan preview sebelum disimpan
        function handleFile(file) {
            clearError();

            if (!file) {
                resetSelection();
                return;
            }

            if (!ALLOWED_TYPES.includes(file.type)) {
                resetSelection();
                showError('Format logo harus PNG, JPG, atau WEBP.');
                return;
            }

            if (file.size > MAX_SIZE) {
                resetSelection();
                showError(`Ukuran logo ${formatSize(file.size)}, maksimal 2 MB.`);
                return;
            }

            if (objectUrl) {
                URL.revokeObjectURL(objectUrl);
            }

            objectUrl = URL.createObjectURL(file);

            const image = new Image();

            image.onload = function () {
                fileMeta.textContent = `${image.naturalWidth} × ${image.naturalHeight} px · ${formatSize(file.size)}`;
            };

            image.src = objectUrl;

            preview.src = objectUrl;
            previewLabel.classList.add('is-new');

            fileName.textContent = file.name;
            fileMeta.textContent = formatSize(file.size);
            fileInfo.classList.add('is-visible');

            saveButton.disabled = false;
            cancelButton.disabled = false;
        }

        input.addEventListener('change', () => handleFile(input.files[0]));

        cancelButton.addEventListener('click', () => {
            clearError();
            resetSelection();
        });

        // Drag & drop
        ['dragenter', 'dragover'].forEach(type => {
            dropzone.addEventListener(type, event => {
                event.preventDefault();
                dropzone.classList.add('is-dragover');
            });
        });

        ['dragleave', 'drop'].forEach(type => {
            dropzone.addEventListener(type, event => {
                event.preventDefault();
                dropzone.classList.remove('is-dragover');
            });
        });

        dropzone.addEventListener('drop', event => {
            const file = event.dataTransfer.files[0];

            if (!file) {
                return;
            }

            const transfer = new DataTransfer();
            transfer.items.add(file);
            input.files = transfer.files;

            handleFile(file);
        });

        form.addEventListener('submit', () => {
            saveButton.disabled = true;
            saveButton.textContent = 'Menyimpan...';
        });

    });
</script>
@endpush
