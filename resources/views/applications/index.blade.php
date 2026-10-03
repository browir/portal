<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        Portal Aplikasi Syifa Global Group
    </title>

    <link
        rel="stylesheet"
        href="{{ asset('css/styleindex.css') }}?v={{ time() }}"
    >

    <style>

        .header .brand {
            flex-shrink: 0;
            display: flex;
            align-items: center;
        }

        .header .logo-img {
            display: block;
            width: 185px !important;
            height: auto !important;
            max-width: 185px !important;
            max-height: 52px !important;
            object-fit: contain !important;
            object-position: left center !important;
        }


        /*
        |--------------------------------------------------------------------------
        | NAVBAR
        |--------------------------------------------------------------------------
        */

        .header .navbar {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .header .nav-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 30px;
            padding: 0 12px;
            border-radius: 999px;
            color: #334155;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition: background-color .2s ease, color .2s ease;
        }

        .header .nav-icon {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .header .nav-link:hover {
            background: #eef7f4;
            color: #0d8a72;
        }

        .header .nav-link.active {
            background: #0d8a72;
            color: #ffffff;
        }

        .header .nav-link:focus-visible {
            outline: 2px solid #0d8a72;
            outline-offset: 2px;
        }


        /*
        |--------------------------------------------------------------------------
        | FOOTER LOGO
        |--------------------------------------------------------------------------
        */

        .footer-brand-badge {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            padding: 6px 12px;
            border-radius: 20px;
        }

        .footer-brand-badge img {
            height: 20px;
            width: auto;
            object-fit: contain;
        }


        /*
        |--------------------------------------------------------------------------
        | BADGE PEMBERITAHUAN
        |--------------------------------------------------------------------------
        */

        .popular-card,
        .app-card {
            position: relative;
        }

        .application-notification-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 48px;
            height: 24px;
            padding: 0 9px;
            border-radius: 999px;
            background: #0d8a72;
            color: #ffffff;
            font-size: 9px;
            font-weight: 700;
            letter-spacing: .35px;
            box-shadow: 0 2px 7px rgba(0,0,0,.14);
        }

        .application-notification-badge.update {
            background: #2563eb;
        }

        .popular-card .application-notification-badge {
            top: 10px;
            right: 10px;
        }


        /*
        |--------------------------------------------------------------------------
        | LIVE SEARCH
        |--------------------------------------------------------------------------
        */

        .live-search-section {
            display: none;
            padding: 40px 20px 60px;
            background: #ffffff;
        }

        .live-search-section.active {
            display: block;
        }

        .live-search-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .live-search-title {
            margin-bottom: 25px;
            font-size: 28px;
            font-weight: 700;
            color: #123c35;
        }

        .live-search-title span {
            color: #0d8a72;
        }

        .live-search-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 25px;
        }

        .live-search-empty {
            width: 100%;
            padding: 50px 20px;
            text-align: center;
            color: #777;
            font-size: 16px;
        }

        .live-search-loading {
            width: 100%;
            padding: 40px 20px;
            text-align: center;
            color: #777;
        }


        /*
        |--------------------------------------------------------------------------
        | RESPONSIVE
        |--------------------------------------------------------------------------
        */

        @media (max-width: 900px) {

            .live-search-grid {
                grid-template-columns:
                    repeat(
                        2,
                        minmax(0, 1fr)
                    );
            }

        }

        @media (max-width: 800px) {

            .header .logo-img {
                width: 165px !important;
                max-width: 165px !important;
                max-height: 48px !important;
            }

        }

        @media (max-width: 600px) {

            .header .logo-img {
                width: 150px !important;
                max-width: 150px !important;
                max-height: 45px !important;
            }

            .header .navbar {
                gap: 2px;
            }

            .header .nav-link {
                height: 26px;
                padding: 0 8px;
                gap: 4px;
                font-size: 10px;
            }

            .header .nav-icon {
                width: 13px;
                height: 13px;
            }

            .live-search-section {
                padding: 30px 15px 45px;
            }

            .live-search-title {
                font-size: 23px;
            }

            .live-search-grid {
                grid-template-columns: 1fr;
            }

        }

        @media (max-width: 480px) {

            /* Layar sempit: tampilkan ikon saja, teks tetap ada di title */
            .header .nav-label {
                display: none;
            }

            .header .nav-link {
                width: 30px;
                height: 30px;
                padding: 0;
                justify-content: center;
            }

            .header .nav-icon {
                width: 16px;
                height: 16px;
            }

        }

    </style>

</head>


<body>


    <!-- =========================================================
         HEADER
    ========================================================== -->

    <header class="header">

        <div class="header-content">

            <div class="brand">

                <img
                    src="{{ asset('images/logo-new.png') }}"
                    alt="Portal PT. Syifa Global Group"
                    class="logo-img"
                >

            </div>


            <nav class="navbar">

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
             HERO
        ====================================================== -->

        <section
            class="hero-wrapper"
            id="beranda"
        >

            <div class="hero-container">


                <div class="hero-text">

                    <h1>

                        Pusat Akses Terpadu Seluruh Aplikasi
                        <br>

                        Syifa Global Group

                    </h1>


                    <p class="hero-subtitle">

                        Connected Care, Better Experience.

                    </p>


                    <!-- =================================================
                         SEARCH
                    ================================================== -->

                    <form
                        method="GET"
                        action="{{ route('applications.index') }}"
                        class="search-form"
                        id="applicationSearchForm"
                    >

                        <div class="search-input-wrapper">

                            <span class="search-icon">
                                🔍
                            </span>


                            <input
                                type="text"
                                name="search"
                                id="applicationSearchInput"
                                placeholder="Cari Aplikasi..."
                                value="{{ $search }}"
                                autocomplete="off"
                            >

                        </div>

                    </form>

                </div>



                <div class="hero-image">

                    <div class="oval-image-wrapper">

                        <img
                            src="{{ asset('images/rs.jpeg') }}"
                            alt="Gedung RSU Syifa Medika"
                        >

                    </div>

                </div>

            </div>



            <!-- =====================================================
                 JUDUL POPULAR
            ====================================================== -->

            <div
                class="popular-title-box"
                id="aplikasi-populer"
            >

                <h2>
                    Aplikasi Populer
                </h2>

            </div>

        </section>



        <!-- =========================================================
             APLIKASI POPULER
        ========================================================== -->

        <section class="popular-green-section">

            <div class="popular-grid-container">

                <div
                    class="popular-grid"
                    id="popularApplicationsList"
                >

                    @forelse($popularApplications as $application)

                        <div
                            class="popular-card"
                            data-application-id="{{ $application->id }}"
                        >

                            @if($application->notification_type === 'new')

                                <span class="application-notification-badge">
                                    NEW
                                </span>

                            @elseif($application->notification_type === 'updated')

                                <span class="application-notification-badge update">
                                    UPDATE
                                </span>

                            @endif


                            <div class="popular-card-top">

                                @if($application->icon)

                                    <img
                                        src="{{ asset('storage/' . $application->icon) }}"
                                        alt="{{ $application->name }}"
                                    >

                                @else

                                    <span class="fallback-icon">
                                        📱
                                    </span>

                                @endif

                            </div>


                            <div class="popular-card-bottom">

                                <h3>
                                    {{ $application->name }}
                                </h3>


                                <p>
                                    {{
                                        $application->description
                                        ?: 'Mendaftarkan Diri untuk Pemeriksaan'
                                    }}
                                </p>


                                <a
                                    href="{{ route('applications.open', $application) }}"
                                    class="btn-open"
                                >
                                    Buka Aplikasi
                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="empty text-white">

                            Belum ada data aplikasi populer.

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
        >

            <div class="live-search-container">

                <h2 class="live-search-title">

                    Hasil Pencarian

                    <span id="liveSearchKeyword"></span>

                </h2>


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
        >

            <div class="all-apps-container">


                <h2 class="section-title text-dark">

                    Semua Aplikasi

                </h2>


                <div class="applications-grid">

                    @forelse($applications as $application)

                        <div class="app-card">


                            @if($application->notification_type === 'new')

                                <span class="application-notification-badge">
                                    NEW
                                </span>

                            @elseif($application->notification_type === 'updated')

                                <span class="application-notification-badge update">
                                    UPDATE
                                </span>

                            @endif


                            <div class="app-card-header">

                                @if($application->icon)

                                    <img
                                        src="{{ asset('storage/' . $application->icon) }}"
                                        alt="{{ $application->name }}"
                                    >

                                @else

                                    <div class="placeholder-box">

                                        <span class="fallback-icon">
                                            📱
                                        </span>

                                    </div>

                                @endif

                            </div>


                            <div class="app-card-body">

                                <h3>
                                    {{ $application->name }}
                                </h3>


                                <p>
                                    {{
                                        $application->description
                                        ?: 'Mendaftarkan Diri untuk Pemeriksaan'
                                    }}
                                </p>


                                <a
                                    href="{{ route('applications.open', $application) }}"
                                    class="btn-open"
                                >
                                    Buka Aplikasi
                                </a>

                            </div>

                        </div>

                    @empty

                        <div class="empty">

                            Belum ada aplikasi tersedia.

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



    <!-- =========================================================
         JAVASCRIPT
    ========================================================== -->

    <script>

        const storageUrl =
            @json(asset('storage'));


        /*
        |--------------------------------------------------------------------------
        | POPULAR APPLICATIONS
        |--------------------------------------------------------------------------
        */

        async function loadPopularApplications() {

            try {

                const response =
                    await fetch(
                        '{{ route('applications.popular') }}',
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
                    await response.json();


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


                popularList.innerHTML =
                    applications
                        .slice(0, 3)
                        .map((application) => {


                            const logoUrl =
                                application.icon
                                    ? (
                                        application.icon.startsWith('http')
                                            ? application.icon
                                            : `${storageUrl}/${application.icon}`
                                    )
                                    : null;


                            const name =
                                application.name ||
                                'SiLapor';


                            const description =
                                application.description ||
                                'Mendaftarkan Diri untuk Pemeriksaan';


                            const logo =
                                logoUrl
                                    ? `
                                        <img
                                            src="${logoUrl}"
                                            alt="${escapeHtml(name)}"
                                        >
                                    `
                                    : `
                                        <span class="fallback-icon">
                                            📱
                                        </span>
                                    `;


                            return `

                                <div
                                    class="popular-card"
                                    data-application-id="${application.id}"
                                >

                                    ${
                                        application.notification_type === 'new'
                                            ? '<span class="application-notification-badge">NEW</span>'

                                            : application.notification_type === 'updated'
                                                ? '<span class="application-notification-badge update">UPDATE</span>'

                                                : ''
                                    }


                                    <div class="popular-card-top">

                                        ${logo}

                                    </div>


                                    <div class="popular-card-bottom">

                                        <h3>

                                            ${escapeHtml(name)}

                                        </h3>


                                        <p>

                                            ${escapeHtml(description)}

                                        </p>


                                        <a
                                            href="{{ url('/applications') }}/${application.id}/open"
                                            class="btn-open"
                                        >
                                            Buka Aplikasi
                                        </a>

                                    </div>

                                </div>

                            `;

                        })
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
        | ESCAPE HTML
        |--------------------------------------------------------------------------
        */

        function escapeHtml(text) {

            const div =
                document.createElement('div');


            div.textContent =
                text ?? '';


            return div.innerHTML;

        }



        /*
        |--------------------------------------------------------------------------
        | LIVE SEARCH ELEMENT
        |--------------------------------------------------------------------------
        */

        const searchInput =
            document.getElementById(
                'applicationSearchInput'
            );


        const liveSearchSection =
            document.getElementById(
                'liveSearchSection'
            );


        const liveSearchResults =
            document.getElementById(
                'liveSearchResults'
            );


        const liveSearchKeyword =
            document.getElementById(
                'liveSearchKeyword'
            );


        const popularSection =
            document.querySelector(
                '.popular-green-section'
            );


        const popularTitleBox =
            document.getElementById(
                'aplikasi-populer'
            );


        const allAppsSection =
            document.getElementById(
                'semua-aplikasi'
            );


        let searchTimeout = null;



        /*
        |--------------------------------------------------------------------------
        | RENDER HASIL SEARCH
        |--------------------------------------------------------------------------
        */

        function renderSearchResults(
            applications,
            keyword
        ) {

            if (!liveSearchResults) {
                return;
            }


            liveSearchKeyword.textContent =
                keyword
                    ? `"${keyword}"`
                    : '';



            /*
            |--------------------------------------------------------------------------
            | TIDAK ADA HASIL
            |--------------------------------------------------------------------------
            */

            if (!applications.length) {

                liveSearchResults.innerHTML = `

                    <div class="live-search-empty">

                        Tidak ada aplikasi yang ditemukan.

                    </div>

                `;

                return;

            }



            /*
            |--------------------------------------------------------------------------
            | HASIL APLIKASI
            |--------------------------------------------------------------------------
            */

            liveSearchResults.innerHTML =
                applications
                    .map((application) => {


                        const logoUrl =
                            application.icon
                                ? (
                                    application.icon.startsWith('http')
                                        ? application.icon
                                        : `${storageUrl}/${application.icon}`
                                )
                                : null;


                        const name =
                            application.name ||
                            'Aplikasi';


                        const description =
                            application.description ||
                            'Mendaftarkan Diri untuk Pemeriksaan';


                        const logo =
                            logoUrl
                                ? `
                                    <img
                                        src="${logoUrl}"
                                        alt="${escapeHtml(name)}"
                                    >
                                `
                                : `
                                    <div class="placeholder-box">

                                        <span class="fallback-icon">
                                            📱
                                        </span>

                                    </div>
                                `;


                        let notificationBadge = '';


                        if (
                            application.notification_type === 'new'
                        ) {

                            notificationBadge = `

                                <span class="application-notification-badge">

                                    NEW

                                </span>

                            `;

                        }


                        if (
                            application.notification_type === 'updated'
                        ) {

                            notificationBadge = `

                                <span class="application-notification-badge update">

                                    UPDATE

                                </span>

                            `;

                        }


                        return `

                            <div class="app-card">

                                ${notificationBadge}


                                <div class="app-card-header">

                                    ${logo}

                                </div>


                                <div class="app-card-body">

                                    <h3>

                                        ${escapeHtml(name)}

                                    </h3>


                                    <p>

                                        ${escapeHtml(description)}

                                    </p>


                                    <a
                                        href="{{ url('/applications') }}/${application.id}/open"
                                        class="btn-open"
                                    >
                                        Buka Aplikasi
                                    </a>

                                </div>

                            </div>

                        `;

                    })
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



            /*
            |--------------------------------------------------------------------------
            | INPUT KOSONG
            |--------------------------------------------------------------------------
            |
            | Kembalikan tampilan awal.
            |
            */

            if (!cleanKeyword) {

                liveSearchSection.classList.remove(
                    'active'
                );


                if (popularSection) {

                    popularSection.style.display =
                        '';

                }


                if (popularTitleBox) {

                    popularTitleBox.style.display =
                        '';

                }


                if (allAppsSection) {

                    allAppsSection.style.display =
                        '';

                }


                liveSearchResults.innerHTML =
                    '';


                liveSearchKeyword.textContent =
                    '';


                return;

            }



            /*
            |--------------------------------------------------------------------------
            | USER SEDANG SEARCH
            |--------------------------------------------------------------------------
            |
            | Sembunyikan Aplikasi Populer.
            |
            */

            if (popularSection) {

                popularSection.style.display =
                    'none';

            }


            if (popularTitleBox) {

                popularTitleBox.style.display =
                    'none';

            }



            /*
            |--------------------------------------------------------------------------
            | SEMBUNYIKAN SEMUA APLIKASI
            |--------------------------------------------------------------------------
            |
            | Supaya hasil pencarian tidak tampil dua kali.
            |
            */

            if (allAppsSection) {

                allAppsSection.style.display =
                    'none';

            }



            /*
            |--------------------------------------------------------------------------
            | TAMPILKAN LIVE SEARCH
            |--------------------------------------------------------------------------
            */

            liveSearchSection.classList.add(
                'active'
            );


            liveSearchResults.innerHTML = `

                <div class="live-search-loading">

                    Mencari aplikasi...

                </div>

            `;



            try {

                const response =
                    await fetch(
                        `{{ route('applications.search') }}?search=${encodeURIComponent(cleanKeyword)}`,
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



                /*
                |--------------------------------------------------------------------------
                | PASTIKAN HASIL SESUAI INPUT TERBARU
                |--------------------------------------------------------------------------
                */

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


                liveSearchResults.innerHTML = `

                    <div class="live-search-empty">

                        Terjadi kesalahan saat mencari aplikasi.

                    </div>

                `;

            }

        }



        /*
        |--------------------------------------------------------------------------
        | EVENT INPUT
        |--------------------------------------------------------------------------
        */

        if (searchInput) {

            searchInput.addEventListener(
                'input',
                function () {

                    clearTimeout(
                        searchTimeout
                    );


                    const keyword =
                        this.value;


                    /*
                    |--------------------------------------------------------------------------
                    | Delay 200ms
                    |--------------------------------------------------------------------------
                    |
                    | Supaya request tidak terlalu banyak.
                    |
                    */

                    searchTimeout =
                        setTimeout(
                            function () {

                                performLiveSearch(
                                    keyword
                                );

                            },
                            200
                        );

                }
            );



            /*
            |--------------------------------------------------------------------------
            | JIKA HALAMAN DIBUKA DENGAN ?search=
            |--------------------------------------------------------------------------
            */

            if (
                searchInput.value.trim() !== ''
            ) {

                performLiveSearch(
                    searchInput.value
                );

            }

        }



        /*
        |--------------------------------------------------------------------------
        | POLLING APLIKASI POPULER
        |--------------------------------------------------------------------------
        |
        | Tetap berjalan seperti sebelumnya.
        |
        */

        @if(!$search)

            loadPopularApplications();


            setInterval(
                loadPopularApplications,
                3000
            );

        @endif



        /*
        |--------------------------------------------------------------------------
        | NAVBAR AKTIF SESUAI POSISI SCROLL
        |--------------------------------------------------------------------------
        */

        const navLinks =
            document.querySelectorAll(
                '.header .nav-link'
            );

        const header =
            document.querySelector('.header');

        function updateActiveNavLink() {

            const offset =
                (header ? header.offsetHeight : 0) + 80;

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

                link.classList.toggle(
                    'active',
                    link.getAttribute('href') === '#' + currentId
                );

            });

        }

        let navTicking = false;

        window.addEventListener('scroll', () => {

            if (navTicking) {
                return;
            }

            navTicking = true;

            requestAnimationFrame(() => {
                updateActiveNavLink();
                navTicking = false;
            });

        }, { passive: true });

        updateActiveNavLink();

    </script>


</body>

</html>
