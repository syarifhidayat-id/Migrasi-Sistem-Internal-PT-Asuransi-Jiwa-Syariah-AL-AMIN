@extends('layouts.main-admin')

@section('title')
    Input Pajak Komisi & Overreding
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Pajak Komisi & Overreding</h3>
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
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                        <input type="search" data-kt-datatable-table-filter="search" name="seacrh" id="seacrh" class="form-control form-control-solid" placeholder="Cari All" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Cabang Alamin</label>
                                        <select class="form-select form-select-solid fw-bolder" id="e_cab" name="e_cab" data-control="select2" data-kt-select2="true" data-placeholder="Pilih cabang" data-allow-clear="true" data-hide-search="false">
                                            <option></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-5">
                                        <label class="form-label fs-6 fw-bold">Periode Proses Inkaso</label>
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select form-select-solid fw-bolder" id="e_bln1" name="e_bln1" data-control="select2" data-kt-select2="true" data-placeholder="Pilih Bulan 1" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    @foreach (range(1,12) as $month)
                                                        {{-- <option value="{{ date('m', strtotime(date('Y').'-'.$month)) }}">{{ date('F', strtotime(date('Y').'-'.$month)) }}</option> --}}
                                                        <option value="{{ $month }}">{{ date('F', strtotime(date('Y').'-'.$month)) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="input-group-text">s.d</span>
                                            <div class="overflow-hidden flex-grow-1">
                                                <select class="form-select form-select-solid fw-bolder" id="e_bln2" name="e_bln2" data-control="select2" data-kt-select2="true" data-placeholder="Pilih Bulan 2" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    @foreach (range(1,12) as $month)
                                                        {{-- <option value="{{ date('m', strtotime(date('Y').'-'.$month)) }}">{{ date('F', strtotime(date('Y').'-'.$month)) }}</option> --}}
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
        <form id="frxx_pjkomisi" name="frxx_pjkomisi" class="form-mixs" method="post" enctype="multipart/form-data">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" data-kt-menu="true" tabindex="-1" id="InpOjkKomOver">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px">No.</th>
                            <th class="min-w-200px">Pemegang Polis</th>
                            <th class="min-w-150px">Kode Polis</th>
                            <th class="min-w-125px">Peserta</th>
                            <th class="min-w-200px">Uang Pertanggungan</th>
                            <th class="min-w-200px">Kontribusi Tagih</th>
                            <th class="min-w-200px">Kontribusi Bayar</th>
                            <th class="min-w-120px">Komisi</th>
                            <th class="min-w-450px">Pic Pajak Komisi 1</th>
                            <th class="min-w-200px">Komisi Bruto 1</th>
                            <th class="min-w-450px">Pic Pajak Komisi 2</th>
                            <th class="min-w-200px">Komisi Bruto 2</th>
                            <th class="min-w-120px">Overreding</th>
                            <th class="min-w-450px">Pic Pajak Overreding 1</th>
                            <th class="min-w-200px">Komisi Bruto 1</th>
                            <th class="min-w-150px">Proses Data</th>
                            <th class="min-w-350px">Keterangan</th>
                            <th class="min-w-150px">Cab. Alamin</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 align-middle" align="right">
                            <th colspan="3"></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </form>
    </div>

    @include('pages.keuangan.komisi-overreding.input.modal.input')
    @include('pages.keuangan.komisi-overreding.input.modal.update-saldo')
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

        console.log(nowDate());
        console.log(nowYear());

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectSide('e_cab', false, '{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/select-cabalamin") }}', function(d) { return {
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
                }}, function(res) {
                        var data = res.params.data;
                        if(data.status == '0') {
                            setText('x_status', 'Karyawan Al Amin');
                        } else if (data.status == '1') {
                            setText('x_status', 'Non Karyawan Al Amin');
                        }
                        jsonForm('formUpdateTax', res.params.data);
                        console.log(res.params.data);
                });
            });

            filterAll('input[type="search"]', 'InpOjkKomOver'); //khusus type search inputan

            serverSides( //datatable serverside
                "InpOjkKomOver",
                "{{ url('api/keuangan/komisi-overriding/input-komisi-overriding/lod-input-komisioverriding') }}", //url api/route
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.e_cab = getText('e_cab'),
                    d.e_bln1 = getText('e_bln1'),
                    d.e_bln2 = getText('e_bln2'),
                    d.e_thn = getText('e_thn'),
                    // d.check_2 = getText('check_2'),
                    // d.wmn_tipe = getText('tipe_menu'),
                    // d.wmn_descp = getText('key'),
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
                    {
                        data: "nama",
                        render: function(data, type, row, meta) {
                            var kode = row.kdpolis;
                            var cab = getText('e_cab');
                            var bln1 = getText('e_bln1');
                            var bln2 = getText('e_bln2');
                            var thn = getText('e_thn');
                            var rms = "kode="+kode+"&e_cab="+cab+"&e_bln1="+bln1+"&e_bln2="+bln2+"&e_thn="+thn;
                            if (cab == "") {
                                return `<a disable><div class="badge badge-light-success fw-bolder">`+row.nama+`</div></a>`;
                            } else {
                                return `<a href="{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/export-input?") }}`+rms+`"><div class="badge badge-light-success fw-bolder">`+row.nama+`</div></a>`;
                            }
                        }
                    },
                    { data: "kdpolis" },
                    { data: "tpst", className: "text-center" },
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
                        data: "tbyr",
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.tbyr, 2);
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
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `<input type="text" class="easyui-textbox selectGrid xpic1" id="xpic1`+row.DT_RowIndex+`" name="xpic1`+row.DT_RowIndex+`" data-options="prompt:'Pic pajak komisi 1'" style="width: 100%; height: 38px;" />`;
                        },
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<input type="text" class="form-control form-control-solid xsaldo1" id="xsaldo1`+row.DT_RowIndex+`" name="xsaldo1`+row.DT_RowIndex+`" data-type="rupiah" placeholder="Komisi bruto 1" />`;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<input type="text" class="easyui-textbox selectGrid xpic1a" id="xpic1a`+row.DT_RowIndex+`" name="xpic1a`+row.DT_RowIndex+`" data-options="prompt:'Pic pajak komisi 2'" style="width: 100%; height: 38px;" />`;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<input type="text" class="form-control form-control-solid xsaldo1a" id="xsaldo1a`+row.DT_RowIndex+`" name="xsaldo1a`+row.DT_RowIndex+`" data-type="rupiah" placeholder="Komisi bruto 2" />`;
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
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<input type="text" class="easyui-textbox selectGrid xpic2" id="xpic2`+row.DT_RowIndex+`" name="xpic2`+row.DT_RowIndex+`" data-options="prompt:'Pic pajak overreding 1'" style="width: 100%; height: 38px;" />`;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<input type="text" class="form-control form-control-solid xsaldo2" id="xsaldo2`+row.DT_RowIndex+`" name="xsaldo2`+row.DT_RowIndex+`" data-type="rupiah" placeholder="Komisi bruto 1" />`;
                        }
                    },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var bln1 = getText('e_bln1');
                            var bln2 = getText('e_bln2');
                            var thn = getText('e_thn');
                            var cab = getText('e_cab');
                            return `<button type="button" class="btn btn-primary btn-sm xproses" id="xproses`+row.DT_RowIndex+`" name="xproses`+row.DT_RowIndex+`" onclick="proses_pst(`+row.DT_RowIndex+`, '`+row.kdpolis+`', `+row.tpst+`, '`+row.tup+`', '`+row.tkomisi+`', `+row.toverreding+`, `+bln1+`, `+bln2+`, `+thn+`, `+cab+`, 1)">Proses</button>`;
                        }
                    },
                    { data: "ket" },
                    { data: "cabang" },
                ],
                function(row, data, start, end, display) {
                    var api = this.api(), data;
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '')*1 :
                            typeof i === 'number' ?
                                i : 0;
                    };

                    var totPst = api.column(3).data().reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                    var totUangPert = api.column(4).data().reduce(function(a, b) {
                        var tot = intVal(a) + intVal(b);
                        return formatNum(tot, 2);
                    }, 0);

                    var totKonTagih = api.column(5).data().reduce(function(a, b) {
                        var tot = intVal(a) + intVal(b);
                        return formatNum(tot, 2);
                    }, 0);

                    var totKonByr = api.column(6).data().reduce(function(a, b) {
                        var tot = intVal(a) + intVal(b);
                        return formatNum(tot, 2);
                    }, 0);

                    var totKomisi = api.column(7).data().reduce(function(a, b) {
                        var tot = intVal(a) + intVal(b);
                        return formatNum(tot, 2);
                    }, 0);

                    var totOver = api.column(12).data().reduce(function(a, b) {
                        var tot = intVal(a) + intVal(b);
                        return formatNum(tot, 2);
                    }, 0);

                    $(api.column(0).footer()).html('TOTAL');
                    $(api.column(3).footer()).html(totPst);
                    $(api.column(4).footer()).html(totUangPert);
                    $(api.column(5).footer()).html(totKonTagih);
                    $(api.column(6).footer()).html(totKonByr);
                    $(api.column(7).footer()).html(totKomisi);
                    $(api.column(12).footer()).html(totOver);
                },
                function (api) {
                    var xpic1 = $('.xpic1').attr('id');
                    var xsaldo1 = $('.xsaldo1').attr('id');
                    var xpic1a = $('.xpic1a').attr('id');
                    var xsaldo1a = $('.xsaldo1a').attr('id');
                    var xpic2 = $('.xpic2').attr('id');
                    var xsaldo2 = $('.xsaldo2').attr('id');
                    var xproses = $('.xproses').attr('id');
                    // xpic1
                    selectGrids('#'+xpic1,'GET','{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/lod-user-tax") }}','kode','nama',[
                        {field:"npwp",title:"NPWP",width:200},
                        {field:"nama",title:"NAMA",align:"left",width:280},
                        {field:"ket",title:"STATUS",align:"left",width:120},
                    ], function(i, row) {
                        setText(xsaldo1, row.mtx_saldo);
                    });
                    setTextReadOnly(xsaldo1, true);
                    // xpic1a
                    selectGrids('#'+xpic1a,'GET','{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/lod-user-tax") }}','kode','nama',[
                        {field:"npwp",title:"NPWP",width:200},
                        {field:"nama",title:"NAMA",align:"left",width:280},
                        {field:"ket",title:"STATUS",align:"left",width:120},
                    ], function(i, row) {
                        setText(xsaldo1a, row.mtx_saldo);
                    });
                    setTextReadOnly(xsaldo1a, true);
                    // xpic2
                    selectGrids('#'+xpic2,'GET','{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/lod-user-tax") }}','kode','nama',[
                        {field:"npwp",title:"NPWP",width:200},
                        {field:"nama",title:"NAMA",align:"left",width:280},
                        {field:"ket",title:"STATUS",align:"left",width:120},
                        {field:"mtx_saldo",title:"SALDO",align:"left",width:100},
                    ], function(i, row) {
                        setText(xsaldo2, row.mtx_saldo);
                    });
                    setTextReadOnly(xsaldo2, true);
                },
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
                // lodTable("InpOjkKomOver");
                closeModal('modalInputTax');
            });

            submitForm("formUpdateTax", "btn_simpan", "POST", "{{ route('keuangan.komisi-overriding.input-komisi-overriding.store') }}", (resSuccess) => {
                clearForm("formUpdateTax");
                bsimpan('btn_simpan', 'Simpan');
                // lodTable("InpOjkKomOver");
                closeModal('modalUpdateTax');
            });

            tombol('click', 'omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.store') }}" + "/" + kode;
                submitDelete(kode, url, function(resSuccess) {
                    lodTable("InpOjkKomOver");
                    console.log(resSuccess);
                }, function(resError) {
                    console.log(resError);
                });
            });
        });

        function proses_pst(i,kdpolis,tpst,tup,tkom,tover,bln1,bln2,thn,cab,tipe){
            var url='{{ url("api/keuangan/komisi-overriding/input-komisi-overriding/post-pjkomisi") }}';
            var rms = kdpolis+"&bln1="+bln1+"&bln2="+bln2+"&thn="+thn+"&pst="+tpst+"&up="+tup+"&tkom="+tkom+"&tover="+tover+"&saldo1="+vsaldo1+"&pic1="+vpic1+"&pic1a="+vpic1a+"&pic1b="+vpic1b+"&saldo2="+vsaldo2+"&pic2="+vpic2+"&pic2a="+vpic2a+"&cab="+cab+"&tipe="+tipe;
            getJson(url + rms, '', function(data) {
                console.log(data);
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
