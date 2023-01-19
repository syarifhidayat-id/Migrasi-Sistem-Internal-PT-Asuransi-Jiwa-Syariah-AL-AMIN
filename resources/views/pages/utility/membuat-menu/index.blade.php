@extends('layouts.main-admin')

@section('title')
    Menu
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Menu</h3>
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

                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                    </div>
                    <div class="separator border-gray-200"></div>

                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                    <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control form-control-solid" placeholder="Cari Menu" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Tipe Menu</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" id="check_1" name="check_1" type="checkbox" data-checkbox="check_1" />
                                        </label>
                                        <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih route" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" id="tipe_menu" name="tipe_menu">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Nama Menu</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" id="check_2" type="checkbox" data-checkbox="check_2" />
                                        </label>
                                        <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih menu" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="key">
                                            <option></option>
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

                {{-- <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button> --}}

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

        </div>
    </div>

    <div class="card-body py-10">
        <div class="table-responsive">
            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="dataMenu">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                        <th class="min-w-50px">No.</th>
                        <th class="min-w-50px">Icon</th>
                        <th class="min-w-125px">Nama Menu</th>
                        <th class="min-w-125px">Tipe</th>
                        <th class="min-w-125px">Route</th>
                        <th class="min-w-250px">Url</th>
                        <th class="min-w-125px">Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('pages.utility.membuat-menu.modal.create')
</div>
@endsection

@section('script')
    <script>
        setHide('kode_tipe', false);
        $('#wmn_key').select2({
            tags: true,
        });
        $('#wmn_mrkn_kode').select2();
        $('#wmn_mpol_kode').select2();

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectSide('tipe_menu', false, '{{ url("api/utility/menu/select-tipemenu") }}', function(d) { return {
                id: d.wmt_kode,
                text: d.wmt_nama
            }}, function(e) {
                var data = e.params.data.id;
                selectSide('key', false, '{{ url("api/utility/menu/select-menu") }}' + '?tipe=' + data, function(d) { return {
                // selectSide('key', false, '{{ url("api/utility/menu/select-menu") }}' + '?tipe=' + getText('tipe_menu'), function(d) { return {
                    id: d.wmn_descp,
                    text: d.wmn_descp
                }});
            });

            selectSide('wmn_tipe', false, '{{ url("api/utility/menu/select-tipemenu") }}', function(d) { return {
                id: d.wmt_kode,
                text: d.wmt_nama
            }}, function(e) {
                var data = e.params.data.id;
                // console.log(data);
                selectSide('wmn_key', false, '{{ url("api/utility/menu/select-menu") }}' + '?tipe=' + data, function(d) { return {
                // selectSide('wmn_key', false, '{{ url("api/utility/menu/select-menu") }}' + '?tipe=' + getText('wmn_tipe'), function(d) { return {
                    id: d.wmn_descp,
                    text: d.wmn_descp
                }});
            });

            filterAll('input[type="search"]', 'dataMenu'); //khusus type search inputan

            serverSide( //datatable serverside
                "dataMenu",
                "{{ url('api/utility/menu/lihat-menu') }}", //url api/route
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.check_1 = getText('check_1');
                    d.check_2 = getText('check_2');
                    d.wmn_tipe = getText('tipe_menu');
                    d.wmn_descp = getText('key');
                    d.search = $('input[type="search"]').val();
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
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
                        data: "wmn_kode",
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

            tombol('click', 'omodTam', function() {
                openModal('modalMenu');
                titleAction('tModMenu', 'Tambah Menu');
                clearForm("formMenu");
                clearSelect();
                bsimpan('btn_simpan', 'Simpan');
                setHide('btn_reset', false);
            });

            tombol('click', 'omodEdit', function() {
                var kode = $(this).attr('data-resouce');
                lodJson("GET", "{{ route('utility.menu.index') }}" + "/" + kode + "/edit", function (data) {
                    openModal('modalMenu');
                    titleAction('tModMenu', 'Edit Menu');
                    bsimpan('btn_simpan', 'Update');
                    setHide('btn_reset', true);

                    var tipe = "{{ url('api/utility/menu/tipe-menu') }}" + "/" + data.wmn_tipe;
                    var key = "{{ url('api/utility/menu/key-menu') }}" + "/" + data.wmn_key;
                    jsonForm('formMenu', data);
                    lodJson("GET", "{{ url('api/utility/menu/tipe-menu') }}" + "/" + data.wmn_tipe, function (res) {
                        if ($('#wmn_tipe').find("option[value='" + res.wmt_kode + "']").length) {
                            $('#wmn_tipe').val(res.wmt_kode).trigger('change');
                        } else {
                            selectEdit('wmn_tipe', res.wmt_kode, res.wmt_nama);
                        }
                    });
                    if (data.wmn_key == "MAIN") {
                        selectEdit('wmn_key', 'MAIN', 'MAIN');
                    } else {
                        lodJson("GET", "{{ url('api/utility/menu/key-menu') }}" + "/" + data.wmn_key, function (res) {
                            if ($('#wmn_key').find("option[value='" + res.wmn_kode + "']").length) {
                                $('#wmn_key').val(res.wmn_kode).trigger('change');
                            } else {
                                selectEdit('wmn_key', res.wmn_kode, res.wmn_descp);
                            }
                        });
                    }
                });
            });

            submitForm("formMenu", "btn_simpan", "POST", "{{ route('utility.menu.store') }}", (resSuccess) => {
                clearForm("formMenu");
                bsimpan('btn_simpan', 'Simpan');
                lodTable("dataMenu");
                closeModal('modalMenu');
            });

            tombol('click', 'omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.store') }}" + "/" + kode;
                submitDelete(kode, url, function(resSuccess) {
                    lodTable("dataMenu");
                    // console.log(resSuccess);
                }, function(resError) {
                    // console.log(resError);
                });
            });
        });


        function closeBtnModal () {
            closeModal('modalMenu');
            clearForm("formMenu");
        };

        hidePesan('wmn_tipe');
        hidePesan('wmn_key');
        hidePesan('wmn_descp');
        hidePesan('wmn_url_o_n');
        hidePesan('wmn_urut');
    </script>
@endsection
