@extends('layouts.main-admin')

@section('title')
    Lihat Polis
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>List Lihat Polis</h3>
            </div>
        </div>

        <form id="frxrpt" name="frxrpt" action="{{ url('tehnik/polis/lihat-polis/grd_lihat_polis') }}" method="get"
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

                        <button type="button" id="btn_export" data-title="Daftar Polis Asuransi"
                            class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i>
                            Export</button>

                        <div id="kt_table_datatable_export_menu" title-kt-export="Daftar Polis Asuransi"
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

                        {{-- <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-solid fa-square-plus"></i> Input Pic Tax</button>
                    <button type="button" id="omodEdit" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i> Update Saldo Tax</button> --}}
                    </div>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="fw-bold fs-6 text-gray-800 text-center mb-5">DAFTAR POLIS ASURANSI</div>
                <div class="table-responsive" id="dtTable"></div>
            </div>

            @include('pages.tehnik.polis.lihat-polis.modal.filter')
        </form>
    </div>

    @include('pages.tehnik.polis.lihat-polis.modal.data-polis-asuransi')
    @include('pages.tehnik.polis.lihat-polis.modal.cetak-polis')
@endsection

@section('script')
    <script>
        $(function() {
            setHide('mpol_mrkn_kode', true);
            setHide('mpol_mjns_mpid_kode', true);
            setHide('mpol_mjns_kode2', true);
            setHide('mpol_mssp_kode2', true);
            setHide('e_bersih', true);
            setHide('mpol_mjm_kode2', true);
            setHide('mpol_mpid_kode2', true);
            setHide('mpol_endos2', true);
            setHide('mpol_mpras_kode2', true);
            setHide('mpol_mlok_kode2', true);
            setHide('mpol_mkar_kode_mkr2', true);
            setHide('mpol_mkar_kode_pim2', true);

            setTextReadOnly('mpol_mrkn_nama', true);
            setTextReadOnly('mpol_msoc_kode', true);
            setTextReadOnly('mpol_mspaj_nama', true);
            setTextReadOnly('mpol_mspaj_nomor2', true);
            setTextReadOnly('e_nasabah2', true);
            setTextReadOnly('mpol_mssp_nama', true);
            setTextReadOnly('mpol_mft_kode', true);
            setTextReadOnly('e_manfaat2', true);
            setTextReadOnly('mpol_jns_perusahaan', true);
            setTextReadOnly('jenprod', true);
            setTextReadOnly('e_pras2', true);
            setTextReadOnly('mpol_mslr_kode', true);
            setTextReadOnly('e_cabalamin2', true);
            setTextReadOnly('e_marketing', true);
            setTextReadOnly('e_pinca', true);

            setTextReadOnly('mpol_aktif', true);
            setTextReadOnly('mpol_online', true);
            setTextReadOnly('mpol_penerima_manfaat', true);
            setTextReadOnly('mpol_max_up', true);
            setTextReadOnly('mpol_tgl_terbit', true);
            setTextReadOnly('mpol_openpolis', true);
            setTextReadOnly('mpol_tgl_awal_polis', true);
            setTextReadOnly('mpol_tgl_ahir_polis', true);
            setTextReadOnly('mpol_lapor_data', true);
            setTextReadOnly('mpol_byr_premi', true);
            setTextReadOnly('mpol_max_pst', true);
            setTextReadOnly('mpol_aprove_fc', true);
            setTextReadOnly('mpol_jenis_cetak', true);
            setTextReadOnly('mpol_va', true);
            setTextReadOnly('mpol_surplus', true);
            setTextReadOnly('mpol_produkbank', true);

            setTextReadOnly('mpol_usia_min', true);
            setTextReadOnly('mpol_usia_max', true);
            setTextReadOnly('mpol_jatuh_tempo', true);
            setTextReadOnly('mpol_tenor_max', true);
            setTextReadOnly('mpol_kadaluarsa_klaim', true);
            setTextReadOnly('mpol_max_bayar_klaim', true);
            setTextReadOnly('mpol_mut_kode', true);
            setTextReadOnly('mpol_mujhrf_kode', true);
            setTextReadOnly('mpol_lapor_stnc', true);
            setTextReadOnly('mpol_mnfa_kode', true);
            setTextReadOnly('mpol_mmft_kode_gu', true);
            setTextReadOnly('mpol_mmft_kode_wp_swasta', true);
            setTextReadOnly('mpol_mmft_kode_wp_pns', true);
            setTextReadOnly('mpol_mmft_kode_wp_pensiun', true);
            setTextReadOnly('mpol_mmft_kode_phk_swasta', true);
            setTextReadOnly('mpol_mmft_kode_phk_pns', true);
            setTextReadOnly('mpol_mmft_kode_phk_pensiun', true);
            setTextReadOnly('mpol_mmft_kode_fire', true);
            setTextReadOnly('mpol_mmft_kode_tlo', true);
            setTextReadOnly('mpol_jl', true);
            setTextReadOnly('mpol_status_polis', true);
            setTextReadOnly('mpol_jl_pst', true);
            setTextReadOnly('mpol_jl_pasangan', true);
            setTextReadOnly('mpol_mmft_kode_jiwa', true);

            setTextReadOnly('mpol_mujh_persen', true);
            setTextReadOnly('mpol_mmfe_persen', true);
            setTextReadOnly('mpol_overreding', true);
            setTextReadOnly('mpol_mkom_persen', true);
            setTextReadOnly('mpol_referal', true);
            setTextReadOnly('mpol_maintenance', true);
            setTextReadOnly('mpol_mfee_persen', true);
            setTextReadOnly('mpol_mdr_kode', true);
            setTextReadOnly('mpol_pajakfee', true);
            setTextReadOnly('mpol_handlingfee', true);
            setTextReadOnly('mpol_msrf_kode', true);
            setTextReadOnly('mpol_no_endors', true);
            setTextReadOnly('mpol_ket_endors', true);

            setTextReadOnly('mpol_nomor', true);
            setTextReadOnly('mpol_kode', true);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setLoad("#dtTable", "{{ url('tehnik/polis/lihat-polis/grd_lihat_polis') }}" + "?e_baris=" +
                getText('e_baris'));

            selectSide('e_pmgpolis', false, '{{ url('tehnik/polis/lihat-polis/lod_pmg_polis') }}', function(d) {
                return {
                    id: d.kode,
                    text: d.nama
                }
            });
        });

        function aprovPst(kode, tipe) {
            var vv = {
                res: ''
            };
            var rms = "?kode=" + kode;
            var url = "{{ url('tehnik/polis/lihat-polis/get_polisfull2') }}" + rms;
            getJson(url, vv, function(data) {
                if (data) {
                    setText("e_bersih", "1");
                    jsonForm('frxx_dtlpolis', data);
                    titleAction('titlePolis', 'Data Input Polis Asuransi');
                    openModal('modalDataPolis');
                }
            });
        }

        function aprovalpolis(kodepolis, tipe) {
            var vv = {
                res: ''
            };
            var rms = "?kodepolis=" + kodepolis;
            var url = "{{ url('tehnik/polis/lihat-polis/get_kodepoliskodeapprov') }}" + rms;
            getJson(url, vv, function(data) {
                if (data) {
                    if (data.mpap_mpol_kode != "") {

                    }
                    if (tipe = "0") {
                        setText("mpap_mpol_kode", kodepolis);
                        setText("kodex_soc", data.msoc_kode);
                        setText("mpap_msoc_kode", data.msoc_nomor);
                        // jsonForm('frxx_cetakpolis', data);
                        titleAction('titleCetak', 'Form Cetak');
                        openModal('modalCetak');
                    }
                }
            });
        }

        function lihat(kode, polis, tipe) {
            openModal('modalCetak');
            // var vv={ res : ''};
            // var rms = "?kode="+kode;
            // var url = '{{ url('tehnik/polis/lihat-polis/grd_approv_polis') }}' + rms;
            // getJson(url, vv, function(data) {
            //     if (data) {
            //         jsonForm('frxx_cetakpolis',data);
            //     }
            // });
        }

        function closeBtnModal() {
            closeModal('modalInputTax');
            clearForm("formInputTax");
        };

        function closeBtnUpdate() {
            closeModal('modalUpdateTax');
            clearForm("formUpdateTax");
        };

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
