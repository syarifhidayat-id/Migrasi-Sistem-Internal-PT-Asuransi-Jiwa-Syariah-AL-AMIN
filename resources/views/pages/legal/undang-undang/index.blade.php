@extends('layouts.main-admin')

@section('title')
    Lihat Undang-undang Asuransi
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Undang-undang Asuransi</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" data-kt-datatable-table-filter="search" id="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Cari menu" />
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                    <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="fa-sharp fa-solid fa-filter"></i> Filter
                    </button>

                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                        </div>
                        <div class="separator border-gray-200"></div>

                        <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Nama Menu:</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                    data-placeholder="Pilih menu" data-allow-clear="true"
                                    data-kt-datatable-table-filter="nama-menu" data-hide-search="false">
                                    <option></option>
                                    {{-- @foreach ($list_menu as $key => $data)
                                    <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                @endforeach --}}
                                </select>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Nama Route:</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                    data-placeholder="Pilih route" data-allow-clear="true"
                                    data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                    <option></option>
                                    {{-- @foreach ($list_menu as $key => $data)
                                    <option value="{{ $data->wmn_url }}">{{ $data->wmn_url }}</option>
                                @endforeach --}}
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6"
                                    data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true"
                                    data-kt-datatable-table-filter="filter">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <div id="kt_table_datatable_export" class="d-none"></div>

                    <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i
                            class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button>

                    <div id="kt_table_datatable_export_menu" title-kt-export="Data PKS"
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                        data-kt-menu="true">
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

                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru"
                        onclick="tombolAct(0)">Tambah</button>
                </div>

                @include('pages.legal.undang-undang.modal.create')
                @include('pages.legal.undang-undang.modal.view')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_uu">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>Nomor</th>
                            <th class="min-w-250px">Tentang</th>
                            <th>User Input</th>
                            <th>Tanggal Input</th>
                            <th>Dokumen</th>
                        </tr>
                    </thead>
                    {{-- <tbody></tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            filterAll('input[type="search"]', 'serverSide_uu');
            serverSide( //datatable serverside
            "serverSide_uu",
                "{{ url('api/legal/uu_asuransi/uu_asuransi') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.wmn_tipe = $('#tipe_menu').val(),
                        d.wmn_descp = $('#key').val(),
                        d.search = $('input[type="search"]').val()
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        // data: 'mua_nomor'
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                    <a href="#" id="omodEdit" data-resouce="`+ row.mua_pk +`"
                                    class="btn btn-light-success" onclick="tombolAct(1)"> `+  row.mua_nomor +`</a>`}

                    },
                    {
                        // data: 'mua_tentang'
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                    <a href="#" id="omodDetail" data-resouce="`+ row.mua_pk +`"
                                    class="btn btn-light-primary" onclick="tombolAct(4)"> `+  row.mua_tentang +`</a>`}
                    },
                    {
                        data: 'mua_ins_user'
                    },
                    {
                        data: 'ins_date'
                    },
                    {
                        // data: 'mua_dokumen'

                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <a href="#" id="bmoViewPdf" data-resouce="` + row.mua_pk + `" data-show-pdf="` + row
                                .mua_dokumen + `"
                                        class="btn btn-light-success"> Lihat </a>`
                        }

                    },
                    // {
                    //     data: null,
                    //     orderable: false,
                    //     className: 'text-center',
                    //     render: function(data, type, row) {
                    //         return `
                    //             <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                    //                 <span class="svg-icon svg-icon-5 m-0">
                    //                     <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    //                 </span>
                    //             </a>
                    //             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                    //                 <div class="menu-item px-3">
                    //                     <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="` + row.mua_pk + `">Edit</a>
                    //                 </div>
                    //                 <div class="menu-item px-3">
                    //                     <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="` + row
                    //             .mua_pk + `">Delete</a>
                    //                 </div>
                    //             </div>
                    //         `;
                    //     },
                    // },
                ],
            );

            selectServerSide( //select server side with api/route
                'mpks_mrkn_kode', //kode select
                '{{ url('api/legal/pks/polis') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.mrkn_nama, // text nama
                                id: d.mrkn_kode // kode value
                            }
                        })
                    };
                },
            );

            $('body').on('click', '#bmoViewPdf', function() {
                // $('#tModView').text('Rincian PKS');
                var kode = $(this).attr('data-show-pdf');
                $('#tModView').text('File : ' + kode);
                var loc = $(location).attr('origin') + '/storage/legal/uu_asuransi/' + kode;
                openModal('modalView');
                $('#pdf').attr('data', loc);
            });

            submitForm(
                "frxx_uu",
                "btn_simpan",
                "POST",
                "{{ route('legal.uu_asuransi.store') }}",
                (resSuccess) => {
                    clearForm("frxx_uu");
                    clearSelect();
                    lodTable('serverSide_uu');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modal_uu');
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function tombolAct(tipe) {
            clearForm('frxx_uu');
            clearSelect();
            // setHide('mpks_pk', true);

            if (tipe == "0") {
                // setHide('hidePk', true);
                // setHide('hideField', true);
                openModal('modal_uu');
                titleAction('tMod', 'Tambah');
            }

            if (tipe == "1") {
                // setHide('hidePk', true);
                // setHide('hideField', true);
                var kode = $('#omodEdit').attr('data-resouce'),
                    url = "{{ url('legal/uu_asuransi') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    openModal('modal_uu');
                    // clearForm('frxx_uu');
                    titleAction('tMod', 'Edit Undang-undang Asuransi');
                    console.log(res.mdp_mssp_kode);
                    $('#frxx_uu').formToJson(res);
                });
            }
            if (tipe == "4") {
                // setHide('hidePk', true);
                setHide('hideField', true);
                var kode = $('#omodDetail').attr('data-resouce'),
                    url = "{{url('legal/uu_asuransi') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    openModal('modal_uu');
                    titleAction('tMod', 'Detail Undang-undang Asuransi');
                    $('#frxx_uu').formToJson(res);
                });
            }
        }
    </script>
@endsection
