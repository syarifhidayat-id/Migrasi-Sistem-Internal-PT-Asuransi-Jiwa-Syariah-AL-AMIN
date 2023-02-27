@extends('layouts.main-admin')

@section('title')
    Entry Master Polis
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <form id="frxx_mstpolis" name="frxx_mstpolis" class="form-mixs" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <div class="card-title">
                    <span class="badge badge-warning" id="title_action">Polis Baru</span>
                    <input type="text" class="form-control form-control-solid" name="judul" id="judul" placeholder="judul" />
                </div>

                <div class="card-toolbar">
                    <div class="input-group input-group-solid">
                        <button type="button" id="btnBru" class="btn btn-light-primary active" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Polis Baru" onclick="cekForm(0)">Baru</button>
                        <button type="button" id="btnEdt" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Polis Edit" onclick="cekForm(1)">Edit</button>
                        <button type="button" id="btnEds" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Polis Endors" onclick="cekForm(2)">Endors</button>
                        <button type="button" id="btnEdsBr" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Polis Endors Baru" onclick="cekForm(4)">Endors Baru</button>
                        <button type="button" id="btnBtl" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Polis Batal" onclick="cekForm(3)">Batal</button>
                    </div>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="required form-label">Nama Pemegang Polis</label>
                            <input type="text" class="easyui-combogrid" name="mpol_mrkn_nama" id="mpol_mrkn_nama" data-options="prompt:'Pilih pemegang polis'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mrkn_kode" id="mpol_mrkn_kode" placeholder="mpol_mrkn_kode" />
                            <span class="text-danger error-text mpol_mrkn_nama_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="required form-label">Kode Soc</label>
                            <input type="text" class="easyui-combogrid" name="mpol_msoc_kode" id="mpol_msoc_kode" data-options="prompt:'Pilih kode soc'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_msoc_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12 bg-light-warning hoverable" id="polisOld">
                        <div class="mb-5 my-3">
                            <label class="required form-label">Endos Untuk Polis Lama</label>
                            <input type="text" class="easyui-combogrid" name="e_oldpolis" id="e_oldpolis" data-options="prompt:'Pilih pemegang polis lama'" style="width: 100%; height: 38px;" />
                            <span>*Polis lama akan di batal endos dan terbit polis baru</span>
                            <span class="text-danger error-text e_oldpolis_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nomor Spaj</label>
                            <input type="text" class="easyui-combogrid" name="mpol_mspaj_nama" id="mpol_mspaj_nama" data-options="prompt:'Pilih nomor spaj'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mspaj_nomor" id="mpol_mspaj_nomor" placeholder="mpol_mspaj_nomor" />
                            <span class="text-danger error-text mpol_mspaj_nama_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nasabah Bank/Peserta</label>
                            <input type="text" class="easyui-combogrid" name="e_nasabah" id="e_nasabah" data-options="prompt:'Pilih nasabah bank/peserta'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mjns_mpid_kode" id="mpol_mjns_mpid_kode" placeholder="mpol_mjns_mpid_kode" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mjns_kode" id="mpol_mjns_kode" placeholder="mpol_mjns_kode" />
                            <span class="text-danger error-text e_nasabah_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Segmen Pasar</label>
                            <input type="text" class="easyui-combogrid" name="mpol_mssp_nama" id="mpol_mssp_nama" data-options="prompt:'Pilih segmen pasar'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mssp_kode" id="mpol_mssp_kode" placeholder="mpol_mssp_kode" />
                            <span class="text-danger error-text mpol_mssp_nama_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Pembayaran Kontribusi</label>
                            <select class="easyui-combobox" name="mpol_jenis_bayar" id="mpol_jenis_bayar" data-options="prompt:'Pilih kontribusi'" style="width: 100%; height: 38px;">
                                <option value="0">Sekaligus</option>
                                <option value="1">Per Tahun</option>
                                <option value="2">Per Bulan</option>
                            </select>
                            <span class="text-danger error-text mpol_jenis_bayar_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Mekanisme</label>
                            <select class="easyui-combobox" name="mpol_mekanisme" id="mpol_mekanisme" data-options="prompt:'Pilih mekanisme'" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mkm_kode kode, mkm_nama nama FROM emst.mst_mekanisme WHERE mkm_aktif!=1 ORDER BY 1", "kode", "nama") }}
                            </select>
                            <span class="text-danger error-text mpol_mekanisme_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Asuransi</label>
                            <select class="easyui-combobox" name="mpol_mft_kode" id="mpol_mft_kode" data-options="prompt:'Pilih manfaat asuransi', onSelect: function(rec){  }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mft_kode kode, mft_nama nama FROM emst.mst_manfaat_plafond ORDER BY 1", "kode", "nama") }}
                            </select>
                            <span class="text-danger error-text mpol_mft_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Penutupan</label>
                            <select class="easyui-combobox" name="mpol_mekanisme2" id="mpol_mekanisme2" data-options="prompt:'Pilih penutupan'" style="width: 100%; height: 38px;">
                                <option value="1">KARYAWAN</option>
                                <option value="2">NON KARYAWAN</option>
                            </select>
                            <span class="text-danger error-text mpol_mekanisme2_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Jaminan Asuransi</label>
                            <input type="text" class="easyui-combogrid" name="e_manfaat" id="e_manfaat" data-options="prompt:'Pilih jaminan asuransi'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mjm_kode" id="mpol_mjm_kode" placeholder="mpol_mjm_kode" />
                            <span class="text-danger error-text e_manfaat_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Jenis Pekerjaan</label>
                            <select class="easyui-combobox" name="mpol_jns_perusahaan" id="mpol_jns_perusahaan" data-options="prompt:'Pilih jenis pekerjaan'" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mker_kode kode,mker_nama ket FROM emst.mst_pekerjaan ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_jns_perusahaan_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Produk Induk Internal</label>
                            <input type="text" class="easyui-combogrid" name="e_jenisprod" id="e_jenisprod" data-options="prompt:'Pilih produk induk'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mpid_kode" id="mpol_mpid_kode" placeholder="mpol_mpid_kode" />
                            <input type="text" class="form-control form-control-solid" name="endors" id="endors" placeholder="endors" />
                            <span class="text-danger error-text e_jenisprod_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Program Asuransi</label>
                            <input type="text" class="easyui-combogrid" name="e_pras" id="e_pras" data-options="prompt:'Pilih program asuransi'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mpras_kode" id="mpol_mpras_kode" placeholder="mpol_mpras_kode" />
                            <span class="text-danger error-text e_pras_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Saluran Distribusi</label>
                            <select class="easyui-combobox" name="mpol_mslr_kode" id="mpol_mslr_kode" data-options="prompt:'Pilih saluran distribusi'" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mslr_kode kode, mslr_ket ket FROM emst.mst_saluran_distribusi ORDER BY 1", "kode", "ket") }}
                            </select>
                            <input type="text" class="form-control form-control-solid" name="e_bersih" id="e_bersih" placeholder="e_bersih" />
                            <span class="text-danger error-text mpol_mslr_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Cabang Al-Amin</label>
                            <input type="text" class="easyui-combogrid" name="e_cabalamin" id="e_cabalamin" data-options="prompt:'Pilih cabang'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mlok_kode" id="mpol_mlok_kode" placeholder="mpol_mlok_kode" />
                            <span class="text-danger error-text e_cabalamin_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Marketing</label>
                            <input type="text" class="easyui-combogrid" name="e_marketing" id="e_marketing" data-options="prompt:'Pilih marketing'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mkar_kode_mkr" id="mpol_mkar_kode_mkr" placeholder="mpol_mkar_kode_mkr" />
                            <span class="text-danger error-text e_marketing_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Pimpinan Cabang</label>
                            <input type="text" class="form-control form-control-solid" name="e_pinca" id="e_pinca" placeholder="Pimpinan cabang" />
                            <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_pim" id="msoc_mkar_kode_pim" placeholder="msoc_mkar_kode_pim" />
                            <span class="text-danger error-text e_pinca_err"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header bg-primary">
                <div class="card-title">
                    <h3 class="text-white">Ketentuan Umum dan Produk</h3>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="required form-label">Produk Induk Ojk</label>
                            <select class="easyui-combobox" name="mpol_mpojk_kode" id="mpol_mpojk_kode" data-options="prompt:'Pilih produk induk', onSelect: function(rec) { hidePesan('mpol_mpojk_kode') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mpojk_kode kode, mpojk_nama ket FROM emst.mst_produk_ojk ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_mpojk_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Jenis Ausransi</label>
                            <select class="easyui-combobox" name="mpol_mja_kode" id="mpol_mja_kode" data-options="prompt:'Pilih jenis asuransi', onSelect: function(rec) { hidePesan('mpol_mja_kode') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mja_kode kode, mja_nama ket FROM emst.mst_jns_asu WHERE mja_kode IN (1,2) ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_mja_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Produk Segmen</label>
                            <select class="easyui-combobox" name="mpol_mgpp_kode" id="mpol_mgpp_kode" data-options="prompt:'Pilih produk segmen', onSelect: function(rec) { hidePesan('mpol_mgpp_kode') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mgpp_kode kode, mgpp_nama ket FROM emst.mst_grup_prodpolis ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_mgpp_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Kelompok Produk</label>
                            <select class="easyui-combobox" name="mpol_mgp_kode" id="mpol_mgp_kode" data-options="prompt:'Pilih kelompok produk', onSelect: function(rec) { hidePesan('mpol_mgp_kode') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mgp_kode kode,mgp_nama ket FROM emst.mst_gruproduk ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_mgp_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Rekan Segmen</label>
                            <select class="easyui-combobox" name="mpol_mgs_kode" id="mpol_mgs_kode" data-options="prompt:'Pilih rekan segmen', onSelect: function(rec) { hidePesan('mpol_mgs_kode') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mgs_kode kode,mgs_nama ket FROM emst.mst_grupsegmen ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_mgs_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Lini Usaha</label>
                            <select class="easyui-combobox" name="mpol_mlu_kode" id="mpol_mlu_kode" data-options="prompt:'Pilih lini usaha', onSelect: function(rec) { hidePesan('mpol_mlu_kode') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mlu_kode kode,mlu_nama ket FROM emst.mst_liniusaha ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_mlu_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Golongan</label>
                            <select class="easyui-combobox" name="mpol_mgol_kode" id="mpol_mgol_kode" data-options="prompt:'Pilih golongan', onSelect: function(rec) { hidePesan('mpol_mgol_kode') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mgol_kode kode,mgol_nama ket FROM emst.mst_golongan ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_mgol_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Status Aktif Polis</label>
                            <select class="easyui-combobox" name="mpol_aktif" id="mpol_aktif" data-options="prompt:'Pilih status', onSelect: function(rec){  }" style="width: 100%; height: 38px;">
                                <option value="0">SUSPEND</option>
                                <option value="1">AKTIF</option>
                                <option value="2">MATI</option>
                            </select>
                            <span class="text-danger error-text mpol_aktif_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Online Polis Cabang</label>
                            <select class="easyui-combobox" name="mpol_online" id="mpol_online" data-options="prompt:'Pilih online cabang'" style="width: 100%; height: 38px;">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_online_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Online Polis Rekan</label>
                            <select class="easyui-combobox" name="mpol_online_rekan" id="mpol_online_rekan" data-options="prompt:'Pilih online rekan', onSelect: function(rec) { hidePesan('mpol_online_rekan') }" style="width: 100%; height: 38px;">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_online_rekan_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Tanggal Terbit Polis</label>
                            <input type="date" class="form-control form-control-solid dateflatpickr" name="mpol_tgl_terbit" id="mpol_tgl_terbit" placeholder="Pilih tanggal" />
                            <span class="text-danger error-text mpol_tgl_terbit_err"></span>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-5">
                            <label class="required form-label">Open Polis</label>
                            <select class="easyui-combobox" name="mpol_openpolis" id="mpol_openpolis" data-options="prompt:'Pilih online rekan', onSelect: function(rec){ cekopenpolis(); }" style="width: 100%; height: 38px;">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_openpolis_err"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="form-label">Periode Polis</label>
                            <div class="input-group">
                                <input type="date" class="form-control form-control-solid dateflatpickr" name="mpol_tgl_awal_polis" id="mpol_tgl_awal_polis" placeholder="Pilih tanggal" />
                                <span class="text-danger error-text mpol_tgl_awal_polis_err"></span>
                                <span class="input-group-text">s/d</span>
                                <input type="date" class="form-control form-control-solid dateflatpickr" name="mpol_tgl_ahir_polis" id="mpol_tgl_ahir_polis" placeholder="Pilih tanggal" />
                                <span class="text-danger error-text mpol_tgl_ahir_polis_err"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Max Pelaporan Data</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_lapor_data" id="mpol_lapor_data" />
                                <span class="input-group-text">Hari *(Dari Tanggal Tagihan)</span>
                            </div>
                            <span class="text-danger error-text mpol_lapor_data_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Max Pembayaran Kontribusi</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_byr_premi" id="mpol_byr_premi" />
                                <span class="input-group-text">Hari Dari Tanggal Tagihan</span>
                            </div>
                            <span class="text-danger error-text mpol_byr_premi_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Max Peserta Per 1 Thn</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_max_pst" id="mpol_max_pst" />
                                <span class="input-group-text">Peserta</span>
                            </div>
                            <span class="text-danger error-text mpol_max_pst_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Auto Approval Freecover</label>
                            <select class="easyui-combobox" name="mpol_aprove_fc" id="mpol_aprove_fc" data-options="prompt:'Pilih approval'" style="width: 100%; height: 38px;">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_aprove_fc_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Cetak Peserta Pengajuan</label>
                            <select class="easyui-combobox" name="mpol_jenis_cetak" id="mpol_jenis_cetak" data-options="prompt:'Pilih cetak peserta pengajuan', onSelect: function(rec) { hidePesan('mpol_jenis_cetak') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mpc_kode kode,mpc_nama ket FROM eopr.mst_polis_cetakan where mpc_tipe=0 ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_jenis_cetak_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Cetak Peserta Lunas</label>
                            <select class="easyui-combobox" name="mpol_cetak_lunas" id="mpol_cetak_lunas" data-options="prompt:'Pilih cetak peserta lunas', onSelect: function(rec) { hidePesan('mpol_cetak_lunas') }" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mpc_kode kode,mpc_nama ket FROM eopr.mst_polis_cetakan where mpc_tipe=1 UNION ALL SELECT mpc_kode kode,mpc_nama ket FROM eopr.mst_polis_cetakan WHERE mpc_kode=16 ORDER BY 1", "kode", "ket") }}
                            </select>
                            <span class="text-danger error-text mpol_cetak_lunas_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Status Polis</label>
                            <select class="easyui-combobox" name="mpol_status_polis" id="mpol_status_polis" data-options="prompt:'Pilih status'" style="width: 100%; height: 38px;">
                                <option selected value="0">-</option>
                                <option value="1">POLIS MIGRASI LAPSE</option>
                                <option value="2">POLIS MIGRASI INFORCE</option>
                                <option value="3">LAPSE</option>
                            </select>
                            <span class="text-danger error-text mpol_status_polis_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nama Alias Produk Bank</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_produkbank" id="mpol_produkbank" placeholder="ex. Joni Alba" />
                            <span class="text-danger error-text mpol_produkbank_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Host to Host Produk Rekanan</label>
                            <select class="easyui-combobox" name="mpol_host2host" id="mpol_host2host" data-options="prompt:'Pilih status', onSelect: function(rec) { hidePesan('mpol_host2host') }" style="width: 100%; height: 38px;">
                                <option selected value="0">-</option>
                                <option value="1">POLIS MIGRASI LAPSE</option>
                                <option value="2">POLIS MIGRASI INFORCE</option>
                                <option value="3">LAPSE</option>
                            </select>
                            <span class="text-danger error-text mpol_host2host_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Buat Endors Soc Baru</label>
                            <select class="easyui-combobox" name="mpol_ins_soc" id="mpol_ins_soc" data-options="prompt:'Pilih endors baru'" style="width: 100%; height: 38px;">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_ins_soc_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Pemasaran Group Usaha</label>
                            <select class="easyui-combobox" name="mpol_pemgroupusaha" id="mpol_pemgroupusaha" data-options="prompt:'Pilih pemasaran group usaha', onSelect: function(rec) { hidePesan('mpol_pemgroupusaha') }" style="width: 100%; height: 38px;">
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_pemgroupusaha_err"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header bg-primary">
                <div class="card-title">
                    <h3 class="text-white">Standar Nilai Polis</h3>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Maximal Manfaat Up</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_max_up" id="mpol_max_up" placeholder="max manfaat up" />
                            <span class="text-danger error-text mpol_max_up_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Nilai Perlindungan</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_standar_perlindungan" id="mpol_standar_perlindungan" placeholder="Nilai perlindungan" />
                            <span class="text-danger error-text mpol_standar_perlindungan_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nilai Kontribusi Standar</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_standar_premi" id="mpol_standar_premi" placeholder="Nilai kontribusi statndar" />
                            <span>*Sesuai Jenis pembayaran(bulan/tahun/hari)</span>
                            <span class="text-danger error-text mpol_standar_premi_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Min Usia Masuk</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_usia_min" id="mpol_usia_min" placeholder="Min usia masuk" />
                                <span class="input-group-text">Tahun</span>
                            </div>
                            <span class="text-danger error-text mpol_usia_min_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Max Usia Masuk</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_usia_max" id="mpol_usia_max" placeholder="Max usia masuk" />
                                <span class="input-group-text">Tahun</span>
                            </div>
                            <span class="text-danger error-text mpol_usia_max_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Usia Jatuh Tempo</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_jatuh_tempo" id="mpol_jatuh_tempo" placeholder="Usia jatuh tempo" />
                                <span class="input-group-text">Tahun</span>
                            </div>
                            <span class="text-danger error-text mpol_jatuh_tempo_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Max Jangka Waktu</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_tenor_max" id="mpol_tenor_max" placeholder="Max jangka waktu" />
                                <span class="input-group-text">Bulan</span>
                            </div>
                            <span class="text-danger error-text mpol_tenor_max_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Kadaluarsa Klaim</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_kadaluarsa_klaim" id="mpol_kadaluarsa_klaim" placeholder="Kadaluarsa Klaim" />
                                <span class="input-group-text">Hari</span>
                            </div>
                            <span class="text-danger error-text mpol_kadaluarsa_klaim_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Pembayaran Klaim</label>
                            <div class="input-group input-group-solid">
                                <input type="text" class="form-control form-control-solid" name="mpol_max_bayar_klaim" id="mpol_max_bayar_klaim" placeholder="Pembayaran klaim" />
                                <span class="input-group-text">Hari</span>
                            </div>
                            <span class="text-danger error-text mpol_max_bayar_klaim_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Up Tambahan</label>
                            <div class="input-group input-group-solid flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <select class="easyui-combobox" name="mpol_mut_kode" id="mpol_mut_kode" data-options="prompt:'Pilih up tambahan'" style="width: 100%; height: 38px;">
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
                            <div class="input-group input-group-solid flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <select class="easyui-combobox" name="mpol_mujhrf_kode" id="mpol_mujhrf_kode" data-options="prompt:'Pilih ujrah referal'" style="width: 100%; height: 38px;">
                                        {{ optSql("SELECT mujhrf_tampil tampil, mujhrf_persen persen FROM emst.mst_ujrah_referal ORDER BY 1", "tampil", "persen") }}
                                    </select>
                                </div>
                                <span class="input-group-text">%</span>
                            </div>
                            <span class="text-danger error-text mpol_mujhrf_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Stnc Pelaporan</label>
                            <select class="easyui-combobox" name="mpol_lapor_stnc" id="mpol_lapor_stnc" data-options="prompt:'Pilih stnc pelaporan'" style="width: 100%; height: 38px;">
                                {{ optSql("SELECT mlst_kode kode, mlst_hari hari FROM emst.mst_lapor_stnc ORDER BY 1", "kode", "hari") }}
                            </select>
                            <span class="text-danger error-text mpol_lapor_stnc_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Ujrah Treaty Reas</label>
                            <div class="input-group input-group-solid flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <select class="easyui-combobox" name="mpol_ujroh_treaty" id="mpol_ujroh_treaty" data-options="prompt:'Pilih stnc pelaporan'" style="width: 100%; height: 38px;">
                                        {{ optSql("SELECT mujh_tampil tampil, mujh_persen persen FROM emst.mst_ujroh WHERE mujh_tipe='Ujroh' ORDER BY 1", "persen", "tampil") }}
                                    </select>
                                </div>
                                <span class="input-group-text">%</span>
                            </div>
                            <span class="text-danger error-text mpol_ujroh_treaty_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Qty Dok. Klaim</label>
                            <select class="easyui-combobox" name="mpol_klaim_doc" id="mpol_klaim_doc" data-options="prompt:'Pilih qty dok. klaim'" style="width: 100%; height: 38px;">
                                <option value="8">8</option>
                                <option value="4">4</option>
                                <option value="6">6</option>
                                <option value="10">10</option>
                            </select>
                            <span class="text-danger error-text mpol_klaim_doc_err"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header bg-primary">
                <div class="card-title">
                    <h3 class="text-white">Standar Manfaat Polis</h3>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Penerima Manfaat</label>
                            <select class="easyui-combobox" name="mpol_penerima_manfaat" id="mpol_penerima_manfaat" data-options="prompt:'Pilih penerima manfaat'" style="width: 100%; height: 38px;">
                                <option selected disabled>Pilih penerima manfaat</option>
                                <option value="0">PEMEGANG POLIS</option>
                                <option value="1">AHLI WARIS</option>
                                <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                            </select>
                            <span class="text-danger error-text mpol_penerima_manfaat_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Jiwa</label>
                            <select class="easyui-combobox" name="mpol_mnfa_kode" id="mpol_mnfa_kode" data-options="prompt:'Pilih manfaat jiwa'" style="width: 100%; height: 38px;">
                                <option selected disabled>Pilih manfaat jiwa</option>
                                {{ optSql("SELECT mnfa_kode kode, mnfa_nama nama FROM emst.mst_manfaat_asuransi ORDER BY 1", "kode", "nama") }}
                            </select>
                            <span class="text-danger error-text mpol_mnfa_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Tambahan Gu</label>
                            <select class="easyui-combobox" name="mpol_mmft_kode_gu" id="mpol_mmft_kode_gu" data-options="prompt:'Pilih manfaat tambahan gu'" style="width: 100%; height: 38px;">
                                <option selected disabled>Pilih manfaat tambahan gu</option>
                                {{ optSql("SELECT mnfa_kode kode, mnfa_nama nama FROM emst.mst_manfaat_asuransi ORDER BY 1", "kode", "nama") }}
                            </select>
                            <span class="text-danger error-text mpol_mmft_kode_gu_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Manfaat Tambahan Wp</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mmft_kode_wp_swasta" id="mpol_mmft_kode_wp_swasta" data-options="prompt:'Pilih manfaat tambahan wp'" style="width: 100%; height: 38px;">
                                                <option selected disabled>Pilih manfaat tambahan wp</option>
                                                {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='C' AND mprp_kode = 'B' ORDER BY mpwp_persen", "kode", "persen") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Swasta</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_wp_swasta_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mmft_kode_wp_pns" id="mpol_mmft_kode_wp_pns" data-options="prompt:'Pilih manfaat tambahan wp'" style="width: 100%; height: 38px;">
                                                <option selected disabled>Pilih manfaat tambahan wp</option>
                                                {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'B' ORDER BY mpwp_persen", "kode", "persen") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Pns</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_wp_pns_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mmft_kode_wp_pensiun" id="mpol_mmft_kode_wp_pensiun" data-options="prompt:'Pilih manfaat tambahan wp'" style="width: 100%; height: 38px;">
                                                <option selected disabled>Pilih manfaat tambahan wp</option>
                                                {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'B' ORDER BY mpwp_persen", "kode", "persen") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">% *(Diisi Jika Pensiun)</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_wp_pensiun_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Manfaat Tambahan Phk</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mmft_kode_phk_swasta" id="mpol_mmft_kode_phk_swasta" data-options="prompt:'Pilih manfaat tambahan phk'" style="width: 100%; height: 38px;">
                                                <option selected disabled>Pilih manfaat tambahan phk</option>
                                                {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='C' AND mprp_kode = 'X' ORDER BY mpwp_persen", "kode", "persen") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Swasta</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_phk_swasta_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mmft_kode_phk_pns" id="mpol_mmft_kode_phk_pns" data-options="prompt:'Pilih manfaat tambahan phk'" style="width: 100%; height: 38px;">
                                                <option selected disabled>Pilih manfaat tambahan phk</option>
                                                {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'X' ORDER BY mpwp_persen", "kode", "persen") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Pns</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_phk_pns_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mmft_kode_phk_pensiun" id="mpol_mmft_kode_phk_pensiun" data-options="prompt:'Pilih manfaat tambahan phk'" style="width: 100%; height: 38px;">
                                                <option selected disabled>Pilih manfaat tambahan phk</option>
                                                {{ optSql("SELECT mpwp_kode kode, mprp_kode kodee, mins_kode koddee, mpwp_persen persen FROM emst.mst_persen_wpphk WHERE mins_kode='B' AND mprp_kode = 'X' ORDER BY mpwp_persen", "kode", "persen") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">% *(Diisi Jika Pensiun)</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_phk_pensiun_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan Fire</label>
                                    <select class="easyui-combobox" name="mpol_mmft_kode_fire" id="mpol_mmft_kode_fire" data-options="prompt:'Pilih manfaat tambahan Fire'" style="width: 100%; height: 38px;">
                                        <option selected disabled>Pilih manfaat tambahan Fire</option>
                                        {{ optSql("SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_kode = 'F' OR mmft_kode = 'G' OR mmft_kode = 'H' ORDER BY 1", "kode", "nama") }}
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_fire_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan Tlo</label>
                                    <select class="easyui-combobox" name="mpol_mmft_kode_tlo" id="mpol_mmft_kode_tlo" data-options="prompt:'Pilih manfaat tambahan tlo'" style="width: 100%; height: 38px;">
                                        <option selected disabled>Pilih manfaat tambahan tlo</option>
                                        {{ optSql("SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_kode = 'A' OR mmft_kode = 'B' OR mmft_kode = 'H' ORDER BY 1", "kode", "nama") }}
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_tlo_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Tambahan Join Life</label>
                            <select class="easyui-combobox" name="mpol_jl" id="mpol_jl" data-options="prompt:'Pilih manfaat tambahan join life', onSelect: function(rec) { jointlife(); }" style="width: 100%; height: 38px;">
                                <option selected disabled>Pilih manfaat tambahan join life</option>
                                {{ optSql("SELECT mmft_kode kode,mmft_nama nama FROM emst.mst_manfaat_tambahan WHERE mmft_tipe = 'JL' OR mmft_kode = '0' ORDER BY 1", "kode", "nama") }}
                            </select>
                            <span class="text-danger error-text mpol_jl_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Join Life Peserta</label>
                            <select class="easyui-combobox" name="mpol_jl_pst" id="mpol_jl_pst" data-options="prompt:'Pilih manfaat j.life peserta'" style="width: 100%; height: 38px;">
                                <option selected disabled>Pilih manfaat j.life peserta</option>
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
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Join Life Pasangan</label>
                            <select class="easyui-combobox" name="mpol_jl_pasangan" id="mpol_jl_pasangan" data-options="prompt:'Pilih manfaat j.life pasangan'" style="width: 100%; height: 38px;">
                                <option selected disabled>Pilih manfaat j.life pasangan</option>
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
                </div>
            </div>

            <div class="card-header bg-primary">
                <div class="card-title">
                    <h3 class="text-white">Perhitungan Nilai Uw/Ujroh/Fee Polis</h3>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Penanggung Jawab Fee</label>
                            <select class="easyui-combobox" name="mpol_pajakfee" id="mpol_pajakfee" data-options="prompt:'Penanggung jawab fee'" style="width: 100%; height: 38px;">
                                <option value="0">-</option>
                                <option value="1">PPN & PPH TIDAK POTONG/NAMBAH KONTRIBUSI</option>
                                <option value="2">REKANAN</option>
                                <option value="3">PPN AL AMIN POTONG KONTRIBUSI & PPH TAMBAH KONTRIBUSI</option>
                            </select>
                            <span class="text-danger error-text mpol_pajakfee_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Fee Ppn</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_handlingfee" id="mpol_handlingfee" data-options="prompt:'Fee ppn'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_handlingfee_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Fee Pph 23</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_pajakfee_persen" id="mpol_pajakfee_persen" data-options="prompt:'Fee pph 23'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_pajakfee_persen_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Ujrah</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mujh_persen" id="mpol_mujh_persen" data-options="prompt:'Ujrah'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mujh_tampil tampil, mujh_persen persen FROM emst.mst_ujroh where mujh_tipe='Ujroh' ORDER BY 1", "tampil", "persen") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mujh_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Managemen Fee</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mmfe_persen" id="mpol_mmfe_persen" data-options="prompt:'Managemen fee'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmfe_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Overreding</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_overreding" id="mpol_overreding" data-options="prompt:'Overreding'" style="width: 100%; height: 38px;">
                                                <option value="0">0</option>
                                                <option value="2.5">2.5</option>
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_overreding_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Komisi Tidak Potong</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mkom_persen" id="mpol_mkom_persen" data-options="prompt:'Komisi tidak potong'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mkom_persen persen,mkom_tipe tipe FROM emst.mst_komisi ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mkom_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Referal</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_referal" id="mpol_referal" data-options="prompt:'Referal'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mkom_persen persen,mkom_tipe tipe FROM emst.mst_komisi ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_referal_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Maintenance</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_maintenance" id="mpol_maintenance" data-options="prompt:'Maintenance'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mdr_persen persen,mdr_tipe tipe FROM emst.mst_discount_rate ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_maintenance_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Feebase Tidak Potong</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mfee_persen" id="mpol_mfee_persen" data-options="prompt:'Feebase Tidak Potong'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mfee_persen persen,mfee_tipe tipe FROM emst.mst_fee ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mfee_persen_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Feebase Potong</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mdr_kode" id="mpol_mdr_kode" data-options="prompt:'Feebase Potong'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mdr_persen persen,mdr_tipe tipe FROM emst.mst_discount_rate ORDER BY 1", "persen", "tipe") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mdr_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Komisi Potong Langsung</label>
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="easyui-combobox" name="mpol_mkomdisc_persen" id="mpol_mkomdisc_persen" data-options="prompt:'Feebase Potong'" style="width: 100%; height: 38px;">
                                                {{ optSql("SELECT mmfee_persen persen,mmfee_tampil tampil FROM emst.mst_manajemen_fee ORDER BY 1", "persen", "tampil") }}
                                            </select>
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mkomdisc_persen_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Berlaku Surplus U/W</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_surplus" id="mpol_surplus" data-placeholder="Pilih berlaku surplus u/w" data-allow-clear="true">
                                <option></option>
                                <option value="0">0</option>
                                <option value="1">30/40/30</option>
                                <option value="2">20/30/50</option>
                            </select>
                            <span class="text-danger error-text mpol_surplus_err"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header bg-primary">
                <div class="card-title">
                    <h3 class="text-white">Payment Mode Polis</h3>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="row">
                    <div class="col-md-2">
                        <div class="mb-5">
                            <label class="form-label">Virtual Account</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_va" id="mpol_va" data-placeholder="Pilih vistual account" data-allow-clear="true">
                                <option></option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_va_err"></span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="mb-5">
                            <label class="form-label">Via</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-5">
                                        <select class="form-select form-select-solid" data-control="select2" name="buka_paymod1[]" id="buka_paymod1" data-placeholder="Pilih VA" data-allow-clear="true" multiple="multiple"></select>
                                        <span class="text-danger error-text buka_paymod1_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <input type="text" class="form-control form-control-solid" name="mpol_va_via" id="mpol_va_via" placeholder="Virtuaal account" />
                                        <span class="text-danger error-text mpol_va_via_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-5">
                            <label class="required form-label">Pembayaran Online</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_payonline" id="mpol_payonline" data-placeholder="Pilih" data-allow-clear="true">
                                <option></option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_payonline_err"></span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="mb-5">
                            <label class="form-label">Via</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-5">
                                        <select class="form-select form-select-solid" data-control="select2" name="buka_paymod2[]" id="buka_paymod2" data-placeholder="Pilih VA" data-allow-clear="true" multiple="multiple"></select>
                                        <span class="text-danger error-text buka_paymod2_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <input type="text" class="form-control form-control-solid" name="mpol_playonline_via" id="mpol_playonline_via" placeholder="Pembayaran online" />
                                        <span class="text-danger error-text mpol_playonline_via_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-5">
                            <label class="required form-label">Pembayaran Agent</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_agent" id="mpol_agent" data-placeholder="Pilih" data-allow-clear="true">
                                <option></option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_agent_err"></span>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="mb-5">
                            <label class="form-label">Via</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-5">
                                        <select class="form-select form-select-solid" data-control="select2" name="buka_paymod3[]" id="buka_paymod3" data-placeholder="Pilih VA" data-allow-clear="true" multiple="multiple"></select>
                                        <span class="text-danger error-text buka_paymod3_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <input type="text" class="form-control form-control-solid" name="mpol_agent_via" id="mpol_agent_via" placeholder="Pembayaran retail/agent" />
                                        <span class="text-danger error-text mpol_agent_via_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Keterangan Refund</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_msrf_kode" id="mpol_msrf_kode" data-placeholder="Pilih keterangan" data-allow-clear="true">
                                <option></option>
                                <option value="0">SISA DANA TABARRU YANG BELUM DIJALANI</option>
                                <option value="1">TIDAK ADA REFUND</option>
                            </select>
                            <span class="text-danger error-text mpol_msrf_kode_err"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-header bg-primary">
                <div class="card-title">
                    <h3 class="text-white">Lain-lain</h3>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Jenis Login Web</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_jenis_login" id="mpol_jenis_login" data-placeholder="Pilih jenis login" data-allow-clear="true">
                                <option></option>
                                <option value="0">TIDAK ADA AKSES</option>
                                <option value="1">MENU SISWA</option>
                                <option value="2">MENU MAHASISWA</option>
                                <option value="3">MENU BADAL</option>
                                <option value="4">MENU INDIVIDU </option>
                            </select>
                            <span class="text-danger error-text mpol_jenis_login_err"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Persetujuan Teknik Klaim</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_acc_tek" id="mpol_acc_tek" data-placeholder="Pilih persetujuan" data-allow-clear="true">
                                <option></option>
                                <option value="0">Tampil</option>
                                <option value="1">Tidak Tampil</option>
                            </select>
                            <span class="text-danger error-text mpol_acc_tek_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label">Catatan</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_note" id="mpol_note" placeholder="Makukkan catatan" />
                            <span class="text-danger error-text mpol_note_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label">No Surat Endors</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_no_endors" id="mpol_no_endors" placeholder="Makukkan no surat endors" />
                            <span class="text-danger error-text mpol_no_endors_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label">Keterangan Endors</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_ket_endors" id="mpol_ket_endors" placeholder="Makukkan keterangan endors" />
                            <span class="text-danger error-text mpol_ket_endors_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label">Berlaku Untuk Provinsi</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <select class="form-select form-select-solid" data-control="select2" name="mpol_mprov_kode" id="mpol_mprov_kode" data-placeholder="Pilih berlaku" data-allow-clear="true">
                                            <option></option>
                                            <option value="1">Seluruh Provinsi</option>
                                            <option value="0">Provinsi Tertentu</option></select>
                                        </select>
                                        <span class="text-danger error-text mpol_mprov_kode_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-5">
                                        <select class="form-select form-select-solid" data-control="select2" name="o_prov[]" id="o_prov" data-placeholder="Pilih provinsi" data-allow-clear="true" multiple="multiple"></select>
                                        <input type="text" class="form-control form-control-solid" name="mpol_mprov_berlaku" id="mpol_mprov_berlaku" placeholder="" />
                                        <span class="text-danger error-text o_prov_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="separator my-10"></div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nomor Polis</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_nomor" id="mpol_nomor" placeholder="Nomor Polis" />
                            <span class="text-danger error-text mpol_nomor_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nomor Cetak</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_nomor_cetak" id="mpol_nomor_cetak" placeholder="Nomor Cetak" />
                            <span class="text-danger error-text mpol_nomor_cetak_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Kode Polis</label>
                            <input type="text" class="form-control form-control-solid" name="mpol_kode" id="mpol_kode" placeholder="Kode Polis" />
                            <span class="text-danger error-text mpol_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label">Import Tarif</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <select class="form-select form-select-solid" data-control="select2" name="mpol_jns_tarif" id="mpol_jns_tarif" data-placeholder="Pilih">
                                            <option></option>
                                            <option value="0">PER USIA</option>
                                            <option value="1">PER MASA</option>
                                        </select>
                                        <span class="text-danger error-text mpol_jns_tarif_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-5">
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <input type="text" class="easyui-combogrid" name="e_tarif" id="e_tarif" data-options="prompt:'Pilih jenis tarif'" style="width: 100%; height: 38px;" />
                                                <input type="text" class="form-control form-control-solid" name="mpol_mth_nomor" id="mpol_mth_nomor" placeholder="mpol_mth_nomor" />
                                            </div>
                                            <button type="button" id="lihatTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                        </div>
                                        <span class="text-danger error-text e_tarif_err"></span>
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
                                        <select class="form-select form-select-solid" data-control="select2" name="mpol_tipe_uw" id="mpol_tipe_uw" data-placeholder="Pilih">
                                            <option></option>
                                            <option value="0">Usia</option>
                                            <option value="1">X+N</option>
                                        </select>
                                        <span class="text-danger error-text mpol_tipe_uw_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-5">
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <input type="text" class="easyui-combogrid" name="e_uw" id="e_uw" data-options="prompt:'Pilih jenis underwriting'" style="width: 100%; height: 38px;" />
                                                <input type="text" class="form-control form-control-solid" name="mpol_mpuw_nomor" id="mpol_mpuw_nomor" placeholder="mpol_mpuw_nomor" />
                                            </div>
                                            <button type="button" id="lihatUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                        </div>
                                        <span class="text-danger error-text e_uw_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label">Upload File Polis</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group input-group-solid">
                                        <input type="file" class="form-control" name="mpol_dok" id="mpol_dok" accept="application/pdf" placeholder="pilih file" />
                                        <button type="button" id="lihatDocPolis" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                    </div>
                                    <span>*Jenis file harus bentuk format PDF</span>
                                    <span class="text-danger error-text mpol_dok_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary btn-sm me-3" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                <button type="button" class="btn btn-warning btn-sm" onclick="clear_f()"><i class="fa-solid fa-trash"></i> Bersihkan</button>
            </div>
        </form>
    </div>

    @include('pages.tehnik.polis.entry-master-polis.modal.lihat-tarif')
    @include('pages.tehnik.polis.entry-master-polis.modal.lihat-uw')
    @include('pages.tehnik.polis.entry-master-polis.modal.lihat-doc')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            cekForm(0);
            buka_paymod('buka_paymod1', 'mpol_va_via', '{{ url("tehnik/polis/entry-master-polis/lod_paymod") }}' + '?tipe=V');
            buka_paymod('buka_paymod2', 'mpol_playonline_via', '{{ url("tehnik/polis/entry-master-polis/lod_paymod") }}' + '?tipe=O');
            buka_paymod('buka_paymod3', 'mpol_agent_via', '{{ url("tehnik/polis/entry-master-polis/lod_paymod") }}' + '?tipe=A');
            buka_provinsi('{{ url("tehnik/polis/entry-master-polis/lod_provinsi") }}', 'polis', '&polis=' + getText('mpol_kode'));
        });

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectGrid('mpol_mrkn_nama', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_pmg_polis") }}', 'nama', 'nama', [
                {field:'kode',title:'Kode',align:'left',width:180},
                {field:'nama',title:'Nama',align:'left',width:280},
            ], function(i, row) {
                hidePesan('mpol_mrkn_nama');
                var kode = row.kode;
                setText('mpol_mrkn_kode', kode);
                reSelGrid('mpol_msoc_kode','{{ url("tehnik/polis/entry-master-polis/lod_soc") }}' + '?pmgpolis=' + getText("mpol_mrkn_kode"));
            });

            selectGrid('mpol_msoc_kode', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_soc") }}', 'msoc_kode', 'msoc_kode', [
                {field:'msoc_kode',title:'Kode SOC',width:130},
                {field:'mjns_Keterangan',title:'Nasabah',width:255},
                {field:'mssp_nama',title:'Segemen',width:100,hidden:false},
                {field:'mkm_nama',title:'Mekanisme 1',width:100,hidden:false},
                {field:'mkm_ket2',title:'Mekanisme 2',width:100,hidden:false},
                {field:'mker_nama',title:'Pekerjaan',width:140,hidden:false},
                {field:'mft_nama',title:'Manfaat',width:70,hidden:false},
                {field:'bayar',title:'Pembayaran',width:70,hidden:false},
                {field:'msoc_mjm_nama',title:'Jaminan',width:100},
                {field:'mpras_nama',title:'Program Asuransi',width:97},
                {field:'msoc_mrkn_nama',title:'Pmg Polis',width:200,hidden:true},
            ], function(i, row) {
                hidePesan('mpol_msoc_kode');
                var kode = row.msoc_kode;
                reSelGrid('e_tarif','{{ url("tehnik/polis/entry-master-polis/lod_tarif_polis") }}' + '?pmgpolis=' +getText("mpol_mrkn_kode")+"&msoc="+getText("mpol_msoc_kode")+"&mft="+getText("mpol_mft_kode")+"&jnspro="+getText("judul"));
                reSelGrid('e_uw','{{ url("tehnik/polis/entry-master-polis/lod_uw_polis") }}' + '?pmgpolis=' + getText("mpol_mrkn_kode")+"&msoc="+getText("mpol_msoc_kode")+"&mft="+getText("mpol_mft_kode")+"&jnspro="+getText("judul"));

				muncul4(row.mjm_bundling,row.mjns_wp_pens,row.mjns_phk_pens,row.mjm_jiwa,row.mjm_gu,row.mjm_phk,row.mjm_tlo,row.mjm_fire,row.mjm_wp,row.mjm_umut,0, row.mpras_discrate,row.mjm_wp_pensiun,row.mjm_phk_pensiun,row.mpras_uptambah,row.mpras_ujrah_referal,row.mpras_discrate,row.mpras_mmft_kode_jiwa,row.mssp_tgl_awal,row.mssp_tgl_ahir,row.mssp_komisi,row.mssp_feebase,row.mssp_openpolis,row.mjns_jl,row.mjns_jl_pst,row.mjns_jl_pas);
				// cekpolis();
				// ceksoc();
				// e_leave("mpol_kode");
				cekdata();
            });

            selectGrid('mpol_mspaj_nama', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_spaj") }}' + '?id=spaj', 'mspaj_nomor', 'mspaj_keterangan', [
                {field:'mspaj_keterangan',title:'Keterangan',align:'left',width:150},
                {field:'mspaj_nomor',title:'Nomor SPAJ',width:50,hidden:false},
            ], function(i, row) {
                hidePesan('mpol_mspaj_nama');
                setText("mpol_mspaj_nomor",row.mspaj_nomor);
            });

            selectGrid('e_nasabah', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_nasabah") }}', 'mjns_kode', 'mjns_keterangan', [
                {field:'mjns_keterangan',title:'Jenis Nasabah',align:'left',width:280},
                {field:'mjns_kode',title:'Kode Jns Nasabah',width:50,hidden:true},
                {field:'mjns_jl',title:'Joint Life',width:80,hidden:true},
                {field:'mjns_jl_pst',title:'Joint Life Peserta',width:80,hidden:true},
                {field:'mjns_jl_pas',title:'Joint Life Pasangan',width:80,hidden:true},
                {field:'mjns_wp_pens',title:'WP Pensiun',width:80,hidden:true},
                {field:'mjns_phk_pens',title:'PHK Pensiun',width:80,hidden:true},
                {field:'mjns_mpid_nomor',title:'Jenis Mpid',width:80,hidden:true},
            ], function(i, row) {
                hidePesan('e_nasabah');
                setText("mpol_mjns_kode", row.mjns_kode);
                setText("mpol_mjns_mpid_kode", row.mjns_mpid_nomor);
                reSelGrid('e_jenisprod','{{ url("tehnik/polis/entry-master-polis/lod_mpid") }}' + '?mjns=' + getText("mpol_mjns_mpid_kode"));
                cekpolis();
                muncul3(row.mjns_jl,row.mjns_jl_pst,row.mjns_jl_pas,row.mjns_wp_pens,row.mjns_phk_pens);
            });

            selectGrid('mpol_mssp_nama', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_segmen") }}' + '?id=segmen', 'mssp_kode', 'mssp_nama', [
                {field:'mssp_kode',title:'Kode Segmen Pasar',width:60},
                {field:'mssp_nama',title:'Segmen Pasar',align:'left',width:150},
                {field:'mssp_tgl_awal',title:'Tgl Awal',width:80,hidden:true},
                {field:'mssp_tgl_ahir',title:'tgl Akhir',width:80,hidden:true},
                {field:'mssp_komisi',title:'Komisi',width:50,hidden:true},
                {field:'mssp_feebase',title:'Fee Base',width:50,hidden:true},
                {field:'mssp_openpolis',title:'Open Polis',width:50,hidden:true},
            ], function(i, row) {
                hidePesan('mpol_mssp_nama');
                setText("mpol_mssp_kode",row.mpol_mssp_kode);
                muncul2(row.mssp_tgl_awal,row.mssp_tgl_ahir,row.mssp_komisi,row.mssp_feebase,row.mssp_openpolis);
            });

            selectGrid('e_manfaat', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_manfaat") }}', 'mjm_kode', 'mjm_nama', [
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
                setText("mpol_mjm_kode",row.mjm_kode);
				// setText("mpol_kode",kode);
				muncul(row.mjm_bundling,row.mjm_jiwa,row.mjm_gu,row.mjm_phk,row.mjm_tlo,row.mjm_fire,row.mjm_wp,row.mjm_umut,row.mjm_wp_pensiun,row.mjm_phk_pensiun);
				tanya();
            });

            selectGrid('e_jenisprod', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_mpid") }}', 'mpid_kode', 'mpid_nama', [
                {field:'mpid_kode',title:'Kode',width:120},
                {field:'mpid_nama',title:'Jenis Produk',width:300},
            ], function(i, row) {
                hidePesan('e_jenisprod');
                // setText("e_jenisprod",row.e_jenisprod);
            });

            selectGrid('e_pras', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_pras") }}', 'mpras_kode', 'mpras_nama', [
                {field:'mpras_nama',title:'Program Asuransi',align:'left',width:280},
                {field:'mpras_kode',title:'Kode Program Asuransi',width:50,hidden:true},
                {field:'mpras_uptambah',title:'UP Tambahan',width:80,hidden:true},
                {field:'mpras_ujrah_referal',title:'Ujrah Referal',width:80,hidden:true},
                {field:'mpras_disc_rate',title:'Discount Rate',width:50,hidden:true},
                {field:'mpras_mmft_kode_jiwa',title:'Tambahan Jiwa',width:50,hidden:true},
            ], function(i, row) {
                hidePesan('e_pras');
                setText("mpol_mpras_kode",row.mpras_kode);

			    muncul1(row.mpras_uptambah,row.mpras_ujrah_referal,row.mpras_discrate,row.mpras_mmft_kode_jiwa);
                e_leave("mpol_kode");
            });

            selectGrid('e_cabalamin', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_cabalamin_komisi") }}', 'kode', 'nama', [
                {field:'kode',title:'Kode Cabang',width:60},
                {field:'nama',title:'Nama Cabang',align:'left',width:150},
            ], function(i, row) {
                hidePesan('e_cabalamin');
                setText("mpol_mlok_kode",row.kode);
				setText("mpol_mkar_kode_pim",row.kd_pinca);
                reSelGrid('e_marketing','{{ url("api/tehnik/polis/entry-master-polis/lod_marketing") }}' + '?mlok=' + row.kode);
            });

            selectGrid('e_marketing', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_marketing") }}', 'kode', 'nama', [
                {field:'kode',title:'Kode Cabang',width:60},
                {field:'nama',title:'Nama Cabang',align:'left',width:150},
            ], function(i, row) {
                hidePesan('e_marketing');
                setText("mpol_mkar_kode_mkr",row.kode);
            });

            selectGrid('e_tarif', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_tarif_polis") }}', 'kode', 'nama', [
                {field:'kode',title:'Kode tarif',width:75},
                {field:'nama',title:'Keterangan',align:'left',width:300},
            ], function(i, row) {
                hidePesan('e_tarif');
                setText("mpol_mth_nomor",row.kode);

			    // setloadpolis();
            });

            selectGrid('e_uw', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_tarif_polis") }}', 'kode', 'nama', [
                {field:'kode',title:'Kode Cabang',width:60},
                {field:'nama',title:'Nama Cabang',align:'left',width:150},
            ], function(i, row) {
                hidePesan('e_uw');
                setText("mpol_mpuw_nomor",row.kode);
            });

            // selectSideMt('mpol_mprov_berlaku', '{{ url("tehnik/polis/entry-master-polis/lod_provinsi") }}' + '?polis=' + getText('mpol_kode'), function(d) { return {
            //     id: d.mprov_kode,
            //     text: d.mprov_nama
            // }}, function(e) {
            //     var data = e.params.data.id;
            //     // console.log(data);
            // });

            // selectSideMt('mpol_va_via', '{{ url("tehnik/polis/entry-master-polis/lod_paymod") }}' + '?tipe=V', function(d) { return {
            //     id: d.kode,
            //     text: d.nama
            // }}, function(e) {
            //     var data = e.params.data.id;
            //     // console.log(data);
            // });

            // selectSideMt('mpol_playonline_via', '{{ url("tehnik/polis/entry-master-polis/lod_paymod") }}' + '?tipe=O', function(d) { return {
            //     id: d.kode,
            //     text: d.nama
            // }}, function(e) {
            //     var data = e.params.data.id;
            //     // console.log(data);
            // });

            // selectSideMt('mpol_agent_via', '{{ url("tehnik/polis/entry-master-polis/lod_paymod") }}' + '?tipe=A', function(d) { return {
            //     id: d.kode,
            //     text: d.nama
            // }}, function(e) {
            //     var data = e.params.data.id;
            //     // console.log(data);
            // });


            tombol('click', 'lihatTarif', function() {
                var kode = getText('mpol_mth_nomor');
                var idFrame = $('#tbTarif');
                if (kode !== "" && kode !== null) {
                    openModal('modalLihatTarif');
                    titleAction('titleLihatTarif', 'Table Tarif');
                    setAttr("tbTarif", "src", "{{ url('tehnik/polis/entry-master-polis/rpt_lihattarif') }}" + "?nomor=" + kode);
                } else {
                    message('error', 'Oops...', 'Pilih dulu ketentuan tarif!');
                }
            });

            tombol('click', 'lihatUw', function() {
                var kode = getText('mpol_mpuw_nomor');
                if (kode !== "" && kode !== null) {
                    openModal('modalLihatUw');
                    titleAction('titleLihatUw', 'Table Underwriting');
                    setAttr("tbUw", "src", "{{ url('tehnik/polis/entry-master-polis/rpt_lihat_uw') }}" + "?nomor=" + kode);
                } else {
                    message('error', 'Oops...', 'Pilih dulu ketentuan uw!');
                }
            });

            tombol('change', 'mpol_dok', function(e) {
                var _this = e.target.files[0];
                showObj('viewPdfFile', 'data', _this);
            });

            tombol('click', 'lihatDocPolis', function() {
                var file = getText('mpol_dok');
                if (file == null || file == "") {
                    message("error","Ops..","File dokumen kosong, harap di isi dulu!");
                } else {
                    openModal('modalLihatDoc');
                    titleAction('titleLihatDoc', 'Lihat Dokumen');
                }
            });

            submitForm(
                "frxx_mstpolis",
                "btn_simpan",
                "POST",
                "{{ route('tehnik.polis.entry-master-polis.store') }}",
                (resSukses) => {
                    clear_f();
                    console.log(resSukses);
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        function e_leave(id) {
            var vv='';
            var rms="";
            var url="";

            if (id=="mpol_kode") {
                var tipe=getText("endors");
                vv = { res : ''};
                rms = "&pmgpolis="+getText("mpol_mrkn_kode")+"&kdstatus="+getText("endors")+"&mekanisme2="+getText("mpol_mekanisme2")+"&judul="+getText("judul")+"&kdsoc="+getText("mpol_msoc_kode");

                url="{{ url('tehnik/polis/entry-master-polis/get_kodepolis') }}"+"?id="+id+"&"+rms;
                getJson(url, vv, function(data){
                    console.log(data);
                    if (data) {
                        if (data.mpol_kode!="" && tipe=="0") {
                            cekPesan("info", "Data sudah pernah di input dengan nomor: "+data.mpol_kode, (result) => {
                                if (result.isConfirmed) {
                                    clear_f();
                                }
                            });
                        }
                        if (tipe!="0") {
                            setText("e_bersih","1");
                            jsonForm('frxx_mstpolis', data);
                            if (getText('judul')==4) {
                                setText("mpol_tgl_terbit","");
                                setText("mpol_tgl_awal_polis","");
                            }
                            if (data.mpol_mja_kode=="" || data.mpol_mja_kode=="0" || data.mpol_mgpp_kode=="" || data.mpol_mgpp_kode=="00") {
                                setTextReadOnly("mpol_mja_kode",false) ;
                                setTextReadOnly("mpol_mgpp_kode",false) ;
                            } else {
                                setTextReadOnly("mpol_mja_kode",true) ;
                                setTextReadOnly("mpol_mgpp_kode",true) ;
                            }
                            // $('#ffile').form('load',data);
                            setText("e_bersih","");
                        }
                        muncul(data.mjm_bundling,data.mjm_jiwa,data.mjm_gu,data.mjm_phk,data.mjm_tlo,data.mjm_fire,data.mjm_wp,data.mjm_umut);
                    }
                });
            }
        }

        function cekForm(tipe) {
            clear_f();
            if (tipe=='0') {
                adClass('btnBru', 'active');
                setHide('polisOld', true);
                rmClass('btnEds', 'active');
                rmClass('btnEdsBr', 'active');
                rmClass('btnEdt', 'active');
                rmClass('btnBtl', 'active');
                toster('success', 'Tombol Polis Baru Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Baru');
                setText('judul', tipe);

                setText("mpol_ins_soc",0);
                setTextReadOnly("mpol_ins_soc",true);
                setTextReadOnly("mpol_pajakfee",true);
                setTextReadOnly("mpol_handlingfee",true);
                setTextReadOnly("mpol_pajakfee_persen",true);
                setTextReadOnly("mpol_mujh_persen",true);
                setTextReadOnly("mpol_mmfe_persen",true);
                setTextReadOnly("mpol_overreding",true);
                setTextReadOnly("mpol_mkom_persen",true);
                setTextReadOnly("mpol_referal",true);
                setTextReadOnly("mpol_maintenance",true);
                setTextReadOnly("mpol_mfee_persen",true);
                setTextReadOnly("mpol_mdr_kode",true);
                setTextReadOnly("mpol_mkomdisc_persen",true);
                setReadEdit(false);
            }

            if (tipe=='1') {
                adClass('btnEdt', 'active');
                setHide('polisOld', true);
                rmClass('btnBru', 'active');
                rmClass('btnEds', 'active');
                rmClass('btnEdsBr', 'active');
                rmClass('btnBtl', 'active');
                toster('success', 'Tombol Polis Edit Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Edit');
                setText('judul', tipe);

                setText("mpol_ins_soc",0);
                setTextReadOnly("mpol_ins_soc",true);
                setTextReadOnly("mpol_pajakfee",true);
                setTextReadOnly("mpol_handlingfee",true);
                setTextReadOnly("mpol_pajakfee_persen",true);
                setTextReadOnly("mpol_mujh_persen",true);
                setTextReadOnly("mpol_mmfe_persen",true);
                setTextReadOnly("mpol_overreding",true);
                setTextReadOnly("mpol_mkom_persen",true);
                setTextReadOnly("mpol_referal",true);
                setTextReadOnly("mpol_maintenance",true);
                setTextReadOnly("mpol_mfee_persen",true);
                setTextReadOnly("mpol_mdr_kode",true);
                setTextReadOnly("mpol_mkomdisc_persen",true);
                setReadEdit(true);
            }

            if (tipe=='2') {
                adClass('btnEds', 'active');
                setHide('polisOld', false);
                oldPolis();
                rmClass('btnEdsBr', 'active');
                rmClass('btnBru', 'active');
                rmClass('btnEdt', 'active');
                rmClass('btnBtl', 'active');
                toster('success', 'Tombol Polis Endors Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Endors');
                setText('judul', tipe);

                setText("mpol_ins_soc",0);
                setTextReadOnly("mpol_ins_soc",true);
                setTextReadOnly("mpol_pajakfee",true);
                setTextReadOnly("mpol_handlingfee",true);
                setTextReadOnly("mpol_pajakfee_persen",true);
                setTextReadOnly("mpol_mujh_persen",true);
                setTextReadOnly("mpol_mmfe_persen",true);
                setTextReadOnly("mpol_overreding",true);
                setTextReadOnly("mpol_mkom_persen",true);
                setTextReadOnly("mpol_referal",true);
                setTextReadOnly("mpol_maintenance",true);
                setTextReadOnly("mpol_mfee_persen",true);
                setTextReadOnly("mpol_mdr_kode",true);
                setTextReadOnly("mpol_mkomdisc_persen",true);
                setReadEdit(true);
            }

            if (tipe=='3') {
                adClass('btnBtl', 'active');
                setHide('polisOld', true);
                rmClass('btnBru', 'active');
                rmClass('btnEdt', 'active');
                rmClass('btnEds', 'active');
                rmClass('btnEdsBr', 'active');
                toster('success', 'Tombol Polis Batal Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Batal');
                setText('judul', tipe);

                setText("mpol_ins_soc",0);
                setTextReadOnly("mpol_ins_soc",true) ;
                setTextReadOnly("mpol_pajakfee",true);
                setTextReadOnly("mpol_handlingfee",true);
                setTextReadOnly("mpol_pajakfee_persen",true);
                setTextReadOnly("mpol_mujh_persen",true);
                setTextReadOnly("mpol_mmfe_persen",true);
                setTextReadOnly("mpol_overreding",true);
                setTextReadOnly("mpol_mkom_persen",true);
                setTextReadOnly("mpol_referal",true);
                setTextReadOnly("mpol_maintenance",true);
                setTextReadOnly("mpol_mfee_persen",true);
                setTextReadOnly("mpol_mdr_kode",true);
                setTextReadOnly("mpol_mkomdisc_persen",true);
                setReadEdit(true);
            }

            if (tipe=='4') {
                adClass('btnEdsBr', 'active');
                setHide('polisOld', true);
                rmClass('btnBru', 'active');
                rmClass('btnEdt', 'active');
                rmClass('btnEds', 'active');
                rmClass('btnBtl', 'active');
                toster('success', 'Tombol Polis Endors Baru Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Endors Baru');
                setText('judul', tipe);

                setTextReadOnly("mpol_ins_soc",false);
                setTextReadOnly("mpol_pajakfee",false);
                setTextReadOnly("mpol_handlingfee",false);
                setTextReadOnly("mpol_pajakfee_persen",false);
                setTextReadOnly("mpol_mujh_persen",false);
                setTextReadOnly("mpol_mmfe_persen",false);
                setTextReadOnly("mpol_overreding",false);
                setTextReadOnly("mpol_mkom_persen",false);
                setTextReadOnly("mpol_referal",false);
                setTextReadOnly("mpol_maintenance",false);
                setTextReadOnly("mpol_mfee_persen",false);
                setTextReadOnly("mpol_mdr_kode",false);
                setTextReadOnly("mpol_mkomdisc_persen",false);
                setText("mpol_tgl_terbit","");
                setText("mpol_tgl_awal_polis","");
                setReadEdit(false);
            }
            setText('endors',tipe);
            // reSelGrid('mpol_mrkn_nama','{{ url("tehnik/polis/entry-master-polis/lod_pmg_polis") }}');
        }

        function setReadEdit(sts) {
            setTextReadOnly("mpol_mjns_kode",sts);
            setTextReadOnly("mpol_tgl_terbit",sts);
            setTextReadOnly("mpol_tgl_awal_polis",sts);
        }

        function oldPolis() {
            selectGrid('e_oldpolis', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_oldpolis") }}', 'mpol_kode', 'mpol_kode', [
                {field:'mpol_kode',title:'No. Polis',width:150},
                {field:'mpol_msoc_kode',title:'No. Soc',width:150},
                {field:'mjns_Keterangan',title:'Nasabah',width:200},
                {field:'mssp_nama',title:'Segemen',width:100,hidden:false},
                {field:'mkm_nama',title:'Mekanisme 1',width:100,hidden:false},
                {field:'mkm_ket2',title:'Mekanisme 2',width:100,hidden:false},
                {field:'mker_nama',title:'Pekerjaan',width:140,hidden:false},
                {field:'mft_nama',title:'Manfaat',width:70,hidden:false},
                {field:'bayar',title:'Pembayaran',width:70,hidden:false},
                {field:'msoc_mjm_nama',title:'Jaminan',width:100},
                {field:'mpras_nama',title:'Program Asuransi',width:97},
                {field:'msoc_mrkn_nama',title:'Pmg Polis',width:200,hidden:true},
            ], function(i, row) {
                // hidePesan('e_oldpolis');
                var kode = row.mpol_kode;
                ambil_oldpolis(kode);
            });
        }

        // function setloadpolis() {
        //     //bersih(1)
        //     //var url="/live/ww.load/lod_soc.php?&jmn="+getText("mpol_mjns_kode")+"&pmgpolis="+getText("mpol_mrkn_kode")+"&mft="+getText("mpol_mft_kode");
        //     //alert(url);
        //     //reComboGrid("#e_pras",url);
        // }

        function cekopenpolis() {
            hidePesan('mpol_openpolis');
            var _this = getText("mpol_openpolis");
            // if (getText("mpol_openpolis")=="1") {
            if (_this) {
                setTextReadOnly("mpol_tgl_ahir_polis",true);
                setTextReadOnly("mpol_tgl_awal_polis",true);
            } else {
                setTextReadOnly("mpol_tgl_ahir_polis",false);
                setTextReadOnly("mpol_tgl_awal_polis",true);
                //setTextReadOnly("mpol_tgl_awal_polis",false);
            }
        }

        function cekpolis() {
            vv = { res : ''};
            rms = "pmgpolis="+getText("mpol_mrkn_kode")+"&msoc="+getText("mpol_msoc_kode")+"&nasabah="+getText("mpol_mjns_kode")+"&mrkn_nama="+getText("mpol_mrkn_nama")+"&jns_bayar="+getText("mpol_jenis_bayar")+"&mekanisme="+getText("mpol_mekanisme");

            url = '{{ url("tehnik/polis/entry-master-polis/get_nopolis") }}' + '?' + rms;
            getJson(url, vv, function(data) {
                if (data) {
                    jsonForm('frxx_mstpolis', data);
                }
            });
        }

        function ambil_oldpolis(kode) {
            vv={};
            rms="pmgpolis="+getText("mpol_mrkn_kode")+"&mekanisme2="+getText("mpol_mekanisme2")+"&judul="+getText("judul")+"&nomor="+kode;
            url='{{ url("tehnik/polis/entry-master-polis/get_oldpolis") }}' + '?' + rms;

            getJson(url,vv, function(data){
                if (data) {
                    jsonForm('frxx_mstpolis', data);
                }
            });
        }

        function ceksoc() {
            vv = { res : ''};
            rms = "pmgpolis="+getText("mpol_mrkn_kode")+"&mekanisme="+getText("mpol_mekanisme")+"&msoc="+getText("mpol_msoc_kode")+"&judul="+getText("judul")+"&mrkn_nama="+getText("mpol_mrkn_nama");

            url = '{{ url("tehnik/polis/entry-master-polis/get_ket_soc") }}' + '?' + rms;
            getJson(url, vv, function(data) {
                if (data) {
                    jsonForm('frxx_mstpolis', data);
                    setText("mpol_jns_perusahaan",data.mpol_jns_perusahaan);
                }
            });
        }

        function cekdata() {
            messageValid('Apakah Anda Yakin data ini sudah sesuai dengan surat penawaran PT Asuransi Jiwa Syariah Al Amin ?', (result) => {
                if (result.isConfirmed) {
                    cekpolis();
				    ceksoc();
                    e_leave("mpol_kode");
                } else if (result.isDenied) {
                    // pesan("info", "Silahkan Konfirmasi ke Bagian Teknik !!! ");
                    // clear_f();
                    pesan("info", "Silahkan Konfirmasi ke Bagian Teknik !!! ");
                    clear_f();
                }
            });
        }

        function tanya() {
            setTextReadOnly("mpol_mujh_persen",true);
            setTextReadOnly("mpol_mmfe_persen",true);
            setTextReadOnly("mpol_overreding",true);
            setTextReadOnly("mpol_mfee_persen",true);
            setTextReadOnly("mpol_mkom_persen",true);
            setTextReadOnly("mpol_mdr_kode",true);
            messageValid('Silahkan Cek Terlebih Dahulu, Apakah Data Ujroh dan Feebase sudah Benar ( Mengikuti Ketentuan di SOC ) ?', (result) => {
                if (result.isConfirmed) {

                } else if (result.isDenied) {
                    pesan("info", "Silahkan Konfirmasi ke Bagian Teknik !!! ");
                    clearForm();
                }
            });
        }

        function jointlife() {
            if (getText('mpol_jl')==0) {
                setTextReadOnly("mpol_jl",true);
                setTextReadOnly("mpol_jl_pst",false);
                setTextReadOnly("mpol_jl_pasangan",false);
            }
        }

        function muncul(bandling,jiwa,gu,phk,tlo,fire,wp,umut,ujrf,discrate,wp_pens,phk_pens) {
            setTextReadOnly("mpol_mmft_kode_gu",true);
            if (gu=="1") {
                setTextReadOnly("mpol_mmft_kode_gu",false);
            }

            setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
            if (wp=="1") {
                setTextReadOnly("mpol_mmft_kode_wp_swasta",false);
            }

            setTextReadOnly("mpol_mmft_kode_wp_pns",true);
            if (wp=="1") {
                setTextReadOnly("mpol_mmft_kode_wp_pns",false);
            }

            setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
            if (phk=="1") {
                setTextReadOnly("mpol_mmft_kode_phk_swasta",false);
            }

            setTextReadOnly("mpol_mmft_kode_phk_pns",true);
            if (phk=="1") {
                setTextReadOnly("mpol_mmft_kode_phk_pns",false);
            }

            setTextReadOnly("mpol_mmft_kode_tlo",true);
            if (tlo=="1") {
                setTextReadOnly("mpol_mmft_kode_tlo",false);
            }

            setTextReadOnly("mpol_mmft_kode_fire",true);
            if (fire=="1") {
                setTextReadOnly("mpol_mmft_kode_fire",false);
            }
        }

        function muncul1(uptambah,ujrah_referal,discrate,mmft_kode_jiwa) {
            setTextReadOnly("mpol_mmft_kode_jiwa",true);
            if (mmft_kode_jiwa=="1") {
                setTextReadOnly("mpol_mmft_kode_jiwa",false);
            }

            setTextReadOnly("mpol_mut_kode",true);
            if (uptambah=="1") {
                setTextReadOnly("mpol_mut_kode",false);
            }

            setTextReadOnly("mpol_mujhrf_kode",true);
            if (ujrah_referal=="1") {
                setTextReadOnly("mpol_mujhrf_kode",false);
            }

            setTextReadOnly("mpol_mdr_kode",false);
            if (discrate=="1") {
                setTextReadOnly("mpol_mdr_kode",true);
            }
        }

        function muncul2(mssp_tgl_awal,mssp_tgl_ahir,mssp_komisi,mssp_feebase,mssp_openpolis) {
            setTextReadOnly("mpol_openpolis",false);
            if (mssp_openpolis=="2") {
                setTextReadOnly("mpol_openpolis",true);
            }

            setTextReadOnly("mpol_tgl_awal_polis",false);
            if (mssp_tgl_awal=="1") {
                setTextReadOnly("mpol_tgl_awal_polis",false);
            }

            setTextReadOnly("mpol_tgl_ahir_polis",false);
            if (mssp_tgl_ahir=="1") {
                setTextReadOnly("mpol_tgl_ahir_polis",true);
            }

            setTextReadOnly("mpol_overreding",false);
            if (mssp_komisi=="1") {
                setTextReadOnly("mpol_overreding",true);
            }

            setTextReadOnly("mpol_mfee_persen",false);
            if (mssp_feebase=="1") {
                setTextReadOnly("mpol_mfee_persen",true);
            }
        }

        function muncul3(mjns_jl,mjns_jl_pst,mjns_jl_pas,mjns_wp_pens,mjns_phk_pens) {
            setTextReadOnly("mpol_jl",true);
            if (mjns_jl=="1") {
                setTextReadOnly("mpol_jl",false);
            }
            setTextReadOnly("mpol_jl_pst",true);
            if (mjns_jl_pst=="1") {
                setTextReadOnly("mpol_jl_pst",false);
            }
            setTextReadOnly("mpol_jl_pasangan",true);
            if (mjns_jl_pas=="1") {
                setTextReadOnly("mpol_jl_pasangan",false);
            }
            setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
            if (mjns_wp_pens=="1") {
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",false);
            }
            setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
            if (mjns_phk_pens=="1") {
                setTextReadOnly("mpol_mmft_kode_phk_pensiun",false);
            }
            setTextReadOnly("mpol_mmft_kode_phk_swasta",false);
            if (mjns_phk_pens=="1") {
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);
            }
        }

        function muncul4(bandling,mjns_wp_pens,mjns_phk_pens,jiwa,gu,phk,tlo,fire,wp,umut,ujrf,discrate,wp_pens,phk_pens,uptambah,ujrah_referal,discrate,mmft_kode_jiwa,mssp_tgl_awal,mssp_tgl_ahir,mssp_komisi,mssp_feebase,mssp_openpolis,mjns_jl,mjns_jl_pst,mjns_jl_pas)
		{
            if (jiwa="01") {
                setTextReadOnly("mpol_mnfa_kode",false);
                setTextReadOnly("mpol_mmft_kode_gu",true);
                setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
                setTextReadOnly("mpol_mmft_kode_wp_pns",true);
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);
                setTextReadOnly("mpol_mmft_kode_tlo",true);
                setTextReadOnly("mpol_mmft_kode_fire",true);
                setTextReadOnly("mpol_mmft_kode_jiwa",true);
            }
            setTextReadOnly("mpol_mmft_kode_gu",true);
            if (gu=="1") {
                setTextReadOnly("mpol_mmft_kode_gu",false);
                setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
                setTextReadOnly("mpol_mmft_kode_wp_pns",true);
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);
                setTextReadOnly("mpol_mmft_kode_tlo",true);
                setTextReadOnly("mpol_mmft_kode_fire",true);
                setTextReadOnly("mpol_mmft_kode_jiwa",true);
            }

            setTextReadOnly("mpol_mmft_kode_wp_swasta",true);

            if (wp=="1") {
                setTextReadOnly("mpol_mmft_kode_wp_swasta",false);
            }

            setTextReadOnly("mpol_mmft_kode_wp_pns",true);
            if (wp=="1") {
                setTextReadOnly("mpol_mmft_kode_wp_pns",false);
            }

            setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
            if (mjns_wp_pens=="1") {
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",false);
                setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
                setTextReadOnly("mpol_mmft_kode_wp_pns",true);

                setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);

                setTextReadOnly("mpol_mmft_kode_tlo",true);
                setTextReadOnly("mpol_mmft_kode_fire",true);
                setTextReadOnly("mpol_mmft_kode_jiwa",true);
            }


            //setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
            if (mjns_phk_pens=="1") {
                setTextReadOnly("mpol_mmft_kode_phk_pensiun",false);
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);
                if (mjns_wp_pens=="1")
                {
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",false);
                }
                else
                {

                setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
                }

                setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
                setTextReadOnly("mpol_mmft_kode_wp_pns",true);
                setTextReadOnly("mpol_mmft_kode_tlo",true);
                setTextReadOnly("mpol_mmft_kode_fire",true);
                setTextReadOnly("mpol_mmft_kode_jiwa",true);
            }

            setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
            if (phk=="1") {
                setTextReadOnly("mpol_mmft_kode_phk_swasta",false);

            }

            setTextReadOnly("mpol_mmft_kode_phk_pns",true);
            if (phk=="1") {
                setTextReadOnly("mpol_mmft_kode_phk_pns",false);

            }

            setTextReadOnly("mpol_mmft_kode_tlo",true);
            if (tlo=="1") {
                setTextReadOnly("mpol_mmft_kode_tlo",false);
                setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
                setTextReadOnly("mpol_mmft_kode_wp_pns",true);
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);
                setTextReadOnly("mpol_mmft_kode_fire",true);
                setTextReadOnly("mpol_mmft_kode_jiwa",true);
            }

            setTextReadOnly("mpol_mmft_kode_fire",true);
            if (fire=="1") {
                setTextReadOnly("mpol_mmft_kode_fire",false);
                setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
                setTextReadOnly("mpol_mmft_kode_wp_pns",true);
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);
                setTextReadOnly("mpol_mmft_kode_tlo",true);
                setTextReadOnly("mpol_mmft_kode_jiwa",true);
            }
            setTextReadOnly("mpol_mmft_kode_jiwa",true);
            if (mmft_kode_jiwa=="1") {
                setTextReadOnly("mpol_mmft_kode_jiwa",false);
                setTextReadOnly("mpol_mmft_kode_wp_swasta",true);
                setTextReadOnly("mpol_mmft_kode_wp_pns",true);
                setTextReadOnly("mpol_mmft_kode_wp_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_pensiun",true);
                setTextReadOnly("mpol_mmft_kode_phk_swasta",true);
                setTextReadOnly("mpol_mmft_kode_phk_pns",true);
                setTextReadOnly("mpol_mmft_kode_tlo",true);
                setTextReadOnly("mpol_mmft_kode_fire",true);
            }

            setTextReadOnly("mpol_mut_kode",true);
            if (uptambah=="1") {
                setTextReadOnly("mpol_mut_kode",false);
            }

            setTextReadOnly("mpol_mujhrf_kode",true);
            if (ujrah_referal=="1") {
                setTextReadOnly("mpol_mujhrf_kode",false);
            }
            setTextReadOnly("mpol_openpolis",false);
            if (mssp_openpolis=="2") {
                setTextReadOnly("mpol_openpolis",true);
            }

            setTextReadOnly("mpol_tgl_awal_polis",false);
            if (mssp_tgl_awal=="1") {
                setTextReadOnly("mpol_tgl_awal_polis",true);
            }

            setTextReadOnly("mpol_tgl_ahir_polis",false);
            if (mssp_tgl_ahir=="1") {
                setTextReadOnly("mpol_tgl_ahir_polis",true);
            }

            setTextReadOnly("mpol_jl",true);
            if (mjns_jl=="1") {
                setTextReadOnly("mpol_jl",false);
            }
            setTextReadOnly("mpol_jl_pst",true);
            if (mjns_jl_pst=="1") {
                setTextReadOnly("mpol_jl_pst",false);
            }
            setTextReadOnly("mpol_jl_pasangan",true);
            if (mjns_jl_pas=="1") {
                setTextReadOnly("mpol_jl_pasangan",false);
            }
        }

        function clear_f() {
            cekField();
            clearForm('frxx_mstpolis');
            bsimpan('btn_simpan', 'Simpan');
            setTextReadOnly('mpol_mspaj_nama', true);
            setTextReadOnly('e_nasabah', true);
            setTextReadOnly('mpol_mssp_nama', true);
            setTextReadOnly('e_jenisprod', true);
            setTextReadOnly('mpol_jenis_bayar', true);
            setTextReadOnly('mpol_mekanisme', true);
            setTextReadOnly('mpol_mft_kode', true);
            setTextReadOnly('mpol_mekanisme2', true);
            setTextReadOnly('e_manfaat', true);
            setTextReadOnly('mpol_jns_perusahaan', true);
            setTextReadOnly('e_pras', true);
            setTextReadOnly('mpol_mslr_kode', true);
            setTextReadOnly('e_cabalamin', true);
            setTextReadOnly('e_marketing', true);
            setTextReadOnly('e_pinca', true);
            // setText('sjab_editsoc','1');

            setText("mpol_mft_kode","01");
            setText("mpol_aktif","1");
            setText("mpol_online","0");
            setText("mpol_va","0");
            setText("mpol_jns_tarif","0");
            // tutup_paymod();
            setText("e_pras","REGULER");
            setText("mpol_nilai_ketusreas1","0");
            setText("mpol_nilai_ketusreas2","0");

            setText("endors","0");
            setText("mpol_tgl_terbit", curDate());
            setText("mpol_tgl_awal_polis", curDate());
            setText("mpol_tgl_ahir_polis", curDate());
            setText("mpol_usia_max","0");
            setText("mpol_usia_min","0");
            setText("mpol_tenor_max","0");
            setText("mpol_jatuh_tempo","0");
            setText("mpol_lapor_data","0");
            setText("mpol_kadaluarsa_klaim","0");
            setText("mpol_byr_premi","0");
            setText("mpol_max_pst","100");
            setText("mpol_max_up","1000000");
            setText("mpol_standar_premi","50000");

            setText("mpol_aprove_fc","0");
            setText("mpol_mfee_persen","0");
            setText("mpol_mkom_persen","0");
            setText("mpol_overreding","0");
            setText("mpol_mmfe_persen","0");
            setText("mpol_mujh_persen","0");
            setText("mpol_mujhrf_kode","0");
            setText("mpol_mdr_kode","0");
            setText("mpol_mut_kode","0");
            setText("mpol_ket_endors","-");
            setText("mpol_no_endors","-");
            setText("mpol_max_bayar_klaim","0");
            setText("mpol_tipe_uw","0");
            // setText("typerpt","web");

            setReadEdit(false);
        }

        function cekField() {
            // setRequired
            //tab1
            setTextReq('mpol_mrkn_nama', true);
            setTextReq('mpol_msoc_kode', true);
            //tab2
            setTextReq('mpol_mpojk_kode', true);
            setTextReq('mpol_mja_kode', true);
            setTextReq('mpol_mgpp_kode', true);
            setTextReq('mpol_mgp_kode', true);
            setTextReq('mpol_mgs_kode', true);
            setTextReq('mpol_mlu_kode', true);
            setTextReq('mpol_mgol_kode', true);
            setTextReq('mpol_online_rekan', true);
            setTextReq('mpol_openpolis', true);
            setTextReq('mpol_jenis_cetak', true);
            setTextReq('mpol_cetak_lunas', true);
            setTextReq('mpol_host2host', true);
            setTextReq('mpol_pemgroupusaha', true);
            setTextReadOnly('mpol_max_pst', true);
            setTextReadOnly('mpol_status_polis', true);
            //tab3
            setTextReq('mpol_standar_perlindungan', true);
            //tab4
            setTextReq('mpol_penerima_manfaat', true);
            setTextReq('mpol_mnfa_kode', true);
            setTextReadOnly("mpol_jl", false);
            //tab5
            setTextReq('mpol_surplus', true);
            //tab6
            setTextReq('mpol_payonline', true);
            setTextReq('mpol_agent', true);
            setTextReq('mpol_msrf_kode', true);
            setTextReadOnly('mpol_va_via', true);
            setTextReadOnly('mpol_playonline_via', true);
            setTextReadOnly('mpol_agent_via', true);
            //tab7
            setTextReq('mpol_jenis_login', true);
            setTextReq('mpol_acc_tek', true);
            //tab8
            setTextReadOnly('mpol_nomor', true);
            setTextReadOnly('mpol_nomor_cetak', true);
            setTextReadOnly('mpol_kode', true);
            setHide('mpol_mprov_berlaku', true);

            // setHide
            setHide('judul', true);
            setHide('mpol_mrkn_kode', true);
            setHide('mpol_mspaj_nomor', true);
            setHide('mpol_mjns_mpid_kode', true);
            setHide('mpol_mjns_kode', true);
            setHide('mpol_mssp_kode', true);
            setHide('mpol_mjm_kode', true);
            setHide('mpol_mpid_kode', true);
            setHide('endors', true);
            setHide('mpol_mpras_kode', true);
            setHide('e_bersih', true);
            setHide('mpol_mlok_kode', true);
            setHide('mpol_mkar_kode_mkr', true);
            setHide('msoc_mkar_kode_pim', true);
            setHide('mpol_mth_nomor', true);
            setHide('mpol_mpuw_nomor', true);

            // tab 3
            hidePesan('mpol_standar_perlindungan');
            // tab 4
            hidePesan('mpol_penerima_manfaat');
            hidePesan('mpol_mnfa_kode');
            // tab 5
            hidePesan('mpol_surplus');
            // tab 6
            hidePesan('mpol_payonline');
            hidePesan('mpol_agent');
            hidePesan('mpol_msrf_kode');
            // tab 7
            hidePesan('mpol_jenis_login');
            hidePesan('mpol_acc_tek');
        }

        function bersih(tipe) {
            if (getText("e_bersih")=="1") {
                return ;
            }
            if (tipe==1) {
                setText("e_manfaat","");
                setText("e_pras","");
                setText("mpol_nomor","");
                setText("mpol_mpras_kode","");
                setText("mpol_mjm_kode","");
            }
            if (tipe==2) {
                setText("mpol_mrkn_nama","");
            }
        }

        function close_mTarif() {
            closeModal('modalTarif');
            clearForm('frxx_uploadTarif');
        }

        function close_mUw() {
            closeModal('modalUw');
            clearForm('frxx_uploadUw');
        }

        function close_lihatDoc() {
            closeModal('modalLihatDoc');
            $('#lihatFileDoc').attr("data","");
        }
    </script>


@endsection
