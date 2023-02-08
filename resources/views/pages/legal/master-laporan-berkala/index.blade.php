@extends('layouts.main-admin')

@section('title')
    Lihat Master Laporan Berkala
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Master Laporan Berkala</h3>
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
                                        <label class="form-label fs-6 fw-bold">Judul Laporan Berkala:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_judul" name="check_judul"
                                                    type="checkbox" data-checkbox="check_judul" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                                data-placeholder="Pilih nomor" data-allow-clear="true"
                                                data-kt-datatable-table-filter="check_judul_laporan"
                                                data-hide-search="false" id="check_judul_laporan">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Jenis Dokumen:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_jenis" name="check_jenis" type="checkbox" data-checkbox="check_jenis" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih perihal" data-allow-clear="true" data-kt-datatable-table-filter="check_jenis_dokumen" data-hide-search="false" id="check_jenis_dokumen">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Tahun:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_tahun" name="check_tahun" type="checkbox" data-checkbox="check_tahun" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih jenis" data-allow-clear="true" data-kt-datatable-table-filter="check_tahun_laporan" data-hide-search="false" id="check_tahun_laporan">
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
                        data-bs-trigger="hover" id="omodTam" data-bs-placement="top" title="Tambah Baru">Tambah</button>
                </div>

                @include('pages.legal.master-laporan-berkala.modal.create')
                @include('pages.legal.master-laporan-berkala.modal.view')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_mst_lap_ber">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>Nomor PK</th>
                            <th class="min-w-250px">Jenis Laporan</th>
                            <th>Laporan Kepada</th>
                            <th>Batas Waktu Penyampaian</th>
                            <th>Unit Kerja Penanggungjawab Laporan</th>
                            <th>Persetujuan</th>
                            <th>Email PIC</th>
                            <th>WA PIC</th>
                            <th>Reminder</th>
                            <th>Last Update</th>
                        </tr>
                    </thead>
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

            //SELECT FILTER
            selectSide('check_judul_laporan', false, '{{ url('api/legal/selectJudul') }}', function(d) {
                return {
                    id: d.mlapbkl_jenis,
                    text: d.mlapbkl_jenis
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            changeSelect('check_judul_laporan', 'key', '{{ url('api/legal/getJudul') }}', function(d) {
                return {
                    id: d.mlapbkl_jenis,
                    text: d.mlapbkl_jenis
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            filterAll('input[type="search"]', 'serverSide_mst_lap_ber'); //khusus type search inputan

            serverSide( //datatable serverside
                'serverSide_mst_lap_ber',
                "{{ url('api/legal/m_laporan_berkala') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.check_judul = getText('check_judul'),
                        d.mlapbkl_jenis = getText('check_judul_laporan'),
                        d.search = $('input[type="search"]').val();
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
                        <button type="button" id="omodEdit" data-resouce="` + row.mlapbkl_pk +
                                `" class="btn btn-light-success" target="blank"> ` + row.mlapbkl_pk +
                                ` </button>`
                        }
                    },
                    {
                        data: 'mlapbkl_jenis'
                    },
                    {
                        data: 'mlapbkl_kepada'
                    },
                    {
                        data: 'mlapbkl_batas'
                    },
                    {
                        data: 'unit'
                    },
                    {
                        data: 'mlapbkl_persetujuan'
                    },
                    {
                        data: 'mlapbkl_pic_email'
                    },
                    {
                        data: 'mlapbkl_pic_hp'
                    },
                    {
                        data: 'aktif'
                    },
                    {
                        data: 'mlapbkl_update'
                    },
                ],
            );

            tombol('click', 'omodTam', function() {
                openModal('modal');
                bsimpan('btn_simpan', 'Simpan');
                titleAction('tMod', 'Tambah Data');
            });

            tombol('click', 'omodEdit', function() {
                titleAction('tMod', 'Edit Data');
                bsimpan('btn_simpan', 'Update');
                setHide('btn_reset', true);
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/master-laporan') }}" + "/" + kode + "/edit";
                lodJson('GET', url, function(data) {
                    openModal('modal');
                    jsonForm('frxx', data);
                });

            });

            submitForm(
                "frxx",
                "btn_simpan",
                "POST",
                "{{ route('legal.master-laporan.store') }}",
                (resSuccess) => {
                    clearForm("frxx");
                    clearSelect();
                    lodTable('serverSide_mst_lap_ber');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modal');
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function closeModLap() {
            closeModal('modal');
            clearForm('frxx');
        }
    </script>
@endsection
