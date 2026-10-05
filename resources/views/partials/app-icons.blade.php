{{-- Favicon, ikon PWA & manifest — semuanya dibuat dari logo portal (Pengaturan). --}}
@php($iconVersion = \App\Models\Setting::logoVersion())

<link rel="icon" type="image/png" sizes="32x32" href="{{ route('app-icon', 'favicon-32') }}?v={{ $iconVersion }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ route('app-icon', 'icon-192') }}?v={{ $iconVersion }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ route('app-icon', 'apple-touch-icon') }}?v={{ $iconVersion }}">
<link rel="manifest" href="{{ route('app-manifest') }}?v={{ $iconVersion }}">

<meta name="theme-color" content="#3b5d44">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-title" content="Portal Syifa">

<script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', function () {
            navigator.serviceWorker.register('{{ asset('sw.js') }}').catch(function () {});
        });
    }
</script>
