@extends('layouts.main-admin')

@section('title')
    Lihat Draft PKS
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Draft PKS</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-start">
                        <i class="fa-sharp fa-solid fa-filter"></i> Filter Pencarian
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                        </div>
                        <div class="separator border-gray-200"></div>

                        <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                        <input type="search" data-kt-datatable-table-filter="search" name="seacrh"
                                            id="seacrh" class="form-control form-control-solid" placeholder="Cari All" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">ID Draft:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_id" name="check_id"
                                                    type="checkbox" data-checkbox="check_id" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih ID draft" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_id_draft" data-hide-search="false"
                                                id="check_id_draft">
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
                                                <input class="form-check-input" id="check_tentang" name="check_tentang"
                                                    type="checkbox" data-checkbox="check_tentang" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih tentang" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_mdp_tentang" data-hide-search="false"
                                                id="check_mdp_tentang">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Segmen Pasar:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_segmen" name="check_segmen"
                                                    type="checkbox" data-checkbox="check_segmen" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih segmen pasar" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_segmen_pasar" data-hide-search="false"
                                                id="check_segmen_pasar">
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
                                                <input class="form-check-input" id="check_periode" name="check_periode"
                                                    type="checkbox" data-checkbox="check_periode" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih periode input" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_periode_input"
                                                data-hide-search="false" id="check_periode_input">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold btn-sm me-2"
                                    data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                                <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm"
                                    data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i
                                        class="fa-solid fa-repeat"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    {{-- <div id="kt_table_datatable_export" class="d-none"></div>

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
                    </div> --}}

                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru"
                        onclick="tombolAct(0)">Tambah draft pks</button>
                </div>
                @include('pages.legal.draft_pks.modal.create')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                {{-- <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="kt_table_datatable"> --}}
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_draft">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>Nomor</th>
                            <th>Tentang</th>
                            <th>User Input</th>
                            <th>Tanggal Input</th>
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

            //SELECT FORM DRAFT PKS
            selectSide('mdp_mssp_kode', false, '{{ url('api/legal/pks/mssp') }}', function(d) {
                    return {
                        text: d.mssp_nama, // text nama
                        id: d.mssp_kode // kode value
                    };
                },
                function(res) {
                    // $('#tsin_noreferensi').val(res.params.data.nomor);
                    // setText('tsin_noreferensi', res.params.data.nomor); //membuat isi pada id input yang di inginkan
                    // getText('mpks_mrkn_kode_test'); //ambil data yang berada dalam input berdasarkan id input
                },
            );

            //SELECT FILTER DRAFT PKS
            selectSide('check_id_draft', false, '{{ url('api/legal/pks/selectId') }}', function(d) {
                return {
                    id: d.mdp_pk,
                    text: d.mdp_pk
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('check_mdp_tentang', false, '{{ url('api/legal/pks/selectTentang') }}', function(d) {
                return {
                    id: d.mdp_tentang,
                    text: d.mdp_tentang
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('check_segmen_pasar', false, '{{ url('api/legal/pks/selectSegmen') }}', function(d) {
                return {
                    id: d.mssp_kode,
                    text: d.mssp_nama
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            filterAll('input[type="search"]', 'serverSide_draft');
            serverSide("serverSide_draft", "{{ url('api/legal/draft_pks') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.check_id = getText('check_id');
                    d.mdp_pk = getText('check_id_draft');
                    d.check_tentang = getText('check_tentang');
                    d.mdp_tentang = getText('check_mdp_tentang');
                    d.check_segmen = getText('check_segmen');
                    d.mdp_mssp_kode = getText('check_segmen_pasar');
                    // d.check_user_ins = getText('check_user_ins');
                    // d.mpks_ins_user = getText('check_ins_user');

                    d.search = $('input[type="search"]').val()
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="omodEdit" data-resouce="` + row.mdp_pk +
                                `"class="btn btn-light-success" onclick="tombolAct(1)"> ` +
                                row.mdp_pk + ` </button>`
                        }

                    },
                    {
                        data: 'mdp_tentang'
                    },
                    {
                        data: 'mdp_ins_user'
                    },
                    {
                        data: 'ins_date'
                    },
                ],
            );

            submitForm(
                "frxx_draft",
                "btn_simpan",
                "POST",
                "{{ route('legal.pks.draft.store') }}",
                (resSuccess) => {
                    clearForm("frxx_draft");
                    clearSelect();
                    lodTable('serverSide_draft');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modalDraftPks');
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function tombolAct(tipe) {
            clearForm('frxx_draft');
            clearSelect();
            // setHide('mpks_pk', true);
            if (tipe == "0") {
                setHide('btnReset', false);
                // setHide('hideField', true);
                openModal('modalDraftPks');
                titleAction('tmod', 'Tambah');
            }

            if (tipe == "1") {
                setHide('btnReset', true);
                // setHide('hideField', true);
                var kode = $('#omodEdit').attr('data-resouce'),
                    url = "{{ url('legal/pks/draft') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    openModal('modalDraftPks');
                    titleAction('tmod', 'Edit Draft PKS');
                    console.log(res.mdp_mssp_kode);
                    var key = "{{ url('api/legal/pks/mssp_kode') }}" + "/" + res
                        .mdp_mssp_kode;
                    $('#frxx_draft').formToJson(res);
                    $.get(key, function(data) {
                        selectEdit('mdp_mssp_kode', data.mssp_kode, data.mssp_nama);
                    });
                });
            }
        }
    </script>
@endsection
