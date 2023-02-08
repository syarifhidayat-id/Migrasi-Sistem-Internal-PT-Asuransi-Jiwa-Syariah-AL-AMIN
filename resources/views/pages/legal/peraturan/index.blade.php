@extends('layouts.main-admin')

@section('title')
    Lihat Peraturan Perusahaan
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Peraturan Perusahaan</h3>
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
                                        <label class="form-label fs-6 fw-bold">Nama Menu:</label>
                                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                            data-placeholder="Pilih menu" data-allow-clear="true"
                                            data-kt-datatable-table-filter="nama-menu" data-hide-search="false">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                </div>

                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <div id="kt_table_datatable_export" class="d-none"></div>
                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" id="omodTam">Tambah</button>
                </div>
            </div>
            @include('pages.legal.peraturan.modal.create')
            @include('pages.legal.peraturan.modal.view')
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_peraturan">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>Nomor</th>
                            <th class="min-w-250px">Tentang</th>
                            <th>Jenis</th>
                            <th>Bulan</th>
                            <th>Tahun</th>
                            <th>User Input</th>
                            <th>Tanggal Input</th>
                            <th>Dokumen</th>
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

            filterAll('input[type="search"]', 'serverSide_peraturan');
            serverSide( //datatable serverside
                'serverSide_peraturan',
                "{{ url('api/legal/peraturan_perusahaan') }}", //url api/route
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
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="omodEdit" data-resouce="` + row.map_pk +
                                `" class="btn btn-light-success" target="blank"> ` + row.map_nomor +
                                ` </button>`
                        }
                    },
                    {
                        data: 'map_tentang'
                    },
                    {
                        data: 'jenis_map'
                    },
                    {
                        data: 'bulan_map'
                    },
                    {
                        data: 'map_tahun'
                    },
                    {
                        data: 'map_ins_user'
                    },
                    {
                        data: 'ins_date'
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="bmoViewPdf" data-resouce="` + row.map_pk + `" data-show-pdf="` + row
                                .map_dokumen + `"
                                        class="btn btn-light-success" target="blank"> Lihat </button>`
                        }
                    },
                ],
            );

            tombol('click', 'omodTam', function() {
                openModal('modal_peraturan');
                bsimpan('btn_simpan', 'Simpan');
                titleAction('tMod', 'Tambah Data');
            });

            tombol('click', 'bmoViewPdf', function() {
                var kode = $(this).attr('data-show-pdf');
                var loc2 = '{{ url("storage/legal/peraturan") }}'+ '/' + kode;
                openModal('modalView');
                $('#view_pdf').attr('src', loc2);
            });

            tombol('click', 'omodEdit', function() {
                titleAction('tMod', 'Edit Data');
                bsimpan('btn_simpan', 'Update');
                setHide('btn_reset', true);
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/peraturan-perusahaan') }}" + "/" + kode + "/edit";
                    lodJson('GET', url, function(data) {
                        openModal('modal_peraturan');
                        jsonForm('frxx_peraturan', data);
                    });
            });

            submitForm(
                "frxx_peraturan",
                "btn_simpan",
                "POST",
                "{{ route('legal.peraturan-perusahaan.store') }}",
                (resSuccess) => {
                    clearForm("frxx_peraturan");
                    clearSelect();
                    lodTable('serverSide_peraturan');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modal_peraturan');
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function closeModCreate() {
            closeModal('modal_peraturan');
            clearForm('frxx_peraturan');
        }
    </script>
@endsection
