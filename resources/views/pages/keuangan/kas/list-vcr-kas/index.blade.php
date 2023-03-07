@extends('layouts.main-admin')

@section('title')
    List Transaksi Voucher Kas
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>List Transaksi Voucher Kas</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">
                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Cabang Al-Amin</label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-kt-select2="true" data-placeholder="Pilih cabang" data-allow-clear="true"
                                        data-hide-search="false" id="e_cabalamin" name="e_cabalamin">
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
                                    <label class="form-label fs-6 fw-bold">Keuangan</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" id="c_keu" name="c_keu" type="checkbox"
                                                data-checkbox="c_keu" />
                                        </label>
                                        <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                            data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true"
                                            data-hide-search="false" id="e_keu" name="e_keu">
                                            <option></option>
                                            <option value="0" selected>BELUM APPROV</option>
                                            <option value="1">SETUJU</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Jurnal</label>
                                    <div class="d-flex flex-stack">
                                        <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" id="c_jur" name="c_jur" type="checkbox"
                                                data-checkbox="c_jur" />
                                        </label>
                                        <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                            data-kt-select2="true" data-placeholder="Pilih proses" data-allow-clear="true"
                                            data-hide-search="false" id="e_jur" name="e_jur">
                                            <option></option>
                                            <option value="0" selected>BELUM APPROV</option>
                                            <option value="1">SETUJU</option>
                                        </select>
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
                                            class="fa-sharp fa-solid fa-magnifying-glass"></i> Tampilkan</button>
                                    <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm"
                                        data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i
                                            class="fa-solid fa-repeat"></i> Reset</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="card-toolbar">
            <div class="card-body py-10">
                <div class="table-responsive">
                    <table class="table table-rounded table-striped border cell-border align-middle gy-5 gs-5"
                        id="serverSide_list_vcr">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                <th class="min-w-50px">No.</th>
                                <th class="min-w-50px">Cabang</th>
                                <th class="min-w-100px">Tgl. Transaksi</th>
                                <th class="min-w-250px">Penerima</th>
                                <th class="min-w-150px">Voucher</th>
                                <th class="min-w-150px">Keterangan</th>
                                <th class="min-w-100px">Tipe Dana</th>
                                <th class="min-w-70px">Nominal</th>
                                <th class="min-w-70px">Keuangan</th>
                                <th class="min-w-70px">Jurnal</th>
                            </tr>
                            {{-- <tr class="fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                    <td colspan="14">colspan</td>
                                </tr> --}}
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

    @include('pages.keuangan.kas.approv-kas-anggaran.modal.upload')
    @include('pages.keuangan.kas.approv-kas-anggaran.modal.approv')
    @include('pages.keuangan.kas.approv-kas-anggaran.modal.view')
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

            // SELECT FILTER
            selectSide('e_cabalamin', false, '{{ url('api/kantor_cabang') }}',
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

            filterAll('input[type="search"]', 'serverSide_list_vcr'); //khusus type search inputan

            serverSide( //datatable serverside
                "serverSide_list_vcr",
                "{{ url('api/keuangan/kas/list-vcr/rpt_kas') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.mlok_kode = getText('e_cabalamin'),
                        d.e_entry1 = getText('e_entry1'),
                        d.e_entry2 = getText('e_entry2'),
                        d.c_keu = getText('c_keu'),
                        d.e_keu = getText('e_keu'),
                        d.c_jur = getText('c_jur'),
                        d.e_jur = getText('e_jur'),
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
                        data: 'tdna_penerima',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'tdna_kode_vcr',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'tdna_ket',
                        orderable: true,
                        className: 'text-left'
                    },
                    {
                        data: 'tdna_tipe',
                        orderable: true,
                        className: 'text-left',
                        render : function(data, type, row, meta) {
                            if (row.tdna_tipe == '0') {
                                return `Pengeluaran`;
                            }
                            if (row.tdna_tipe == '1') {
                                return `Pemasukan`;
                            }
                        }
                    },
                    {
                        data: 'tdna_total',
                        orderable: true,
                        className: 'dt-body-right',
                        render : function(data, type, row, meta)
                        {
                            return formatNum(row.tdna_total, 2);
                        }
                    },
                    {
                        data: 'tdna_aprov_ho',
                        orderable: true,
                        className: 'text-left',
                        render : function(data, type, row, meta)
                        {
                            if (row.tdna_aprov_ho == '0') {
                                return `Belum Approv`;
                            }
                            if (row.tdna_aprov_ho == '1') {
                                return `Setuju`;
                            }
                        }
                    },
                    {
                        data: 'tdna_sts_jurnal',
                        orderable: true,
                        className: 'text-left',
                        render : function(data, type, row, meta)
                        {
                            if (row.tdna_sts_jurnal == '0') {
                                return `Belum`;
                            }
                            if (row.tdna_sts_jurnal == '1') {
                                return `Sudah`;
                            }
                        }
                    },
                ],
            );
        });



        // function showPil(i, pk) {
        //     var tipe = "0";
        //     // var kode = $(this).attr('data-show-pdf');
        //     var file = '{{ url('api/keuangan/kas/approv-kas-anggaran/op_file_danaju') }}' + '/' + '?nomor=' + pk +
        //         '&tipe=' + tipe;
        //     $('#view_pdf').attr('src', file);
        //     openModal('modalView');

        // }

        function close_dlg_approv() {
            clearForm('ff_dlg_approv');
            closeModal('dlg_approv');
        }
    </script>
@endsection
