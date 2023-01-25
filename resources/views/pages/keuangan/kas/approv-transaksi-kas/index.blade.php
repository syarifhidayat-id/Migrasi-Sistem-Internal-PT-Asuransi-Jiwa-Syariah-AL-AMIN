@extends('layouts.main-admin')

@section('title')
    Approv/upload Transaksi KAS
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
    
                    <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                        <i class="fa-sharp fa-solid fa-filter"></i> Filter Pencarian
                    </button>
    
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                        </div>
                        <div class="separator border-gray-200"></div>
    
                        <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                            <div class="row mb-10">
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                        <input type="search" data-kt-datatable-table-filter="search" name="seacrh" id="seacrh" class="form-control form-control-solid" placeholder="Cari All" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Jumlah Baris yang Tampil</label>
                                        <select class="form-select form-select-solid fw-bolder" id="e_baris" name="e_baris" data-control="select2" data-kt-select2="true" data-placeholder="Pilih cabang" data-allow-clear="true" data-hide-search="false">
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
                                {{-- <div class="col-md-12">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                        <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control form-control-solid" placeholder="Cari data!" />
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Cabang Al-amin</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_cab_alamin" name="check_cab_alamin" type="checkbox" data-checkbox="check_cab_alamin" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih cabang" data-allow-clear="true" data-kt-datatable-table-filter="nama-cabang" data-hide-search="false" id="cab_alamin" name="cab_alamin">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Buku Besar</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_buku_besar" name="check_buku_besar" type="checkbox" data-checkbox="check_buku_besar" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true" data-kt-datatable-table-filter="nama-buku" data-hide-search="false" id="buku_besar" name="buku_besar">
                                                <option></option>
                                                <option value="0">Belum Proses</option>
                                                <option value="1">Sudah Proses</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Jurnal</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_jurnal" name="check_jurnal" type="checkbox" data-checkbox="check_jurnal" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true" data-kt-datatable-table-filter="nama-jurnal" data-hide-search="false" id="select_jurnal" name="select_jurnal">
                                                <option></option>
                                                <option value="0" selected>Belum Proses</option>
                                                <option value="1">Sudah Proses</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Keuangan</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_keu" name="check_keu" type="checkbox" data-checkbox="check_keu" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true" data-kt-datatable-table-filter="nama-keuangan" data-hide-search="false" id="select_keu" name="select_keu">
                                                <option></option>
                                                <option value="0" selected>Belum Approv</option>
                                                <option value="1">Setuju</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Admin</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_admin" name="check_admin" type="checkbox" data-checkbox="check_admin" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true" data-kt-datatable-table-filter="nama-admin" data-hide-search="false" id="select_admin" name="select_admin">
                                                <option></option>
                                                <option value="0" selected>Belum Approv</option>
                                                <option value="1">Setuju</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Pincab</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_pincab" name="check_pincab" type="checkbox" data-checkbox="check_pincab" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true" data-kt-datatable-table-filter="nama-pincab" data-hide-search="false" id="select_pincab" name="select_pincab">
                                                <option></option>
                                                <option value="0" selected>Belum Approv</option>
                                                <option value="1">Setuju</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Kadiv/Wakadiv</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_kadiv" name="check_kadiv" type="checkbox" data-checkbox="check_kadiv" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true" data-kt-datatable-table-filter="nama-kadiv" data-hide-search="false" id="select_kadiv" name="select_kadiv">
                                                <option></option>
                                                <option value="0" selected>Belum Approv</option>
                                                <option value="1">Setuju</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Korwil</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_korwil" name="check_korwil" type="checkbox" data-checkbox="check_korwil" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true" data-kt-datatable-table-filter="nama-korwil" data-hide-search="false" id="select_korwil" name="select_korwil">
                                                <option></option>
                                                <option value="0" selected>Belum Approv</option>
                                                <option value="1">Setuju</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Periode</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_periode" type="checkbox" data-checkbox="check_periode" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-control="select2" data-kt-select2="true" data-placeholder="Pilih periode" data-allow-clear="true" data-kt-datatable-table-filter="nama-periode" data-hide-search="false" id="periode">
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
            </div>
    
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <div id="kt_table_datatable_export" class="d-none"></div>
    
                    {{-- <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button> --}}
    
                    <div id="kt_table_datatable_export_menu" title-kt-export="Data Menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
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
                    id="serverSide_approv_kas">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px">No.</th>
                            <th class="min-w-100px">Kantor Al-amin</th>
                            <th class="min-w-100px">Tgl Pengajuan</th>
                            <th class="min-w-250px">Peruntukan Dana</th>
                            <th class="min-w-150px">Nilai</th>
                            <th class="min-w-100px">Voucher</th>
                            <th class="min-w-100px">Upload Bukti</th>
                            <th class="min-w-100px">Bukti</th>
                            <th class="min-w-100px">Lihat</th>
                            <th class="min-w-100px">Admin</th>
                            <th class="min-w-100px">Kepala Cabang</th>
                            <th class="min-w-100px">Kadiv/Wakadiv</th>
                            <th class="min-w-100px">Korwil</th>
                            <th class="min-w-100px">Keuangan</th>
                            <th>Keterangan</th>
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
        setHide('btn_reset', true);
        
        
        setTextReadOnly('mlok_nama', true);
        setTextReadOnly('tdna_tgl_aju', true);
        setTextReadOnly('tdna_ket', true);
        setTextReadOnly('tdna_penerima', true);
        setTextReadOnly('tdna_total', true);



        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // SELECT FILTER
            selectSide('cab_alamin', false, '{{ url('api/keuangan/kas/selectCabangAlamin') }}', function(d) {
                return {
                    id: d.mlok_pk,
                    text: d.mlok_nama
                }
            }, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            filterAll('input[type="search"]', 'serverSide_approv_kas'); //khusus type search inputan

            serverSide( //datatable serverside
                "serverSide_approv_kas",
                "{{ url('api/keuangan/kas/api_dtl_approv') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.e_baris = getText('e_baris'),
                    d.check_cab_alamin = getText('check_cab_alamin'),
                    d.mlok_pk = getText('cab_alamin'),
                    
                    d.check_buku_besar = getText('check_buku_besar'),
                    d.tdna_sts_buku = getText('buku_besar'),

                    d.check_jurnal = getText('check_jurnal'),
                    d.tdna_sts_jurnal = getText('select_jurnal'),
                    
                    d.check_keu = getText('check_keu'),
                    d.tdna_aprov_ho = getText('select_keu'),
                    
                    d.check_admin = getText('check_admin'),
                    d.tdna_aprov_admin = getText('select_admin'),
                    
                    d.check_pincab = getText('check_pincab'),
                    d.tdna_aprov_kacab = getText('select_pincab'),
                    
                    d.check_kadiv = getText('check_kadiv'),
                    d.tdna_aprov_kapms = getText('select_kadiv'),
                    
                    d.check_korwil = getText('check_korwil'),
                    d.tdna_aprov_korwil = getText('select_korwil'), 
                    
                    d.search = $('input[type="search"]').val();
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    // {
                    //     // data: 'mojk_pk'
                    //     data: null,
                    //     orderable: false,
                    //     className: 'text-center',
                    //     render: function(data, type, row) {
                    //         return `
                    //     <button type="button" id="omodEdit" data-resouce="` + row.tdna_pk +
                    //             `" class="btn btn-light-success" target="blank"> ` + row.tdna_pk +
                    //             ` </button>`
                    //     }
                    // },
                    {
                        data: 'tdna_mlok_kode'
                    },
                    {
                        data: 'tdna_tgl_aju'
                    },
                    {
                        // data: 'tdna_ket'
                        data: null,
                        orderable: true,
                        // className: 'text-left',
                        render: function(data, type, row) {
                            return `<button type="button" id="btn_approv" data-resource="`+ row.tdna_pk +`" class="btn btn-light-success">`+ row.tdna_ket +`</button>`
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `Rp.` + row.tdna_total }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<button type="button" id="btn_vcr" class="btn btn-light-success">` + row.tdna_kode_vcr + `</button>`
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<button type="button" onclick="uploadPolis('`+row.tdna_pk+`','`+row.tdna_bukti+`')" class="btn btn-light-success"> Upload </button>`;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `Bukti Kas`
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<button type="button" id="btn_lihat_bukti" class="btn btn-light-success"> Proses </button>`
                        }
                    },
                    {
                        data: 'tdna_aprov_admin'
                    },
                    {
                        data: 'tdna_aprov_kacab'
                    },
                    {
                        data: 'tdna_aprov_kapms'
                    },
                    {
                        data: 'tdna_aprov_korwil'
                    },
                    {
                        data: 'tdna_aprov_ho'
                    },
                    {
                        data: null,
                        orderable:false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `?`
                        }
                    },
                ],
            );

            tombol('click', 'btn_approv', function() {
                var kode = $(this).attr('data-resource');
                lodJson("GET", "{{ url('api/keuangan/kas/api_approv') }}" + "/" + kode, function (data) {
                openModal('modal_approv');
                setHide('tdna_pk', true);
                titleAction('tMod_approv', 'Approval Dana Kas');
                bsimpan('btn_simpan', 'Simpan');
                jsonForm('frxx_approv', data);
            });
        });

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
        )
    });

    function uploadPolis(kode, doc) {
        // var url = "{{ url('storage/keuangan/kas/master-kas') }}" + "/" + doc;
        // console.log(doc)
        lodJson('GET', '{{ url("api/keuangan/kas/lod-doc-approv") }}' + '?doc=' + doc, function(res) {
            console.log(res);
        });
        // if (doc=="" || doc==null || doc = file_exists(public_path(url))) {
        //     titleAction('tMod', 'Lihat');
        //     openModal('modal_upload');
        //     setText('tdna_pk', kode);
        // } else {
        //     titleAction('tModView', 'Lihat');
        //     openModal('modalView');
        //     $('#view_pdf').attr('src', url);
        // }
        console.log(kode,doc);
    }

        function close_approv() {
            closeModal('modal_approv');
            clearForm('frxx_approv');
        }
        function close_upload() {
            closeModal('modal_upload');
            clearForm('frxx_upload');
        }
    </script>
@endsection
