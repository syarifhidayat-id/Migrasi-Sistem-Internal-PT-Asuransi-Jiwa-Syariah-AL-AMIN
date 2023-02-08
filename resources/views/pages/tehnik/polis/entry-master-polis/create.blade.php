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
                            <input type="text" class="easyui-combogrid selectGrid" name="mpol_mrkn_nama" id="mpol_mrkn_nama" data-options="prompt:'Pilih pemegang polis'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mrkn_kode" id="mpol_mrkn_kode" placeholder="mpol_mrkn_kode" />
                            <span class="text-danger error-text mpol_mrkn_nama_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="required form-label">Kode Soc</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="mpol_msoc_kode" id="mpol_msoc_kode" data-options="prompt:'Pilih kode soc'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_msoc_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nomor Spaj</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="mpol_mspaj_nama" id="mpol_mspaj_nama" data-options="prompt:'Pilih nomor spaj'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mspaj_nomor" id="mpol_mspaj_nomor" placeholder="mpol_mspaj_nomor" />
                            <span class="text-danger error-text mpol_mspaj_nama_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Nasabah Bank/Peserta</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="e_nasabah" id="e_nasabah" data-options="prompt:'Pilih nasabah bank/peserta'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mjns_mpid_kode" id="mpol_mjns_mpid_kode" placeholder="mpol_mjns_mpid_kode" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mjns_kode" id="mpol_mjns_kode" placeholder="mpol_mjns_kode" />
                            <span class="text-danger error-text e_nasabah_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Segmen Pasar</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="mpol_mssp_nama" id="mpol_mssp_nama" data-options="prompt:'Pilih segmen pasar'" style="width: 100%; height: 38px;" />
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
                            <input type="text" class="easyui-combobox" name="mpol_mekanisme" id="mpol_mekanisme" data-options="prompt:'Pilih mkanisme'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mekanisme_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Asuransi</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="mpol_mft_kode" id="mpol_mft_kode" data-options="prompt:'Pilih manfaat asuransi'" style="width: 100%; height: 38px;" />
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
                            <input type="text" class="easyui-combogrid selectGrid" name="e_manfaat" id="e_manfaat" data-options="prompt:'Pilih jaminan asuransi'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mjm_kode" id="mpol_mjm_kode" placeholder="mpol_mjm_kode" />
                            <span class="text-danger error-text e_manfaat_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Jenis Pekerjaan</label>
                            <input type="text" class="easyui-combobox" name="mpol_jns_perusahaan" id="mpol_jns_perusahaan" data-options="prompt:'Pilih jenis pekerjaan'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_jns_perusahaan_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Produk Induk Internal</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="e_jenisprod" id="e_jenisprod" data-options="prompt:'Pilih segmen pasar'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mpid_kode" id="mpol_mpid_kode" placeholder="mpol_mpid_kode" />
                            <input type="text" class="form-control form-control-solid" name="endors" id="endors" placeholder="endors" />
                            <span class="text-danger error-text e_jenisprod_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Program Asuransi</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="e_pras" id="e_pras" data-options="prompt:'Pilih program asuransi'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mpras_kode" id="mpol_mpras_kode" placeholder="mpol_mpras_kode" />
                            <span class="text-danger error-text e_pras_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Saluran Distribusi</label>
                            <input type="text" class="easyui-combobox" name="mpol_mslr_kode" id="mpol_mslr_kode" data-options="prompt:'Pilih saluran distribusi'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="e_bersih" id="e_bersih" placeholder="e_bersih" />
                            <span class="text-danger error-text mpol_mslr_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Cabang Al-Amin</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="e_cabalamin" id="e_cabalamin" data-options="prompt:'Pilih cabang'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mlok_kode" id="mpol_mlok_kode" placeholder="mpol_mlok_kode" />
                            <span class="text-danger error-text e_cabalamin_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Marketing</label>
                            <input type="text" class="easyui-combogrid selectGrid" name="e_marketing" id="e_marketing" data-options="prompt:'Pilih marketing'" style="width: 100%; height: 38px;" />
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
                            <input type="text" class="easyui-combobox" name="mpol_mpojk_kode" id="mpol_mpojk_kode" data-options="prompt:'Pilih produk induk'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mpojk_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Jenis Ausransi</label>
                            <input type="text" class="easyui-combobox" name="mpol_mja_kode" id="mpol_mja_kode" data-options="prompt:'Pilih jenis asuransi'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mja_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Produk Segmen</label>
                            <input type="text" class="easyui-combobox" name="mpol_mgpp_kode" id="mpol_mgpp_kode" data-options="prompt:'Pilih produk'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mgpp_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Kelompok Produk</label>
                            <input type="text" class="easyui-combobox" name="mpol_mgp_kode" id="mpol_mgp_kode" data-options="prompt:'Pilih kelompok'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mgp_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Rekan Segmen</label>
                            <input type="text" class="easyui-combobox" name="mpol_mgs_kode" id="mpol_mgs_kode" data-options="prompt:'Pilih rekan segmen'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mgs_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Lini Usaha</label>
                            <input type="text" class="easyui-combobox" name="mpol_mlu_kode" id="mpol_mlu_kode" data-options="prompt:'Pilih lini usaha'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mlu_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Golongan</label>
                            <input type="text" class="easyui-combobox" name="mpol_mgol_kode" id="mpol_mgol_kode" data-options="prompt:'Pilih golongan'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mgol_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Status Aktif Polis</label>
                            <select class="easyui-combobox" name="mpol_aktif" id="mpol_aktif" data-options="prompt:'Pilih status'" style="width: 100%; height: 38px;">
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
                            <span class="text-danger error-text mpol_online_err">asdasdasdasdasdasd</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Online Polis Rekan</label>
                            <select class="easyui-combobox" name="mpol_online_rekan" id="mpol_online_rekan" data-options="prompt:'Pilih online rekan'" style="width: 100%; height: 38px;">
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
                            <select class="easyui-combobox" name="mpol_openpolis" id="mpol_openpolis" data-options="prompt:'Pilih online rekan'" style="width: 100%; height: 38px;">
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
                            <input type="text" class="easyui-combobox" name="mpol_jenis_cetak" id="mpol_jenis_cetak" data-options="prompt:'Pilih cetak pengajuan'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_jenis_cetak_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Cetak Peserta Lunas</label>
                            <input type="text" class="easyui-combobox" name="mpol_cetak_lunas" id="mpol_cetak_lunas" data-options="prompt:'Pilih cetak lunas'" style="width: 100%; height: 38px;" />
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
                            <select class="easyui-combobox" name="mpol_host2host" id="mpol_host2host" data-options="prompt:'Pilih status'" style="width: 100%; height: 38px;">
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
                            <select class="easyui-combobox" name="mpol_pemgroupusaha" id="mpol_pemgroupusaha" data-options="prompt:'Pilih pemasaran group usaha'" style="width: 100%; height: 38px;">
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
                                    <input type="text" class="easyui-combobox" name="mpol_mujhrf_kode" id="mpol_mujhrf_kode" data-options="prompt:'Pilih ujrah referal'" style="width: 100%; height: 38px;" />
                                </div>
                                <span class="input-group-text">%</span>
                            </div>
                            <span class="text-danger error-text mpol_mujhrf_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Stnc Pelaporan</label>
                            <input type="text" class="easyui-combobox" name="mpol_lapor_stnc" id="mpol_lapor_stnc" data-options="prompt:'Pilih stnc pelaporan'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_lapor_stnc_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Ujrah Treaty Reas</label>
                            <div class="input-group input-group-solid flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <input type="text" class="easyui-combobox" name="mpol_ujroh_treaty" id="mpol_ujroh_treaty" data-options="prompt:'Pilih ujrah treaty reas'" style="width: 100%; height: 38px;" />
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
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_penerima_manfaat" id="mpol_penerima_manfaat" data-placeholder="Pilih penerima manfaat" data-allow-clear="true">
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
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mnfa_kode" id="mpol_mnfa_kode" data-placeholder="Pilih manfaat jiwa" data-allow-clear="true">
                                <option></option>
                            </select>
                            <span class="text-danger error-text mpol_mnfa_kode_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Tambahan Gu</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_gu" id="mpol_mmft_kode_gu" data-placeholder="Pilih manfaat tambahan gu" data-allow-clear="true">
                                <option></option>
                            </select>
                            <span class="text-danger error-text mpol_mmft_kode_gu_err"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Tambahan Wp</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_wp_swasta" id="mpol_mmft_kode_wp_swasta" data-placeholder="Pilih manfaat tambahan wp" data-allow-clear="true">
                                                <option></option>
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Swasta</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_wp_swasta_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_wp_pns" id="mpol_mmft_kode_wp_pns" data-placeholder="Pilih manfaat tambahan wp" data-allow-clear="true">
                                                <option></option>
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Pns</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_wp_pns_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_wp_pensiun" id="mpol_mmft_kode_wp_pensiun" data-placeholder="Pilih manfaat tambahan wp" data-allow-clear="true">
                                                <option></option>
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
                        <div class="mb-5">
                            <label class="form-label">Manfaat Tambahan Phk</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_phk_swasta" id="mpol_mmft_kode_phk_swasta" data-placeholder="Pilih manfaat tambahan phk" data-allow-clear="true">
                                                <option></option>
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Swasta</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_phk_swasta_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_phk_pns" id="mpol_mmft_kode_phk_pns" data-placeholder="Pilih manfaat tambahan phk" data-allow-clear="true">
                                                <option></option>
                                            </select>
                                        </div>
                                        <span class="input-group-text">% Pns</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mmft_kode_phk_pns_err"></span>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_phk_pensiun" id="mpol_mmft_kode_phk_pensiun" data-placeholder="Pilih manfaat tambahan phk" data-allow-clear="true">
                                                <option></option>
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
                                    <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_fire" id="mpol_mmft_kode_fire" data-placeholder="Pilih manfaat tambahan Fire" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_fire_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="form-label">Manfaat Tambahan Tlo</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mpol_mmft_kode_tlo" id="mpol_mmft_kode_tlo" data-placeholder="Pilih manfaat tambahan tlo" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text mpol_mmft_kode_tlo_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Tambahan Join Life</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_jl" id="mpol_jl" data-placeholder="Pilih manfaat tambahan join life" data-allow-clear="true">
                                <option></option>
                            </select>
                            <span class="text-danger error-text mpol_jl_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="form-label">Manfaat Join Life Peserta</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_jl_pst" id="mpol_jl_pst" data-placeholder="Pilih manfaat j.life peserta" data-allow-clear="true">
                                <option></option>
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
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_jl_pasangan" id="mpol_jl_pasangan" data-placeholder="Pilih manfaat  j.life pasangan" data-allow-clear="true">
                                <option></option>
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
                                            <input type="text" class="easyui-combobox" name="mpol_handlingfee" id="mpol_handlingfee" data-options="prompt:'Fee ppn'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_pajakfee_persen" id="mpol_pajakfee_persen" data-options="prompt:'Fee pph 23'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_mujh_persen" id="mpol_mujh_persen" data-options="prompt:'Ujrah'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_mmfe_persen" id="mpol_mmfe_persen" data-options="prompt:'Managemen fee'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_overreding" id="mpol_overreding" data-options="prompt:'Overreding'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_mkom_persen" id="mpol_mkom_persen" data-options="prompt:'Komisi tidak potong'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_referal" id="mpol_referal" data-options="prompt:'Referal'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_maintenance" id="mpol_maintenance" data-options="prompt:'Maintenance'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_mfee_persen" id="mpol_mfee_persen" data-options="prompt:'Feebase Tidak Potong'" style="width: 100%; height: 38px;" />
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
                                            <input type="text" class="easyui-combobox" name="mpol_mdr_kode" id="mpol_mdr_kode" data-options="prompt:'Feebase Potong'" style="width: 100%; height: 38px;" />
                                        </div>
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <span class="text-danger error-text mpol_mdr_kode_err"></span>
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
                    <div class="col-md-4">
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
                    <div class="col-md-8">
                        <div class="mb-5">
                            <label class="form-label">Via</label>
                            <div class="input-group input-group-solid flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <input type="text" class="form-control form-control-solid" name="mpol_va_via" id="mpol_va_via" placeholder="" />
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" onclick=""><i class="fa-solid fa-plus"></i> Tambah</button>
                            </div>
                            <span class="text-danger error-text mpol_va_via_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Pembayaran Online</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_payonline" id="mpol_payonline" data-placeholder="Pilih pembayaran online" data-allow-clear="true">
                                <option></option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_payonline_err"></span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-5">
                            <label class="form-label">Via</label>
                            <div class="input-group input-group-solid flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <input type="text" class="form-control form-control-solid" name="mpol_playonline_via" id="mpol_playonline_via" placeholder="" />
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" onclick=""><i class="fa-solid fa-plus"></i> Tambah</button>
                            </div>
                            <span class="text-danger error-text mpol_playonline_via_err"></span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-5">
                            <label class="required form-label">Pembayaran Retail/Agent</label>
                            <select class="form-select form-select-solid" data-control="select2" name="mpol_agent" id="mpol_agent" data-placeholder="Pilih pembayaran retail/agent" data-allow-clear="true">
                                <option></option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                            <span class="text-danger error-text mpol_agent_err"></span>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-5">
                            <label class="form-label">Via</label>
                            <div class="input-group input-group-solid flex-nowrap">
                                <div class="overflow-hidden flex-grow-1">
                                    <input type="text" class="form-control form-control-solid" name="mpol_agent_via" id="mpol_agent_via" placeholder="" />
                                </div>
                                <button type="button" class="btn btn-primary btn-sm" onclick=""><i class="fa-solid fa-plus"></i> Tambah</button>
                            </div>
                            <span class="text-danger error-text mpol_agent_via_err"></span>
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
                                    <select class="form-select form-select-solid" data-control="select2" name="mpol_mprov_kode" id="mpol_mprov_kode" data-placeholder="Pilih berlaku" data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Seluruh Provinsi</option>
                                        <option value="0">Provinsi Tertentu</option></select>
                                    </select>
                                    <span class="text-danger error-text mpol_mprov_kode_err"></span>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-select form-select-solid" name="mpol_mprov_berlaku" id="mpol_mprov_berlaku" data-placeholder="Pilih provinsi" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text mpol_mprov_berlaku_err"></span>
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
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <input type="text" class="easyui-combobox" name="e_tarif" id="e_tarif" data-options="prompt:'Pilih jenis tarif'" style="width: 100%; height: 38px;" />
                                                {{-- <select class="form-select form-select-solid" data-control="select2" name="e_tarif" id="e_tarif" data-placeholder="Pilih tarif" data-allow-clear="true">
                                                    <option></option>
                                                    @foreach ($e_tarif as $key => $data)
                                                        <option value="{{ $data->kode }}">{{ $data->nama }}</option>
                                                    @endforeach
                                                </select> --}}
                                                <input type="text" class="form-control form-control-solid" name="mpol_mth_nomor" id="mpol_mth_nomor" placeholder="mpol_mth_nomor" />
                                            </div>
                                        </div>
                                        <span class="text-danger error-text e_tarif_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <button type="button" id="importTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                        <button type="button" id="lihatTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
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
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <input type="text" class="easyui-combobox" name="e_uw" id="e_uw" data-options="prompt:'Pilih jenis underwriting'" style="width: 100%; height: 38px;" />
                                                {{-- <select class="form-select form-select-solid" data-control="select2" name="e_uw" id="e_uw" data-placeholder="Pilih underwriting" data-allow-clear="true">
                                                    <option></option>
                                                    @foreach ($e_uw as $key => $data)
                                                        <option value="{{ $data->kode }}">{{ $data->nama }}</option>
                                                    @endforeach
                                                </select> --}}
                                                <input type="text" class="form-control form-control-solid" name="mpol_mpuw_nomor" id="mpol_mpuw_nomor" placeholder="mpol_mpuw_nomor" />
                                            </div>
                                        </div>
                                        <span class="text-danger error-text e_uw_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <button type="button" id="importUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                        <button type="button" id="lihatUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
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
                                        <button type="button" id="lihatDocSoc" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
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
@endsection

@section('script')
    <script>
        $(document).ready(function() {
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

            // setHide
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

            cekForm(0);
            //setHideMessage
            // change message Form SOC
            hidePesan('msoc_jenis_bayar');
            hidePesan('msoc_mslr_kode');
            hidePesan('msoc_dok');
            // Form Upload Tarif
            hidePesan('mth_tipe_pertanggungan');
            hidePesan('mth_ket');
            hidePesan('mth_tipe_rumus');
            hidePesan('mth_kolom');
            hidePesan('mth_baris');
            hidePesan('mth_file');
            // Form Update Upload Tarif
            hidePesan('mth_final');
            // Form Upload Uw
            hidePesan('mpuw_tipe_pertanggungan');
            hidePesan('mpuw_nama');
            hidePesan('mpuw_type_uw');
            hidePesan('mpuw_baris');
            hidePesan('mpuw_file');
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
                reSelGrid('mpol_msoc_kode','{{ url("api/tehnik/polis/entry-master-polis/lod_soc") }}' + '?pmgpolis=' + getText("mpol_mrkn_kode"));
            });

            selectGrid('mpol_msoc_kode', 'GET', '{{ url("api/tehnik/polis/entry-master-polis/lod_soc") }}', 'msoc_kode', 'msoc_kode', [
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
                console.log(kode);
                // reSelGrid('mpol_msoc_kode','{{ url("api/tehnik/polis/entry-master-polis/lod_soc") }}' + '?pmgpolis=' + getText("mpol_mrkn_kode"));
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

            selectGrid('e_jenisprod', 'GET', '{{ url("tehnik/polis/entry-master-polis/lod_mpid") }}', 'mpid_kode', 'mpid_nama', [
                {field:'mpid_kode',title:'Kode',width:120},
                {field:'mpid_nama',title:'Jenis Produk',width:300},
            ], function(i, row) {
                hidePesan('e_jenisprod');
				// setText("e_jenisprod",row.e_jenisprod);
            });

            selectSideMt('mpol_mprov_berlaku', '{{ url("api/utility/menu/select-tipemenu") }}', function(d) { return {
                id: d.wmt_kode,
                text: d.wmt_nama
            }}, function(e) {
                var data = e.params.data.id;
                console.log(data);
            });

            // onSelect('msoc_jns_perusahaan', function(e) {
            //     var row = e.params.data;
            //     cekpolis();
            // });

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


        function cekForm(tipe) {
            clear_f();
            if (tipe=='0') {
                $('#btnBru').addClass('active');
                $('#btnEds').removeClass('active');
                $('#btnEdsBr').removeClass('active');
                $('#btnEdt').removeClass('active');
                $('#btnBtl').removeClass('active');
                toster('success', 'Tombol Polis Baru Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Baru');

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
                $('#btnEdt').addClass('active');
                $('#btnBru').removeClass('active');
                $('#btnEds').removeClass('active');
                $('#btnEdsBr').removeClass('active');
                $('#btnBtl').removeClass('active');
                toster('success', 'Tombol Polis Edit Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Edit');

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
                $('#btnEds').addClass('active');
                $('#btnEdsBr').removeClass('active');
                $('#btnBru').removeClass('active');
                $('#btnEdt').removeClass('active');
                $('#btnBtl').removeClass('active');
                toster('success', 'Tombol Polis Endors Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Endors');

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
                $('#btnBtl').addClass('active');
                $('#btnBru').removeClass('active');
                $('#btnEdt').removeClass('active');
                $('#btnEds').removeClass('active');
                $('#btnEdsBr').removeClass('active');
                toster('success', 'Tombol Polis Batal Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Batal');

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
                $('#btnEdsBr').addClass('active');
                $('#btnBru').removeClass('active');
                $('#btnEdt').removeClass('active');
                $('#btnEds').removeClass('active');
                $('#btnBtl').removeClass('active');
                toster('success', 'Tombol Polis Endors Baru Telah Aktif', 5000, 2);
                titleAction('title_action', 'Polis Endors Baru');

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
            reSelGrid('mpol_mrkn_nama','{{ url("tehnik/polis/entry-master-polis/lod_pmg_polis") }}' + '?tipe=' + tipe);
        }

        function setReadEdit(sts) {
            setTextReadOnly("mpol_mjns_kode",sts);
            setTextReadOnly("mpol_tgl_terbit",sts);
            setTextReadOnly("mpol_tgl_awal_polis",sts);
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

        function clear_f() {
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

			setText("mpol_endos","0");
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

        // function e_pras() {
        //     setTextReadOnly('e_pras', false);
        //     setTextReadOnly('msoc_mpras_kode',false);
        //     setTextReadOnly('msoc_mrkn_nama',false);
        //     setTextReadOnly('msoc_mrkn_kode',false);
        //     setTextReadOnly('e_nasabah',false);
        //     setTextReadOnly('msoc_mspaj_nama',false);
        //     setTextReadOnly('msoc_mft_kode',false);
        //     setTextReadOnly('e_manfaat',false);
        //     setTextReadOnly('e_manfaat_pol',false);
        //     setTextReadOnly('msoc_mssp_nama',false);
        //     setTextReadOnly('msoc_jenis_bayar',false);
        //     setTextReadOnly('msoc_mekanisme',false);
        // }

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

        function showTarifTable(idTable, kode) {
            dtTable(
                idTable,
                false,
                "{{ url('api/tehnik/soc/entry-soc/lihat-tarif') }}" + "/" + kode,
                [
                    { data: "DT_RowIndex", className: "text-center" },
                    { data: "mstuj_1", className: "text-center" },
                    { data: "mstuj_2", className: "text-center" },
                    { data: "mstuj_3", className: "text-center" },
                    { data: "mstuj_4", className: "text-center" },
                    { data: "mstuj_5", className: "text-center" },
                    { data: "mstuj_6", className: "text-center" },
                    { data: "mstuj_7", className: "text-center" },
                    { data: "mstuj_8", className: "text-center" },
                    { data: "mstuj_9", className: "text-center" },
                    { data: "mstuj_10", className: "text-center" },
                    { data: "mstuj_11", className: "text-center" },
                    { data: "mstuj_12", className: "text-center" },
                    { data: "mstuj_13", className: "text-center" },
                    { data: "mstuj_14", className: "text-center" },
                    { data: "mstuj_15", className: "text-center" },
                    { data: "mstuj_16", className: "text-center" },
                    { data: "mstuj_17", className: "text-center" },
                    { data: "mstuj_18", className: "text-center" },
                    { data: "mstuj_19", className: "text-center" },
                    { data: "mstuj_20", className: "text-center" },
                    { data: "mstuj_21", className: "text-center" },
                    { data: "mstuj_22", className: "text-center" },
                    { data: "mstuj_23", className: "text-center" },
                    { data: "mstuj_24", className: "text-center" },
                    { data: "mstuj_25", className: "text-center" },
                    { data: "mstuj_26", className: "text-center" },
                    { data: "mstuj_27", className: "text-center" },
                    { data: "mstuj_28", className: "text-center" },
                    { data: "mstuj_29", className: "text-center" },
                    { data: "mstuj_30", className: "text-center" },
                    { data: "mstuj_31", className: "text-center" },
                    { data: "mstuj_32", className: "text-center" },
                    { data: "mstuj_33", className: "text-center" },
                    { data: "mstuj_34", className: "text-center" },
                    { data: "mstuj_35", className: "text-center" },
                    { data: "mstuj_36", className: "text-center" },
                    { data: "mstuj_37", className: "text-center" },
                    { data: "mstuj_38", className: "text-center" },
                    { data: "mstuj_39", className: "text-center" },
                    { data: "mstuj_40", className: "text-center" },
                    { data: "mstuj_41", className: "text-center" },
                    { data: "mstuj_42", className: "text-center" },
                    { data: "mstuj_43", className: "text-center" },
                    { data: "mstuj_44", className: "text-center" },
                    { data: "mstuj_45", className: "text-center" },
                    { data: "mstuj_46", className: "text-center" },
                    { data: "mstuj_47", className: "text-center" },
                    { data: "mstuj_48", className: "text-center" },
                    { data: "mstuj_49", className: "text-center" },
                    { data: "mstuj_50", className: "text-center" },
                    { data: "mstuj_51", className: "text-center" },
                    { data: "mstuj_52", className: "text-center" },
                    { data: "mstuj_53", className: "text-center" },
                    { data: "mstuj_54", className: "text-center" },
                    { data: "mstuj_55", className: "text-center" },
                    { data: "mstuj_56", className: "text-center" },
                    { data: "mstuj_57", className: "text-center" },
                    { data: "mstuj_58", className: "text-center" },
                    { data: "mstuj_59", className: "text-center" },
                    { data: "mstuj_60", className: "text-center" },
                    { data: "mstuj_61", className: "text-center" },
                    { data: "mstuj_62", className: "text-center" },
                    { data: "mstuj_63", className: "text-center" },
                    { data: "mstuj_64", className: "text-center" },
                    { data: "mstuj_65", className: "text-center" },
                    { data: "mstuj_66", className: "text-center" },
                    { data: "mstuj_67", className: "text-center" },
                    { data: "mstuj_68", className: "text-center" },
                    { data: "mstuj_69", className: "text-center" },
                    { data: "mstuj_70", className: "text-center" },
                    // { data: "mstuj_71", className: "text-center" },
                    // { data: "mstuj_72", className: "text-center" },
                    // { data: "mstuj_73", className: "text-center" },
                    // { data: "mstuj_74", className: "text-center" },
                    // { data: "mstuj_75", className: "text-center" },
                    // { data: "mstuj_76", className: "text-center" },
                    // { data: "mstuj_77", className: "text-center" },
                    // { data: "mstuj_78", className: "text-center" },
                    // { data: "mstuj_79", className: "text-center" },
                    // { data: "mstuj_80", className: "text-center" },
                    // { data: "mstuj_81", className: "text-center" },
                    // { data: "mstuj_82", className: "text-center" },
                    // { data: "mstuj_83", className: "text-center" },
                    // { data: "mstuj_84", className: "text-center" },
                    // { data: "mstuj_85", className: "text-center" },
                    // { data: "mstuj_86", className: "text-center" },
                ],
                [0, 'asc'],
            );
        }

        function showUwTable(idTable, kode) {
            dtTable(
                idTable,
                false,
                "{{ url('api/tehnik/soc/entry-soc/lihat-uw') }}" + "/" + kode,
                [
                    { data: "mrmp_urut", className: "text-center" },
                    { data: "mrmp_tipe_peserta", className: "text-center" },
                    { data: "mrmp_ket1", className: "text-center" },
                    { data: "mrmp_ket2", className: "text-left" },
                    { data: "mrmp_min_umur", className: "text-center" },
                    { data: "mrmp_max_umur", className: "text-center" },
                    { data: "mrmp_total_min", className: "text-center" },
                    { data: "mrmp_total_max", className: "text-center" },
                    { data: "mrmp_xn_max", className: "text-center" },
                ],
                [0, 'asc'],
            );
        }
    </script>
@endsection
