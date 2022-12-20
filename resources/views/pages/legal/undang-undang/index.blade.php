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
                    <div class="input-group input-group-solid">
                        <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control" placeholder="Cari undang-undang" />
                        <button type="submit" class="btn btn-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                    </div>
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
                                        <label class="form-label fs-6 fw-bold">Nomor UU:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_nomor" name="check_nomor" type="checkbox" data-checkbox="check_nomor" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih nomor undand-undang" data-allow-clear="true" data-kt-datatable-table-filter="check_nomor_uu" data-hide-search="false" id="check_nomor_uu">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Tentang:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_tentang" name="check_tentang" type="checkbox" data-checkbox="check_tentang" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih tentang" data-allow-clear="true" data-kt-datatable-table-filter="check_uu_tentang" data-hide-search="false" id="check_uu_tentang">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{--
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Segmen Pasar:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_segmen" name="check_segmen" type="checkbox" data-checkbox="check_segmen" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih segmen pasar" data-allow-clear="true" data-kt-datatable-table-filter="check_segmen_pasar" data-hide-search="false" id="check_segmen_pasar">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Periode Input:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_periode" name="check_periode" type="checkbox" data-checkbox="check_periode" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih periode input" data-allow-clear="true" data-kt-datatable-table-filter="check_periode_input" data-hide-search="false" id="check_periode_input">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                                <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i class="fa-solid fa-repeat"></i> Reset</button>
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

             //SELECT FILTER DRAFT PKS
             selectSide('check_nomor_uu', false, '{{ url("api/legal/uu_asuransi/selectNomor") }}', function(d) { return {
                id: d.mua_nomor,
                text: d.mua_nomor
            }}, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            changeSelect('check_nomor_uu', 'key', '{{ url("api/legal/pks/getId") }}',function(d) { return {
                id: d.mua_nomor,
                text: d.mua_nomor
            }}, function(res) {
                    // setText('msoc_mssp_kode', res.params.data.id);
                    // setText('msoc_mssp_nama', res.params.data.text);
            });
             selectSide('check_uu_tentang', false, '{{ url("api/legal/uu_asuransi/selectTentang") }}', function(d) { return {
                id: d.mua_tentang,
                text: d.mua_tentang
            }}, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            changeSelect('check_uu_tentang', 'key', '{{ url("api/legal/pks/getTentang") }}',function(d) { return {
                id: d.mua_tentang,
                text: d.mua_tentang
            }}, function(res) {
                    // setText('msoc_mssp_kode', res.params.data.id);
                    // setText('msoc_mssp_nama', res.params.data.text);
            });

            filterAll('input[type="search"]', 'serverSide_uu');
            serverSide( "serverSide_uu", "{{ url('api/legal/uu_asuransi/uu_asuransi') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.search = $('input[type="search"]').val();
                    d.check_nomor = getText('check_nomor');
                    d.mua_nomor = getText('check_nomor_uu');
                    d.check_tentang = getText('check_tentang');
                    d.mua_tentang = getText('check_uu_tentang');
                    // d.check_segmen = getText('check_segmen');
                    // d.mdp_mssp_kode = getText('check_segmen_pasar');
                    // d.check_user_ins = getText('check_user_ins');
                    // d.mpks_ins_user = getText('check_ins_user');

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
                ],
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
