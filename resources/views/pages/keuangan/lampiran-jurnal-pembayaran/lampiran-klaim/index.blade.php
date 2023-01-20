@extends('layouts.main-admin')

@section('title')
    Buat Lampiran Klaim
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>Daftar Peserta Lampiran Klaim</h3>
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

                    <div data-kt-datatable-table-filter="form">
                        <div class="px-7 py-5">
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
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Cabang Alamin</label>
                                        <select class="form-select form-select-solid fw-bolder" id="e_cab" name="e_cab" data-control="select2" data-kt-select2="true" data-placeholder="Pilih cabang" data-allow-clear="true" data-hide-search="false">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Periode Proses Inkaso</label>
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select form-select-solid fw-bolder" id="e_bln1" name="e_bln1" data-control="select2" data-kt-select2="true" data-placeholder="Pilih Bulan 1" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    @foreach (range(1,12) as $month)
                                                        <option value="{{ $month }}">{{ date('F', strtotime(date('Y').'-'.$month)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="input-group-text">s.d</span>
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select form-select-solid fw-bolder" id="e_bln2" name="e_bln2" data-control="select2" data-kt-select2="true" data-placeholder="Pilih Bulan 2" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    @foreach (range(1,12) as $month)
                                                        <option value="{{ $month }}">{{ date('F', strtotime(date('Y').'-'.$month)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="input-group-text">tahun</span>
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select form-select-solid fw-bolder" id="e_thn" name="e_thn" data-control="select2" data-kt-select2="true" data-placeholder="Pilih Tahun" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    @for ($year; $year <= date('Y'); $year++)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Pemegang Polis</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="c_pmgpolis" name="c_pmgpolis" type="checkbox" data-checkbox="c_pmgpolis" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" id="e_pmgpolis" name="e_pmgpolis" data-control="select2" data-kt-select2="true" data-placeholder="Pilih pemegang polis" data-allow-clear="true" data-hide-search="false">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Cabang Pmg Polis</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="c_cbpmgpolis" type="checkbox" data-checkbox="c_cbpmgpolis" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" id="e_cbpmgpolis" name="e_cbpmgpolis" data-control="select2" data-kt-select2="true" data-placeholder="Pilih cabang pmg polis" data-allow-clear="true" data-hide-search="false">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="separator border-gray-200"></div>
                        <div class="px-7 py-5">
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter" if><i class="fa-sharp fa-solid fa-eye"></i> Tampilkan</button>
                                <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i class="fa-solid fa-repeat"></i> Reset</button>
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

                <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-solid fa-square-plus"></i> Input Pic Tax</button>
                <button type="button" id="omodEdit" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> Update Saldo Tax</button>
            </div>
        </div>
    </div>

    <div class="card-body py-10">
        <div class="table-responsive">
            <form id="frxx_pjkomisi" name="frxx_pjkomisi" class="form-table" method="post" enctype="multipart/form-data">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="lampiranKlaim">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px" rowspan="2">No.</th>
                            <th class="min-w-350px" rowspan="2">Pemegang Polis</th>
                            <th class="min-w-125px" rowspan="2">Nama Peserta</th>
                            <th class="min-w-200px" rowspan="2">Jumlah Klaim</th>
                            <th class="min-w-150px" rowspan="2">Resiko</th>
                            <th colspan="4">Keputusan klaim</th>
                            <th class="min-w-125px" rowspan="2">Pilih</th>
                        </tr>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <td class="min-w-125px">Staff</td>
                            <td class="min-w-125px">Spv</td>
                            <td class="min-w-125px">Kabag</td>
                            <td class="min-w-125px">Kadiv</td>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </form>
        </div>
    </div>


</div>
@endsection

@section('script')
    <script>
        setText('e_bln1', '1');
        setText('e_bln2', '1');
        setText('e_thn', nowYear());
        setText('x_tahun', nowYear());
        setTextReadOnly('x_kode', true);
        setTextReadOnly('x_npwp', true);
        setTextReadOnly('x_nama', true);
        setTextReadOnly('x_status', true);

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectSide('e_cab', false, '{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/select-cabalamin") }}', function(d) { return {
                id: d.kode,
                text: d.nama
            }});

            selectSide('e_pmgpolis', false, '{{ url("keuangan/komisi-overriding/input-komisi-overriding/lod_pmg_polis") }}', function(d) { return {
                id: d.kode,
                text: d.nama
            }});

            selectSide('e_cbpmgpolis', false, '{{ url("keuangan/komisi-overriding/input-komisi-overriding/lod_pmg_polis") }}', function(d) { return {
                id: d.kode,
                text: d.nama
            }});

            tombol('change', 'x_tahun', function() {
                var tahun = $(this).val();
                selectSide('cari_tax', false, '{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/cari-tax") }}' + '?e_tahun=' + tahun, function(d) { return {
                    id: d.x_kode,
                    text: d.x_kode+' - '+d.x_nama,
                    x_kode: d.x_kode,
                    x_nama: d.x_nama,
                    x_npwp: d.x_npwp,
                    status: d.x_status,
                    x_tahun: d.x_tahun,
                    x_saldo: d.x_saldo
                }}, function(e) {
                        var data = e.params.data;
                        if(data.status == '0') {
                            setText('x_status', 'Karyawan Al Amin');
                        } else if (data.status == '1') {
                            setText('x_status', 'Non Karyawan Al Amin');
                        }
                        jsonForm('formUpdateTax', data);
                        console.log(data);
                });
            });

            tombol('change', 'c_pmgpolis',  function() {
                var _this = $(this).val();
                console.log(_this);
            });

            filterAll('input[type="search"]', 'lampiranKlaim'); //khusus type search inputan

            serverSide( //datatable serverside
                "lampiranKlaim",
                "{{ url('api/keuangan/lampiran-jurnal-pembayaran/lampiran-klaim/table-lampiran-klaim') }}", //url api/route
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.e_baris = getText('e_baris'),
                    // d.e_bln1 = getText('e_bln1'),
                    // d.e_bln2 = getText('e_bln2'),
                    // d.e_thn = getText('e_thn'),
                    // d.c_pmgpolis = getText('c_pmgpolis'),
                    // d.e_pmgpolis = getText('e_pmgpolis'),
                    // d.c_cbpmgpolis = getText('c_cbpmgpolis'),
                    // d.e_cbpmgpolis = getText('e_cbpmgpolis'),
                    d.search = $('input[type="search"]').val()
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return row.DT_RowIndex+`.`;
                        }
                    },
                    { data: "e_nmrekan" },
                    { data: "tpprd_nama" },
                    { data: "tpprd_klaim_netto", className: "dt-body-right" },
                    { data: "e_resikoklm", className: "text-center" },
                    { data: "klm_putusan01" },
                    { data: "klm_putusan02" },
                    { data: "klm_putusan1" },
                    { data: "klm_putusan2" },
                    { data: "klm_putusan3" },
                ],
                [100, 250, 500, 750, 1000, 2500, 5000, 10000],
            );

            tombol('click', 'omodTam', function() {
                openModal('modalInputTax');
                titleAction('tModInputTax', 'Entry User Tax');
                clearForm("formInputTax");
                bsimpan('btn_simpan', 'Simpan');
                setHide('btn_reset', false);
            });

            tombol('click', 'omodEdit', function() {
                openModal('modalUpdateTax');
                titleAction('titleMod', 'Pic Tax Update Saldo');
                clearForm("formUpdateTax");
                bsimpan('btn_simpan', 'Simpan');
                setHide('btn_reset', false);
            });

            submitForm("formInputTax", "btn_simpan", "POST", "{{ route('keuangan.komisi-overriding.input-komisi-overriding.store') }}", (resSuccess) => {
                clearForm("formInputTax");
                bsimpan('btn_simpan', 'Simpan');
                // lodTable("lampiranKlaim");
                closeModal('modalInputTax');
            });

            submitForm("formUpdateTax", "btn_simpan", "POST", "{{ route('keuangan.komisi-overriding.input-komisi-overriding.store') }}", (resSuccess) => {
                clearForm("formUpdateTax");
                bsimpan('btn_simpan', 'Simpan');
                // lodTable("lampiranKlaim");
                closeModal('modalUpdateTax');
            });

            tombol('click', 'omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.store') }}" + "/" + kode;
                submitDelete(kode, url, function(resSuccess) {
                    lodTable("lampiranKlaim");
                    console.log(resSuccess);
                }, function(resError) {
                    console.log(resError);
                });
            });
        });

        function proses_pst(i,kdpolis,tpst,tup,tkom,tover,bln1,bln2,thn,cab,tipe){
            var ck = "#chx"+i;
            var vpic1 = getText("xpic1"+i);
            var vsaldo1 = getText("xsaldo1"+i);

            var vpic1a = getText("xpic1a"+i);
            var vsaldo1a = getText("xsaldo1a"+i);

            var vpic1b = getText("xpic1b"+i);
            var vsaldo1b = getText("xsaldo1b"+i);

            var vpic2 = getText("xpic2"+i);
            var vsaldo2 = getText("xsaldo2"+i);

            var vpic2a = getText("xpic2a"+i);
            var vsaldo2a = getText("xsaldo2a"+i);

		    var vproses="xproses"+i;

            var vv={ res : ''};
            var url='{{ url("keuangan/komisi-overriding/input-komisi-overriding/post-pjkomisi") }}';
            var rms = "?kode="+kdpolis+"&bln1="+bln1+"&bln2="+bln2+"&thn="+thn+"&pst="+tpst+"&up="+tup+"&tkom="+tkom+"&tover="+tover+"&saldo1="+vsaldo1+"&pic1="+vpic1+"&pic1a="+vpic1a+"&pic1b="+vpic1b+"&saldo2="+vsaldo2+"&pic2="+vpic2+"&pic2a="+vpic2a+"&cab="+cab+"&tipe="+tipe;

            getJson(url+rms, vv, function(data) {
                if (data.error) {
                    pesan('error', data.error);
                    // clearForm("frxx_pjkomisi");
                } else {
                    // pesan('success', data.success);
                    console.log(data.success);
                    clearForm("frxx_pjkomisi");
                }
            });
        }

        function closeBtnModal() {
            closeModal('modalInputTax');
            clearForm("formInputTax");
        };
        function closeBtnUpdate() {
            closeModal('modalUpdateTax');
            clearForm("formUpdateTax");
        };

        hidePesan('mtx_kode');
        hidePesan('mtx_npwp');
        hidePesan('mtx_nama');
        hidePesan('mtx_status');
    </script>
@endsection
