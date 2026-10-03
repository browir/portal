@extends('layouts.superadmin')



@section('title', 'Kelola Aplikasi - Super Admin')



@push('styles')

<link href="https\://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght\@400;500;600;700&display=swap" rel="stylesheet">



<style>



    .page-wrapper,

.page-wrapper * {

    font-family: 'Plus Jakarta Sans', sans-serif;

}





    .page-wrapper {

        position: relative;

        isolation: isolate;

        min-height: 100vh;

        width: 100%;

        padding: 40px 30px;

        box-sizing: border-box;

        background: transparent;

    }





    .page-wrapper::before {

        content: "";

        position: fixed;

        top: 50px;

        right: 0;

        bottom: 0;

        left: 190px;



        background:

            linear-gradient(

                rgba(105, 140, 120, 0.75),

                rgba(105, 140, 120, 0.75)

            ),

            url('{{ asset('images/rs.jpeg') }}')

            center center / cover no-repeat;



        z-index: -1;

        pointer-events: none;

    }





    .page-inner {

        max-width: 980px;

        margin: 0 auto;

    }





    .page-header {

        text-align: center;

        margin-bottom: 25px;

        margin-top: 5px;

    }





    .page-header h1 {

        font-size: 40px;

        line-height: 1.2;

        font-weight: 700;

        color: #ffffff;

        margin-bottom: 6px;

        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);

    }





    .page-header p {

        font-size: 14px;

        color: #f1f5f9;

        font-weight: 400;

        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);

    }





    .table-card {

        background: #ffffff;

        border-radius: 20px;

        border: none;

        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);

        overflow: hidden;

        margin-bottom: 20px;

    }





    .table-container {

        width: 100%;

        overflow-x: auto;

    }





    table {

        width: 100%;

        border-collapse: collapse;

        background: #ffffff;

    }





    th {

        height: 50px;

        padding: 12px 24px;

        background: #ffffff;

        color: #94a3b8;

        font-size: 14px;

        font-weight: 500;

        text-align: left;

        border-bottom: 1.5px solid #e2e8f0;

    }





    th.text-center,

    td.text-center {

        text-align: center;

    }





    td {

        height: 60px;

        padding: 10px 24px;

        font-size: 14px;

        text-align: left;

        border-bottom: 1.5px solid #e2e8f0;

        color: #0f172a;

        vertical-align: middle;

    }





    tbody tr:last-child td {

        border-bottom: none;

    }





    .logo-cell {

        width: 90px;

    }





    .application-logo {

        width: 70px;

        height: 50px;

        object-fit: contain;

        object-position: center;

        border-radius: 0;

        display: block;

    }





    .no-logo {

        width: 44px;

        height: 44px;

        border-radius: 12px;

        background: #cbd5e1;

    }





    .application-name {

        font-size: 14px;

        font-weight: 700;

        color: #000000;

    }





    .application-url {

        color: #64748b;

        font-size: 14px;

        font-weight: 500;

        text-decoration: none;

    }





    /*

    |--------------------------------------------------------------------------

    | STATUS

    |--------------------------------------------------------------------------

    */



    .status-form {

        margin: 0;

        padding: 0;

    }





    .status-button {

        min-width: 88px;

        height: 30px;

        padding: 0 12px;

        border: none;

        border-radius: 20px;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        gap: 7px;

        font-family: 'Plus Jakarta Sans', sans-serif;

        font-size: 12px;

        font-weight: 700;

        cursor: pointer;

        transition: 0.2s ease;

    }





    .status-button:hover {

        transform: translateY(-1px);

        opacity: 0.88;

    }





    .status-active {

        background: #dcfce7;

        color: #15803d;

    }





    .status-inactive {

        background: #fee2e2;

        color: #dc2626;

    }





    .status-dot {

        width: 7px;

        height: 7px;

        border-radius: 50%;

        background: currentColor;

        display: inline-block;

        flex-shrink: 0;

    }





    .action-wrapper {

        display: flex;

        align-items: center;

        justify-content: center;

        gap: 6px;

    }





    .btn-action-edit {

        padding: 5px 14px;

        border-radius: 8px;

        background: linear-gradient(

            180deg,

            #ffffff 0%,

            #f1f5f9 100%

        );

        border: 1px solid #cbd5e1;

        color: #334155;

        font-size: 12px;

        font-weight: 700;

        text-decoration: none;

        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);

        display: inline-block;

        cursor: pointer;

        transition: 0.2s ease;

    }





    .btn-action-edit:hover {

        background: #f8fafc;

        transform: translateY(-1px);

    }





    .btn-action-delete {

        padding: 5px 14px;

        border-radius: 8px;

        background: #ef4444;

        border: none;

        color: #ffffff;

        font-size: 12px;

        font-weight: 700;

        cursor: pointer;

        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);

        transition: 0.2s ease;

    }





    .btn-action-delete:hover {

        background: #dc2626;

        transform: translateY(-1px);

    }





    .bottom-toolbar {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }

    .search-wrapper {
        position: relative;
        width: 260px;
    }

    .search-input {
        width: 100%;
        height: 38px;
        padding: 0 16px 0 42px;
        border-radius: 20px;
        background: #ffffff;
        border: none;
        color: #0f172a;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13px;
        font-weight: 500;
        outline: none;
        box-sizing: border-box;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: 0.2s ease;
    }

    .search-input:focus {
        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.14);
    }

    .search-input::placeholder {
        color: #94a3b8;
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        width: 16px;
        height: 16px;
        transform: translateY(-50%);
        color: #94a3b8;
        pointer-events: none;
        fill: none;
        stroke: currentColor;
        stroke-width: 2;
        stroke-linecap: round;
        stroke-linejoin: round;
    }

    .no-search-result {
        display: none;
        text-align: center;
        padding: 25px 20px;
        color: #64748b;
        font-size: 14px;
    }





    .add-button {

        height: 38px;

        padding: 0 20px;

        border-radius: 20px;

        background: #ffffff;

        border: none;

        color: #0f172a;

        text-decoration: none;

        font-size: 13px;

        font-weight: 700;

        display: inline-flex;

        align-items: center;

        justify-content: center;

        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);

        transition: 0.2s ease;

    }





    .add-button:hover {

        transform: translateY(-1px);

        box-shadow: 0 6px 14px rgba(0, 0, 0, 0.14);

    }





    /*

    |--------------------------------------------------------------------------

    | DELETE MODAL

    |--------------------------------------------------------------------------

    */



    .delete-modal {

        position: fixed;

        inset: 0;

        z-index: 9999;

        display: none;

        align-items: center;

        justify-content: center;

        padding: 20px;

        background: rgba(15, 23, 42, 0.55);

        backdrop-filter: blur(4px);

        -webkit-backdrop-filter: blur(4px);

    }





    .delete-modal.show {

        display: flex;

    }





    .delete-modal-card {

        width: 100%;

        max-width: 400px;

        background: #ffffff;

        border-radius: 20px;

        padding: 30px;

        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.25);

        text-align: center;

        transform: translateY(10px) scale(0.97);

        opacity: 0;

        transition: all 0.2s ease;

    }





    .delete-modal.show .delete-modal-card {

        transform: translateY(0) scale(1);

        opacity: 1;

    }





    .delete-modal-icon {

        width: 58px;

        height: 58px;

        margin: 0 auto 18px;

        border-radius: 50%;

        background: #fee2e2;

        color: #ef4444;

        display: flex;

        align-items: center;

        justify-content: center;

    }





    .delete-modal-icon svg {

        width: 28px;

        height: 28px;

        fill: none;

        stroke: currentColor;

        stroke-width: 2;

        stroke-linecap: round;

        stroke-linejoin: round;

    }





    .delete-modal-title {

        margin: 0 0 8px;

        color: #0f172a;

        font-size: 21px;

        font-weight: 700;

    }





    .delete-modal-text {

        margin: 0 auto;

        max-width: 320px;

        color: #64748b;

        font-size: 13px;

        line-height: 1.6;

    }





    .delete-modal-app-name {

        margin-top: 8px;

        color: #0f172a;

        font-size: 14px;

        font-weight: 700;

        word-break: break-word;

    }





    .delete-modal-actions {

        display: flex;

        gap: 10px;

        margin-top: 24px;

    }





    .delete-modal-button {

        flex: 1;

        height: 42px;

        border-radius: 10px;

        border: none;

        font-family: 'Plus Jakarta Sans', sans-serif;

        font-size: 13px;

        font-weight: 700;

        cursor: pointer;

        transition: 0.2s ease;

    }





    .delete-modal-cancel {

        background: #f1f5f9;

        color: #475569;

        border: 1px solid #e2e8f0;

    }





    .delete-modal-cancel:hover {

        background: #e2e8f0;

    }





    .delete-modal-confirm {

        background: #ef4444;

        color: #ffffff;

    }





    .delete-modal-confirm:hover {

        background: #dc2626;

    }





    /*

    |--------------------------------------------------------------------------

    | RESPONSIVE

    |--------------------------------------------------------------------------

    */



    @media (max-width: 768px) {



        .page-wrapper {

            padding: 30px 15px;

        }





        .page-header h1 {

            font-size: 32px;

        }





        .page-header p {

            font-size: 13px;

        }





        .table-card {

            border-radius: 16px;

        }





        th,

        td {

            padding: 10px 16px;

        }





        .delete-modal-card {

            max-width: 360px;

            padding: 25px 20px;

        }

        .bottom-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-wrapper {
            width: 100%;
        }

        .add-button {
            width: 100%;
        }

    }





    @media (max-width: 480px) {



        .page-wrapper {

            padding: 25px 10px;

        }





        .page-header h1 {

            font-size: 28px;

        }





        .delete-modal-actions {

            flex-direction: column-reverse;

        }





        .delete-modal-button {

            width: 100%;

        }

    }



</style>

@endpush





@section('content')



<div

    class="page-wrapper"

    style="background: linear-gradient(rgba(105, 140, 120, 0.75), rgba(105, 140, 120, 0.75)), url('{{ asset('images/rs.jpeg') }}') center/cover no-repeat;"

>



    <div class="page-inner">



        <div class="page-header">



            <h1>

                Kelola Aplikasi

            </h1>



            <p>

                Kelola aplikasi yang tersedia di Portal Rumah Sakit.

            </p>



        </div>





        <div class="table-card">



            <div class="table-container">



                <table>



                    <thead>



                        <tr>



                            <th class="logo-cell">

                                Logo

                            </th>



                            <th>

                                Nama Aplikasi

                            </th>



                            <th>

                                URL

                            </th>



                            <th>

                                Status

                            </th>



                            <th

                                class="text-center"

                                style="width: 150px;"

                            >

                                Aksi

                            </th>



                        </tr>



                    </thead>





                    <tbody>



                        @foreach ($applications as $application)



                            <tr>



                                <td class="logo-cell">



                                    @if ($application->icon)



                                        <img

                                            src="{{ asset('storage/' . $application->icon) }}"

                                            class="application-logo"

                                            alt="{{ $application->name }}"

                                        >



                                    @else



                                        <div class="no-logo"></div>



                                    @endif



                                </td>





                                <td>



                                    <div class="application-name">

                                        {{ $application->name }}

                                    </div>



                                </td>





                                <td>



                                    <a

                                        href="{{ $application->url }}"

                                        target="_blank"

                                        class="application-url"

                                    >

                                        {{ $application->url }}

                                    </a>



                                </td>





                                <td>



                                    <form

                                        action="{{ route('superadmin.applications.toggle-status', $application) }}"

                                        method="POST"

                                        class="status-form"

                                    >



                                        @csrf



                                        @method('PATCH')





                                        @if ($application->is_active)



                                            <button

                                                type="submit"

                                                class="status-button status-active"

                                                title="Klik untuk menonaktifkan aplikasi"

                                                onclick="return confirm('Nonaktifkan aplikasi {{ $application->name }}?');"

                                            >



                                                <span class="status-dot"></span>



                                                Aktif



                                            </button>



                                        @else



                                            <button

                                                type="submit"

                                                class="status-button status-inactive"

                                                title="Klik untuk mengaktifkan aplikasi"

                                                onclick="return confirm('Aktifkan aplikasi {{ $application->name }}?');"

                                            >



                                                <span class="status-dot"></span>



                                                Nonaktif



                                            </button>



                                        @endif



                                    </form>



                                </td>





                                <td>



                                    <div class="action-wrapper">



                                        <a

                                            href="{{ route('superadmin.applications.edit', $application) }}"

                                            class="btn-action-edit"

                                        >

                                            Edit

                                        </a>





                                        <form

                                            action="{{ route('superadmin.applications.destroy', $application) }}"

                                            method="POST"

                                            class="delete-form"

                                            data-application-name="{{ $application->name }}"

                                        >



                                            @csrf



                                            @method('DELETE')





                                            <button

                                                type="submit"

                                                class="btn-action-delete"

                                            >

                                                Hapus

                                            </button>



                                        </form>



                                    </div>



                                </td>



                            </tr>



                        @endforeach



                        <tr id="noSearchResult" class="no-search-result-row">
                            <td colspan="5" class="no-search-result">
                                Aplikasi tidak ditemukan.
                            </td>
                        </tr>

                    </tbody>



                </table>



            </div>



        </div>





        <div class="bottom-toolbar">

            <div class="search-wrapper">
                <svg class="search-icon" viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="11" cy="11" r="7"></circle>
                    <path d="m20 20-4-4"></path>
                </svg>

                <input
                    type="search"
                    id="applicationSearch"
                    class="search-input"
                    placeholder="Cari aplikasi..."
                    autocomplete="off"
                    aria-label="Cari aplikasi"
                >
            </div>

            <a
                href="{{ route('superadmin.applications.create') }}"
                class="add-button"
            >
                + Tambah Aplikasi
            </a>

        </div>



    </div>



</div>





<!-- DELETE MODAL -->



<div

    class="delete-modal"

    id="deleteModal"

    aria-hidden="true"

>



    <div

        class="delete-modal-card"

        role="dialog"

        aria-modal="true"

        aria-labelledby="deleteModalTitle"

    >



        <div class="delete-modal-icon">



            <svg viewBox="0 0 24 24">



                <path d="M12 9v4"></path>



                <path d="M12 17h.01"></path>



                <path d="M10.3 3.6L2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.6a2 2 0 0 0-3.4 0z"></path>



            </svg>



        </div>





        <h2

            class="delete-modal-title"

            id="deleteModalTitle"

        >

            Hapus Aplikasi?

        </h2>





        <p class="delete-modal-text">

            Apakah kamu yakin ingin menghapus aplikasi ini?

        </p>





        <div

            class="delete-modal-app-name"

            id="deleteModalAppName"

        ></div>





        <div class="delete-modal-actions">



            <button

                type="button"

                class="delete-modal-button delete-modal-cancel"

                id="deleteModalCancel"

            >

                Batal

            </button>





            <button

                type="button"

                class="delete-modal-button delete-modal-confirm"

                id="deleteModalConfirm"

            >

                Hapus

            </button>



        </div>



    </div>



</div>





@endsection





@push('scripts')



<script>



    document.addEventListener('DOMContentLoaded', function () {



        const modal =

            document.getElementById('deleteModal');



        const modalAppName =

            document.getElementById('deleteModalAppName');



        const cancelButton =

            document.getElementById('deleteModalCancel');



        const confirmButton =

            document.getElementById('deleteModalConfirm');



        const deleteForms =

            document.querySelectorAll('.delete-form');





        let selectedForm = null;





        deleteForms.forEach(function (form) {



            form.addEventListener('submit', function (event) {



                event.preventDefault();





                selectedForm = form;





                const applicationName =

                    form.dataset.applicationName ||

                    'Aplikasi ini';





                modalAppName.textContent =

                    applicationName;





                modal.classList.add('show');



                modal.setAttribute(

                    'aria-hidden',

                    'false'

                );





                document.body.style.overflow =

                    'hidden';



            });



        });





        function closeDeleteModal() {



            modal.classList.remove('show');



            modal.setAttribute(

                'aria-hidden',

                'true'

            );





            document.body.style.overflow =

                '';





            selectedForm = null;



        }





        cancelButton.addEventListener(

            'click',

            function () {



                closeDeleteModal();



            }

        );





        confirmButton.addEventListener(

            'click',

            function () {



                if (!selectedForm) {

                    return;

                }





                const formToSubmit =

                    selectedForm;





                closeDeleteModal();





                HTMLFormElement.prototype.submit.call(

                    formToSubmit

                );



            }

        );





        modal.addEventListener(

            'click',

            function (event) {



                if (event.target === modal) {



                    closeDeleteModal();



                }



            }

        );





        document.addEventListener(

            'keydown',

            function (event) {



                if (

                    event.key === 'Escape' &&

                    modal.classList.contains('show')

                ) {



                    closeDeleteModal();



                }



            }

        );

        // SEARCH APLIKASI
        const searchInput = document.getElementById('applicationSearch');
        const tableBody = document.getElementById('applicationTableBody');
        const noSearchResult = document.getElementById('noSearchResult');

        if (searchInput && tableBody && noSearchResult) {
            searchInput.addEventListener('input', function () {
                const keyword = this.value.toLowerCase().trim();
                const rows = tableBody.querySelectorAll('tr:not(#noSearchResult)');
                let visibleRows = 0;

                rows.forEach(function (row) {
                    const text = row.textContent.toLowerCase();
                    const isMatch = text.includes(keyword);

                    row.style.display = isMatch ? '' : 'none';

                    if (isMatch) {
                        visibleRows++;
                    }
                });

                noSearchResult.style.display =
                    visibleRows === 0 ? 'table-row' : 'none';
            });
        }

    });

</script>



@endpush
