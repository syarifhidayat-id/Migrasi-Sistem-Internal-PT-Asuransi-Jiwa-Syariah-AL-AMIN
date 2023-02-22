@extends('layouts.main-admin')

@section('title')
    Approval Kas Anggaran
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Transaksi KAS</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">
                    <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-start">
                        <i class="fa-sharp fa-solid fa-filter"></i> Filter Pencarian
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                        </div>
                        <div class="separator border-gray-200"></div>
                        <div class="scroll h-400px px-5">
                            <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                                <div class="row mb-10">
                                    <div class="col-md-12">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                            <input type="search" data-kt-datatable-table-filter="search" name="seacrh"
                                                id="seacrh" class="form-control form-control-solid"
                                                placeholder="Cari All" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Periode Input:</label>
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_periode" name="c_periode"
                                                        type="checkbox" data-checkbox="c_periode" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true" data-placeholder="Bulan"
                                                    data-allow-clear="true" data-kt-datatable-table-filter="e_probulan1"
                                                    data-hide-search="false" id="e_probulan1" name="e_probulan1">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">S.D</label>
                                            <div class="d-flex flex-stack">
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true" data-placeholder="Bulan"
                                                    data-allow-clear="true" data-kt-datatable-table-filter="e_probulan2"
                                                    data-hide-search="false" id="e_probulan2" name="e_probulan2">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Tahun</label>
                                            <div class="d-flex flex-stack">
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true" data-placeholder="Tahun"
                                                    data-allow-clear="true" data-kt-datatable-table-filter="e_protahun"
                                                    data-hide-search="false" id="e_protahun" name="e_protahun">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Jumlah Baris yang Tampil</label>
                                            <select class="form-select form-select-solid fw-bolder" id="e_baris"
                                                name="e_baris" data-control="select2" data-kt-select2="true"
                                                data-placeholder="Pilih cabang" data-allow-clear="false"
                                                data-hide-search="false">
                                                <option value="50" selected>50</option>
                                                <option value="100" selected>100</option>
                                                <option value="250">250</option>
                                                <option value="500">500</option>
                                                <option value="750">750</option>
                                                <option value="1000">1000</option>
                                                <option value="2500">2500</option>
                                                <option value="5000">5000</option>
                                                <option value="10000">10000</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Cabang Al-amin</label>
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_cabang" name="c_cabang"
                                                        type="checkbox" data-checkbox="c_cabang" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih cabang" data-allow-clear="true"
                                                    data-kt-datatable-table-filter="nama-cabang" data-hide-search="false"
                                                    id="e_cabalaminx" name="e_cabalaminx">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Kabag Keuangan</label>
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_keu2" name="c_keu2"
                                                        type="checkbox" data-checkbox="c_keu2" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih proses" data-allow-clear="true"
                                                    data-kt-datatable-table-filter="nama-buku" data-hide-search="false"
                                                    id="e_keu2" name="e_keu2">
                                                    <option value="0" selected>Belum Proses</option>
                                                    <option value="1">Seuju</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Divisi Pemasaran</label>
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_pms" name="c_pms"
                                                        type="checkbox" data-checkbox="c_pms" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih proses" data-allow-clear="true"
                                                    data-kt-datatable-table-filter="e_pms" data-hide-search="false"
                                                    id="e_pms" name="e_pms">
                                                    <option value="0" selected>Belum Approv</option>
                                                    <option value="1">Setuju</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Staff Keuangan</label>
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_keu1" name="c_keu1"
                                                        type="checkbox" data-checkbox="c_keu1" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih proses" data-allow-clear="true"
                                                    data-kt-datatable-table-filter="e_keu1" data-hide-search="false"
                                                    id="e_keu1" name="e_keu1">
                                                    <option value="0" selected>Belum Approv</option>
                                                    <option value="1">Setuju</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Divisi Akuntansi</label>
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_acc" name="c_acc"
                                                        type="checkbox" data-checkbox="c_acc" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih proses" data-allow-clear="true"
                                                    data-kt-datatable-table-filter="e_acc" data-hide-search="false"
                                                    id="e_acc" name="e_acc">
                                                    <option value="0" selected>Belum Approv</option>
                                                    <option value="1">Setuju</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Urut Berdasarkan</label>
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_group" name="c_group"
                                                        type="checkbox" data-checkbox="c_group" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder"
                                                    data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih proses" data-allow-clear="true"
                                                    data-kt-datatable-table-filter="e_group" data-hide-search="false"
                                                    id="e_group" name="e_group">
                                                    <option value="tkad_mta_pk" selected>TIPE ANGGARAN</option>
                                                    <option value="mrops_pk">JENIS REALISASI</option>
                                                    <option value="mkk_pk">KELOMPOK KAS</option>
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
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <div id="kt_table_datatable_export" class="d-none"></div>

                    {{-- <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button> --}}

                    <div id="kt_table_datatable_export_menu" title-kt-export="Data Menu"
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                        data-kt-menu="true">
                        {{-- <div class="menu-item px-3">
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
                        </div> --}}
                    </div>
                    {{-- <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-sharp fa-solid fa-plus"></i> Tambah Data Approv</button> --}}
                </div>
            </div>
        </div>

        @include('pages.keuangan.kas.approv-transaksi-kas.modal.upload')
        @include('pages.keuangan.kas.approv-transaksi-kas.modal.approv')
        @include('pages.keuangan.kas.approv-transaksi-kas.modal.view')
        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border cell-border align-middle gy-5 gs-5"
                    id="serverSide_approv_kas_anggaran">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px">No.</th>
                            <th class="min-w-100px">Cabang Al Amin</th>
                            <th class="min-w-100px">Tgl Pengajuan</th>
                            <th class="min-w-250px">Peruntukan Dana</th>
                            <th class="min-w-150px">Debet</th>
                            <th class="min-w-100px">Kredit</th>
                            <th class="min-w-100px">Voucher</th>
                            <th class="min-w-100px">Dokumen</th>
                            <th class="min-w-100px">Tipe Anggaran</th>
                            <th class="min-w-100px">Jenis Realisasi</th>
                            <th class="min-w-100px">Kelompok Kas</th>
                            <th class="min-w-100px">Staff Keuangan</th>
                            <th class="min-w-100px">Kabag Keuangan</th>
                            <th class="min-w-100px">Divisi PMS</th>
                            <th class="min-w-100px">Akuntansi</th>
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
        tombol('change', 'e_baris', function() {
            var _this = $(this).val();
            if (_this == "" || _this == null) {
                setText('e_baris', '100');
            }
        });
        tombol('change', 'e_group', function() {
            var _this = $(this).val();
            if (_this == "" || _this == null) {
                setText('e_group', 'tkad_mta_pk');
            }
        });


        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // SELECT FILTER
            selectSide('e_cabalaminx', false, '{{ url('api/keuangan/kas/approv-kas-anggaran/cabang_alamin') }}',
                function(d) {
                    return {
                        id: d.mlok_kode,
                        text: d.mlok_nama
                    }
                },
                function(res) {
                    // setText('msoc_mssp_kode', res.params.data.id);
                    // setText('msoc_mssp_nama', res.params.data.text);
                    console.log(res);
                });

            selectSide('e_probulan1', false, '{{ url('api/bulan') }}',
                function(d) {
                    return {
                        id: d.no,
                        text: d.nama
                    }
                });

            selectSide('e_probulan2', false, '{{ url('api/bulan') }}',
                function(d) {
                    return {
                        id: d.no,
                        text: d.nama
                    }
                });

            selectSide('e_protahun', false, '{{ url('api/tahun') }}',
                function(d) {
                    return {
                        id: d.no,
                        text: d.no
                    }
                });

            filterAll('input[type="search"]', 'serverSide_approv_kas_anggaran'); //khusus type search inputan

            serverSide( //datatable serverside
                "serverSide_approv_kas_anggaran",
                "{{ url('api/keuangan/kas/approv-kas-anggaran/api_approv_kas_anggaran') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.c_periode = getText('c_periode'),
                        d.e_probulan1 = getText('e_probulan1'),
                        d.e_probulan2 = getText('e_probulan2'),
                        d.e_protahun = getText('e_protahun'),
                        d.c_cabang = getText('c_cabang'),
                        d.tdna_mlok_kode = getText('e_cabalaminx'),
                        d.c_keu2 = getText('c_keu2'),
                        d.e_keu2 = getText('e_keu2'),
                        d.c_pms = getText('c_pms'),
                        d.e_pms = getText('e_pms'),
                        d.c_keu1 = getText('c_keu1'),
                        d.c_keu1 = getText('c_keu1'),
                        d.c_acc = getText('c_acc'),
                        d.e_acc = getText('e_acc'),
                        d.c_group = getText('c_group'),
                        d.e_group = getText('e_group'),
                        d.e_baris = getText('e_baris'),
                        d.search = $('input[type="search"]').val();
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: 'mlok_nama',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'tdna_tgl_aju',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: null,
                        orderable: true,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<button type="button" onclick="approv_rk('` + row.tkad_pk +
                                `','0')" class="btn btn-light-success">` + row.tkad_keterangan +
                                `</button>`;
                        }
                    },
                    {
                        data: 'debit',
                        orderable: true,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return formatNum(row.debit, 2);
                        }
                    },
                    {
                        data: 'kredit',
                        orderable: true,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return formatNum(row.kredit, 2);
                        }
                    },
                    {
                        data: null,
                        orderable: true,
                        // className: 'text-left',
                        render: function(data, type, row) {
                            return `<button type="button" onclick="cetakpstaju('` + row.tdna_kode_vcr +
                                `','0')" class="btn btn-light-success">` + row.tdna_kode_vcr + `</button>`;
                        }
                    },
                    {
                        data: null,
                        orderable: true,
                        // className: 'text-left',
                        render: function(data, type, row) {
                            return `<button type="button" onclick="showPil('` + row.tdna_pk +
                                `')" class="btn btn-light-success">Lihat</button>`;
                        }
                    },
                    {
                        data: 'mta_keterangan',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'mrops_keterangan',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'mkk_nama',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'approv_staffkeu',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'approv_kbgkeu',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'approv_pms',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'approv_acc',
                        orderable: true,
                        className: 'text-left'
                    }

                ],
            );

            submitForm(
                "frxx_approv",
                "btn_simpan",
                "POST",
                "{{ url('keuangan/kas/approv') }}",
                (resSuccess) => {
                    // filterInput('a_pk', 'serverSide_kas');
                    lodTable('serverSide_approv_kas');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modal_approv');
                    clearForm("frxx_approv");
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function approv_rk(kode, tipe)
        {
            var url = "{{url('')}}"
        }

    </script>
@endsection
