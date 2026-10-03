{{--
    Logo aplikasi. Jika ikon kosong atau gagal dimuat,
    tampilkan huruf awal nama aplikasi dengan warna latar.
--}}
@php
    $hasIcon = filled($application->icon);
@endphp

<div class="app-logo {{ $size ?? '' }} tone-{{ $application->id % 5 }} {{ $hasIcon ? '' : 'no-image' }}">

    @if($hasIcon)
        <img
            src="{{ asset('storage/' . $application->icon) }}"
            alt=""
            loading="lazy"
            onerror="this.parentElement.classList.add('no-image'); this.remove();"
        >
    @endif

    <span class="app-initial" aria-hidden="true">
        {{ mb_strtoupper(mb_substr($application->name, 0, 1)) }}
    </span>

</div>
