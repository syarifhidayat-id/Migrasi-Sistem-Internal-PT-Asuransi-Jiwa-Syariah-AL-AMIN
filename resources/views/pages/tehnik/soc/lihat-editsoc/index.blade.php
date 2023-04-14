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

        <form id="frxrpt" name="frxrpt" action="{{ url('tehnik/soc/lihat-edit-soc/grd_lihat_soc_khu') }}" method="get"
            onSubmit="return form_submit(this,0);">
            @csrf

            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">
                        <button type="button" class="btn btn-light-primary me-3 btn-sm"
                            onclick="openModal('modalFilter')"><i class="fa-sharp fa-solid fa-filter"></i> Filter
                            Pencarian</button>
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                        <div id="kt_table_datatable_export" class="d-none"></div>

                        <button type="button" id="btn_export" data-title="DAFTAR SUMMARY OF COMMISION"
                            class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i>
                            Export</button>

                        <div id="kt_table_datatable_export_menu" title-kt-export="DAFTAR SUMMARY OF COMMISION"
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
                        </div>

                        {{-- <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i
                            class="fa-solid fa-square-plus"></i> Input Pic Tax</button>
                    <button type="button" id="omodEdit" class="btn btn-primary btn-sm"><i
                            class="fa-solid fa-pen-to-square"></i> Update Saldo Tax</button> --}}
                    </div>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="fw-bold fs-6 text-gray-800 text-center mb-5">DAFTAR SUMMARY OF COMMISION</div>
                <div class="table-responsive" id="dtTable"></div>
            </div>
            @include('pages.tehnik.soc.lihat-editsoc.modal.filter')
        </form>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setLoad("#dtTable", "{{ url('tehnik/soc/lihat-edit-soc/grd_lihat_soc_khu') }}" + "?e_baris=" + getText(
                'e_baris'));

            selectGrid('nm_polis', 'GET', '{{ url('tehnik/soc/lihat-edit-soc/lod_pmg_polis') }}', 'nama', 'nama', [{
                    field: 'kode',
                    title: 'Kode',
                    align: 'left',
                    width: 180
                },
                {
                    field: 'nama',
                    title: 'Nama',
                    align: 'left',
                    width: 280
                },
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

            selectSide('e_pmgpolis', false, '{{ url('tehnik/soc/lihat-edit-soc/lod_pmg_polis') }}', function(d) {
                return {
                    id: d.kode,
                    text: d.nama
                }
            });

            selectGrid('e_manfaat', 'GET', '{{ url('tehnik/soc/lihat-edit-soc/lod_manfaat') }}', 'mjm_kode',
                'mjm_nama', [{
                        field: 'mjm_nama',
                        title: 'Manfaat',
                        align: 'left',
                        width: 280
                    },
                    {
                        field: 'mjm_kode',
                        title: 'Kode',
                        width: 60
                    },
                    {
                        field: 'mjm_bundling',
                        title: 'Bundling',
                        width: 80,
                        hidden: true
                    },
                    {
                        field: 'mjm_jiwa',
                        title: 'jiwa',
                        width: 180,
                        hidden: true
                    },
                    {
                        field: 'mjm_gu',
                        title: 'gu',
                        width: 50,
                        hidden: true
                    },
                    {
                        field: 'mjm_phk',
                        title: 'phk',
                        width: 50,
                        hidden: true
                    },
                    {
                        field: 'mjm_tlo',
                        title: 'tlo',
                        width: 50,
                        hidden: true
                    },
                    {
                        field: 'mjm_fire',
                        title: 'fire',
                        width: 50,
                        hidden: true
                    },
                    {
                        field: 'mjm_wp',
                        title: 'wp',
                        width: 50,
                        hidden: true
                    },
                    {
                        field: 'mjm_umut',
                        title: 'umut',
                        width: 50,
                        hidden: true
                    },
                    {
                        field: 'mjm_wp_pensiun',
                        title: 'wp_pens',
                        width: 50,
                        hidden: true
                    },
                    {
                        field: 'mjm_phk_pensiun',
                        title: 'phk_pens',
                        width: 50,
                        hidden: true
                    },
                ],
                function(i, row) {
                    hidePesan('e_manfaat');
                    setText("msoc_mjm_kode", row.mjm_kode);
                    // muncul(row.mjm_bundling,row.mjm_jiwa,row.mjm_gu,row.mjm_phk,row.mjm_tlo,row.mjm_fire,row.mjm_wp,row.mjm_umut,row.mjm_wp_pensiun,row.mjm_phk_pensiun);
                });

            selectGrid('e_cabalamin', 'GET', '{{ url('tehnik/soc/lihat-edit-soc/lod_cabalamin_komisi') }}', 'kode',
                'nama', [{
                        field: 'kode',
                        title: 'Kode Cabang',
                        width: 60
                    },
                    {
                        field: 'nama',
                        title: 'Nama Cabang',
                        align: 'left',
                        width: 150
                    },
                ],
                function(i, row) {
                    hidePesan('e_cabalamin');
                    setText("msoc_mlok_kode", row.kode);
                    setText("msoc_mkar_kode_pim", row.kd_pinca);
                    setText("e_pinca", row.nm_pinca);
                    reSelGrid('e_marketing', '{{ url('tehnik/soc/lihat-edit-soc/lod_marketing') }}' + '?mlok=' +
                        getText("e_cabalamin"));
                });

            selectGrid('e_marketing', 'GET', '{{ url('tehnik/soc/lihat-edit-soc/lod_marketing') }}', 'kode', 'nama',
                [{
                        field: 'kode',
                        title: 'NIP',
                        width: 60
                    },
                    {
                        field: 'nama',
                        title: 'Nama Marketing',
                        align: 'left',
                        width: 280
                    },
                ],
                function(i, row) {
                    hidePesan('e_marketing');
                    setText("msoc_mkar_kode_mkr", row.kode);
                });

            selectGrid('e_tarif', 'GET', '{{ url('tehnik/soc/lihat-edit-soc/lod_tarif') }}', 'kode', 'nama', [{
                    field: 'kode',
                    title: 'Kode tarif',
                    width: 75
                },
                {
                    field: 'nama',
                    title: 'Keterangan',
                    align: 'left',
                    width: 300
                },
            ], function(i, row) {
                hidePesan('e_tarif');
                setText('msoc_mth_nomor', row.kode);
            });

            selectGrid('e_uw', 'GET', '{{ url('tehnik/soc/lihat-edit-soc/lod_uw') }}', 'kode', 'nama', [{
                    field: 'kode',
                    title: 'Kode',
                    width: 75
                },
                {
                    field: 'nama',
                    title: 'Keterangan UW',
                    align: 'left',
                    width: 300
                },
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
                    setAttr("#tbTarif", "src", "{{ url('tehnik/soc/lihat-edit-soc/rpt_lihattarif') }}" +
                        "?nomor=" + kode);
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
                    setAttr("#tbUw", "src", "{{ url('tehnik/soc/lihat-edit-soc/rpt_lihat_uw') }}" +
                        "?nomor=" + kode);
                    setAttr("#close_btn_uw1", "onclick", "close_mLUw()");
                    setAttr("#close_btn_uw2", "onclick", "close_mLUw()");
                    closeModal('m_dtlsoc');
                } else {
                    message('error', 'Oops...', 'Pilih dulu ketentuan uw!');
                }
            });

            submitForm("frxx_dtlsoc", "btn_simpan", "POST", "{{ route('tehnik.soc.lihat-edit-soc.store') }}", (
                resSuccess) => {
                clearForm("frxx_dtlsoc");
                bsimpan('btn_simpan', 'Simpan');
                lodTable("lihatEditSoc");
                closeModal('m_dtlsoc');
            });
        });

        function socKhusus(kodepolis, tipe) {
            console.log('Kode: ' + kodepolis, 'tipe: ' + tipe);
        }

        function editSoc(kodepolis, tipe) {
            cekHide();
            cekReadonly();
            vv = {
                res: ''
            };
            rms = "?kodepolis=" + kodepolis;
            url = "{{ url('tehnik/soc/lihat-edit-soc/get_kodesockode') }}" + rms;
            getJson(url, vv, function(data) {
                if (data) {
                    if (tipe = "0") {
                        setText("mpap_mpol_kode", kodepolis);
                        setText("kodex_soc", data.msoc_kode);
                        jsonForm('frxx_dtlsoc', data);
                        titleAction('titleDtlsoc', 'Approval Polis Asuransi');
                        openModal('m_dtlsoc');
                    }
                }
            });
        }

        function cetakSoc(kodepolis, tipe) {
            vv = {
                res: ''
            };
            rms = "?kodepolis=" + kodepolis;
            url = "{{ url('tehnik/soc/lihat-edit-soc/get_kodesockodeapprov') }}" + rms;
            getJson(url, vv, function(data) {
                if (data) {
                    if (tipe = "0") {
                        setText("mpap_mpol_kode", kodepolis);
                        setText("kodex_soc", data.msoc_kode);
                        titleAction('titleCetak', 'Form Cetak');
                        openModal('modalCetak');
                    }
                }
            });
        }

        function xdisposisi() {
            if (getCombo("jns_cetak") == "Disposisi") {
                var html =
                    "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_disposisi.php?nomor=" +
                    getText("mpap_mpol_kode") + "&typerpt=" + getCombo("typerpt") + "'></iframe>";
            }
            if (getCombo("jns_cetak") == "SOC_ttd") {
                var html =
                    "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.open/op_filedok_soc.php?nomor=" +
                    getText("kodex_soc") + "&typerpt=" + getCombo("typerpt") + "'></iframe>";
            }
            if (getCombo("jns_cetak") == "Cover") {
                var html =
                    "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_coverpolis.php?nomor=" +
                    getText("mpap_mpol_kode") + "&typerpt=" + getCombo("typerpt") + "'></iframe>";
            }
            if (getCombo("jns_cetak") == "SOC") {
                var html =
                    "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_soc.php?nomor=" +
                    getText("kodex_soc") + "&typerpt=" + getCombo("typerpt") + "'></iframe>";
            }
            if (getCombo("jns_cetak") == "Disposisi_soc") {
                var html =
                    "<iframe style=' overflow-y: 'hidden' ' width='100%' height='100%' src='ww.rpt/rpt_disposisi_soc.php?nomor=" +
                    getText("mpap_mpol_kode") + "&typerpt=" + getCombo("typerpt") + "'></iframe>";
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

        function muncul(mjm_bundling, mjm_jiwa, mjm_gu, mjm_phk, mjm_tlo, mjm_fire, mjm_wp, mjm_umut, mjm_wp_pensiun,
            mjm_phk_pensiun) {

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

        function form_submit(form, ids) {
            filter(form, ids, function(res) {
                setHtml("#dtTable", res);
                return false;
            }, function(errr) {
                pesan("error", "Data gagal dimasukkan. \n cek koneksi jaringan");
            });
            return false;
        }
    </script>
@endsection
