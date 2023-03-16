@extends('layouts.main-admin')

@section('title')
    Lihat Kasbon
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Kasbon</h3>
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
                                <div class="col-md-12">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                        <input type="search" data-kt-datatable-table-filter="search" name="seacrh"
                                            id="seacrh" class="form-control form-control-solid" placeholder="Cari All" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Periode Input:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="c_periode" name="c_periode"
                                                    type="checkbox" data-checkbox="c_periode" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                                data-kt-select2="true" data-placeholder="Bulan" data-allow-clear="true"
                                                data-kt-datatable-table-filter="e_probulan1" data-hide-search="false"
                                                id="e_probulan1" name="e_probulan1">
                                                <option></option>
                                                {{ optSql('SELECT no2 kode,nama ket FROM eset.bulan', 'kode', 'ket') }}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">S.D</label>
                                        <div class="d-flex flex-stack">
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                                data-kt-select2="true" data-placeholder="Bulan" data-allow-clear="true"
                                                data-kt-datatable-table-filter="e_probulan2" data-hide-search="false"
                                                id="e_probulan2" name="e_probulan2">
                                                <option></option>
                                                {{ optSql('SELECT no2 kode,nama ket FROM eset.bulan', 'kode', 'ket') }}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Tahun</label>
                                        <div class="d-flex flex-stack">
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                                data-kt-select2="true" data-placeholder="Tahun" data-allow-clear="true"
                                                data-kt-datatable-table-filter="e_protahun" data-hide-search="false"
                                                id="e_protahun" name="e_protahun">
                                                <option></option>
                                                {{ optSql('SELECT no kode,no ket FROM eset.tahun', 'kode', 'ket') }}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Jenis Realisasi</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="c_jenis" name="c_jenis"
                                                    type="checkbox" data-checkbox="c_jenis" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                                data-kt-select2="true" data-placeholder="Pilih proses"
                                                data-allow-clear="true" data-hide-search="false" id="e_realisasix"
                                                name="e_realisasix">
                                                <option></option>
                                                {{ optSql('SELECT mar_kode kode, mar_nama nama FROM emst.`mst_anggaran_realisasi` ORDER BY nama', 'kode', 'nama') }}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Nama Karyawan</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="c_nama" name="c_nama"
                                                    type="checkbox" data-checkbox="c_nama" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                                data-kt-select2="true" data-placeholder="Pilih proses"
                                                data-allow-clear="true" data-hide-search="false" id="e_nmkaryawan"
                                                name="e_nmkaryawan">
                                                <option></option>
                                                {{ optSql('SELECT skar_pk kode , upper(skar_nama) nama FROM esdm.`sdm_karyawan_new` order by 1 ', 'kode', 'nama') }}
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
                        data-bs-trigger="hover" id="omodTam" data-bs-placement="top" title="Tambah Baru">Tambah
                        Kasbon</button>
                </div>
            </div>
        </div>

        @include('pages.keuangan.kas.kasbon.modal.create')

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_kasbon">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px">No.</th>
                            <th class="min-w-100px">Tanggal Kasbon</th>
                            <th class="min-w-200px">Nama Karyawan</th>
                            <th class="min-w-100px">Nominal</th>
                            <th class="min-w-100px">Status</th>
                            <th class="min-w-100px">Tanggal Input</th>
                            <th class="min-w-150px">ID Kasbon</th>
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

            selectOpTag('e_cabalamin');
            selectOpTag('e_karyawan');
            selectOpTag('e_realisasi');
            selectOpTag('e_akunkas');

            selectSide('e_cabalamin', false, '{{ url('api/kantor_cabang') }}',
                function(d) {
                    return {
                        id: d.mlok_kode,
                        text: d.mlok_nama
                    }
                },
                function(e) {
                    var data = e.params.data.id;
                    console.log(data);
                    selectSide('e_karyawan', false, '{{ url('api/lod_karyawan') }}' +
                        '?mlok=' + data,
                        function(d) {
                            return {
                                id: d.kode,
                                text: d.nama
                            }
                        }, function (values) {
                            console.log(values.params.data.id);
                        });

                    selectSide('e_akunkas', false, '{{ url('api/lod_akunkascab') }}' +
                        '?mlok=' + data,
                        function(d) {
                            return {
                                id: d.akun,
                                text: d.nama
                            }
                        }, function (value) {
                            console.log(value.params.data.id);
                            
                        });
                });

            selectSide('e_realisasi', false, '{{ url('api/lod_ang_realisasi') }}',
                function(d) {
                    return {
                        id: d.kode,
                        text: d.nama
                    }
                });

            filterAll('input[type="search"]', 'serverSide_kasbon'); //khusus type search inputan

            serverSide( //datatable serverside
                "serverSide_kasbon",
                "{{ url('api/keuangan/kas/kasbon/grd_lihat_kasbon') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.c_periode = getText('c_periode'),
                        d.e_probulan1 = getText('e_probulan1'),
                        d.e_probulan2 = getText('e_probulan2'),
                        d.e_protahun = getText('e_protahun'),
                        d.c_jenis = getText('c_jenis'),
                        d.e_realisasix = getText('e_realisasix'),
                        d.c_nama = getText('c_nama'),
                        d.e_nmkaryawan = getText('e_nmkaryawan'),
                        d.search = $('input[type="search"]').val()
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: "tkb_tanggal",
                        className: "text-center"
                    },
                    {
                        data: "skar_nama",
                        className: "text-center"
                    },
                    {
                        data: "tkb_nominal",
                        className: "td-text-right"
                    },
                    {
                        data: "status_kasbon",
                        className: "text-center"
                    },
                    {
                        data: "tkb_ins_date",
                        className: "text-center"
                    },
                    {
                        data: "tkb_pk",
                        className: "td-text-left"
                    },

                ],
            );

            tombol('click', 'omodTam', function() {
                openModal('modalTamKasbon');
                setHide('btn_reset', false);
                bsimpan('btn_simpan', 'Simpan');
                titleAction('tModKasbon', 'Tambah Kasbon');
            });

            submitForm(
                "frxx_kasbon",
                "btn_simpan",
                "POST",
                "{{ route('keuangan.kas.kasbon.store') }}",
                (resSuccess) => {
                    clearForm("frxx_kasbon");
                    // clearSelect();
                    lodTable('serverSide_kasbon');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modalTamKasbon');
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function closeMod() {
            closeModal('modalTamKasbon');
            clearForm('frxx_kasbon');
        }
    </script>
@endsection
