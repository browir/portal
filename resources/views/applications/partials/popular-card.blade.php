@php
    $visits = (int) ($application->visits_count ?? 0);
@endphp

<article
    class="popular-card"
    data-application-id="{{ $application->id }}"
>

    @if($visits > 0)
        <span class="popular-rank rank-{{ $rank }}">
            #{{ $rank }}
        </span>
    @endif

    @include('applications.partials.notification-badge')


    <div class="popular-card-top">
        @include('applications.partials.app-logo', ['size' => 'app-logo--lg'])
    </div>


    <div class="popular-card-bottom">

        <h3>
            {{ $application->name }}
        </h3>

        <p>
            {{ $application->description ?: 'Klik untuk membuka aplikasi.' }}
        </p>

        @if($visits > 0)
            <span class="popular-visits">
                <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                    <polyline points="17 6 23 6 23 12"></polyline>
                </svg>
                Dibuka {{ number_format($visits, 0, ',', '.') }} kali
            </span>
        @endif

        <a
            href="{{ route('applications.open', $application) }}"
            class="btn-open"
            target="_blank"
            rel="noopener"
            aria-label="Buka aplikasi {{ $application->name }} (tab baru)"
        >
            <span class="btn-open-label">Buka Aplikasi</span>

            <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                <line x1="7" y1="17" x2="17" y2="7"></line>
                <polyline points="7 7 17 7 17 17"></polyline>
            </svg>
        </a>

    </div>

</article>
