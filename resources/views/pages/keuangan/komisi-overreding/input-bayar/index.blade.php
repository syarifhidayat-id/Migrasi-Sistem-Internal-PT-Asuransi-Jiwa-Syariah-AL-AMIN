@extends('layouts.main-admin')

@section('title')
    Input Bayar Komisi & Overreding
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>Daftar Pemegang Polis Belum Bayar Komisi</h3>
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
                                            <option value="10" selected>10</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
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
                                <div class="col-md-12">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Periode Approval Kadiv</label>
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="c_periode" name="c_periode" type="checkbox" data-checkbox="c_periode" />
                                            </label>
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select form-select-solid fw-bolder" id="e_bln1" name="e_bln1" data-control="select2" data-kt-select2="true" data-placeholder="Pilih Bulan" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    @foreach (range(1,12) as $num)
                                                        <option value="{{ $num }}">{{ $month[$num] }}</option>
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

                {{-- <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-solid fa-square-plus"></i> Input Pic Tax</button>
                <button type="button" id="omodEdit" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> Update Saldo Tax</button> --}}
            </div>
        </div>
    </div>

    <div class="card-body py-10">
        <div class="table-responsive">
            <form id="frxx_bjkomisi" name="frxx_bjkomisi" class="form-table" method="post" enctype="multipart/form-data">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="inputByr">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px">No.</th>
                            <th class="min-w-50px">Peserta</th>
                            <th class="min-w-250px">ID</th>
                            <th class="min-w-350px">Pemegang Polis</th>
                            <th class="min-w-250px">Up</th>
                            <th class="min-w-250px">Konribusi Tagih</th>
                            <th class="min-w-250px">Komisi Gross</th>
                            <th class="min-w-250px">Tax Komisi</th>
                            <th class="min-w-250px">Komisi Netto</th>
                            <th class="min-w-250px">Overreding</th>
                            <th class="min-w-250px">Tax Overreding</th>
                            <th class="min-w-250px">Overreding Netto</th>
                            <th class="min-w-300px">Komisi + Overreding Netto</th>
                            <th class="min-w-200px">Jumlah Bayar</th>
                            <th class="min-w-200px">Tanggal Bayar</th>
                            <th class="min-w-100px">Proses</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </form>
        </div>
    </div>

    @include('pages.keuangan.komisi-overreding.input-bayar.modal.pilih')
</div>
@endsection

@section('script')
    <script>
        setText('e_bln1', '1');
        setText('e_thn', nowYear());

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectSide('e_cab', false, '{{ url("api/keuangan/komisi-overriding/input-bayar-overriding/lod_cabalamin") }}', function(d) { return {
                id: d.kode,
                text: d.nama
            }});

            selectSide('e_pmgpolis', false, '{{ url("keuangan/komisi-overriding/input-bayar-overriding/lod_pmg_polis") }}', function(d) { return {
                id: d.kode,
                text: d.nama
            }});

            filterAll('input[type="search"]', 'inputByr'); //khusus type search inputan

            serverSide( //datatable serverside
                "inputByr",
                "{{ url('api/keuangan/komisi-overriding/input-bayar-overriding/lod-input-bayar') }}", //url api/route
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.e_baris = getText('e_baris'),
                    d.e_cab = getText('e_cab'),
                    d.c_pmgpolis = getText('c_pmgpolis'),
                    d.e_pmgpolis = getText('e_pmgpolis'),
                    d.c_pmgpolis = getText('c_pmgpolis'),
                    d.e_bln1 = getText('e_bln1'),
                    d.e_thn = getText('e_thn'),
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
                    { data: "tpst" },
                    { data: "id" },
                    { data: "nama" },
                    {
                        data: "tup",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.tup, 2);
                        }
                    },
                    {
                        data: "ttagih",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.ttagih, 2);
                        }
                    },
                    {
                        data: "tkomisi",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.tkomisi, 2);
                        }
                    },
                    {
                        data: "ttax",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.ttax, 2);
                        }
                    },
                    {
                        data: "tkomisi",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.tkomisi-row.ttax, 2);
                        }
                    },
                    {
                        data: "toverreding",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.toverreding, 2);
                        }
                    },
                    {
                        data: "ttax_overr",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.ttax_overr, 2);
                        }
                    },
                    {
                        data: "toverreding",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.toverreding-row.ttax_overr, 2);
                        }
                    },
                    {
                        data: "tagihan",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.tagihan, 2);
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            // return `<input type="text" class="form-control form-control-solid xrp" id="xrp`+row.DT_RowIndex+`" name="xrp`+row.DT_RowIndex+`" data-type="rupiah" placeholder="Jumlah bayar" />`;
                            return `<input type="text" class="form-control form-control-solid xrp" name="xrp${row.DT_RowIndex}" id="xrp${row.DT_RowIndex}" placeholder="ex. 250,078.00" data-type="rupiah" />`;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<input type="date" class="form-control form-control-solid xtgl" id="xtgl${row.DT_RowIndex}" name="xtgl${row.DT_RowIndex}" placeholder="dd/mm/yyyy" />`;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var xrp = "xrp"+row.DT_RowIndex;
                            var xtgl = "xtgl"+row.DT_RowIndex;
                            return `<button type="button" class="btn btn-primary btn-sm" onclick="aprovPst('`+row.id+`', '${xrp}', '${xtgl}')">Pilih</button>`;
                        }
                    },
                ],
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

            submitForm("formInputTax", "btn_simpan", "POST", "{{ route('keuangan.komisi-overriding.input-bayar-overriding.store') }}", (resSuccess) => {
                clearForm("formInputTax");
                bsimpan('btn_simpan', 'Simpan');
                // lodTable("inputByr");
                closeModal('modalInputTax');
            });

            submitForm("formUpdateTax", "btn_simpan", "POST", "{{ route('keuangan.komisi-overriding.input-bayar-overriding.store') }}", (resSuccess) => {
                clearForm("formUpdateTax");
                bsimpan('btn_simpan', 'Simpan');
                // lodTable("inputByr");
                closeModal('modalUpdateTax');
            });

            tombol('click', 'omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.store') }}" + "/" + kode;
                submitDelete(kode, url, function(resSuccess) {
                    lodTable("inputByr");
                    console.log(resSuccess);
                }, function(resError) {
                    console.log(resError);
                });
            });
        });

        function aprovPst(kode,idx,tgl)
        {
            var xkode = getText(kode);
            var xrp = getText(idx);
            var xtgl = getText(tgl);
            openModal('modalPilihJab');
            titleAction('titleMod', 'Pembayaran Komisi/Overriding');
            buka_jabatan('?vlain='+xrp+'&polis='+kode+'&vtgl='+xtgl);
            // console.log(vlain, vtgl, xrows);
        }

        function buka_jabatan(vkon) {
            tableSideSel('listPemIbr', '', { style: 'multi', selector: 'td:first-child input[type="checkbox"]', className: 'row-selected' }, '{{ url("keuangan/komisi-overriding/input-bayar-overriding/lod_byr_pjkomisi") }}' + vkon, function(d) {}, [
                { data: 'DT_RowIndex', className: 'text-center' },
                { data: 'ck', className: 'text-center' },
                { data: 'tpprd_pk' },
                { data: 'bayar', className: 'dt-body-right' },
                { data: 'stsbyr', className: 'text-center' },
                { data: 'tgl_bayar', className: 'text-center' },
                { data: 'nopst' },
                { data: 'nama' },
                { data: 'up', className: 'dt-body-right' },
                { data: 'komisinett', className: 'dt-body-right' },
                { data: 'ovrnett', className: 'dt-body-right' },
            ],[
                {
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return row.DT_RowIndex+`.`;
                    }
                },
                {
                    targets: 1,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        var check = row.ck;
                        var cek1 = `<input class="form-check-input cpemb" id="cpemb${row.DT_RowIndex}" type="checkbox" value="" />`;
                        var cek2 = `<input class="form-check-input cpemb" id="cpemb${row.DT_RowIndex}" type="checkbox" value="${check}" checked />`;
                        if (check=='1') {
                            return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                ${cek2}
                            </div>`;
                        } else {
                            return `
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                ${cek1}
                            </div>`;
                        }
                    }
                },
            ]);
        }

        function closeJabPil() {
            clearForm('frxx_bjkomisi');
            closeModal('modalPilihJab');
            lodTable('inputByr');
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
