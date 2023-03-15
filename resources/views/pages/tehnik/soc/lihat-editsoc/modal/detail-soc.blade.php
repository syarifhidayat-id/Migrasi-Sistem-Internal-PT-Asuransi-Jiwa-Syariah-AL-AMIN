<div class="modal fade" id="m_dtlsoc" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="m_dtlsoc_header">
                <h2 class="fw-bolder" id="titleDtlsoc"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeMdsoc()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_dtlsoc" name="frxx_dtlsoc" class="form-mixs" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mx-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="m_dtlsoc_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#m_dtlsoc_header" data-kt-scroll-wrappers="#m_dtlsoc_scroll" data-kt-scroll-offset="300px">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Nama Pemegang Polis</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <input type="text" class="easyui-combogrid modal-combo-2" name="nm_polis" id="nm_polis" data-options="prompt:'Pilih pemegang polis'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                                <input type="text" class="form-control form-control-solid" name="msoc_mrkn_kode" id="msoc_mrkn_kode" placeholder="msoc_mrkn_kode"/>
                                                <span class="text-danger error-text nm_polis_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <input type="text" class="form-control form-control-solid" name="msoc_kode" id="msoc_kode" placeholder="Kode polis"/>
                                                <span class="text-danger error-text msoc_kode_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nasabah Bank/ Peserta</label>
                                    <input type="text" class="easyui-combogrid modal-combo-2" name="e_nasabah" id="e_nasabah"  data-options="prompt:'Nasabah bank/ peserta'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                    <input type="text" class="form-control form-control-solid" name="e_bersihsoc" id="e_bersihsoc" placeholder="e_bersihsoc"/>
                                    <input type="text" class="form-control form-control-solid" name="msoc_mjns_kode" id="msoc_mjns_kode" placeholder="msoc_mjns_kode"/>
                                    <span class="text-danger error-text e_nasabah_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Segmen Pasar</label>
                                    <input type="text" class="easyui-combobox modal-combo-2" name="e_segmen" id="e_segmen" data-options="prompt:'Pilih segmen pasar'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                    <input type="text" class="form-control form-control-solid" name="msoc_mssp_kode" id="msoc_mssp_kode" placeholder="msoc_mssp_kode"/>
                                    <input type="text" class="form-control form-control-solid" name="mpid_mssp_kode" id="mpid_mssp_kode" placeholder="mpid_mssp_kode"/>
                                    <span class="text-danger error-text e_segmen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Nomor SPAJ</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <input type="text" class="easyui-combogrid modal-combo-2" name="msoc_mspaj_nama" id="msoc_mspaj_nama" data-options="prompt:'Pilih nomor spaj'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                                <span class="text-danger error-text msoc_mspaj_nama_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <input type="text" class="form-control form-control-solid" name="msoc_mspaj_nomor" id="msoc_mspaj_nomor" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Mekanisme 1 (Umum)</label>
                                    <select class="easyui-combobox modal-combo-2" name="msoc_mekanisme" id="msoc_mekanisme" data-options="prompt:'Pilih mekanisme'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                        <option selected disabled>Pilih mekanisme</option>
                                        {{ optSql("SELECT mkm_kode kode, mkm_nama nama FROM emst.mst_mekanisme WHERE mkm_aktif!=1 ORDER BY 1", "kode", "nama") }}
                                    </select>
                                    <span class="text-danger error-text msoc_mekanisme_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Mekanisme 2 (Penutupan)</label>
                                    <select class="easyui-combobox modal-combo-2" name="msoc_mekanisme2" id="msoc_mekanisme2" data-options="prompt:'Pilih mekanisme 2'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                        <option selected disabled>Pilih mekanisme 2</option>
                                        {{ optSql("SELECT mkm_kode2 kode, mkm_ket2 nama FROM emst.mst_mekanisme2 WHERE 1=1 ORDER BY 1", "kode", "nama") }}
                                    </select>
                                    <span class="text-danger error-text msoc_mekanisme2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Asuransi</label>
                                    <select class="easyui-combobox modal-combo-3" name="msoc_mft_kode" id="msoc_mft_kode" data-options="prompt:'Pilih manfaat asuransi'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                        <option selected disabled>Pilih manfaat asuransi</option>
                                        {{ optSql("SELECT mft_kode kode,mft_nama nama FROM emst.mst_manfaat_plafond ORDER BY 1", "kode", "nama") }}
                                    </select>
                                    <span class="text-danger error-text msoc_mft_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Pembayaran Kontribusi</label>
                                    <select class="easyui-combobox modal-combo-3" name="msoc_jenis_bayar" id="msoc_jenis_bayar" data-options="prompt:'Pilih kontribusi'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                        <option selected disabled>Pilih kontribusi</option>
                                        <option value="0">SEKALIGUS</option>
                                        <option value="1">PER TAHUN</option>
                                        <option value="2">PER BULAN</option>
                                    </select>
                                    <span class="text-danger error-text msoc_jenis_bayar_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Pekerjaan</label>
                                    <select class="easyui-combobox modal-combo-3" name="msoc_jns_perusahaan" id="msoc_jns_perusahaan" data-options="prompt:'Pilih jenis pekerjaan'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                        <option selected disabled>Pilih jenis pekerjaan</option>
                                        {{ optSql("SELECT mker_kode kode,mker_nama ket FROM emst.mst_pekerjaan ORDER BY 1", "kode", "ket") }}
                                    </select>
                                    <span class="text-danger error-text msoc_jns_perusahaan_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Jaminan Asuransi</label>
                                    <input type="text" class="easyui-combogrid modal-combo-3" name="e_manfaat" id="e_manfaat" data-options="prompt:'Pilih jaminan asuransi'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                    <input type="text" class="form-control form-control-solid" name="msoc_mjm_kode" id="msoc_mjm_kode" placeholder="msoc_mjm_kode" />
                                    <input type="text" class="form-control form-control-solid" name="mpol_endos" id="mpol_endos" placeholder="mpol_endos" />
                                    <span class="text-danger error-text e_manfaat_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Produk</label>
                                    <input type="text" class="form-control form-control-solid" name="e_produk" id="e_produk" placeholder="Jenis produk" />
                                    <input type="text" class="form-control form-control-solid" name="msoc_mpid_kode" id="msoc_mpid_kode" placeholder="msoc_mpid_kode" />
                                    <input type="text" class="form-control form-control-solid" name="msoc_mjns_mpid_kode" id="msoc_mjns_mpid_kode" placeholder="msoc_mjns_mpid_kode" />
                                    <span class="text-danger error-text e_produk_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Program Asuransi</label>
                                    <input type="text" class="easyui-combogrid modal-combo-3" name="e_pras" id="e_pras" data-options="prompt:'Pilih program asuransi'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                    <span class="text-danger error-text e_pras_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-10"></div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Saluran Distribusi</label>
                                    <select class="easyui-combobox modal-combo-2" name="msoc_mslr_kode" id="msoc_mslr_kode" data-options="prompt:'Pilih saluran distribusi'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                        <option selected disabled>Pilih saluran distribusi</option>
                                        {{ optSql("SELECT mslr_kode kode,mslr_ket ket FROM emst.mst_saluran_distribusi ORDER BY 1", "kode", "ket") }}
                                    </select>
                                    <input type="text" class="form-control form-control-solid" name="msoc_endos" id="msoc_endos" placeholder="msoc_endos" />
                                    <span class="text-danger error-text msoc_mslr_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Cabang Alamin</label>
                                    <input type="text" class="easyui-combogrid modal-combo-2" name="e_cabalamin" id="e_cabalamin" data-options="prompt:'Pilih cabang alamin'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                    <input type="text" class="form-control form-control-solid" name="msoc_mlok_kode" id="msoc_mlok_kode" placeholder="msoc_mlok_kode" />
                                    <span class="text-danger error-text e_cabalamin_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Marketing</label>
                                    <input type="text" class="easyui-combogrid modal-combo-2" name="e_marketing" id="e_marketing" data-options="prompt:'Pilih marketing'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                    <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_mkr" id="msoc_mkar_kode_mkr" placeholder="msoc_mkar_kode_mkr" />
                                    <span class="text-danger error-text e_marketing_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Pimpinan Cabang</label>
                                    <input type="text" class="form-control form-control-solid" name="e_pinca" id="e_pinca" placeholder="Pimpinan cabang" />
                                    <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_pim" id="msoc_mkar_kode_pim" placeholder="msoc_mkar_kode_pim" />
                                    <span class="text-danger error-text e_pinca_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-10"></div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label">Penanggung Pajak Fee</label>
                                            <select class="easyui-combobox modal-combo-2" name="msoc_pajakfee" id="msoc_pajakfee" data-options="prompt:'Pilih pajak fee'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih pajak fee</option>
                                                <option value="0">-</option>
                                                <option value="1">PPN & PPH Tidak Potongan/Nambah Kontribusi</option>
                                                <option value="2">Rekanan</option>
                                                <option value="3">PPN Potong Kontribusi & PPH Tambah Kontribusi</option>
                                            </select>
                                            <span class="text-danger error-text msoc_pajakfee_err"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Fee PPN</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_handlingfee" id="msoc_handlingfee" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_handlingfee_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Fee PPH 23</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_handlingfee2" id="msoc_handlingfee2" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_handlingfee2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Ujrah</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_mujh_persen" id="msoc_mujh_persen" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mujh_tampil tampil,mujh_persen persen FROM emst.mst_ujroh where mujh_tipe='Ujroh' ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_mujh_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Managemen Fee</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_mmfe_persen" id="msoc_mmfe_persen" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_mmfe_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Overreding</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_overreding" id="msoc_overreding" data-options="prompt:'Pilih overreding'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                <option value="0">0</option>
                                                <option value="25">25</option>
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_overreding_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Total Komisi</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_mkom_persen" id="msoc_mkom_persen" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mkom_persen persen,mkom_tipe tipe FROM emst.mst_komisi ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_mkom_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Referal</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_referal" id="msoc_referal" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mdr_persen persen,mdr_tipe tipe FROM emst.mst_discount_rate ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_referal_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Maintenance</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_maintenance" id="msoc_maintenance" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mdr_persen persen,mdr_tipe tipe FROM emst.mst_discount_rate ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_maintenance_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Fee Base Tidak Potong</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_mfee_persen" id="msoc_mfee_persen" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mfee_persen persen,mfee_tipe tipe FROM emst.mst_fee ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_mfee_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Fee Base Potong</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox modal-combo-4-sp" name="msoc_mdr_kode" id="msoc_mdr_kode" data-options="prompt:'Pilih'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih</option>
                                                {{ optSql("SELECT mdr_persen persen,mdr_tipe tipe FROM emst.mst_discount_rate ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text" style="height: 38px;">%</span>
                                    </div>
                                    <span class="text-danger error-text msoc_mdr_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label">Status SOC</label>
                                            <select class="easyui-combobox modal-combo-2" name="msoc_status" id="msoc_status" data-options="prompt:'Pilih status SOC'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;">
                                                <option selected disabled>Pilih status soc</option>
                                                <option selected value="0">-</option>
                                                <option value="1">SOC Migrasi Lapse</option>
                                                <option value="2">SOC Migrasi Inforce</option>
                                                <option value="3">Lapse</option>
                                            </select>
                                            <span class="text-danger error-text msoc_status_err"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">No Surat Endors</label>
                                    <input type="text" class="form-control form-control-solid" name="msoc_no_endors" id="msoc_no_endors" placeholder="No surat endors" />
                                    <span class="text-danger error-text msoc_no_endors_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Keterangan Endors</label>
                                    <textarea class="form-control form-control-solid" name="msoc_ket_endors" id="msoc_ket_endors" cols="3" rows="3" placeholder="Keterangan endors"></textarea>
                                    <span class="text-danger error-text msoc_ket_endors_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="separator my-10"></div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nomor SOC</label>
                                    <input type="text" class="form-control form-control-solid" name="msoc_nomor" id="msoc_nomor" placeholder="Nomor SOC" />
                                    <span class="text-danger error-text msoc_nomor_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Kode SOC</label>
                                    <input type="text" class="form-control form-control-solid" name="kode_xsoc" id="kode_xsoc" placeholder="Kode SOC" />
                                    <span class="text-danger error-text kode_x_errsoc"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Import Tarif</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <select class="form-select form-select-solid" data-control="select2" name="msoc_jenis_tarif" id="msoc_jenis_tarif" data-placeholder="Pilih" data-allow-clear="true">
                                                    <option value="0">Usia</option>
                                                    <option value="1">Masa</option>
                                                </select>
                                                <span class="text-danger error-text msoc_jenis_tarif_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <input type="text" class="easyui-combogrid modal-combo-3" name="e_tarif" id="e_tarif" data-options="prompt:'Pilih jenis tarif'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                                <input type="text" class="form-control form-control-solid" name="msoc_mth_nomor" id="msoc_mth_nomor" placeholder="msoc_mth_nomor" />
                                                <span class="text-danger error-text e_tarif_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group">
                                                    <button type="button" id="importTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                                    <button type="button" id="lihatTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Import Underwriting</label>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <select class="form-select form-select-solid" data-control="select2" name="msoc_tipe_uw" id="msoc_tipe_uw" data-placeholder="Pilih" data-allow-clear="true">
                                                    <option value="0">Usia</option>
                                                    <option value="1">X+N</option>
                                                </select>
                                                <span class="text-danger error-text msoc_tipe_uw_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <input type="text" class="easyui-combogrid modal-combo-3" name="e_uw" id="e_uw" data-options="prompt:'Pilih jenis underwriting'" data-dropdown-parent="#m_dtlsoc" style="height: 38px;" />
                                                <input type="text" class="form-control form-control-solid" name="msoc_mpuw_nomor" id="msoc_mpuw_nomor" placeholder="msoc_mpuw_nomor" />
                                                <span class="text-danger error-text e_uw_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-5">
                                                <div class="input-group">
                                                    <button type="button" id="importUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                                    <button type="button" id="lihatUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btnImportTarif_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeMdsoc()"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
