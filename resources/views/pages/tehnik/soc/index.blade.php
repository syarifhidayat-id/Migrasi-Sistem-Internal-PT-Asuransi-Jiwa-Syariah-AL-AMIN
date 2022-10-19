@extends('layouts.main-admin')

@section('title')
    Lihat SOC
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Lihat SOC</h3>
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
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" data-kt-datatable-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari menu" />
            </div>
        </div>

        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="fa-sharp fa-solid fa-filter"></i> Filter
                </button>

                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>

                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Tipe Menu:</label>
                                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih route" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" id="tipe" onchange="tipe()">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Nama Menu:</label>
                                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih menu" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="key">
                                        <option></option>
                                        {{-- @foreach ($nama_menu as $key=>$data)
                                            <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                <div id="kt_table_datatable_export" class="d-none"></div>

                <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button>

                <div id="kt_table_datatable_export_menu" title-kt-export="Data Menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
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

                <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-sharp fa-solid fa-plus"></i> Tambah Menu</button>
            </div>

            {{-- @include('pages.utility.membuat-menu.modal.create') --}}
        </div>
    </div>

    <div class="card-body py-10">
        <div class="table-responsive">
            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                        <th>No.</th>
                        <th>No SOC</th>
                        <th>Kode SOC</th>
                        <th>Nama Pemegang Polis</th>
                        <th>Jenis Nasabah</th>
                        <th>Segmen Pasar</th>
                        <th>Mekanisme 1 (Umum)</th>
                        <th>Mekanisme 2 (Penutupan)</th>
                        <th>Jenis Pekerjaan</th>
                        <th>Manfaat Asuransi</th>
                        <th>Pembayaran</th>
                        <th>Jaminan</th>
                        <th>Program Asuransi</th>
                        <th>Cover Polis</th>
                        <th>SOC</th>
                        <th>Disposisi</th>
                        <th>Cetak</th>
                        <th>Tanggal Input</th>
                        <th>Umur Input</th>
                        <th>Status Approval</th>
                        <th>Kode Polis</th>
                        <th>Approval Polis</th>
                        <th>Status Polis</th>
                        <th>Online Polis</th>
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
</div>
@endsection

@section('script')
    <script>
        $('#tipe').select2();
        $('#key').select2();
        $('#wmn_tipe').select2();
        $('#wmn_key').select2({
            tags: true,
        });
        $('#wmn_mrkn_kode').select2();
        $('#wmn_mpol_kode').select2();

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            serverSide(
                "#serverSide",
                "{{ url('api/utility/menu/lihat-menu') }}",
                [
                    { data: "DT_RowIndex", className: "text-center" },
                    {
                        data: "wmn_icon",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<i class="`+row.wmn_icon+`"></i>`;
                        }
                    },
                    { data: "wmn_descp" },
                    { data: "wmn_tipe" },
                    {
                        data: "wmn_url_n",
                        render: function(data, type, row, meta) {
                            var route = row.wmn_url_n;
                            if (route !== "" && route !== null) {
                                return `<div class="badge badge-light-success fw-bolder">`+row.wmn_url_n+`</div>`;
                            } else {
                                return `<div class="badge badge-light-success fw-bolder">-</div>`;
                            }
                        }
                    },
                    {
                        data: "wmn_url_o_n",
                        render: function(data, type, row, meta) {
                            var url = row.wmn_url_o_n;
                            if (url !== "" && url !== null) {
                                return `<div class="badge badge-light fw-bolder">`+row.wmn_url_o_n+`</div>`;
                            } else {
                                return `<div class="badge badge-light fw-bolder">-</div>`;
                            }
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
                                        <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="`+row.wmn_kode+`">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="`+row.wmn_kode+`">Delete</a>
                                    </div>
                                </div>
                            `;
                        },
                    },
                ],
            );

            $('body').on('click', '#omodTam', function() {
                openModal('#modalMenu');
                $('#tModMenu').text('Tambah Menu');
                resetMod();
                bsimpan('btn_simpan', 'Simpan');
                $('#btn_reset').show();
                menuMain();
            });

            $('body').on('click', '#omodEdit', function() {
                $('#tModMenu').text('Edit Menu');
                bsimpan('btn_simpan', 'Update');
                // resetMod();
                // $('#wmn_key').empty();
                $('#wmn_key').val(null).trigger('change');
                $('#btn_reset').hide();

                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.index') }}" + "/" + kode + "/edit";
                    // url = "{{ url('api/utility/menu/edit') }}" + "/" + kode;

                $.get(url, function(res) {
                    menuMain();
                    var key = "{{ url('api/utility/menu/keyMenu') }}" + "/" + res.wmn_key;
                    // var key = "{{ route('utility.menu.store') }}" + "/" + res.wmn_key + "/keyMenu";
                    openModal('#modalMenu');
                    $('#wmn_kode').val(res.wmn_kode);
                    $('#wmn_tipe').val(res.wmn_tipe).trigger('change');
                    $.get(key, function(data) {
                        $('#wmn_key').val(data.wmn_kode).trigger('change');
                    });
                    $('#wmn_descp').val(res.wmn_descp);
                    $('#wmn_icon').val(res.wmn_icon);
                    $('#wmn_url_n').val(res.wmn_url_n);
                    $('#wmn_urlkode').val(res.wmn_urlkode);
                    $('#wmn_info').val(res.wmn_info);
                    $('#wmn_url_o_n').val(res.wmn_url_o_n);
                    $('#wmn_urut').val(res.wmn_urut);
                    $('#wmn_mrkn_kode').val(res.wmn_mrkn_kode);
                    $('#wmn_mpol_kode').val(res.wmn_mpol_kode);
                });
            });

            // $('#frxx').submit(function(e) {
            $('#btn_simpan').click(function(e) {
                e.preventDefault();
                var dataFrx = $('#frxx').serialize();
                // var formData = new FormData(this);
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('utility.menu.store') }}",
                    type: "POST",
                    data: dataFrx,
                    dataType: 'json',
                    success: function (res) {
                        if ($.isEmptyObject(res.error)){
                            // console.log(res);
                            Swal.fire(
                                'Berhasil!',
                                res.success,
                                'success'
                            ).then((res) => {
                                resetMod();
                                bsimpan('btn_simpan', 'Simpan');
                                lodTable("#serverSide");
                                closeModal('#modalMenu');
                            });
                        } else {
                            bsimpan('btn_simpan', 'Simpan');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Field harus ter isi!',
                            });
                            messages(res.error);
                        }

                    },
                    error: function (err) {
                        console.log('Error:', err);
                        bsimpan('btn_simpan', 'Simpan');
                    }
                });
            });

            $('body').on('click', '#omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.store') }}" + "/" + kode;

                // console.log(kode);
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Akan menghapus data menu dengan kode " + kode + " !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Terhapus!',
                        'Anda berhasil menghapus data menu dengan kode ' + kode + ".",
                        'success'
                        ).then((result) => {
                            console.log(kode);
                            $.ajax({
                                url: url,
                                type: "DELETE",
                                success: function(res) {
                                    lodTable("#serverSide");
                                },
                                error: function(err) {
                                    // console.log('Error', err);
                                }
                            });
                        })
                    }
                })
            });

            $('#btn_reset').click(function() {
                resetMod();
            });

            $('#btn_close').click(function() {
                closeModal('#modalMenu');
            });

            $('#btn_close2').click(function() {
                closeModal('#modalMenu');
            });
        });

        function resetMod() {
            $('#frxx').trigger('reset');
            $('#wmn_tipe').val(null).trigger('change');
            $('#wmn_key').val(null).trigger('change');
            // $('#wmn_key').empty();
            // $('#wmn_key').append('<option></option>');
            $('#wmn_mrkn_kode').val(null).trigger('change');
            $('#wmn_mpol_kode').val(null).trigger('change');
        }
    </script>
@endsection