<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="description"
        content="Pusat akses terpadu seluruh aplikasi Syifa Global Group."
    >

    <meta name="theme-color" content="#3b5d44">

    <title>
        Portal Aplikasi RSU Syifa Medika
    </title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    >

    <link
        rel="stylesheet"
        href="{{ asset('css/styleindex.css') }}?v={{ filemtime(public_path('css/styleindex.css')) }}"
    >

</head>


<body>


    <!-- =========================================================
         HEADER
    ========================================================== -->

    <header class="header" id="siteHeader">

        <div class="header-content">

            <a href="#beranda" class="brand" aria-label="Portal PT. Syifa Global Group - ke beranda">

                <img
                    src="{{ \App\Models\Setting::logoUrl() }}"
                    alt="Portal PT. Syifa Global Group"
                    class="logo-img"
                >

            </a>


            <nav class="navbar" aria-label="Navigasi utama">

                <a
                    href="#beranda"
                    class="nav-link active"
                    title="Beranda"
                >
                    <svg class="nav-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>

                    <span class="nav-label">Beranda</span>
                </a>

                <a
                    href="#aplikasi-populer"
                    class="nav-link"
                    title="Aplikasi Populer"
                >
                    <svg class="nav-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>

                    <span class="nav-label">Aplikasi Populer</span>
                </a>

                <a
                    href="#semua-aplikasi"
                    class="nav-link"
                    title="Semua Aplikasi"
                >
                    <svg class="nav-icon" viewBox="0 0 24 24" aria-hidden="true">
                        <rect x="3" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="3" width="7" height="7" rx="1"></rect>
                        <rect x="14" y="14" width="7" height="7" rx="1"></rect>
                        <rect x="3" y="14" width="7" height="7" rx="1"></rect>
                    </svg>

                    <span class="nav-label">Semua Aplikasi</span>
                </a>

            </nav>

        </div>

    </header>



    <main>


        <!-- =====================================================
             HERO / BERANDA
        ====================================================== -->

        <section
            class="hero-wrapper"
            id="beranda"
        >

            <div class="hero-container">


                <div class="hero-text">

                    <span class="hero-eyebrow">
                        <span class="hero-eyebrow-dot" aria-hidden="true"></span>
                        Connected Care, Better Experience
                    </span>


                    <h1>
                        Pusat Akses Terpadu Seluruh Aplikasi
                        <br>
                        <span class="hero-highlight">Syifa Global Group</span>
                    </h1>


                    <p class="hero-subtitle">
                        Temukan dan buka seluruh aplikasi layanan rumah sakit
                        dari satu tempat, cepat dan mudah.
                    </p>


                    <!-- =================================================
                         SEARCH
                    ================================================== -->

                    <form
                        method="GET"
                        action="{{ route('applications.index') }}"
                        class="search-form"
                        id="applicationSearchForm"
                        role="search"
                    >

                        <label for="applicationSearchInput" class="sr-only">
                            Cari aplikasi
                        </label>

                        <div
                            class="search-input-wrapper {{ $search ? 'has-value' : '' }}"
                            id="searchInputWrapper"
                        >

                            <svg class="icon search-icon" viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="11" cy="11" r="7"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>

                            <input
                                type="search"
                                name="search"
                                id="applicationSearchInput"
                                placeholder="Cari aplikasi, misal: SiLapor"
                                value="{{ $search }}"
                                autocomplete="off"
                                enterkeyhint="search"
                            >

                            <kbd class="search-kbd" title="Tekan / untuk mencari">/</kbd>

                            <button
                                type="button"
                                class="search-clear"
                                id="searchClearButton"
                                aria-label="Hapus pencarian"
                            >
                                <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>

                        </div>

                    </form>


                    <div class="hero-meta">

                        <span class="hero-meta-item">
                            <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                                <polyline points="20 6 9 17 4 12"></polyline>
                            </svg>
                            <span><strong>{{ $applications->count() }}</strong> aplikasi aktif</span>
                        </span>

                        <a href="#semua-aplikasi" class="hero-meta-link">
                            Lihat semua aplikasi
                            <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </a>

                    </div>

                </div>



                <div class="hero-image">

                    <div class="oval-image-wrapper">

                        <img
                            src="{{ asset('images/rs.jpeg') }}"
                            alt="Gedung RSU Syifa Medika"
                        >

                    </div>


                    <div class="hero-float-card">

                        <span class="hero-float-icon" aria-hidden="true">
                            <svg class="icon" viewBox="0 0 24 24">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78L12 21.23l8.84-8.84a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </span>

                        <div>
                            <strong>RSU Syifa Medika</strong>
                            <span>Banjarbaru &middot; Barabai</span>
                        </div>

                    </div>

                </div>

            </div>

        </section>



        <!-- =========================================================
             APLIKASI POPULER
        ========================================================== -->

        <section
            class="popular-green-section"
            id="aplikasi-populer"
            aria-labelledby="popularTitle"
        >

            <div class="popular-grid-container">

                <div class="section-head section-head--center">

                    <span class="section-eyebrow">
                        <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                        </svg>
                        Paling sering dibuka
                    </span>

                    <h2 class="section-title" id="popularTitle">
                        Aplikasi Populer
                    </h2>

                </div>


                <div
                    class="popular-grid"
                    id="popularApplicationsList"
                >

                    @forelse($popularApplications as $application)

                        @include('applications.partials.popular-card', [
                            'application' => $application,
                            'rank' => $loop->iteration,
                        ])

                    @empty

                        <div class="empty-state empty-state--dark">
                            <h3>Belum ada aplikasi populer</h3>
                            <p>Aplikasi yang sering dibuka akan muncul di sini.</p>
                        </div>

                    @endforelse

                </div>

            </div>

        </section>



        <!-- =========================================================
             LIVE SEARCH RESULT
        ========================================================== -->

        <section
            class="live-search-section"
            id="liveSearchSection"
            aria-labelledby="liveSearchTitle"
        >

            <div class="live-search-container">

                <div class="section-head section-head--split">

                    <div>
                        <span class="section-eyebrow">Pencarian</span>

                        <h2 class="section-title" id="liveSearchTitle">
                            Hasil untuk
                            <span id="liveSearchKeyword"></span>
                        </h2>
                    </div>

                    <p
                        class="live-search-count"
                        id="liveSearchCount"
                        aria-live="polite"
                    ></p>

                </div>


                <div
                    class="live-search-grid"
                    id="liveSearchResults"
                >
                </div>

            </div>

        </section>



        <!-- =========================================================
             SEMUA APLIKASI
        ========================================================== -->

        <section
            class="all-apps-section"
            id="semua-aplikasi"
            aria-labelledby="allAppsTitle"
        >

            <div class="all-apps-container">

                <div class="section-head section-head--split">

                    <div>
                        <span class="section-eyebrow">Direktori</span>

                        <h2 class="section-title" id="allAppsTitle">
                            Semua Aplikasi
                        </h2>

                        <p class="section-subtitle">
                            Pilih aplikasi untuk membukanya di tab baru.
                        </p>
                    </div>

                    <span class="count-pill">
                        <strong>{{ $applications->count() }}</strong> aplikasi
                    </span>

                </div>


                <div class="applications-grid">

                    @forelse($applications as $application)

                        @include('applications.partials.app-card', [
                            'application' => $application,
                        ])

                    @empty

                        <div class="empty-state">
                            <h3>Belum ada aplikasi tersedia</h3>
                            <p>Aplikasi yang ditambahkan admin akan tampil di sini.</p>
                        </div>

                    @endforelse

                </div>

            </div>

        </section>



        <!-- =========================================================
             FOOTER
        ========================================================== -->

        <footer class="bottom-green-footer">

            <div class="footer-content">


                <div class="footer-brand">

                    <div class="footer-brand-badge">

                        <img
                            src="{{ asset('images/logosyifa.png') }}"
                            alt="RSU Syifa Medika Banjarbaru"
                        >


                        <img
                            src="{{ asset('images/logobrb.png') }}"
                            alt="RSU Syifa Medika Barabai"
                        >

                    </div>


                    <div class="footer-social-icons">


                        <!-- INSTAGRAM -->

                        <a
                            href="#"
                            aria-label="Instagram"
                        >

                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                            >

                                <rect
                                    x="2"
                                    y="2"
                                    width="20"
                                    height="20"
                                    rx="5"
                                    stroke="currentColor"
                                    stroke-width="2"
                                />

                                <circle
                                    cx="12"
                                    cy="12"
                                    r="4.5"
                                    stroke="currentColor"
                                    stroke-width="2"
                                />

                                <circle
                                    cx="17.5"
                                    cy="6.5"
                                    r="1.3"
                                    fill="currentColor"
                                />

                            </svg>

                        </a>



                        <!-- TIKTOK -->

                        <a
                            href="#"
                            aria-label="TikTok"
                        >

                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                            >

                                <path
                                    d="M15 3v10.5a3.5 3.5 0 1 1-3.5-3.5"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />

                                <path
                                    d="M15 3c.5 3 2.5 5 6 5"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                />

                            </svg>

                        </a>



                        <!-- FACEBOOK -->

                        <a
                            href="#"
                            aria-label="Facebook"
                        >

                            <svg
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                            >

                                <path
                                    d="M14 21v-7h2.5l.5-3H14V9c0-.9.3-1.5 1.7-1.5H17V4.8c-.3 0-1.2-.1-2.3-.1-2.3 0-3.9 1.4-3.9 4V11H8.5v3H11v7h3z"
                                    fill="currentColor"
                                />

                            </svg>

                        </a>

                    </div>

                </div>



                <!-- INSTAGRAM -->

                <div class="footer-column">

                    <h4>
                        Instagram
                    </h4>

                    <p>
                        @rsusyifamedikabjb
                    </p>

                    <p>
                        @rsusyifamedikabrb
                    </p>

                    <p>
                        @syifaglobal.group
                    </p>

                </div>



                <!-- FACEBOOK -->

                <div class="footer-column">

                    <h4>
                        Facebook
                    </h4>

                    <p>
                        @rsusyifamedikabjb
                    </p>

                </div>

            </div>



            <hr class="footer-divider">


            <p class="footer-copyright">

                &copy; RSU Syifa Medika {{ date('Y') }}

            </p>

        </footer>

    </main>



    <button
        type="button"
        class="back-to-top"
        id="backToTop"
        aria-label="Kembali ke atas"
    >
        <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
            <line x1="12" y1="19" x2="12" y2="5"></line>
            <polyline points="5 12 12 5 19 12"></polyline>
        </svg>
    </button>



    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>

        const storageUrl =
            @json(asset('storage'));

        const openUrlBase =
            @json(url('/applications'));

        const popularUrl =
            @json(route('applications.popular'));

        const searchUrl =
            @json(route('applications.search'));

        const DEFAULT_DESCRIPTION =
            'Klik untuk membuka aplikasi.';


        /*
        |--------------------------------------------------------------------------
        | IKON SVG
        |--------------------------------------------------------------------------
        */

        const ICONS = {
            external: `
                <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                    <line x1="7" y1="17" x2="17" y2="7"></line>
                    <polyline points="7 7 17 7 17 17"></polyline>
                </svg>`,

            trending: `
                <svg class="icon icon-sm" viewBox="0 0 24 24" aria-hidden="true">
                    <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                    <polyline points="17 6 23 6 23 12"></polyline>
                </svg>`,

            searchOff: `
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    <line x1="8" y1="8" x2="14" y2="14"></line>
                    <line x1="14" y1="8" x2="8" y2="14"></line>
                </svg>`,

            alert: `
                <svg class="icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>`,
        };



        /*
        |--------------------------------------------------------------------------
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(text) {

            const div =
                document.createElement('div');

            div.textContent =
                text ?? '';

            return div.innerHTML.replace(/"/g, '&quot;');

        }



        /*
        |--------------------------------------------------------------------------
        | TEMPLATE KARTU
        |--------------------------------------------------------------------------
        |
        | Harus sama dengan partial Blade di resources/views/applications/partials.
        |
        */

        function renderLogo(application, sizeClass = '') {

            const logoUrl =
                application.icon
                    ? (
                        application.icon.startsWith('http')
                            ? application.icon
                            : `${storageUrl}/${application.icon}`
                    )
                    : null;

            const initial =
                (application.name || '?').trim().charAt(0).toUpperCase();

            const image =
                logoUrl
                    ? `<img
                            src="${escapeHtml(logoUrl)}"
                            alt=""
                            loading="lazy"
                            onerror="this.parentElement.classList.add('no-image'); this.remove();"
                        >`
                    : '';

            return `
                <div class="app-logo ${sizeClass} tone-${application.id % 5} ${logoUrl ? '' : 'no-image'}">
                    ${image}
                    <span class="app-initial" aria-hidden="true">${escapeHtml(initial)}</span>
                </div>
            `;

        }


        function renderBadge(application) {

            if (application.notification_type === 'new') {
                return '<span class="application-notification-badge">NEW</span>';
            }

            if (application.notification_type === 'updated') {
                return '<span class="application-notification-badge update">UPDATE</span>';
            }

            return '';

        }


        function renderOpenLink(application, label) {

            return `
                <a
                    href="${openUrlBase}/${application.id}/open"
                    class="btn-open"
                    target="_blank"
                    rel="noopener"
                    aria-label="Buka aplikasi ${escapeHtml(application.name)} (tab baru)"
                >
                    ${label}
                    ${ICONS.external}
                </a>
            `;

        }


        function renderPopularCard(application, rank) {

            const visits =
                Number(application.visits_count || 0);

            return `
                <article
                    class="popular-card"
                    data-application-id="${application.id}"
                >
                    ${visits > 0 ? `<span class="popular-rank rank-${rank}">#${rank}</span>` : ''}

                    ${renderBadge(application)}

                    <div class="popular-card-top">
                        ${renderLogo(application, 'app-logo--lg')}
                    </div>

                    <div class="popular-card-bottom">

                        <h3>${escapeHtml(application.name)}</h3>

                        <p>${escapeHtml(application.description || DEFAULT_DESCRIPTION)}</p>

                        ${
                            visits > 0
                                ? `<span class="popular-visits">
                                        ${ICONS.trending}
                                        Dibuka ${visits.toLocaleString('id-ID')} kali
                                   </span>`
                                : ''
                        }

                        ${renderOpenLink(application, '<span class="btn-open-label">Buka Aplikasi</span>')}

                    </div>
                </article>
            `;

        }


        function renderAppCard(application) {

            return `
                <article class="app-card">

                    ${renderBadge(application)}

                    <div class="app-card-header">
                        ${renderLogo(application)}
                    </div>

                    <div class="app-card-body">
                        <h3>${escapeHtml(application.name)}</h3>
                        <p>${escapeHtml(application.description || DEFAULT_DESCRIPTION)}</p>
                    </div>

                    ${renderOpenLink(application, 'Buka Aplikasi')}

                </article>
            `;

        }


        function renderSkeletonCards(count) {

            return Array.from({ length: count }, () => `
                <div class="app-card is-skeleton" aria-hidden="true">
                    <div class="skeleton skeleton-logo"></div>
                    <div class="skeleton skeleton-title"></div>
                    <div class="skeleton skeleton-line"></div>
                    <div class="skeleton skeleton-line short"></div>
                    <div class="skeleton skeleton-btn"></div>
                </div>
            `).join('');

        }


        function renderEmptyState(icon, title, message, withResetButton) {

            return `
                <div class="empty-state">
                    <span class="empty-state-icon">${icon}</span>
                    <h3>${title}</h3>
                    <p>${message}</p>
                    ${
                        withResetButton
                            ? '<button type="button" class="btn-ghost" data-action="reset-search">Hapus pencarian</button>'
                            : ''
                    }
                </div>
            `;

        }



        /*
        |--------------------------------------------------------------------------
        | POPULAR APPLICATIONS (POLLING)
        |--------------------------------------------------------------------------
        |
        | Kartu hanya di-render ulang jika datanya berubah, supaya tidak
        | berkedip dan efek hover tidak hilang setiap 3 detik.
        |
        */

        let popularSignature = null;

        async function loadPopularApplications() {

            // Tidak perlu polling saat tab sedang tidak dilihat
            if (document.hidden) {
                return;
            }

            try {

                const response =
                    await fetch(
                        popularUrl,
                        {
                            headers: {
                                'Accept': 'application/json'
                            },

                            cache: 'no-store'
                        }
                    );

                if (!response.ok) {
                    return;
                }

                const applications =
                    (await response.json()).slice(0, 3);

                const popularList =
                    document.getElementById(
                        'popularApplicationsList'
                    );

                if (
                    !popularList ||
                    !applications.length
                ) {
                    return;
                }

                const signature =
                    JSON.stringify(
                        applications.map(application => [
                            application.id,
                            application.name,
                            application.description,
                            application.icon,
                            application.notification_type,
                            application.visits_count,
                        ])
                    );

                if (signature === popularSignature) {
                    return;
                }

                popularSignature = signature;

                popularList.innerHTML =
                    applications
                        .map((application, index) =>
                            renderPopularCard(application, index + 1)
                        )
                        .join('');

            } catch (error) {

                console.error(
                    'Error updating popular applications:',
                    error
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | LIVE SEARCH ELEMENT
        |--------------------------------------------------------------------------
        */

        const searchForm =
            document.getElementById('applicationSearchForm');

        const searchInput =
            document.getElementById('applicationSearchInput');

        const searchInputWrapper =
            document.getElementById('searchInputWrapper');

        const searchClearButton =
            document.getElementById('searchClearButton');

        const liveSearchSection =
            document.getElementById('liveSearchSection');

        const liveSearchResults =
            document.getElementById('liveSearchResults');

        const liveSearchKeyword =
            document.getElementById('liveSearchKeyword');

        const liveSearchCount =
            document.getElementById('liveSearchCount');

        const popularSection =
            document.getElementById('aplikasi-populer');

        const allAppsSection =
            document.getElementById('semua-aplikasi');

        let searchTimeout = null;



        /*
        |--------------------------------------------------------------------------
        | TAMPILAN AWAL / MODE PENCARIAN
        |--------------------------------------------------------------------------
        */

        function setSearchMode(isSearching) {

            liveSearchSection.classList.toggle('active', isSearching);

            // Sembunyikan Populer & Semua Aplikasi supaya hasil tidak tampil dua kali
            popularSection.style.display =
                isSearching ? 'none' : '';

            allAppsSection.style.display =
                isSearching ? 'none' : '';

        }


        // Simpan kata kunci di URL supaya hasil pencarian bisa dibagikan / di-refresh
        function syncSearchUrl(keyword) {

            const url =
                new URL(window.location.href);

            if (keyword) {
                url.searchParams.set('search', keyword);
            } else {
                url.searchParams.delete('search');
            }

            history.replaceState(null, '', url);

        }


        function updateClearButton() {

            searchInputWrapper.classList.toggle(
                'has-value',
                searchInput.value.trim() !== ''
            );

        }


        function resetSearch() {

            clearTimeout(searchTimeout);

            searchInput.value = '';

            updateClearButton();

            performLiveSearch('');

        }



        /*
        |--------------------------------------------------------------------------
        | RENDER HASIL SEARCH
        |--------------------------------------------------------------------------
        */

        function renderSearchResults(
            applications,
            keyword
        ) {

            if (!applications.length) {

                liveSearchCount.textContent = '';

                liveSearchResults.innerHTML =
                    renderEmptyState(
                        ICONS.searchOff,
                        'Aplikasi tidak ditemukan',
                        `Tidak ada aplikasi yang cocok dengan "${escapeHtml(keyword)}". Coba kata kunci lain.`,
                        true
                    );

                return;

            }

            liveSearchCount.innerHTML =
                `<strong>${applications.length}</strong> aplikasi ditemukan`;

            liveSearchResults.innerHTML =
                applications
                    .map(renderAppCard)
                    .join('');

        }



        /*
        |--------------------------------------------------------------------------
        | PERFORM LIVE SEARCH
        |--------------------------------------------------------------------------
        */

        async function performLiveSearch(
            keyword
        ) {

            const cleanKeyword =
                keyword.trim();

            syncSearchUrl(cleanKeyword);


            // Input kosong: kembalikan tampilan awal
            if (!cleanKeyword) {

                setSearchMode(false);

                liveSearchResults.innerHTML = '';
                liveSearchKeyword.textContent = '';
                liveSearchCount.textContent = '';

                return;

            }


            setSearchMode(true);

            liveSearchKeyword.textContent =
                `"${cleanKeyword}"`;

            liveSearchCount.textContent =
                'Mencari...';

            liveSearchResults.innerHTML =
                renderSkeletonCards(4);


            try {

                const response =
                    await fetch(
                        `${searchUrl}?search=${encodeURIComponent(cleanKeyword)}`,
                        {
                            headers: {
                                'Accept': 'application/json'
                            },

                            cache: 'no-store'
                        }
                    );

                if (!response.ok) {

                    throw new Error(
                        'Gagal mengambil data pencarian.'
                    );

                }

                const applications =
                    await response.json();

                // Pastikan hasil sesuai input terbaru
                if (
                    searchInput.value.trim() !==
                    cleanKeyword
                ) {
                    return;
                }

                renderSearchResults(
                    applications,
                    cleanKeyword
                );

            } catch (error) {

                console.error(
                    'Error live search:',
                    error
                );

                liveSearchCount.textContent = '';

                liveSearchResults.innerHTML =
                    renderEmptyState(
                        ICONS.alert,
                        'Terjadi kesalahan',
                        'Pencarian gagal dimuat. Periksa koneksi lalu coba lagi.',
                        false
                    );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | EVENT PENCARIAN
        |--------------------------------------------------------------------------
        */

        searchInput.addEventListener('input', function () {

            clearTimeout(searchTimeout);

            updateClearButton();

            const keyword =
                this.value;

            // Delay 200ms supaya request tidak terlalu banyak
            searchTimeout =
                setTimeout(
                    () => performLiveSearch(keyword),
                    200
                );

        });


        // Enter langsung mencari tanpa reload halaman
        searchForm.addEventListener('submit', function (event) {

            event.preventDefault();

            clearTimeout(searchTimeout);

            performLiveSearch(searchInput.value);

            if (searchInput.value.trim()) {
                liveSearchSection.scrollIntoView({ block: 'start' });
            }

        });


        searchClearButton.addEventListener('click', function () {

            resetSearch();

            searchInput.focus();

        });


        liveSearchResults.addEventListener('click', function (event) {

            if (event.target.closest('[data-action="reset-search"]')) {

                resetSearch();

                searchInput.focus();

            }

        });


        // Pintasan keyboard: "/" untuk fokus ke pencarian, Esc untuk menghapus
        document.addEventListener('keydown', function (event) {

            const target =
                event.target;

            const isTyping =
                target.matches('input, textarea, select, [contenteditable="true"]');

            if (event.key === '/' && !isTyping) {

                event.preventDefault();

                searchInput.focus();

                searchInput.select();

            }

            if (event.key === 'Escape' && target === searchInput && searchInput.value) {

                resetSearch();

            }

        });


        // Halaman dibuka dengan ?search=
        if (searchInput.value.trim() !== '') {

            performLiveSearch(searchInput.value);

        }



        /*
        |--------------------------------------------------------------------------
        | POLLING APLIKASI POPULER
        |--------------------------------------------------------------------------
        */

        loadPopularApplications();

        setInterval(
            loadPopularApplications,
            3000
        );



        /*
        |--------------------------------------------------------------------------
        | NAVBAR AKTIF, HEADER & TOMBOL KE ATAS SESUAI POSISI SCROLL
        |--------------------------------------------------------------------------
        */

        const navLinks =
            document.querySelectorAll(
                '.header .nav-link'
            );

        const header =
            document.getElementById('siteHeader');

        const backToTop =
            document.getElementById('backToTop');

        function updateActiveNavLink() {

            const offset =
                header.offsetHeight + 80;

            let currentId = 'beranda';

            navLinks.forEach(link => {

                const section =
                    document.querySelector(
                        link.getAttribute('href')
                    );

                // Lewati section yang sedang disembunyikan (mis. saat live search)
                if (!section || section.offsetParent === null) {
                    return;
                }

                if (
                    section.getBoundingClientRect().top <= offset
                ) {
                    currentId = section.id;
                }

            });

            navLinks.forEach(link => {

                const isActive =
                    link.getAttribute('href') === '#' + currentId;

                link.classList.toggle('active', isActive);

                if (isActive) {
                    link.setAttribute('aria-current', 'location');
                } else {
                    link.removeAttribute('aria-current');
                }

            });

        }


        function updateScrollUi() {

            updateActiveNavLink();

            header.classList.toggle(
                'is-scrolled',
                window.scrollY > 8
            );

            backToTop.classList.toggle(
                'visible',
                window.scrollY > 600
            );

        }


        // Klik menu saat sedang mencari: tutup pencarian dulu agar section-nya tampil
        navLinks.forEach(link => {

            link.addEventListener('click', function () {

                if (liveSearchSection.classList.contains('active')) {
                    resetSearch();
                }

            });

        });


        backToTop.addEventListener('click', function () {

            window.scrollTo({ top: 0 });

        });


        let scrollTicking = false;

        window.addEventListener('scroll', () => {

            if (scrollTicking) {
                return;
            }

            scrollTicking = true;

            requestAnimationFrame(() => {
                updateScrollUi();
                scrollTicking = false;
            });

        }, { passive: true });

        updateScrollUi();

    </script>


</body>

</html>
