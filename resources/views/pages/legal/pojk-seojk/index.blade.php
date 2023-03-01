@extends('layouts.main-admin')

@section('title')
    Lihat POJK & SEOJK
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar POJK & SEOJK</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
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
                                        <label class="form-label fs-6 fw-bold">Nomor:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_no_pojk" name="check_no_pojk"
                                                    type="checkbox" data-checkbox="check_no_pojk" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih nomor" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_nomor_pojk" data-hide-search="false"
                                                id="check_nomor_pojk">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Perihal:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_hal_pojk" name="check_hal_pojk"
                                                    type="checkbox" data-checkbox="check_hal_pojk" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih perihal" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_perihal_pojk" data-hide-search="false"
                                                id="check_perihal_pojk">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Jenis:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_jenis" name="check_jenis"
                                                    type="checkbox" data-checkbox="check_jenis" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih jenis" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_jenis_pojk" data-hide-search="false"
                                                id="check_jenis_pojk">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{--
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
                    <div id="kt_table_datatable_export" class="d-none"></div>
                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" id="omodTam">Tambah</button>
                </div>

                @include('pages.legal.pojk-seojk.modal.create')
                @include('pages.legal.pojk-seojk.modal.view')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_pojk">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px">No.</th>
                            <th>Dokumen</th>
                            <th>Nomor</th>
                            <th class="min-w-50px">Perihal</th>
                            <th>User Input</th>
                            <th>Jenis</th>
                            <th class="min-w-100px">Tanggal Input</th>
                            {{-- <th>Aksi</th> --}}
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
            selectSide('check_nomor_pojk', false, '{{ url('api/legal/selectNomorPojk') }}', function(d) {
                return {
                    id: d.mpojk_nomor,
                    text: d.mpojk_nomor
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            changeSelect('check_nomor_pojk', 'key', '{{ url('api/legal/getNomorPojk') }}', function(d) {
                return {
                    id: d.mpojk_nomor,
                    text: d.mpojk_nomor
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('check_perihal_pojk', false, '{{ url('api/legal/selectPerihalPojk') }}', function(d) {
                return {
                    id: d.mpojk_tentang,
                    text: d.mpojk_tentang
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            changeSelect('check_perihal_pojk', 'key', '{{ url('api/legal/getPerihalPojk') }}', function(d) {
                return {
                    id: d.mpojk_tentang,
                    text: d.mpojk_tentang
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('check_jenis_pojk', false, '{{ url('api/legal/selectJenis') }}', function(d) {
                return {
                    id: d.jenis,
                    text: d.jenis
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            changeSelect('check_jenis_pojk', 'key', '{{ url('api/legal/getJenis') }}', function(d) {
                return {
                    id: d.jenis,
                    text: d.jenis
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            // selectSide('check_periode_input', false, '{{ url('api/legal/pks/selectSegmen') }}', function(d) { return {
            //     id: d.mssp_kode,
            //     text: d.mssp_nama
            // }}, function(res) {
            //     // setText('msoc_mssp_kode', res.params.data.id);
            //     // setText('msoc_mssp_nama', res.params.data.text);
            // });

            // changeSelect('check_periode_input', 'key', '{{ url('api/legal/pks/getSegmen') }}',function(d) { return {
            //     id: d.mssp_kode,
            //     text: d.mssp_nama
            // }}, function(res) {
            //         // setText('msoc_mssp_kode', res.params.data.id);
            //         // setText('msoc_mssp_nama', res.params.data.text);
            // });

            filterAll('input[type="search"]', 'serverSide_pojk');
            serverSide( //datatable serverside
                'serverSide_pojk',
                "{{ url('api/legal/pojk_seojk') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.check_no_pojk = getText('check_no_pojk');
                    d.mpojk_nomor = getText('check_nomor_pojk');
                    d.check_hal_pojk = getText('check_hal_pojk');
                    d.mpojk_tentang = getText('check_perihal_pojk');
                    d.check_jenis = getText('check_jenis');
                    d.jenis = getText('check_jenis_pojk');
                    d.search = $('input[type="search"]').val()
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: null,
                        orderable: true,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="bmoViewPdf" data-resouce="` + row.mpojk_pk + `" data-show-pdf="` + row.mpojk_dokumen + `" class="btn btn-light-success" target="blank"> Lihat </button>`
                        }
                    },
                    {
                        data: null,
                        orderable: true,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="omodEdit" data-resouce="` + row.mpojk_pk +
                                `" class="btn btn-light-success"> ` + row.mpojk_nomor + ` </button>`
                        }
                    },
                    {
                        data: 'mpojk_tentang'
                    },
                    {
                        data: 'mpojk_ins_user'
                    },
                    {
                        data: 'jenis'
                    },
                    {
                        data: 'mpojk_ins_date'
                    },
                ],
            );

            tombol('click', 'omodTam', function() {
                openModal('modal');
                bsimpan('btn_simpan', 'Simpan');
                titleAction('tMod', 'Tambah Data');
            });

            tombol('click', 'bmoViewPdf', function() {
                var kode = $(this).attr('data-show-pdf');
                var loc2 = '{{ url('storage/legal/pojk') }}' + '/' + kode;
                openModal('modalView');
                $('#view_pdf').attr('src', loc2);
            });

            tombol('click', 'omodEdit', function() {
                titleAction('tMod', 'Edit Data');
                bsimpan('btn_simpan', 'Update');
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/pojk-seojk') }}" + "/" + kode + "/edit";
                lodJson('GET', url, function(data) {
                    openModal('modal');
                    jsonForm('frxx', data);
                });
            });

            submitForm(
                "frxx",
                "btn_simpan",
                "POST",
                "{{ route('legal.pojk-seojk.store') }}",
                (resSuccess) => {
                    lodTable('serverSide_pojk');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modal');
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function closeMod() {
            closeModal('modal');
            clearForm('frxx');
        }

        function closeModView() {
            closeModal('modalView');
            clearForm('frxx');
        }
    </script>
@endsection
