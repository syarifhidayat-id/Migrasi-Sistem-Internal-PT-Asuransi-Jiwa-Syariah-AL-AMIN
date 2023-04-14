<div class="modal fade" id="modalDataPolis" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalDataPolis_header">
                <h2 class="fw-bolder" id="titlePolis"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('modalDataPolis')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form name="frxx_dtlpolis" id="frxx_dtlpolis" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalDataPolis_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalDataPolis_header"
                        data-kt-scroll-wrappers="#modalDataPolis_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nama Pemegang Polis</label>
                                    <input type="text" class="form-control form-control-solid" name="mpol_mrkn_nama"
                                        id="mpol_mrkn_nama" placeholder="Pemegang polis" />
                                    <input type="text" class="form-control form-control-solid" name="mpol_mrkn_kode"
                                        id="mpol_mrkn_kode" placeholder="mpol_mrkn_kode" />
                                    <span class="text-danger error-text mpol_mrkn_nama_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Kode Soc</label>
                                    <input type="text" class="form-control form-control-solid" name="mpol_msoc_kode"
                                        id="mpol_msoc_kode" placeholder="Kode soc" />
                                    <span class="text-danger error-text mpol_msoc_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Nomor Spaj</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <input type="text" class="form-control form-control-solid"
                                                    name="mpol_mspaj_nama" id="mpol_mspaj_nama"
                                                    placeholder="Nama spaj" />
                                                <span class="text-danger error-text mpol_mspaj_nama_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <input type="text" class="form-control form-control-solid"
                                                    name="mpol_mspaj_nomor2" id="mpol_mspaj_nomor2"
                                                    placeholder="Nomor spaj" />
                                                <span class="text-danger error-text mpol_mspaj_nomor2_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nasabah Bank/Peserta</label>
                                    <input type="text" class="form-control form-control-solid" name="e_nasabah2"
                                        id="e_nasabah2" placeholder="Nasabah bank/peserta" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mjns_mpid_kode" id="mpol_mjns_mpid_kode"
                                        placeholder="mpol_mjns_mpid_kode" />
                                    <input type="text" class="form-control form-control-solid" name="mpol_mjns_kode2"
                                        id="mpol_mjns_kode2" placeholder="mpol_mjns_kode2" />
                                    <span class="text-danger error-text e_nasabah2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Segmen Pasar</label>
                                    <input type="text" class="form-control form-control-solid" name="mpol_mssp_nama"
                                        id="mpol_mssp_nama" placeholder="Segmen pasar" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mssp_kode2" id="mpol_mssp_kode2" placeholder="mpol_mssp_kode2" />
                                    <span class="text-danger error-text mpol_mssp_nama_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Asuransi</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_mft_kode" id="mpol_mft_kode"
                                        data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih manfaat asuransi" data-allow-clear="false">
                                        {{ optSql('SELECT mft_kode kode,mft_nama nama FROM emst.mst_manfaat_plafond ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                    <input type="text" class="form-control form-control-solid" name="e_bersih"
                                        id="e_bersih" placeholder="e_bersih" />
                                    <span class="text-danger error-text mpol_mft_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Jaminan Asuransi</label>
                                    <input type="text" class="form-control form-control-solid" name="e_manfaat2"
                                        id="e_manfaat2" placeholder="Jaminan asuransi" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mjm_kode2" id="mpol_mjm_kode2" placeholder="mpol_mjm_kode2" />
                                    <span class="text-danger error-text e_manfaat2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Pekerjaan</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_jns_perusahaan" id="mpol_jns_perusahaan"
                                        data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih jenis pekerjaan" data-allow-clear="false">
                                        <option value="0">-</option>
                                        <option value="1">PEGAWAI SWASTA</option>
                                        <option value="2">PNS/BUMN/BUMD/TNI/POLRI</option>
                                        <option value="3">KARYAWAN PEMEGANG POLIS</option>
                                    </select>
                                    <span class="text-danger error-text mpol_jns_perusahaan_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Produk</label>
                                    <input type="text" class="form-control form-control-solid" name="jenprod"
                                        id="jenprod" placeholder="Jenis produk" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mpid_kode2" id="mpol_mpid_kode2" placeholder="mpol_mpid_kode2" />
                                    <input type="text" class="form-control form-control-solid" name="mpol_endos2"
                                        id="mpol_endos2" placeholder="mpol_endos2" />
                                    <span class="text-danger error-text jenprod_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Program Asuransi</label>
                                    <input type="text" class="form-control form-control-solid" name="e_pras2"
                                        id="e_pras2" placeholder="Program asuransi" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mpras_kode2" id="mpol_mpras_kode2"
                                        placeholder="mpol_mpras_kode2" />
                                    <span class="text-danger error-text e_pras2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Saluran Distribusi</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_mslr_kode" id="mpol_mslr_kode"
                                        data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih manfaat asuransi" data-allow-clear="false">
                                        {{ optSql('SELECT mslr_kode kode,mslr_ket ket FROM emst.mst_saluran_distribusi ORDER BY 1', 'kode', 'ket') }}
                                    </select>
                                    <span class="text-danger error-text mpol_mslr_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Cabang Alamin</label>
                                    <input type="text" class="form-control form-control-solid" name="e_cabalamin2"
                                        id="e_cabalamin2" placeholder="Cabang alamin" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mlok_kode2" id="mpol_mlok_kode2" placeholder="mpol_mlok_kode2" />
                                    <span class="text-danger error-text e_cabalamin2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Marketing</label>
                                    <input type="text" class="form-control form-control-solid" name="e_marketing"
                                        id="e_marketing" placeholder="Cabang alamin" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mkar_kode_mkr2" id="mpol_mkar_kode_mkr2"
                                        placeholder="mpol_mkar_kode_mkr2" />
                                    <span class="text-danger error-text e_marketing_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Pimpinan Cabang</label>
                                    <input type="text" class="form-control form-control-solid" name="e_pinca"
                                        id="e_pinca" placeholder="Cabang alamin" />
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_mkar_kode_pim2" id="mpol_mkar_kode_pim2"
                                        placeholder="mpol_mkar_kode_pim2" />
                                    <span class="text-danger error-text e_pinca_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-10"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Status Aktif Polis</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_aktif" id="mpol_aktif" data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih status aktif" data-allow-clear="false">
                                        <option value="0">SUSPEND</option>
                                        <option value="1">AKTIFKAN</option>
                                        <option value="2">MATIKAN</option>
                                    </select>
                                    <span class="text-danger error-text mpol_aktif_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Status Online Polis</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_online" id="mpol_online" data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih status online" data-allow-clear="false">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                    <span class="text-danger error-text mpol_online_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Penerima Manfaat</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_penerima_manfaat" id="mpol_penerima_manfaat"
                                        data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih penerima manfaat" data-allow-clear="false">
                                        <option value="0">PEMEGANG POLIS</option>
                                        <option value="1">AHLI WARIS</option>
                                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                                    </select>
                                    <span class="text-danger error-text mpol_penerima_manfaat_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Maxs Up</label>
                                    <input type="text" class="form-control form-control-solid" name="mpol_max_up"
                                        id="mpol_max_up" placeholder="Maxs up" />
                                    <span class="text-danger error-text mpol_max_up_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Tanggal Terbit Polis</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="mpol_tgl_terbit"
                                            id="mpol_tgl_terbit" />
                                    </div>
                                    <span class="text-danger error-text mpol_tgl_terbit_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Open Polis</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_openpolis" id="mpol_openpolis"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Pilih open polis"
                                        data-allow-clear="false">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                    <span class="text-danger error-text mpol_openpolis_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Periode Polis</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="date" class="form-control" name="mpol_tgl_awal_polis"
                                                id="mpol_tgl_awal_polis" />
                                            <span class="text-danger error-text mpol_tgl_awal_polis_err"></span>
                                        </div>
                                        <span class="input-group-text">s/d</span>
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="date" class="form-control" name="mpol_tgl_ahir_polis"
                                                id="mpol_tgl_ahir_polis" />
                                            <span class="text-danger error-text mpol_tgl_ahir_polis_err"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Maxs Pelaporan Data</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_lapor_data" id="mpol_lapor_data"
                                                placeholder="Maxs pelaporan data" />
                                        </div>
                                        <span class="input-group-text">Hari *(Dari Tanggal Pencairan)</span>
                                    </div>
                                    <span class="text-danger error-text mpol_lapor_data_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Maxs Pembayaran Kontribusi</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_byr_premi" id="mpol_byr_premi"
                                                placeholder="Maxs pembayaran kontribusi" />
                                        </div>
                                        <span class="input-group-text">Hari Dari Tanggal Tagihan</span>
                                    </div>
                                    <span class="text-danger error-text mpol_byr_premi_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Maxs Peserta Per 1 Thn</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_max_pst" id="mpol_max_pst" placeholder="Maxs peserta" />
                                        </div>
                                        <span class="input-group-text">Peserta</span>
                                    </div>
                                    <span class="text-danger error-text mpol_max_pst_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Auto Approval Peserta</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_aprove_fc" id="mpol_aprove_fc"
                                        data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih approval peserta" data-allow-clear="false">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                    <span class="text-danger error-text mpol_aprove_fc_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Cetak Peserta</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_jenis_cetak" id="mpol_jenis_cetak"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Pilih jenis cetak"
                                        data-allow-clear="false">
                                        {{ optSql('SELECT mpc_kode kode,mpc_nama ket FROM eopr.mst_polis_cetakan ORDER BY 1', 'kode', 'ket') }}
                                    </select>
                                    <span class="text-danger error-text mpol_jenis_cetak_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Sistem Bayar VA</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_va" id="mpol_va" data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih sistem bayar" data-allow-clear="false">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                    <span class="text-danger error-text mpol_va_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Surplus U/W</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_surplus" id="mpol_surplus" data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Pilih surplus" data-allow-clear="false">
                                        <option value="0">0</option>
                                        <option value="1">30/40/30</option>
                                        <option value="2">20/30/50</option>
                                    </select>
                                    <span class="text-danger error-text mpol_surplus_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Nama Alias Produk Bank</label>
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_produkbank" id="mpol_produkbank" placeholder="Maxs nama alias" />
                                    <span class="text-danger error-text mpol_produkbank_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-10"></div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Min Usia Masuk</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_usia_min" id="mpol_usia_min"
                                                placeholder="Min usia masuk" />
                                        </div>
                                        <span class="input-group-text">Tahun</span>
                                    </div>
                                    <span class="text-danger error-text mpol_usia_min_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Max Usia Masuk</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_usia_max" id="mpol_usia_max"
                                                placeholder="Max usia masuk" />
                                        </div>
                                        <span class="input-group-text">Tahun</span>
                                    </div>
                                    <span class="text-danger error-text mpol_usia_max_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Usia Jatuh Tempo</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_jatuh_tempo" id="mpol_jatuh_tempo"
                                                placeholder="Usia jatuh tempo" />
                                        </div>
                                        <span class="input-group-text">Tahun</span>
                                    </div>
                                    <span class="text-danger error-text mpol_jatuh_tempo_err"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Max Jangka Waktu</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_tenor_max" id="mpol_tenor_max"
                                                placeholder="Max jangka waktu" />
                                        </div>
                                        <span class="input-group-text">Bulan</span>
                                    </div>
                                    <span class="text-danger error-text mpol_tenor_max_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Kadaluarsa Klaim</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_kadaluarsa_klaim" id="mpol_kadaluarsa_klaim"
                                                placeholder="Kadaluarsa klaim" />
                                        </div>
                                        <span class="input-group-text">Hari</span>
                                    </div>
                                    <span class="text-danger error-text mpol_kadaluarsa_klaim_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Pembayaran Klaim</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="form-control form-control-solid"
                                                name="mpol_max_bayar_klaim" id="mpol_max_bayar_klaim"
                                                placeholder="Pembayaran kalim" />
                                        </div>
                                        <span class="input-group-text">Hari</span>
                                    </div>
                                    <span class="text-danger error-text mpol_max_bayar_klaim_err"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Up Tambahan</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2"
                                                name="mpol_mut_kode" id="mpol_mut_kode"
                                                data-dropdown-parent="#modalDataPolis"
                                                data-placeholder="Pilih up tambahan" data-allow-clear="false">
                                                <option value="0">0</option>
                                                <option value="2.25">2.25</option>
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mut_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Ujrah Referal</label>
                                    <div class="input-group flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2"
                                                name="mpol_mujhrf_kode" id="mpol_mujhrf_kode"
                                                data-dropdown-parent="#modalDataPolis"
                                                data-placeholder="Pilih ujrah referal" data-allow-clear="false">
                                                {{ optSql('SELECT mujhrf_tampil tampil, mujhrf_persen persen FROM emst.mst_ujrah_referal ORDER BY 1', 'tampil', 'persen') }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mujhrf_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">STNC Pelaporan</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_lapor_stnc" id="mpol_lapor_stnc"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Pilih stnc pelaporan"
                                        data-allow-clear="false">
                                        {{ optSql('SELECT mlst_kode kode, mlst_hari hari FROM emst.mst_lapor_stnc ORDER BY 1', 'hari', 'hari') }}
                                    </select>
                                    <span class="text-danger error-text mpol_lapor_stnc_err"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Jiwa</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_mnfa_kode" id="mpol_mnfa_kode"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Pilih manfaat jiwa"
                                        data-allow-clear="false">
                                        {{ optSql('SELECT mnfa_kode kode,mnfa_nama nama FROM emst.mst_manfaat_asuransi ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                    <span class="text-danger error-text mpol_mnfa_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan GU</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_mmft_kode_gu" id="mpol_mmft_kode_gu"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Manfaat tambahan gu"
                                        data-allow-clear="false">
                                        {{ optSql('SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_kode = "C" or mmft_kode = "H" ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_gu_err"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan WP</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group flex-nowrap">
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid"
                                                            data-control="select2" name="mpol_mmft_kode_wp_swasta"
                                                            id="mpol_mmft_kode_wp_swasta"
                                                            data-dropdown-parent="#modalDataPolis"
                                                            data-placeholder="Manfaat tambahan wp"
                                                            data-allow-clear="false">
                                                            {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='C' AND mprp_kode = 'B' ORDER BY 1", 'kode', 'persen') }}
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">% Swasta</span>
                                                </div>
                                                <span
                                                    class="text-danger error-text mpol_mmft_kode_wp_swasta_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group flex-nowrap">
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid"
                                                            data-control="select2" name="mpol_mmft_kode_wp_pns"
                                                            id="mpol_mmft_kode_wp_pns"
                                                            data-dropdown-parent="#modalDataPolis"
                                                            data-placeholder="Manfaat tambahan wp"
                                                            data-allow-clear="false">
                                                            {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'B' ORDER BY 1", 'kode', 'persen') }}
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">% Pns</span>
                                                </div>
                                                <span class="text-danger error-text mpol_mmft_kode_wp_pns_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group flex-nowrap">
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid"
                                                            data-control="select2" name="mpol_mmft_kode_wp_pensiun"
                                                            id="mpol_mmft_kode_wp_pensiun"
                                                            data-dropdown-parent="#modalDataPolis"
                                                            data-placeholder="Manfaat tambahan wp"
                                                            data-allow-clear="false">
                                                            {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'B' ORDER BY 1", 'kode', 'persen') }}
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">% *(Diisi Jika Pensiun)</span>
                                                </div>
                                                <span
                                                    class="text-danger error-text mpol_mmft_kode_wp_pensiun_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan PHK</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group flex-nowrap">
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid"
                                                            data-control="select2" name="mpol_mmft_kode_phk_swasta"
                                                            id="mpol_mmft_kode_phk_swasta"
                                                            data-dropdown-parent="#modalDataPolis"
                                                            data-placeholder="Manfaat tambahan phk"
                                                            data-allow-clear="false">
                                                            {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='C' AND mprp_kode = 'X' ORDER BY 1", 'kode', 'persen') }}
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">% Swasta</span>
                                                </div>
                                                <span
                                                    class="text-danger error-text mpol_mmft_kode_phk_swasta_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group flex-nowrap">
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid"
                                                            data-control="select2" name="mpol_mmft_kode_phk_pns"
                                                            id="mpol_mmft_kode_phk_pns"
                                                            data-dropdown-parent="#modalDataPolis"
                                                            data-placeholder="Manfaat tambahan phk"
                                                            data-allow-clear="false">
                                                            {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'X' ORDER BY 1", 'kode', 'persen') }}
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">% Pns</span>
                                                </div>
                                                <span class="text-danger error-text mpol_mmft_kode_phk_pns_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group flex-nowrap">
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid"
                                                            data-control="select2" name="mpol_mmft_kode_phk_pensiun"
                                                            id="mpol_mmft_kode_phk_pensiun"
                                                            data-dropdown-parent="#modalDataPolis"
                                                            data-placeholder="Manfaat tambahan phk"
                                                            data-allow-clear="false">
                                                            {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'X' ORDER BY 1", 'kode', 'persen') }}
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">% *(Diisi Jika Pensiun)</span>
                                                </div>
                                                <span
                                                    class="text-danger error-text mpol_mmft_kode_phk_pensiun_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan Fire</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_mmft_kode_fire" id="mpol_mmft_kode_fire"
                                        data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Manfaat tambahan fire" data-allow-clear="false">
                                        {{ optSql("SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_kode = 'F' OR mmft_kode = 'G' OR mmft_kode = 'H' ORDER BY 1", 'kode', 'nama') }}
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_fire_err"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan Tlo</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_mmft_kode_tlo" id="mpol_mmft_kode_tlo"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Manfaat tambahan tlo"
                                        data-allow-clear="false">
                                        {{ optSql("SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_kode = 'A' OR mmft_kode = 'B' OR mmft_kode = 'H' ORDER BY 1", 'kode', 'nama') }}
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_tlo_err"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan Join Life</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_jl" id="mpol_jl" data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Manfaat tambahan join life" data-allow-clear="false">
                                        {{ optSql("SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_kode = 'J' OR mmft_kode = 'H' ORDER BY 1", 'kode', 'nama') }}
                                    </select>
                                    <span class="text-danger error-text mpol_jl_err"></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Status Polis</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_status_polis" id="mpol_status_polis"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Status polis"
                                        data-allow-clear="false">
                                        <option selected value="0">-</option>
                                        <option value="1">POLIS MIGRASI LAPSE</option>
                                        <option value="2">POLIS MIGRASI INFORCE</option>
                                        <option value="3">LAPSE</option>
                                    </select>
                                    <span class="text-danger error-text mpol_status_polis_err"></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat JL Peserta</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_jl_pst" id="mpol_jl_pst" data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Manfaat jl peserta" data-allow-clear="false">
                                        <option value="0">0</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="70">70</option>
                                        <option value="80">80</option>
                                        <option value="90">90</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="text-danger error-text mpol_jl_pst_err"></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat JL Pasangan</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_jl_pasangan" id="mpol_jl_pasangan"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Manfaat jl pasangan"
                                        data-allow-clear="false">
                                        <option value="0">0</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="40">40</option>
                                        <option value="50">50</option>
                                        <option value="60">60</option>
                                        <option value="70">70</option>
                                        <option value="80">80</option>
                                        <option value="90">90</option>
                                        <option value="100">100</option>
                                    </select>
                                    <span class="text-danger error-text mpol_jl_pasangan_err"></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan Jiwa</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_mmft_kode_jiwa" id="mpol_mmft_kode_jiwa"
                                        data-dropdown-parent="#modalDataPolis"
                                        data-placeholder="Manfaat tambahan jiwa" data-allow-clear="false">
                                        {{ optSql("SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_kode = 'D' OR mmft_kode = 'E' OR mmft_kode = 'H' ORDER BY 1", 'kode', 'nama') }}
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_jiwa_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="card my-5 px-5 py-5 bg-light-warning">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Ujrah</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_mujh_persen" id="mpol_mujh_persen"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Ujrah"
                                            data-allow-clear="false">
                                            {{ optSql("SELECT mujh_tampil tampil,mujh_persen persen FROM emst.mst_ujroh WHERE mujh_tipe='Ujroh' ORDER BY 1", 'tampil', 'persen') }}
                                        </select>
                                        <span class="text-danger error-text mpol_mujh_persen_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Managemen Fee</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_mmfe_persen" id="mpol_mmfe_persen"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Managemen fee"
                                            data-allow-clear="false">
                                            {{ optSql('SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1', 'tampil', 'persen') }}
                                        </select>
                                        <span class="text-danger error-text mpol_mmfe_persen_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Overreding</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_overreding" id="mpol_overreding"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Overreding"
                                            data-allow-clear="false">
                                            <option value="0">0</option>
                                            <option value="25">25</option>
                                        </select>
                                        <span class="text-danger error-text mpol_overreding_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Total Komisi</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_mkom_persen" id="mpol_mkom_persen"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Total komisi"
                                            data-allow-clear="false">
                                            {{ optSql('SELECT mkom_persen persen,mkom_tipe tipe FROM emst.mst_komisi ORDER BY 1', 'persen', 'tipe') }}
                                        </select>
                                        <span class="text-danger error-text mpol_mkom_persen_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Referal</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_referal" id="mpol_referal"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Referal"
                                            data-allow-clear="false">
                                            {{ optSql('SELECT mkom_persen persen,mkom_tipe tipe FROM emst.mst_komisi ORDER BY 1', 'persen', 'tipe') }}
                                        </select>
                                        <span class="text-danger error-text mpol_referal_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Maintenance</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_maintenance" id="mpol_maintenance"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Maintenance"
                                            data-allow-clear="false">
                                            {{ optSql('SELECT mdr_persen persen,mdr_tipe tipe FROM emst.mst_discount_rate ORDER BY 1', 'persen', 'tipe') }}
                                        </select>
                                        <span class="text-danger error-text mpol_maintenance_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Fee Base T.Potong</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_mfee_persen" id="mpol_mfee_persen"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Tidak potong"
                                            data-allow-clear="false">
                                            {{ optSql('SELECT mfee_persen persen,mfee_tipe tipe FROM emst.mst_fee ORDER BY 1', 'persen', 'tipe') }}
                                        </select>
                                        <span class="text-danger error-text mpol_mfee_persen_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Fee Base Potong</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_mdr_kode" id="mpol_mdr_kode"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Fee base potong"
                                            data-allow-clear="false">
                                            {{ optSql('SELECT mkom_persen persen,mkom_tipe tipe FROM emst.mst_komisi ORDER BY 1', 'persen', 'tipe') }}
                                        </select>
                                        <span class="text-danger error-text mpol_mdr_kode_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Pajak Fee</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_pajakfee" id="mpol_pajakfee"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Pajak fee"
                                            data-allow-clear="false">
                                            <option value="0">-</option>
                                            <option value="1">AL AMIN</option>
                                            <option value="2">REKANAN</option>
                                        </select>
                                        <span class="text-danger error-text mpol_pajakfee_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-5">
                                        <label class="form-label">Handling Fee</label>
                                        <select class="form-select form-select-solid" data-control="select2"
                                            name="mpol_handlingfee" id="mpol_handlingfee"
                                            data-dropdown-parent="#modalDataPolis" data-placeholder="Handling fee"
                                            data-allow-clear="false">
                                            {{ optSql('SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1', 'persen', 'tampil') }}
                                        </select>
                                        <span class="text-danger error-text mpol_handlingfee_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Keterangan Refund</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpol_msrf_kode" id="mpol_msrf_kode"
                                        data-dropdown-parent="#modalDataPolis" data-placeholder="Keterangan refund"
                                        data-allow-clear="false">
                                        <option value="0">SISA DANA TABARRU YANG BELUM DIJALANI</option>
                                        <option value="1">TIDAK ADA REFUND</option>
                                    </select>
                                    <span class="text-danger error-text mpol_msrf_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">No Surat Endors</label>
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_no_endors" id="mpol_no_endors" placeholder="No surat endors" />
                                    <span class="text-danger error-text mpol_no_endors_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Keterangan Endors</label>
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpol_ket_endors" id="mpol_ket_endors"
                                        placeholder="Keterangan endors" />
                                    <span class="text-danger error-text mpol_ket_endors_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-10"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nomor Polis</label>
                                    <input type="text" class="form-control form-control-solid" name="mpol_nomor"
                                        id="mpol_nomor" placeholder="Nomor polis" />
                                    <span class="text-danger error-text mpol_nomor_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Kode Polis</label>
                                    <input type="text" class="form-control form-control-solid" name="mpol_kode"
                                        id="mpol_kode" placeholder="Kode polis" />
                                    <span class="text-danger error-text mpol_kode_err"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer justify-content-center">
                    {{-- <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-bs-dismiss="modal">
                        <i class="fa-sharp fa-solid fa-eye"></i>
                        Tampilkan
                    </button> --}}
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalDataPolis')">
                        <i class="fa-solid fa-xmark"></i>
                        Tutup
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
