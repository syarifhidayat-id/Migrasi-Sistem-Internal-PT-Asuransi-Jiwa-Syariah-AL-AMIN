@extends('layouts.main-admin')

@section('title')
    Buku Besar Kas
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar KAS</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">
                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Kantor Cabang</label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-kt-select2="true" data-placeholder="Pilih cabang" data-allow-clear="true"
                                        data-kt-datatable-table-filter="e_cabalamin" data-hide-search="false"
                                        id="e_cabalamin" name="e_cabalamin">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Akun Kas</label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-kt-select2="true" data-placeholder="Pilih Akun" data-allow-clear="true"
                                        data-kt-datatable-table-filter="e_akun" data-hide-search="false" id="e_akun"
                                        name="e_akun">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Periode Input:</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="date" class="form-control" id="e_entry1" name="e_entry1"
                                                aria-describedby="basic-addon1">
                                        </div>
                                        <span class="input-group-text">s.d</span>
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="date" class="form-control" id="e_entry2" name="e_entry2"
                                                aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Filter By</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" id="c_tipe" name="c_tipe" type="checkbox"
                                                data-checkbox="c_tipe" />
                                        </label>
                                        <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                            data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true"
                                            data-kt-datatable-table-filter="e_jns" data-hide-search="false" id="e_jns"
                                            name="e_jns">
                                            <option></option>
                                            <option value="0">KETERANGAN</option>
                                            <option value="1">PK DETAIL</option>
                                            <option value="2">AKUN</option>
                                            <option value="3">BELUM FINAL</option>
                                            <option value="4">SUDAH FINAL</option>
                                            <option value="5">VOUCHER</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <input class="form-control form-control-solid" name="e_tag" id="e_tag"
                                        type="text" />
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                            <div id="kt_table_datatable_export" class="d-none"></div>

                            <button type="button" id="btn_export" data-title="Data Menu"
                                class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end"><i
                                    class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button>

                            <div id="kt_table_datatable_export_menu" title-kt-export="Data Menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                                data-kt-menu="true">

                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="excel">Export as Excel</a>
                                </div>

                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-export="pdf">Export as PDF</a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                {{-- <button type="submit" class="btn btn-primary fw-bold btn-sm me-2"
                                    onclick="e_lov()"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i> test</button> --}}
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

            <div class="card-toolbar">

            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border cell-border align-middle gy-5 gs-5"
                    id="serverSide_buku_besar">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th class="min-w-50px">No.</th>
                            <th class="min-w-100px">Tanggal</th>
                            <th class="min-w-250px">Keterangan</th>
                            <th class="min-w-150px">Debit</th>
                            <th class="min-w-150px">Kredit</th>
                            <th class="min-w-100px">Saldo</th>
                            <th class="min-w-250px">Akun</th>
                            <th class="min-w-250px">Nama Akun</th>
                            <th class="min-w-100px"
                                @php
$jab = Auth::user()->jabatan;
                                if($jab != 'KBGIT'  &&  $jab != 'KBGAKU' &&  $jab != 'STFAKU' &&  $jab != 'SPVKEUJAK' &&  $jab != 'SPVACC' &&  $jab != 'KBGACCLOLA') {
                                    echo 'style="display:none;"';
                                } @endphp>
                                Update</th>
                            <th class="min-w-100px">Proses Jurnal</th>
                            <th>Jurnal</th>
                            <th>Status</th>
                            <th class="min-w-100px">Voucher</th>
                            <th class="min-w-100px">PK</th>
                            <th>Keterangan</th>
                        </tr>
                        {{-- <tr class="fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <td colspan="14">colspan</td>
                        </tr> --}}
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 align-middle" align="right">
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
        </div>
    </div>

    @include('pages.keuangan.kas.buku-besar.modal.upload')
    @include('pages.keuangan.kas.buku-besar.modal.approv')
    @include('pages.keuangan.kas.buku-besar.modal.view')
    @include('pages.keuangan.kas.buku-besar.modal.show-pst')
    @include('pages.keuangan.kas.buku-besar.modal.e_lov_cari')
@endsection

@section('script')
    <script type="text/javascript">
        setHide('btn_reset', true);
        setTextReadOnly('atjh_tanggal', true);
        setTextReadOnly('atjh_pk', true);
        setTextReadOnly('atjh_amjb_kode', true);
        setTextReadOnly('atjh_nomor', true);
        setTextReadOnly('atjh_keterangan', true);

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // SELECT FILTER
            selectSide('e_cabalamin', false, '{{ url('api/keuangan/kas/buku-besar-kas/api-kantor-cabang') }}',
                function(d) {
                    return {
                        id: d.mlok_kode,
                        text: d.mlok_nama
                    }
                },
                function(e) {
                    var data = e.params.data.id;
                    console.log(data);
                    selectSide('e_akun', false, '{{ url('api/keuangan/kas/buku-besar-kas/lod_akunkascab') }}' +
                        '?mlok=' + data,
                        function(d) {
                            return {
                                id: d.akun,
                                text: d.nama
                            }
                        });
                });

            filterAll('input[type="search"]', 'serverSide_buku_besar'); //khusus type search inputan
            var e_cabalamin = getText('e_cabalamin'),
                e_akun = getText('e_akun'),
                // tdna_askn_kode = getText('e_akun'),
                e_entry1 = getText('e_entry1'),
                e_entry2 = getText('e_entry2'),
                e_jns = getText('e_jns'),
                e_tag = getText('e_tag'),
                url = "?e_cabalamin=" + e_cabalamin + "&e_akun=" + e_akun + "&e_entry1=" + e_entry1 + "&e_entry2=" +
                e_entry2 + "&e_jns=" + e_jns + "&e_tag=" + e_tag;



            serverSide( //datatable serverside
                "serverSide_buku_besar",
                "{{ url('api/keuangan/kas/buku-besar-kas/lod_bukber') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.e_cabalamin = getText('e_cabalamin'),
                        d.e_akun = getText('e_akun'),
                        d.e_entry1 = getText('e_entry1'),
                        d.e_entry2 = getText('e_entry2'),
                        d.e_jns = getText('e_jns'),
                        d.e_tag = getText('e_tag'),

                        d.search = $('input[type="search"]').val();
                },


                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        orderable: false,
                        className: "text-center"
                    },
                    {
                        data: 'tdna_tgl_aju',
                        orderable: false,
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            if (row.tkad_final == '2') {
                                return `<input type="text" style="background-color: #ffcc8a83;" class="form-control form-control-solid xket" id="xket${row.DT_RowIndex}" name="xket${row.DT_RowIndex}" value="${row.tkad_keterangan}" readonly />`;
                            } else {
                                return `<input type="text" class="form-control form-control-solid xket" id="xket${row.DT_RowIndex}" name="xket${row.DT_RowIndex}" value="${row.tkad_keterangan}" />`;
                            }
                        }
                    },
                    {
                        data: 'debit',
                        orderable: false,
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            if (row.tkad_tipe_dk == 'D' || row.tkad_final == '2') {
                                return `<input type="text" style="background-color: #ffcc8a83;" class="form-control form-control-solid xddr" id="xddr${row.DT_RowIndex}" name="xddr${row.DT_RowIndex}" value="${formatNum(row.debit, 2)}" readonly />`;
                            } else {
                                return `<input type="text" class="form-control form-control-solid xddr" id="xddr${row.DT_RowIndex}" name="xddr${row.DT_RowIndex}" value="${formatNum(row.debit, 2)}" />`;
                            }
                        }
                    },
                    {
                        data: 'kredit',
                        orderable: false,
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            if (row.tkad_tipe_dk == 'K' || row.tkad_final == '2') {
                                return `<input type="text" style="background-color: #ffcc8a83;" class="form-control form-control-solid xdcr" id="xdcr${row.DT_RowIndex}" name="xdcr${row.DT_RowIndex}" value="${formatNum(row.kredit, 2)}" readonly />`;
                            } else {
                                return `<input type="text" class="form-control form-control-solid xdcr" id="xdcr${row.DT_RowIndex}" name="xdcr${row.DT_RowIndex}" value="${formatNum(row.kredit, 2)}" />`;
                            }
                        }
                    },
                    {
                        data: 'saldo_awal',
                        orderable: false,
                        className: "dt-body-right",
                        render: function(data, type, row, meta) {
                            return formatNum(row.saldo_awal, 2);
                        }
                    },
                    {
                        data: 'tkad_askn_kode',
                        orderable: false,
                        render: function(data, type, row, meta) {
                            if (row.tkad_final == '2' || row.debit > 0) {
                                return ` 
                                <div class="input-group input-group-solid">
                                        <input type="text" style="background-color: #ffcc8a83;" class="form-control form-control-solid akuntrs" id="akuntrs${row.DT_RowIndex}" name="akuntrs${row.DT_RowIndex}" value="${row.tkad_askn_kode}" readonly />

                                        <button type="button" onclick="e_lov('akuntrs` + row.DT_RowIndex + `','` + row
                                    .tkad_tipe_dk + `')" data-resouce="` + row.tkad_pk + `" class="btn btn-light-success"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                `;
                            } else {
                                return ` 
                                <div class="input-group input-group-solid">
                                        <input type="text" class="form-control form-control-solid akuntrs" id="akuntrs${row.DT_RowIndex}" name="akuntrs${row.DT_RowIndex}" value="${row.tkad_askn_kode}" />
                                        <button type="button" onclick="e_lov('akuntrs` + row.DT_RowIndex + `','` + row
                                    .tkad_tipe_dk + `')" data-resouce="` + row.tkad_pk + `" class="btn btn-light-success"><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </div>
                                `;
                            }
                        }
                    },

                    {
                        data: 'asakn_keterangan',
                        orderable: false,
                        render: function(data, type, row, meta) {
                            return `<input type="text" style="background-color: #ffcc8a83;" class="form-control form-control-solid takuntrs" id="takuntrs${row.DT_RowIndex}" name="takuntrs${row.DT_RowIndex}" value="${row.asakn_keterangan}" readonly />`;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var jab = '{{ __getJab() }}';
                            // if (row.tkad_final != "2" && row.tkad_final < "x" && row.tkad_final > "x") {
                            if (row.tkad_final != "2") {
                                return `<button type="button" class="btn btn-primary btn-sm" onclick="proses_pst('` +
                                    row.tkad_pk + `','akuntrs` + row.DT_RowIndex + `','` + row
                                    .tkad_tipe_dk +
                                    `','` + row.DT_RowIndex + `','` + row.tkad_atjh_pk + `','` + row
                                    .tkad_final + `')">Update</button>`;
                            } else {
                                return ``;
                            }

                            // return ;
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            if (row.tkad_final == "0") {
                                return `<button type="button" class="btn btn-primary btn-sm" onclick="aprovPst('` +
                                    row.tkad_pk + `','` + row.tkad_tipe_dk + `','` + row.tkad_atjh_pk +
                                    `','` + row.tkad_final + `','` + row.tdna_tgl_aju + `','` + row
                                    .tkad_finalket + `')">` + row.tkad_finalket + `</button>`;
                            }
                            if (row.tkad_final == "1") {
                                return `<button type="button" class="btn btn-primary btn-sm" onclick="showPst22('` +
                                    row.tkad_pk + `','0')">` + row.tkad_finalket + `</button>`;
                            } else {
                                return `Final`;
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            if (row.tkad_final == "2") {
                                return `<button type="button" class="btn btn-primary btn-sm" onclick="showPst('` +
                                    row.tkad_pk + `','0')">Lihat</button>`
                            } else {
                                return `Temp`;
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(data, type, row, meta) {
                            if (row.iserror == "1" || (row.debit + row.kredit) <= 0) {
                                return `<button type="button" class="btn btn-primary btn-sm" onclick="finalError('` +
                                    row.tkad_pk + `','0')">Error</button>`
                            } else {
                                return `Fix`;
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(row, type, data, meta) {
                            return `<a href="#" type="button" id="cetakpstaju" onclick="cetakpstaju('row.tdna_kode_vcr', 'tkad_askn_kode')" data-resouce="` +
                                row.tkad_pk + `" class="btn btn-light-success" target="blank">` + row
                                .tdna_kode_vcr + `</a>`;
                        }
                    },
                    {
                        data: 'tkad_pk',
                        orderable: false,
                    },
                    {
                        data: null,
                        orderable: false,
                        render: function(row, type, data, meta) {
                            return `-`;
                        }
                    },
                ], '',
                function(row, data, start, end, display) {
                    var api = this.api(),
                        data;
                    var intVal = function(i) {
                        return typeof i === 'string' ?
                            i.replace(/[\$,]/g, '') * 1 :
                            typeof i === 'number' ?
                            i : 0;
                    };

                    var totDebit = api.column(3).data().reduce(function(a, b) {
                        var tot = intVal(a) + intVal(b);
                        return formatNum(tot, 2);
                    }, 0);

                    // $(api.column(0).footer()).html('TOTAL');
                    // $(api.column(3).footer()).html(totPst);
                    $(api.column(3).footer()).html(totDebit);
                    // $(api.column(5).footer()).html(totKonTagih);
                    // $(api.column(6).footer()).html(totKonByr);
                    // $(api.column(7).footer()).html(totKomisi);
                    // $(api.column(12).footer()).html(totOver);
                },
            )

            tombol('click', 'btn_approv', function() {
                var kode = $(this).attr('data-resource');
                lodJson("GET", "{{ url('api/keuangan/kas/api_approv') }}" + "/" + kode, function(data) {
                    openModal('modal_approv');
                    titleAction('tMod_approv', 'Approval Dana Kas');
                    bsimpan('btn_simpan', 'Simpan');
                    jsonForm('frxx_approv', data);
                });
            });

            submitForm(
                "ff",
                "btn_simpan",
                "POST",
                "{{ url('keuangan/kas/buku-besar-kas/jurnalkasfinal') }}",
                (resSuccess) => {
                    // lodTable('serverSide_buku_besar');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('approv');
                    // clearForm("ff");
                },
                (resError) => {
                    console.log(resError);
                },
            );

            
        });

        function uploadPolis(kode, doc) {
            var url = "{{ url('storage/keuangan/kas/master-kas') }}" + "/" + doc;
            // console.log(doc)
            lodJson('GET', '{{ url('api/keuangan/kas/lod-doc-approv') }}' + '?doc=' + doc, function(res) {
                if (res.success) {
                    titleAction('tModView', 'Lihat');
                    openModal('modalView');
                    $('#view_pdf').attr('src', url);
                }
                if (res.error) {
                    messageValid('<b>Tidak ada bukti</b> <br> Bukti belum di upload, upload sekarang?', function(
                        res) {
                        if (res.isConfirmed) {
                            titleAction('tMod', 'Lihat');
                            openModal('modal_upload');
                            setText('pk', kode);
                        }
                    });
                }
            });
        }

        function close_approv() {
            closeModal('modal_approv');
            clearForm('frxx_approv');
        }

        function close_upload() {
            closeModal('modal_upload');
            clearForm('frxx_upload');
        }

        function showPst(kode, tipe) {
            url = "{{ url('api/keuangan/kas/buku-besar-kas/getjurnalkasfull') }}" + "?kode=" + kode;
            lodJson('GET', url, function(data) {
                console.log(data);
                if (data) {
                    openModal('dlgModal');
                    titleAction('tMod', 'Lihat Jurnal KAS');
                    jsonForm('dlg2', data);

                    serverSide( //datatable serverside
                        "serverSide_jurkas",
                        "{{ url('api/keuangan/kas/buku-besar-kas/i_jurkas') }}", //url api/route
                        function(d) { // di isi sesuai dengan data yang akan di filter ->
                            d.pk_h = kode;
                        },

                        [{
                                data: "DT_RowIndex",
                                className: "text-center"
                            },
                            {
                                data: "atjd_keterangan",
                                className: "dt-body-left"
                            },
                            {
                                data: "atjd_tipe_dk"
                            },
                            {
                                data: "atjd_totalx",
                                className: "dt-body-right"
                            },
                            {
                                data: "atjd_askn_kode",
                                className: "dt-body-left"
                            },
                            {
                                data: "asakn_keterangan",
                                className: "dt-body-left"
                            },
                        ],
                    );
                    // });
                }
            });
        }

        function aprovPst(kode, tipe, hdrpk, tkad_final, tgl_aju) {

            titleAction('tModtest', 'Lihat Jurnal KAS');
            openModal('approv');
            url = "{{ url('api/keuangan/kas/buku-besar-kas/get_kasdetil') }}" + "?kode=" + kode + "&tipe=" +
                tipe;
            lodJson('GET', url, function(res) {
                if (res) {
                    console.log(res);
                    jsonForm('ff', res);

                    setText("tkad_pk", kode);
                    setText("hdrpk", hdrpk);
                    // setCombo("tkad_final",tkad_final);
                    setText("mlok_kode", getText("tdna_mlok_kode"));
                    var vlok = getText("mlok_kode");
                    var vket1 = getText("ket_1");
                    var vket2 = getText("ket_2");
                    var vak1 = getText("a_1");
                    var vak2 = getText("a_2");
                    var vdb1 = getText("d_1");
                    var vhdrpk = getText("hdrpk");
                    var vtkad_pk = getText("tkad_pk");
                    var vdkhdr = getText("tdna_dk");
                    var vakunkas = getText("tdna_asakn_kode");



                }
            });

            url = "{{ url('api/keuangan/kas/buku-besar-kas/getjurnalkasfull') }}" + "?kode=" + kode;
            lodJson('GET', url, function(data) {
                // console.log(data);
                if (data) {
                    jsonForm('ff', data);
                }
            });

            serverSide( //datatable serverside
                "serverSide_ff",
                "{{ url('api/keuangan/kas/buku-besar-kas/i_jurkas') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter 
                    d.pk_h = kode;
                },
                [{
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: "atjd_keterangan",
                        className: "dt-body-left"
                    },
                    {
                        data: "atjd_tipe_dk"
                    },
                    {
                        data: "atjd_totalx",
                        className: "dt-body-right"
                    },
                    {
                        data: "atjd_askn_kode",
                        className: "dt-body-left"
                    },
                    {
                        data: "asakn_keterangan",
                        className: "dt-body-left"
                    },
                ]
            );
        }

        function e_lov(id, vlain) {
            openModal('modalAkun');
            titleAction('titleMod', 'Lov Pencarian Data');
            setText('e_lov', id);
            setText('e_lovlain', vlain);
            setHide('e_lov', true);
            setHide('e_lovlain', true);

            filterAll('input[type="search"]', 'serverSide_lov_polis');
            serverSide(
                'serverSide_lov_polis', "{{url('api/keuangan/kas/buku-besar-kas/lov_polis')}}" , function(d) {
                    d.id = getText('e_lov'),
                    // d.nama = getText('e_lovcari'),
                    d.xakun = getText('tdna_asakn_kode'),
                    d.xdk = getText('e_lovlain'),
                    d.nama = $('input[type="search"]').val();

                },
                [
                    {
                        data: null,
                        render: function(row, type, data, meta) {
                            return `<button type="button" class="btn btn-primary btn-sm" onclick="pilih('` +
                                    row.kode + `','`+ row.nama +`','`+ row.lain +`')">`+ row.kode +`</button>`;
                        }
                    },
                    {
                        data: 'nama'
                    },
                    {
                        data: 'lain'
                    }
                ]);
            }

            function pilih(kode, nama, lain) {
                closeModal('modalAkun');
                var akuntrs = getText('e_lov');
                setText(akuntrs, kode);
                setText('t'+akuntrs, nama);
            }

        function proses_pst(pk, tipe, dk_dtl, i, pkhdr, tkad_final) {
            var vakun  	= getText("#"+tipe);
            var vdr  	= getText("#xddr"+i);		
            var vcr  	= getText("#xdcr"+i);
            var vket  	= getText("#xket"+i);
            var vdk_dtl = dk_dtl;
            var vpkhdr  = pkhdr;
            var vinal  	= tkad_final;
            // console.log(pk, tipe, dk_dtl, i, pkhdr, tkad_final);

            if (vinal == '2') {
                alert('Sudah Final, Tidak bisa Update!');
            }

            var url="ww.post/p_ubah_akunkas.php?tkad_pk="+pk+"&vakun="+vakun+"&vdr="+vdr+"&vcr="+vcr+"&vdk_dtl="+vdk_dtl+"&vpkhdr="+vpkhdr+"&vket="+vket+"&vinal="+vinal+"&";
				$.getJSON(url,vv, function(data){
				 if (data)
				 {
					notif(data.tkad_pk,"Update :"+data.tkad_pk+" Berhasil Diproses ");
				 }
			}); 
        }
    </script>
@endsection
