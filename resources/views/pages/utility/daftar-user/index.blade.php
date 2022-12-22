@extends('layouts.main-admin')

@section('title')
    Daftar User
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Daftar User</h3>
        </div>

        <div class="card-toolbar">
            {{-- <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" checked="checked" value="1" />
                <span class="form-check-label text-muted">Test mode</span>
            </label>

            <button type="button" class="btn btn-sm btn-light">
                Action
            </button> --}}
        </div>
    </div>

    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">

                <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                    <i class="fa-sharp fa-solid fa-filter"></i> Filter Pencarian
                </button>

                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-700px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                    </div>
                    <div class="separator border-gray-200"></div>

                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                    <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control form-control-solid" placeholder="Cari User" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Nama User</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" id="check_1" type="checkbox" data-checkbox="check_1" />
                                        </label>
                                        <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" id="name_user" name="name_user" data-placeholder="Pilih user" data-allow-clear="true" data-kt-datatable-table-filter="name_user">
                                            <option></option>
                                            @foreach ($nameUser as $key=>$data)
                                                <option value="{{ $data->name }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Username</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" id="check_2" type="checkbox" data-checkbox="check_2" />
                                        </label>
                                        <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" id="username" name="username" data-placeholder="Pilih user" data-allow-clear="true" data-kt-datatable-table-filter="username">
                                            <option></option>
                                            @foreach ($username as $key=>$data)
                                                <option value="{{ $data->email }}">{{ $data->email }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                            <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i class="fa-solid fa-repeat"></i> Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                <div id="kt_table_datatable_export" class="d-none"></div>

                {{-- <button type="button" id="btn_export" data-title="Data Daftar User" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button> --}}

                <div id="kt_table_datatable_export_menu" title-kt-export="Data Daftar User" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
                    <div class="menu-item px-3">
                     <a href="#" class="menu-link px-3" data-kt-export="copy">Copy to clipboard</a>
                    </div>

                    <div class="menu-item px-3">
                     <a href="#" class="menu-link px-3" data-kt-export="excel">Export as Excel</a>
                    </div>

                    <div class="menu-item px-3">
                     <a href="#" class="menu-link px-3" data-kt-export="csv">Export as CSV</a>
                    </div>

                    <div class="menu-item px-3">
                        <a href="#" class="menu-link px-3" data-kt-export="pdf">Export as PDF</a>
                    </div>
                </div>

                <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-sharp fa-solid fa-plus"></i> Tambah User</button>
            </div>

        </div>
    </div>

    <div class="card-body py-10">
        <div class="table-responsive">
            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="dataUser">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th class="min-w-125px">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>

    </div>

    {{-- <div class="card-footer">
        <div align="center">
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-floppy-disk"></i> Simpan</button>&nbsp;
            <button type="button" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div> --}}

    @include('pages.utility.daftar-user.modal.create')
</div>
@endsection

@section('script')
    <script>
        // $('#mrkn_kode_induk').select2();
        // $('#mrkn_kode').select2();
        // $('#mjns_kode').select2({
        //     tokenSeparators: [',', ' '],
        // });
        // $('#mkm_kode').select2({
        //     tokenSeparators: [',', ' '],
        // });
        // $('#mkm_kode2').select2({
        //     tokenSeparators: [',', ' '],
        // });
        // $('#dboard').select2();
        // $('#isnews').select2();
        // $('#livevideo_hak').select2();
        // $('#livevideo_ses').select2({
        //     tokenSeparators: [',', ' '],
        // });
        // $('#jabatan').select2();
        // $('#chat_tipe').select2({
        //     tokenSeparators: [',', ' '],
        // });
        // $('#dirshare').select2();
        formatHp("no_hp");

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectSide('menu_tipe', false, '{{ url("api/utility/daftar-user/select-tipemenu") }}', function(d) { return {
                id: d.wmt_kode,
                text: d.wmt_nama
            }}, function(res) {

            });

            filterAll('input[type="search"]', 'dataUser'); //khusus type search inputan

            serverSide(
                "dataUser",
                "{{ url('api/utility/daftar-user/lihat-user') }}",
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.check_1 = getText('check_1'),
                    d.name = getText('name_user'),
                    d.check_2 = getText('check_2'),
                    d.email = getText('username'),
                    d.search = $('input[type="search"]').val()
                },
                [
                    { data: "DT_RowIndex", className: "text-center" },
                    { data: "name" },
                    {
                        data: "email_user",
                        render: function(data, type, row, meta) {
                            return '<div class="badge badge-light-success fw-bolder">'+row.email_user+'</div>';
                        }
                    },
                    {
                        data: "no_hp",
                        render: function(data, type, row, meta) {
                            return '<div class="badge badge-light fw-bolder">'+row.no_hp+'</div>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="`+row.id+`">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="`+row.id+`">Delete</a>
                                    </div>
                                </div>
                            `;
                        },
                    },
                ],
            );

            tombol('click', 'omodTam', function() {
                openModal('modalUser');
                titleAction('tModUser', 'Tambah User');
                clearForm("frxx_user");
                bsimpan('btn_simpan', 'Simpan');
                setHide('btn_reset', false);
            });

            tombol('click', 'omodEdit', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.daftar-user.index') }}" + "/" + kode + "/edit";
                $.get(url, function(data) {
                    openModal('modalUser');
                    titleAction('tModUser', 'Edit User');
                    bsimpan('btn_simpan', 'Update');
                    setHide('btn_reset', true);

                    var tipe = "{{ url('api/utility/daftar-user/tipe-menu') }}" + "/" + data.menu_tipe;
                    var email = data.email_user;
                    jsonForm('frxx_user', data);
                    setText('email_user', email.replace(/@alamin.co.id/gi, ""));
                    $.get(tipe, function(res) {
                        if ($('#menu_tipe').find("option[value='" + res.wmt_kode + "']").length) {
                            $('#menu_tipe').val(res.wmt_kode).trigger('change');
                        } else {
                            selectEdit('menu_tipe', res.wmt_kode, res.wmt_nama);
                        }
                    });
                });
            });

            submitForm(
                "frxx_user",
                "btn_simpan",
                "POST",
                "{{ route('utility.daftar-user.store') }}",
                (resSuccess) => {
                    clearForm("frxx_user");
                    bsimpan("btn_simpan", 'Simpan');
                    lodTable("dataUser");
                    closeModal('modalUser');
                },
                (resError) => {
                    console.log(resError);
                },
            );

            tombol('click', 'omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.daftar-user.store') }}" + "/" + kode;
                submitDelete(kode, url, function(resSuccess) {
                    lodTable("dataUser");
                    // console.log(resSuccess);
                }, function(resError) {
                    // console.log(resError);
                });
            });

            // $('body').on('click', '#omodDelete', function() {
            //     var kode = $(this).attr('data-resouce'),
            //         url = "{{ route('utility.daftar-user.store') }}" + "/" + kode;

            //     console.log(kode);
            //     Swal.fire({
            //         title: 'Apakah anda yakin?',
            //         text: "Akan menghapus data user dengan kode " + kode + " !",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Ya, hapus!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             Swal.fire(
            //             'Terhapus!',
            //             'Anda berhasil menghapus data user dengan kode ' + kode + ".",
            //             'success'
            //             ).then((result) => {
            //                 console.log(kode);
            //                 $.ajax({
            //                     url: url,
            //                     type: "DELETE",
            //                     success: function(res) {
            //                     lodTable("dataUser");
            //                     },
            //                     error: function(err) {
            //                         reset();
            //                         console.log('Error', err);
            //                     }
            //                 });
            //             })
            //         }
            //     })
            // });
        });


        function closeBtnModal() {
            closeModal('modalUser');
            clearForm("frxx_user");
        };

        hidePesan('email');
        hidePesan('password_n');
        hidePesan('name');
        hidePesan('email_user');
        hidePesan('email_cc');
        hidePesan('menu_tipe');
        hidePesan('no_hp');
    </script>
@endsection
