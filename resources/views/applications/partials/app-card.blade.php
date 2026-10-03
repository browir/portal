<article class="app-card">

    @include('applications.partials.notification-badge')


    <div class="app-card-header">
        @include('applications.partials.app-logo')
    </div>


    <div class="app-card-body">

        <h3>
            {{ $application->name }}
        </h3>

        <p>
            {{ $application->description ?: 'Klik untuk membuka aplikasi.' }}
        </p>

    </div>


    <a
        href="{{ route('applications.open', $application) }}"
        class="btn-open"
        target="_blank"
        rel="noopener"
        aria-label="Buka aplikasi {{ $application->name }} (tab baru)"
    >
        Buka Aplikasi

        <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
            <line x1="7" y1="17" x2="17" y2="7"></line>
            <polyline points="7 7 17 7 17 17"></polyline>
        </svg>
    </a>

</article>
