@extends('layouts.main-admin')

@section('title')
    Lihat Edit Soc
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Edit Soc</h3>
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

                    <div class="scroll h-400px px-5">
                        <div data-kt-datatable-table-filter="form">
                            <div class="px-7 py-5">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                                <input type="search" data-kt-datatable-table-filter="search" name="seacrh" id="seacrh" class="form-control form-control-solid" placeholder="Cari All" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Baris yang Tampil</label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_baris" name="e_baris" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_baris" data-placeholder="Pilih jumlah" data-allow-clear="true" data-hide-search="false">
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option selected value="100">100</option>
                                                    <option value="150">150</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="400">400</option>
                                                    <option value="500">500</option>
                                                    <option value="600">600</option>
                                                    <option value="700">700</option>
                                                    <option value="800">800</option>
                                                    <option value="900">900</option>
                                                    <option value="1000">1000</option>
                                                    <option value="1500">1500</option>
                                                    <option value="2000">2000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Kode Soc</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_kdsoc" name="c_kdsoc" type="checkbox" data-checkbox="c_kdsoc" />
                                                </label>
                                                <input type="text" id="e_kdsoc" name="e_kdsoc" data-kt-datatable-table-filter="e_kdsoc" class="form-control form-control-solid" placeholder="Kode soc" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" hidden>
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Jaminan Asuransi</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_jaminan" name="c_jaminan" type="checkbox" data-checkbox="c_jaminan" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_jaminan" name="e_jaminan" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_jaminan" data-placeholder="Pilih jenis nasabah" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    {{ optSql("SELECT mjm_kode kode,mjm_nama nama FROM emst.mst_jaminan ORDER BY 1", "kode", "nama") }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Jenis Nasabah</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_jnas" name="c_jnas" type="checkbox" data-checkbox="c_jnas" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_jnas" name="e_jnas" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_jnas" data-placeholder="Pilih jenis nasabah" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    {{ optSql("SELECT mjns_kode kode,mjns_keterangan nama FROM emst.mst_jenis_nasabah ORDER BY 1", "kode", "nama") }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Pemegang Polis</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_pmgpolis" name="c_pmgpolis" type="checkbox" data-checkbox="c_pmgpolis" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_pmgpolis" name="e_pmgpolis" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_pmgpolis" data-placeholder="Pilih pemegang polis" data-allow-clear="true" data-hide-search="false">
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
            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="lihatEditSoc">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                        <th class="min-w-80px">No.</th>
                        <th>No SOC</th>
                        <th class="min-w-400px">Kode SOC</th>
                        <th class="min-w-450px">Nama Pemegang Polis</th>
                        <th class="min-w-250px">Jenis Nasabah</th>
                        <th class="min-w-250px">Segmen Pasar</th>
                        <th class="min-w-250px">Mekanisme 1 (Umum)</th>
                        <th class="min-w-250px">Mekanisme 2 (Penutupan)</th>
                        <th class="min-w-250px">Jenis Pekerjaan</th>
                        <th class="min-w-150px">Manfaat Asuransi</th>
                        <th class="min-w-150px">Pembayaran</th>
                        <th class="min-w-150px">Jaminan</th>
                        <th class="min-w-150px">Program Asuransi</th>
                        <th class="min-w-100px">Cetak</th>
                        <th class="min-w-150px">Tanggal Input</th>
                        <th class="min-w-125px">Umur Input</th>
                        <th class="min-w-125px">User Input</th>
                        <th class="min-w-125px">Status Approval</th>
                        <th class="min-w-150px">Kode Polis</th>
                        <th class="min-w-125px">Approval Polis</th>
                        <th class="min-w-125px">Status Polis</th>
                        <th class="min-w-125px">Online Polis</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>

@include('pages.tehnik.soc.lihat-editsoc.modal.detail-soc')
@include('pages.tehnik.soc.lihat-editsoc.modal.editsoc-importtarif')
@include('pages.tehnik.soc.lihat-editsoc.modal.editsoc-lihattarif')
@include('pages.tehnik.soc.lihat-editsoc.modal.editsoc-importuw')
@include('pages.tehnik.soc.lihat-editsoc.modal.editsoc-lihatuw')
@include('pages.tehnik.soc.lihat-editsoc.modal.cetak-soc')
@endsection

@section('script')
    <script>

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectGrid('nm_polis', 'GET', '{{ url("tehnik/soc/lihat-edit-soc/lod_pmg_polis") }}', 'nama', 'nama', [
                {field:'kode',title:'Kode',align:'left',width:180},
                {field:'nama',title:'Nama',align:'left',width:280},
            ], function(i, row) {
                hidePesan('nm_polis');
                var kode = row.kode;
                setText('msoc_mrkn_kode', kode);
                // if (getText('msoc_nomor')=='') {
                //     setText('msoc_mrkn_kode', kode);
                //     bersih(2);
                //     bersih(1);
                // }
            });

            tombol('change', 'e_baris', function() {
                var val = $(this).val();
                if (val == "" || val == null || val == undefined) {
                    setText('e_baris', '100');
                }
            });

            selectSide('e_pmgpolis', false, '{{ url("tehnik/soc/lihat-edit-soc/lod_pmg_polis") }}', function(d) { return {
                id: d.kode,
                text: d.nama
            }});

            filterAll('input[type="search"]', 'lihatEditSoc');
            serverTable(
                "lihatEditSoc",
                "{{ url('tehnik/soc/lihat-edit-soc/grd_lihat_soc_khu') }}",
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.e_baris = getText('e_baris'),
                    d.c_kdsoc = getText('c_kdsoc'),
                    d.e_kdsoc = getText('e_kdsoc'),
                    d.c_jaminan = getText('c_jaminan'),
                    d.e_jaminan = getText('e_jaminan'),
                    d.c_jnas = getText('c_jnas'),
                    d.e_jnas = getText('e_jnas'),
                    d.c_pmgpolis = getText('c_pmgpolis'),
                    d.e_pmgpolis = getText('e_pmgpolis'),
                    d.search = $('input[type="search"]').val()
                },
                [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return row.DT_RowIndex+`.`;
                        }
                    },
                    {
                        data: "msli_nomor",
                        className: "dt-body-center",
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-light-primary btn-sm" onclick="socKhusus('${row.msli_nomor}', 0)">${row.msli_nomor}</button>`;
                        }
                    },
                    {
                        data: "msoc_kode",
                        className: "dt-body-center",
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-light-primary btn-sm" onclick="editSoc('${row.msoc_kode}', 0)">${row.msoc_kode}</button> | <button type="button" class="btn btn-light-primary btn-sm" onclick="showUW('${row.msoc_mpuw_nomor}')"><i class="fa-solid fa-eye"></i> Uw Table</button>`;
                        }
                    },
                    { data: "msli_mrkn_nama" },
                    { data: "mjns_nama" },
                    { data: "mssp_nama" },
                    { data: "mkm_nama" },
                    { data: "mkm_ket2" },
                    { data: "mker_nama" },
                    { data: "mft_nama", className: "text-center" },
                    { data: "bayar" },
                    { data: "mjm_nama" },
                    { data: "mpras_nama" },
                    {
                        data: null,
                        className: "dt-body-center",
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-light-primary btn-sm" onclick="cetakSoc('${row.msli_nomor}', 0)">Pilih</button>`;
                        }
                    },
                    { data: "msoc_ins_date", className: "text-center" },
                    { data: "umur", className: "text-center" },
                    { data: "msoc_ins_user" },
                    {
                        data: "msoc_approve",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var sts = row.msoc_approve;
                            if (sts == "sudah") {
                                var text = "success";
                            } else if (sts == "belum") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.msoc_approve+`</div>`;
                        }
                    },
                    { data: "mpol_kode" },
                    {
                        data: "mpol_approve",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var sts = row.mpol_approve;
                            if (sts == "sudah") {
                                var text = "success";
                            } else if (sts == "belum") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.mpol_approve+`</div>`;
                        }
                    },
                    {
                        data: "aktif",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var sts = row.aktif;
                            if (sts == "aktif") {
                                var text = "success";
                            } else if (sts == "suspend") {
                                var text = "warning";
                            } else if (sts == "mati") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.aktif+`</div>`;
                        }
                    },
                    {
                        data: "online",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var sts = row.online;
                            if (sts == "aktif") {
                                var text = "success";
                            } else if (sts == "mati") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.online+`</div>`;
                        }
                    },
                ],
            );

            selectGrid('e_manfaat', 'GET', '{{ url("tehnik/soc/lihat-edit-soc/lod_manfaat") }}', 'mjm_kode', 'mjm_nama', [
                {field:'mjm_nama',title:'Manfaat',align:'left',width:280},
                {field:'mjm_kode',title:'Kode',width:60},
                {field:'mjm_bundling',title:'Bundling',width:80,hidden:true},
                {field:'mjm_jiwa',title:'jiwa',width:180,hidden:true},
                {field:'mjm_gu',title:'gu',width:50,hidden:true},
                {field:'mjm_phk',title:'phk',width:50,hidden:true},
                {field:'mjm_tlo',title:'tlo',width:50,hidden:true},
                {field:'mjm_fire',title:'fire',width:50,hidden:true},
                {field:'mjm_wp',title:'wp',width:50,hidden:true},
                {field:'mjm_umut',title:'umut',width:50,hidden:true},
                {field:'mjm_wp_pensiun',title:'wp_pens',width:50,hidden:true},
                {field:'mjm_phk_pensiun',title:'phk_pens',width:50,hidden:true},
            ], function(i, row) {
                hidePesan('e_manfaat');
				setText("msoc_mjm_kode", row.mjm_kode);
				// muncul(row.mjm_bundling,row.mjm_jiwa,row.mjm_gu,row.mjm_phk,row.mjm_tlo,row.mjm_fire,row.mjm_wp,row.mjm_umut,row.mjm_wp_pensiun,row.mjm_phk_pensiun);
            });

            selectGrid('e_cabalamin', 'GET', '{{ url("tehnik/soc/lihat-edit-soc/lod_cabalamin_komisi") }}', 'kode', 'nama', [
                {field:'kode',title:'Kode Cabang',width:60},
                {field:'nama',title:'Nama Cabang',align:'left',width:150},
            ], function(i, row) {
                hidePesan('e_cabalamin');
				setText("msoc_mlok_kode",row.kode);
				setText("msoc_mkar_kode_pim",row.kd_pinca);
				setText("e_pinca",row.nm_pinca);
                reSelGrid('e_marketing','{{ url("tehnik/soc/lihat-edit-soc/lod_marketing") }}' + '?mlok=' + getText("e_cabalamin"));
            });

            selectGrid('e_marketing', 'GET', '{{ url("tehnik/soc/lihat-edit-soc/lod_marketing") }}', 'kode', 'nama', [
                {field:'kode',title:'NIP',width:60},
                {field:'nama',title:'Nama Marketing',align:'left',width:280},
            ], function(i, row) {
                hidePesan('e_marketing');
				setText("msoc_mkar_kode_mkr",row.kode);
            });

            selectGrid('e_tarif', 'GET', '{{ url("tehnik/soc/lihat-edit-soc/lod_tarif") }}', 'kode', 'nama', [
                {field:'kode',title:'Kode tarif',width:75},
                {field:'nama',title:'Keterangan',align:'left',width:300},
            ], function(i, row) {
                hidePesan('e_tarif');
                setText('msoc_mth_nomor', row.kode);
            });

            selectGrid('e_uw', 'GET', '{{ url("tehnik/soc/lihat-edit-soc/lod_uw") }}', 'kode', 'nama', [
                {field:'kode',title:'Kode',width:75},
                {field:'nama',title:'Keterangan UW',align:'left',width:300},
            ], function(i, row) {
                hidePesan('e_uw');
                setText('msoc_mpuw_nomor', row.kode);
            });

            tombol('click', 'importTarif', function() {
                openModal('modalTarif');
                titleAction('titleTarif', 'Upload File Table Tarif');
                clearForm('frxx_uploadTarif');
                closeModal('m_dtlsoc');
            });

            tombol('click', 'lihatTarif', function() {
                var kode = getText('msoc_mth_nomor');
                if (kode !== "" && kode !== null) {
                    openModal('modalLihatTarif');
                    titleAction('titleLihatTarif', 'Table Tarif');
                    setAttr("#tbTarif", "src", "{{ url('tehnik/soc/lihat-edit-soc/rpt_lihattarif') }}" + "?nomor=" + kode);
                    closeModal('m_dtlsoc');
                } else {
                    message('error', 'Oops...', 'Pilih dulu ketentuan tarif!');
                }
            });

            tombol('click', 'importUw', function() {
                openModal('modalUw');
                titleAction('titleUw', 'Upload File Table Uw');
                clearForm('frxx_uploadUw');
                closeModal('m_dtlsoc');
            });

            tombol('click', 'lihatUw', function() {
                var kode = getText('msoc_mpuw_nomor');
                if (kode !== "" && kode !== null) {
                    openModal('modalLihatUw');
                    titleAction('titleLihatUw', 'Table Underwriting');
                    setAttr("#tbUw", "src", "{{ url('tehnik/soc/lihat-edit-soc/rpt_lihat_uw') }}" + "?nomor=" + kode);
                    setAttr("#close_btn_uw1", "onclick", "close_mLUw()");
                    setAttr("#close_btn_uw2", "onclick", "close_mLUw()");
                    closeModal('m_dtlsoc');
                } else {
                    message('error', 'Oops...', 'Pilih dulu ketentuan uw!');
                }
            });

            submitForm("frxx_dtlsoc", "btn_simpan", "POST", "{{ route('tehnik.soc.lihat-edit-soc.store') }}", (resSuccess) => {
                clearForm("frxx_dtlsoc");
                bsimpan('btn_simpan', 'Simpan');
                lodTable("lihatEditSoc");
                closeModal('m_dtlsoc');
            });
        });

        function editSoc(kodepolis, tipe) {
            cekHide();
            cekReadonly();
            vv={ res : ''};
            rms="?kodepolis="+kodepolis;
            url="{{ url('tehnik/soc/lihat-edit-soc/get_kodesockode') }}"+rms;
            getJson(url,vv, function(data) {
                if (data) {
                    if (tipe="0") {
                        setText("mpap_mpol_kode",kodepolis);
                        setText("kodex_soc",data.msoc_kode);
                        jsonForm('frxx_dtlsoc',data);
                        titleAction('titleDtlsoc', 'Approval Polis Asuransi');
                        openModal('m_dtlsoc');
                    }
                }
            });
        }

        function cetakSoc(kodepolis,tipe) {
            vv={ res : ''};
            rms="?kodepolis="+kodepolis;
            url="{{ url('tehnik/soc/lihat-edit-soc/get_kodesockodeapprov') }}"+rms;
            getJson(url,vv, function(data){
                if (data) {
                    if (tipe="0") {
                        setText("mpap_mpol_kode",kodepolis);
                        setText("kodex_soc",data.msoc_kode);
                        titleAction('titleCetak', 'Form Cetak');
                        openModal('modalCetak');
                    }
                }
            });
        }

        function xdisposisi() {
            if (getCombo("jns_cetak")=="Disposisi") {
                var html = "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_disposisi.php?nomor="+getText("mpap_mpol_kode")+"&typerpt="+getCombo("typerpt")+"'></iframe>";
            }
            if (getCombo("jns_cetak")=="SOC_ttd") {
                var html = "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.open/op_filedok_soc.php?nomor="+getText("kodex_soc")+"&typerpt="+getCombo("typerpt")+"'></iframe>";
            }
            if (getCombo("jns_cetak")=="Cover") {
                var html = "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_coverpolis.php?nomor="+getText("mpap_mpol_kode")+"&typerpt="+getCombo("typerpt")+"'></iframe>";
            }
            if (getCombo("jns_cetak")=="SOC") {
                var html = "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_soc.php?nomor="+getText("kodex_soc")+"&typerpt="+getCombo("typerpt")+"'></iframe>";
            }
            if (getCombo("jns_cetak")=="Disposisi_soc") {
                var html = "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_disposisi_soc.php?nomor="+getText("mpap_mpol_kode")+"&typerpt="+getCombo("typerpt")+"'></iframe>";
            }
        }

        function showUW(kodeuw) {
            openModal('modalLihatUw');
            titleAction('titleLihatUw', 'Table Underwriting');
            setAttr("#tbUw", "src", "{{ url('tehnik/soc/lihat-edit-soc/rpt_lihat_uw') }}" + "?nomor=" + kodeuw);
            setAttr("#close_btn_uw1", "onclick", "closeModal('modalLihatUw')");
            setAttr("#close_btn_uw2", "onclick", "closeModal('modalLihatUw')");
        }

        function cekReadonly() {
            setTextReadOnly('nm_polis', true);
            setTextReadOnly('msoc_kode', true);
            setTextReadOnly('e_nasabah', true);
            setTextReadOnly('e_segmen', true);
            setTextReadOnly('msoc_mspaj_nama', true);
            setTextReadOnly('msoc_mspaj_nomor', true);
            setTextReadOnly('msoc_mekanisme', true);
            setTextReadOnly('msoc_mekanisme2', true);
            setTextReadOnly('msoc_mft_kode', true);
            setTextReadOnly('msoc_jenis_bayar', true);
            setTextReadOnly('msoc_jns_perusahaan', true);
            setTextReadOnly('e_produk', true);
            setTextReadOnly('e_pras', true);
            setTextReadOnly('e_pinca', true);
            setTextReadOnly('msoc_nomor', true);
            setTextReadOnly('kode_xsoc', true);
        }

        function cekHide() {
            setHide('msoc_mrkn_kode', true);
            setHide('e_bersihsoc', true);
            setHide('msoc_mjns_kode', true);
            setHide('msoc_mssp_kode', true);
            setHide('mpid_mssp_kode', true);
            setHide('msoc_mjm_kode', true);
            setHide('mpol_endos', true);
            setHide('msoc_mpid_kode', true);
            setHide('msoc_mjns_mpid_kode', true);
            setHide('msoc_endos', true);
            setHide('msoc_mlok_kode', true);
            setHide('msoc_mkar_kode_mkr', true);
            setHide('msoc_mkar_kode_pim', true);
            setHide('msoc_mth_nomor', true);
            setHide('msoc_mpuw_nomor', true);
        }

        function muncul(mjm_bundling,mjm_jiwa,mjm_gu,mjm_phk,mjm_tlo,mjm_fire,mjm_wp,mjm_umut,mjm_wp_pensiun,mjm_phk_pensiun) {

        }

        function closeMdsoc() {
            closeModal('m_dtlsoc');
            clearForm("frxx_dtlsoc");
        };

        function close_mTarif() {
            closeModal('modalTarif');
            clearForm('frxx_uploadTarif');
            editSoc(getText('msoc_kode'), 0);
        }

        function close_mLTarif() {
            closeModal('modalLihatTarif');
            editSoc(getText('msoc_kode'), 0);
        }

        function close_mUw() {
            closeModal('modalUw');
            clearForm('frxx_uploadUw');
            editSoc(getText('msoc_kode'), 0);
        }

        function close_mLUw() {
            closeModal('modalLihatUw');
            editSoc(getText('msoc_kode'), 0);
        }
    </script>
@endsection
