@if (__getHak("sjab_soc")!="1")
    @include('layouts.repage')
@else
    @extends('layouts.main-admin')
    @section('title')
        Entry Tarif/Uw Soc Lokasi Khusus
    @endsection

    @section('content')
        <div class="card mb-5 mb-xxl-10">

            <div class="card-header">
                <div class="card-title">
                    <span class="badge badge-warning" id="title_action">Buat SOC Baru</span>
                </div>

                <div class="card-toolbar">
                    <div class="input-group input-group-solid">
                        <button type="button" id="btnBru" class="btn btn-light-primary active" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" onclick="cekForm(0)">Baru</button>
                        {{-- <button type="button" id="btnEdt" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Edit" onclick="cekForm(1)">Edit</button> --}}
                        <button type="button" id="btnBtl" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Batal" onclick="cekForm(3)">Batal</button>
                    </div>
                </div>
            </div>

            <form id="frxx_soc_khusus" name="frxx_soc_khusus" class="form-mixs" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body py-10">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="required form-label">Nama Pemegang Polis</label>
                                <input type="text" class="easyui-combogrid" name="msoc_mrkn_nama" id="msoc_mrkn_nama" data-options="prompt:'Pilih pemegang polis'" style="width: 100%; height: 38px;" />
                                <input type="text" class="form-control form-control-solid" name="msoc_mrkn_kode" id="msoc_mrkn_kode" placeholder="msoc_mrkn_kode" />
                                <span class="text-danger error-text msoc_mrkn_nama_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Nasabah Bank/Peserta</label>
                                <input type="text" class="easyui-combogrid" name="e_nasabah" id="e_nasabah" data-options="prompt:'Pilih nasabah bank'" style="width: 100%; height: 38px;" />
                                <input type="text" class="form-control form-control-solid" name="e_bersih" id="e_bersih" placeholder="e_bersih" />
                                <input type="text" class="form-control form-control-solid" name="msoc_mjns_kode" id="msoc_mjns_kode" placeholder="msoc_mjns_kode" />
                                <span class="text-danger error-text e_nasabah_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Segmen Pasar</label>
                                <input type="text" class="easyui-combobox inputCombo" name="msoc_mssp_nama" id="msoc_mssp_nama" data-options="prompt:'Pilih segmen pasar'" style="width: 100%; height: 38px;" />
                                <input type="text" class="form-control form-control-solid" name="msoc_mssp_kode" id="msoc_mssp_kode" placeholder="msoc_mssp_kode" />
                                <input type="text" class="form-control form-control-solid" name="mpid_mssp_kode" id="mpid_mssp_kode" placeholder="mpid_mssp_kode" />
                                <span class="text-danger error-text msoc_mssp_nama_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5">
                                <label class="required form-label">Mekanisme 1 (Umum)</label>
                                <select class="easyui-combobox" name="msoc_mekanisme" id="msoc_mekanisme" data-options="prompt:'Pilih mkanisme 1', onSelect: function(rec) { hidePesan('msoc_mekanisme'); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih mkanisme 1</option>
                                    {{ optSql("SELECT mkm_kode kode,mkm_nama nama FROM emst.mst_mekanisme ORDER BY 1", "kode", "nama") }}
                                </select>
                                {{-- <input type="text" class="easyui-combobox" name="msoc_mekanisme" id="msoc_mekanisme" data-options="prompt:'Pilih mkanisme 1'" style="width: 100%; height: 38px;" /> --}}
                                <span class="text-danger error-text msoc_mekanisme_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5">
                                <label class="required form-label">Mekanisme 2 (Penutupan)</label>
                                <select class="easyui-combobox" name="msoc_mekanisme2" id="msoc_mekanisme2" data-options="prompt:'Pilih mkanisme 2', onSelect: function(rec) { hidePesan('msoc_mekanisme2'); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih mkanisme 2</option>
                                    {{ optSql("SELECT mkm_kode2 kode,mkm_ket2 nama FROM emst.mst_mekanisme2 ORDER BY 1", "kode", "nama") }}
                                </select>
                                {{-- <input type="text" class="easyui-combobox" name="msoc_mekanisme2" id="msoc_mekanisme2" data-options="prompt:'Pilih mkanisme 2'" style="width: 100%; height: 38px;" /> --}}
                                <span class="text-danger error-text msoc_mekanisme2_err"></span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="mb-5">
                                <label class="required form-label">Manfaat Asuransi</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <select class="easyui-combobox" name="msoc_mft_kode" id="msoc_mft_kode" data-options="prompt:'Pilih manfaat asuransi', onSelect: function(rec) { hidePesan('msoc_mft_kode'); }" style="width: 100%; height: 38px;">
                                                <option selected disabled>Pilih manfaat asuransi</option>
                                                {{ optSql("SELECT mft_kode kode,mft_nama nama FROM emst.mst_manfaat_plafond ORDER BY 1", "kode", "nama") }}
                                            </select>
                                            <span class="text-danger error-text msoc_mft_kode_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <input type="text" class="form-control form-control-solid me-5" name="msotd_pk" id="msotd_pk" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5">
                                <label class="required form-label">Pembayaran Kontribusi</label>
                                <select class="easyui-combobox" name="msoc_jenis_bayar" id="msoc_jenis_bayar" data-options="prompt:'Pilih kontribusi', onSelect: function(rec) { hidePesan('msoc_jenis_bayar'); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih kontribusi</option>
                                    <option value="0">Sekaligus</option>
                                    <option value="1">Per Tahun</option>
                                    <option value="2">Per Bulan</option>
                                </select>
                                <input type="text" class="form-control form-control-solid" name="endors" id="endors" placeholder="endors" />
                                <span class="text-danger error-text msoc_jenis_bayar_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5">
                                <label class="required form-label">Jenis Pekerjaan</label>
                                <select class="easyui-combobox" name="msoc_jns_perusahaan" id="msoc_jns_perusahaan" data-options="prompt:'Pilih jenis pekerjaan', onSelect: function(rec) { hidePesan('msoc_jns_perusahaan'); cekpolis(); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih jenis pekerjaan</option>
                                    {{ optSql("SELECT mker_kode kode,mker_nama ket FROM emst.mst_pekerjaan ORDER BY 1", "kode", "ket") }}
                                </select>
                                <span class="text-danger error-text msoc_jns_perusahaan_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5">
                                <label class="required form-label">Jaminan Asuransi</label>
                                <input type="text" class="easyui-combogrid" name="e_manfaat" id="e_manfaat" data-options="prompt:'Pilih jaminan asuransi'" style="width: 100%; height: 38px;" />
                                <input type="text" class="form-control form-control-solid" name="msoc_mjm_kode" id="msoc_mjm_kode" placeholder="msoc_mjm_kode" />
                                <span class="text-danger error-text e_manfaat_err"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-5">
                                <label class="required form-label">Jenis Produk</label>
                                <input type="text" class="form-control form-control-solid" name="mpid_nama" id="mpid_nama" placeholder="jenis produk" />
                                <input type="text" class="form-control form-control-solid" name="msoc_mpid_kode" id="msoc_mpid_kode" placeholder="msoc_mpid_kode" />
                                <input type="text" class="form-control form-control-solid" name="msoc_mjns_mpid_kode" id="msoc_mjns_mpid_kode" placeholder="msoc_mjns_mpid_kode" />
                                <span class="text-danger error-text mpid_nama_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Jenis Ketentuan</label>
                                <select class="easyui-combobox" name="msotd_tipe" id="msotd_tipe" data-options="prompt:'Pilih jenis ketentuan', onSelect: function(rec) { editsoc(rec); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih jenis ketentuan</option>
                                    <option value="0">CABANG</option>
                                    <option value="1">KC/P REKANAN</option>
                                    <option value="2">SELURUH CABANG AL AMIN</option>
                                    <option value="3">JENIS PEKERJAAN</option>
                                    <option value="4">NAMA PERUSAHAN</option>
                                    <option value="5">STATUS FC ALL CABANG AL AMIN</option>
                                    <option value="6">ESEPSI KHUSUS SEMNTARA</option>
                                </select>
                                <span class="text-danger error-text msotd_tipe_err"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-5">
                                        <label class="form-label">Pilih Beberapa Lokasi</label>
                                        <select class="form-select form-select-solid" name="buka_o_cab[]" id="buka_o_cab" data-control="select2" data-placeholder="Pilih cabang" data-allow-clear="true" multiple="multiple"></select>
                                        <span class="text-danger error-text buka_o_cab_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-5">
                                        <label class="form-label" id="titlePilihCab">Pilih Cabang</label>
                                        <input type="text" class="easyui-combogrid" name="e_cabalamin" id="e_cabalamin" data-options="prompt:'Pilih cabang alamin'" style="width: 100%; height: 38px;" />
                                        <span class="text-danger error-text e_cabalamin_err"></span>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="mb-5">
                                        <label class="form-label">Kode</label>
                                        <input type="text" class="form-control form-control-solid" name="msotd_mlok_kode" id="msotd_mlok_kode" />
                                        <span class="text-danger error-text msotd_mlok_kode_err"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Jenis Perusahaan</label>
                                <input type="text" class="easyui-combogrid" name="e_perush" id="e_perush" data-options="prompt:'Pilih jenis perusahaan'" style="width: 100%; height: 38px;" />
                                <span class="text-danger error-text e_perush_err"></span>
                            </div>
                        </div> --}}
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="required form-label">Program Asuransi</label>
                                <input type="text" class="easyui-combogrid" name="e_pras" id="e_pras" data-options="prompt:'Pilih program asuransi'" style="width: 100%; height: 38px;" />
                                <input type="text" class="form-control form-control-solid" name="msoc_mpras_kode" id="msoc_mpras_kode" placeholder="msoc_mpras_kode" />
                                <label class="required form-label">Urutan Nomor filter/penyaringan harus benar !</label></br>
                                <span class="text-danger error-text e_pras_err"></span>
                            </div>
                        </div>
                    </div>

                    <div class="separator my-10"></div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Nomor SOC</label>
                                <input type="text" class="form-control form-control-solid" name="msotd_msoc_nomor" id="msotd_msoc_nomor" placeholder="Nomor SOC" />
                                <span class="text-danger error-text msotd_msoc_nomor_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Kode SOC</label>
                                <input type="text" class="form-control form-control-solid" name="msotd_msoc_kode" id="msotd_msoc_kode" placeholder="Kode SOC" />
                                <span class="text-danger error-text msotd_msoc_kode_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5">
                                <label class="required form-label">Status Soc Khusus</label>
                                <select class="easyui-combobox" name="msotd_status" id="msotd_status" data-options="prompt:'Pilih status', onSelect: function(rec) { editsoc(rec); hidePesan('msotd_status'); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih status</option>
                                    <option value="0">AKTIF</option>
                                    <option value="1">BATAL</option>
                                </select>
                                <span class="text-danger error-text msotd_status_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Ketentuan Khusus</label>
                                <select class="easyui-combobox" name="msotd_ketentuan" id="msotd_ketentuan" data-options="prompt:'Pilih ketentuan khusus', onSelect: function(rec) { editsoc(rec); hidePesan('msotd_ketentuan'); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih ketentuan khusus</option>
                                    <option value="0">TARIF & UW</option>
                                    <option value="1">TARIF, UW, UJRAH, FEEBASE & DISC RATE</option>
                                    <option value="2">TARIF, UJRAH,FEEBASE & DISC RATE</option>
                                    <option value="3">TARIF, FEEBASE & DISC RATE</option>
                                    <option value="4">TARIF & DISC RATE</option>
                                    <option value="5">TARIF, UW, UJRAH & DISC RATE</option>
                                    <option value="6">TARIF, UW, UJRAH & FEE BASE</option>
                                </select>
                                <span class="text-danger error-text msotd_ketentuan_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5">
                                <label class="required form-label">Soc Berlaku</label>
                                <select class="easyui-combobox" name="msotd_berlaku" id="msotd_berlaku" data-options="prompt:'Pilih soc berlaku', onSelect: function(rec) { cekberlaku(rec); hidePesan('msotd_berlaku'); }" style="width: 100%; height: 38px;">
                                    <option selected disabled>Pilih soc berlaku</option>
                                    <option value="1">BERJANGKA</option>
                                </select>
                                <span class="text-danger error-text msotd_berlaku_err"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="required form-label">Periode Berlaku</label>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-5">
                                        <div class="input-group input-group-solid flex-nowrap">
                                            <div class="overflow-hidden flex-grow-1">
                                                <input type="date" class="form-control form-control-solid dateflatpickr" name="msotd_tgl1" id="msotd_tgl1" placeholder="Tanggal Awal" />
                                                <span class="text-danger error-text msotd_tgl1_err"></span>
                                            </div>
                                            <span class="input-group-text">s/d</span>
                                            <div class="overflow-hidden flex-grow-1">
                                                <input type="date" class="form-control form-control-solid dateflatpickr" name="msotd_tgl2" id="msotd_tgl2" placeholder="Tanggal Akhir" />
                                                <span class="text-danger error-text msotd_tgl2_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5">
                                <label class="required form-label">Disc Rate</label>
                                <div class="input-group input-group-solid flex-nowrap">
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="text" class="form-control form-control-solid" name="msotd_mdr_persen" id="msotd_mdr_persen" placeholder="Dist rate" />
                                        <span class="text-danger error-text msotd_mdr_persen_err"></span>
                                    </div>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5">
                                <label class="required form-label">Berlaku</label>
                                <select class="form-select form-select-solid" data-control="select2" name="msotd_mdr_berlaku" id="msotd_mdr_berlaku" data-placeholder="Berlaku">
                                    <option></option>
                                    <option value="0">Ganti yg asli</option>
                                    <option value="1">Bertingkat</option>
                                </select>
                                <span class="text-danger error-text msotd_mdr_berlaku_err"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5">
                                <label class="required form-label">Ujrah</label>
                                <div class="input-group input-group-solid flex-nowrap">
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="text" class="form-control form-control-solid" name="msotd_mujh_persen" id="msotd_mujh_persen" placeholder="Ujrah" />
                                        <span class="text-danger error-text msotd_mujh_persen_err"></span>
                                    </div>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-5">
                                <label class="required form-label">Fee Base Tidak Potong</label>
                                <div class="input-group input-group-solid flex-nowrap">
                                    <div class="overflow-hidden flex-grow-1">
                                        <input type="text" class="form-control form-control-solid" name="msotd_mfee_persen" id="msotd_mfee_persen" placeholder="Fee base tidak potong" />
                                        <span class="text-danger error-text msotd_mfee_persen_err"></span>
                                    </div>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="required form-label">Import Tarif</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-5">
                                            <select class="form-select form-select-solid" data-control="select2" name="msotd_jenis_tarif" id="msotd_jenis_tarif" data-placeholder="Pilih">
                                                <option></option>
                                                <option value="0">Usia</option>
                                                <option value="1">Masa</option>
                                            </select>
                                            <span class="text-danger error-text msotd_jenis_tarif_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <input type="text" class="easyui-combogrid" name="e_tarif" id="e_tarif" data-options="prompt:'Pilih jenis tarif'" style="width: 100%; height: 38px;" />
                                            <input type="text" class="form-control form-control-solid" name="msotd_mth_nomor" id="msotd_mth_nomor" placeholder="msotd_mth_nomor" />
                                            <span class="text-danger error-text e_tarif_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-5">
                                            <div class="input-group">
                                                <button type="button" id="importTarifKhusus" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                                <button type="button" id="lihatTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="required form-label">Import Underwriting</label>
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="mb-5">
                                            <select class="form-select form-select-solid" data-control="select2" name="msotd_tipe_uw" id="msotd_tipe_uw" data-placeholder="Pilih">
                                                <option></option>
                                                <option value="0">Usia</option>
                                                <option value="1">X+N</option>
                                            </select>
                                            <span class="text-danger error-text msotd_tipe_uw_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <input type="text" class="easyui-combogrid" name="e_uw" id="e_uw" data-options="prompt:'Pilih jenis underwriting'" style="width: 100%; height: 38px;" />
                                            <input type="text" class="form-control form-control-solid" name="msotd_mpuw_nomor" id="msotd_mpuw_nomor" placeholder="msotd_mpuw_nomor" />
                                            <span class="text-danger error-text e_uw_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-5">
                                            <div class="input-group">
                                                <button type="button" id="importUwKhusus" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                                <button type="button" id="lihatUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                            </div>
                                        </div>
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

        @include('pages.tehnik.soc.entrytarifuw-lokasikhusus.modal.import-tarifkhusus')
        @include('pages.tehnik.soc.entrytarifuw-lokasikhusus.modal.ski-tarifkhusus')
        @include('pages.tehnik.soc.entrytarifuw-lokasikhusus.modal.lihat-tarifkhusus')

        @include('pages.tehnik.soc.entrytarifuw-lokasikhusus.modal.import-uwkhusus')
        @include('pages.tehnik.soc.entrytarifuw-lokasikhusus.modal.ski-uwkhusus')
        @include('pages.tehnik.soc.entrytarifuw-lokasikhusus.modal.lihat-wukhusus')
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                setTextReadOnly('mpid_nama', true);
                setTextReadOnly('e_pinca', true);
                setTextReadOnly('msoc_nomor', true);
                setTextReadOnly('msoc_kode', true);
                selectOpTag('mth_kolom');
                selectOpTag('mth_baris');
                selectOpTag('mpuw_baris');

                cekForm(0);
                buka_o_cab('{{ url("tehnik/soc/entry-tarifuw-soc/lod_ocab") }}');
            });

            $(function () {
                $.ajaxSetup({
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                });

                selectGrid('msoc_mrkn_nama', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_pmg_polis") }}', 'nama', 'nama', [
                    {field:'kode',title:'Kode',align:'left',width:180},
                    {field:'nama',title:'Nama',align:'left',width:280},
                ], function(i, row) {
                    hidePesan('msoc_mrkn_nama');
                    var kode = row.kode;
                    setText('msoc_mrkn_kode', kode);
                    // reSelGrid("e_cabalamin",'{{ url("tehnik/soc/entry-tarifuw-soc/lod_Cabang_polis") }}' + '?pmgpolis='+getText("msoc_mrkn_kode"));
                    // if (getText('msotd_msoc_nomor')=='') {
                    //     setText('msoc_mrkn_kode', kode);
                    //     bersih(2);
                    //     bersih(1);
                    // }
                });
                selectGrid('e_nasabah', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_nasabah") }}', 'mjns_kode', 'mjns_keterangan', [
                    {field:'mjns_keterangan',title:'Jenis Nasabah',align:'left',width:280},
                    {field:'mjns_kode',title:'Kode Jns Nasabah',width:50,hidden:true},
                    {field:'mjns_jl',title:'Joint Life',width:80,hidden:true},
                    {field:'mjns_jl_pst',title:'Joint Life Peserta',width:80,hidden:true},
                    {field:'mjns_jl_pas',title:'Joint Life Pasangan',width:80,hidden:true},
                    {field:'mjns_wp_pens',title:'WP Pensiun',width:80,hidden:true},
                    {field:'mjns_phk_pens',title:'PHK Pensiun',width:80,hidden:true},
                ], function(i, row) {
                    hidePesan('e_nasabah');
                    setText('msoc_mjns_kode', row.mjns_kode);
                    setText('msoc_mjns_mpid_kode', row.mjns_mpid_nomor);

                    setText('msoc_mssp_nama', '');
                    reSelBox('msoc_mssp_nama', '{{ url("tehnik/soc/entry-tarifuw-soc/grd_segmen") }}' + '?' + '&mjns=' + getText("e_nasabah"));

                    var rms = '&mjns='+getText("msoc_mjns_kode")+'&mft='+getText("msoc_mft_kode")+'&mrkn='+getText("msoc_mrkn_kode")+'&mssp='+getText("msoc_mssp_kode")+'&mkm='+getText("msoc_mekanisme")+'&mkm2='+getText("msoc_mekanisme2")+'&perush='+getText("msoc_jns_perusahaan")+'&byr='+getText("msoc_jenis_bayar")+'&mjm='+getText("msoc_mjm_kode")+'&mpid='+getText("msoc_mpid_kode");

                    reSelGrid('e_pras', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_prassoc") }}' + '?' + rms);
                });
                selectBox('msoc_mssp_nama', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/grd_segmen") }}', 'value', 'text', function(rec) {
                    hidePesan('msoc_mssp_nama');
                    setsegmen(rec);
                }, 'groupx');
                selectGrid('e_manfaat', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_manfaat") }}', 'mjm_kode', 'mjm_nama', [
                    {field:'mjm_nama',title:'Manfaat',align:'left',width:80},
                    {field:'mpid_nama',title:'Produk Induk',align:'left',width:280},
                    {field:'mjm_kode',title:'Kode',width:60,hidden:true},
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
                    setText('msoc_mjm_kode', row.mjm_kode);
                    setText('msoc_mpid_kode', row.mpid_kode);
                    setText('mpid_nama', row.mpid_nama);

                    var rms = '&mjns='+getText("msoc_mjns_kode")+'&mft='+getText("msoc_mft_kode")+'&mrkn='+getText("msoc_mrkn_kode")+'&mssp='+getText("msoc_mssp_kode")+'&mkm='+getText("msoc_mekanisme")+'&mkm2='+getText("msoc_mekanisme2")+'&perush='+getText("msoc_jns_perusahaan")+'&byr='+getText("msoc_jenis_bayar")+'&mjm='+getText("msoc_mjm_kode")+'&mpid='+getText("msoc_mpid_kode");

                    reSelGrid('e_pras', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_prassoc") }}' + '?' + rms);

                    muncul(row.mjm_bundling,row.mjm_jiwa,row.mjm_gu,row.mjm_phk,row.mjm_tlo,row.mjm_fire,row.mjm_wp,row.mjm_umut,row.mjm_wp_pensiun,row.mjm_phk_pensiun);
                });
                selectGrid('e_pras', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_prassoc") }}', 'mpras_kode', 'mpras_nama', [
                    {field:'mpras_nama',title:'Program Asuransi',align:'left',width:280},
                    {field:'msoc_kode',title:'Nomor SOC',align:'left',width:280},
                    {field:'mpras_kode',title:'Kode Program Asuransi',width:50,hidden:false},
                    {field:'mpras_uptambah',title:'UP Tambahan',width:80,hidden:false},
                    {field:'mpras_ujrah_referal',title:'Ujrah Referal',width:80,hidden:false},
                    {field:'mpras_disc_rate',title:'Discount Rate',width:50,hidden:false},
                    {field:'mpras_mmft_kode_jiwa',title:'Tambahan Jiwa',width:50,hidden:false},
                ], function(i, row) {
                    hidePesan('e_pras');
                    var kode_soc = row.msoc_kode;
                    setText('msoc_mpras_kode', row.mpras_kode);
                    setText("msotd_msoc_kode", kode_soc);
                    muncul1(row.mpras_uptambah,row.mpras_ujrah_referal,row.mpras_discrate,row.mpras_mmft_kode_jiwa);
                    e_leave('msotd_pk');
                });
                selectGrid('e_cabalamin', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_cabalamin") }}', 'kode', 'nama', [
                    {field:'kode',title:'Kode Cabang',width:60},
                    {field:'nama',title:'Nama Cabang',align:'left',width:150},
                ], function(i, row) {
                    setText('msotd_mlok_kode', getText('e_cabalamin'));
                    e_leave("msotd_pk");
                });
                // selectGrid('e_marketing', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_marketing") }}', 'kode', 'nama', [
                //     {field:'kode',title:'NIP',width:60},
                //     {field:'nama',title:'Nama Marketing',align:'left',width:280},
                //     {field:'skar_komisi',title:'Tipe Komisi',width:50,hidden:true},
                //     {field:'skar_overreding',title:'Tipe Overreding',width:50,hidden:true},
                // ], function(i, row) {
                //     hidePesan('e_marketing');
                //     var kode = row.kode;
                //     setText("msoc_mkar_kode_mkr",kode);
                //     muncul4(row.skar_komisi,row.skar_overreding);
                // });
                selectGrid('e_tarif', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_tarif") }}', 'kode', 'nama', [
                    {field:'kode',title:'Kode tarif',width:75},
                    {field:'nama',title:'Keterangan',align:'left',width:300},
                ], function(i, row) {
                    hidePesan('e_tarif');
				    setText("msotd_mth_nomor", row.kode);
                });
                selectGrid('e_uw', 'GET', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_uw") }}', 'kode', 'nama', [
                    {field:'kode',title:'Kode',width:75},
                    {field:'nama',title:'Keterangan UW',align:'left',width:300},
                ], function(i, row) {
                    hidePesan('e_uw');
                    setText('msotd_mpuw_nomor', row.kode);
                });

                tombol('click', 'importTarifKhusus', function() {
                    openModal('modalUitKhusus');
                    titleAction('titleItKhusus', 'Upload File Table Tarif');
                    clearForm('frxx_uitKhusus');
                });

                tombol('click', 'lihatTarif', function() {
                    var kode = getText('msotd_mth_nomor');
                    if (kode !== "" && kode !== null) {
                        openModal('modalLihatTarif');
                        titleAction('titleLihatTarif', 'Table Tarif');
                        setAttr("#tbTarif", "src", "{{ url('api/tehnik/soc/entry-tarifuw-soc/rpt_lihattarif') }}" + "?nomor=" + kode);
                    } else {
                        message('error', 'Oops...', 'Pilih dulu ketentuan tarif!');
                    }
                });

                tombol('click', 'lihatUw', function() {
                    var kode = getText('msotd_mpuw_nomor');
                    if (kode !== "" && kode !== null) {
                        openModal('modalLihatUw');
                        titleAction('titleLihatUw', 'Table Underwriting');
                        setAttr("#tbUw", "src", "{{ url('api/tehnik/soc/entry-tarifuw-soc/rpt_lihat_uw') }}" + "?nomor=" + kode);
                    } else {
                        message('error', 'Oops...', 'Pilih dulu ketentuan underwriting!');
                    }
                });

                tombol('click', 'importUwKhusus', function() {
                    openModal('modalUwKhusus');
                    titleAction('titleUw', 'Upload File Table Uw');
                    clearForm('frxx_uiuKhusus');
                });

                submitForm("frxx_soc_khusus", "btn_simpan", "POST", "{{ url('tehnik/soc/entry-tarifuw-soc/simpan-sockhusus') }}" + "?id=formSocKhusus", (resSuccess) => {
                    var getEds = getText('endors');
                    cekForm(getEds);
                    bsimpan("btn_simpan", 'Simpan');
                }, (resError) => {
                    console.log(resError);
                });

                submitImport("frxx_uitKhusus", "btn_uitKhusus_simpan", "Apakah data yang di upload sudah benar?", "{{ url('api/tehnik/soc/entry-tarifuw-soc/upload-tarifkhusus') }}" + "?id=inputTK", "kode_skitk", (res) => {
                    clearForm("frxx_uitKhusus");
                    bsimpan('btn_uitKhusus_simpan', 'Simpan');
                    closeModal("modalUitKhusus");
                    openModal("modalSkiTarifKhusus");
                    titleAction("titleISkitKhusus", "Konfirmasi Tabel Tarif");
                    var kode = getText("kode_skitk");
                    setAttr("#showTbTarifKhusus", "src", "{{ url('api/tehnik/soc/entry-tarifuw-soc/rpt_lihattarif') }}" + "?nomor=" + kode);
                    reSelGrid('e_tarif', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_tarif") }}');
                });

                submitForm("frxx_skitKhusus", "btnSkitKhusus_simpan", "POST", "{{ url('api/tehnik/soc/entry-tarifuw-soc/update-tarifkhusus') }}" + "?id=updateTK", (resSukses) => {
                    clearForm("frxx_skitKhusus");
                    bsimpan('btnSkitKhusus_simpan', 'Simpan');
                    closeModal("modalSkiTarifKhusus");
                    reSelGrid('e_tarif', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_tarif") }}');
                });

                submitImport("frxx_uiuKhusus", "btn_uiuKhusus_simpan", "Apakah data yang di upload sudah benar?", "{{ url('api/tehnik/soc/entry-tarifuw-soc/upload-uwkhusus') }}" + "?id=inputUK", "kode_skiuk", (res) => {
                    clearForm("frxx_uiuKhusus");
                    bsimpan('btn_uiuKhusus_simpan', 'Simpan');
                    closeModal("modalUwKhusus");
                    openModal("modalSkiUwKhusus");
                    titleAction("titleISkiuKhusus", "Konfirmasi Tabel Underwriting");
                    var kode = getText("kode_skiuk");
                    setAttr("#showTbUwKhusus", "src", "{{ url('api/tehnik/soc/entry-tarifuw-soc/rpt_lihat_uw') }}" + "?nomor=" + kode);
                    reSelGrid('e_uw', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_uw") }}');
                });

                submitForm("frxx_skiuKhusus", "btnSkiuKhusus_simpan", "POST", "{{ url('api/tehnik/soc/entry-tarifuw-soc/update-uwkhusus') }}" + "?id=updateUK", (resSukses) => {
                    clearForm("frxx_skiuKhusus");
                    bsimpan('btnSkiuKhusus_simpan', 'Simpan');
                    closeModal("modalSkiUwKhusus");
                    reSelGrid('e_uw', '{{ url("tehnik/soc/entry-tarifuw-soc/lod_uw") }}');
                });
            });


            function cekForm(tipe) {
                clear_f();
                if (tipe=='0') {
                    adClass('btnBru', 'active');
                    rmClass('btnEds', 'active');
                    rmClass('btnEdt', 'active');
                    rmClass('btnBtl', 'active');
                    toster('success', 'Tombol Buat SOC Baru Telah Aktif', 5000, 2);
                    titleAction('title_action', 'Buat SOC Baru');
                }

                if (tipe=='3') {
                    adClass('btnBtl', 'active');
                    rmClass('btnBru', 'active');
                    rmClass('btnEdt', 'active');
                    rmClass('btnEds', 'active');
                    toster('success', 'Tombol SOC Batal Telah Aktif', 5000, 2);
                    titleAction('title_action', 'SOC Batal');
                }
                setText('endors',tipe);
            }

            function setsegmen(rec) {
                setText('msoc_mssp_kode', rec.value);
                reSelGrid('e_manfaat','{{ url("tehnik/soc/entry-tarifuw-soc/lod_manfaat") }}' + '?' + '&mssp=' + rec.value + '&mjns=' + getText("msoc_mjns_kode"));
            }

            function editsoc(rec) {
                reSelGrid("e_cabalamin",'{{ url("tehnik/soc/entry-tarifuw-soc/lod_cabalamin") }}' + '?mjns='+getText("msoc_mjns_kode"));
                if (rec.value==0) {
                    titleAction('titlePilihCab', 'Pilih Cabang');
                }
                if (rec.value==1) {
                    titleAction('titlePilihCab', 'Pilih KC/P Rekanan');
                    reSelGrid("e_cabalamin",'{{ url("tehnik/soc/entry-tarifuw-soc/lod_Cabang_polis") }}' + '?pmgpolis='+getText("msoc_mrkn_kode"));
                }
                if(rec.value==2) {
                    // e_leave("msotd_pk");
                    titleAction('titlePilihCab', 'Pilih Seluruh Cabang Al Amin');
                }
                if(rec.value==3) {
                    titleAction('titlePilihCab', 'Pilih Jenis Pekerjaan');
                    reSelGrid("e_cabalamin",'{{ url("tehnik/soc/entry-tarifuw-soc/lod_jnskerja") }}');
                }
                if(rec.value==4) {
                    titleAction('titlePilihCab', 'Pilih Nama Perusahaan');
                    reSelGrid("e_cabalamin",'{{ url("tehnik/soc/entry-tarifuw-soc/lod_perusahaansoc") }}');
                }
                if (rec.value==5) {
                    titleAction('titlePilihCab', 'Pilih Status Fc All Cab. Alamin');
                }
                if (rec.value==6) {
                    titleAction('titlePilihCab', 'Pilih Esepsi Khusus Sementara');
                }
            }

            function cekpolis() {
			    vv = { res : ''};
                rms = "pmgpolis="+getText("msoc_mrkn_kode")+"&perus="+getText("msoc_jns_perusahaan")+"&mekanisme2="+getText("msoc_mekanisme2")+"&mekanisme="+getText("msoc_mekanisme")+"&jns_bayar="+getText("msoc_jenis_bayar")+"&nasabah="+getText("msoc_mjns_kode")+"&mrkn_nama="+getText("msoc_mrkn_nama")+"&mft="+getText("msoc_mft_kode");

                url = '{{ url("tehnik/soc/entry-tarifuw-soc/get_nosoc") }}' + '?' + rms;
                getJson(url, vv, function(data) {
                    if (data) {
                        jsonForm('frxx_soc_khusus', data);
                    }
                });
            }

            function muncul(bandling,jiwa,gu,phk,tlo,fire,wp,umut,ujrf,discrate,wp_pens,phk_pens) {
                setTextReadOnly('msoc_mmft_kode_gu',true);
                if (gu=='1') {
                    setTextReadOnly('msoc_mmft_kode_gu',false);
                }

                setTextReadOnly('msoc_mmft_kode_wp_pensiun',false);
                if (wp_pens=='1') {
                    setTextReadOnly('msoc_mmft_kode_wp_pensiun',true);
                }

                setTextReadOnly('msoc_mmft_kode_wp_swasta',true);
                if (wp=='1') {
                    setTextReadOnly('msoc_mmft_kode_wp_swasta',false);
                }

                setTextReadOnly('msoc_mmft_kode_wp_pns',true);
                if (wp=='1') {
                    setTextReadOnly('msoc_mmft_kode_wp_pns',false);
                }

                setTextReadOnly('msoc_mmft_kode_phk_pensiun',false);
                if (phk_pens=='1') {
                    setTextReadOnly('msoc_mmft_kode_phk_pensiun',true);
                }

                setTextReadOnly('msoc_mmft_kode_phk_swasta',true);
                if (phk=='1') {
                    setTextReadOnly('msoc_mmft_kode_phk_swasta',false);
                }

                setTextReadOnly('msoc_mmft_kode_phk_pns',true);
                if (phk=='1') {
                    setTextReadOnly('msoc_mmft_kode_phk_pns',false);
                }

                setTextReadOnly('msoc_mmft_kode_tlo',true);
                if (tlo=='1') {
                    setTextReadOnly('msoc_mmft_kode_tlo',false);
                }

                setTextReadOnly('msoc_mmft_kode_fire',true);
                if (fire=='1') {
                    setTextReadOnly('msoc_mmft_kode_fire',false);
                }
            }

            function muncul1(uptambah,ujrah_referal,discrate,mmft_kode_jiwa) {
                setTextReadOnly('msoc_mmft_kode_jiwa',true);
                if (mmft_kode_jiwa=='1') {
                    setTextReadOnly('msoc_mmft_kode_jiwa',false);
                }

                setTextReadOnly('msoc_mut_kode',true);
                if (uptambah=='1') {
                    setTextReadOnly('msoc_mut_kode',false);
                }

                setTextReadOnly('msoc_mujhrf_kode',true);
                if (ujrah_referal=='1') {
                    setTextReadOnly('msoc_mujhrf_kode',false);
                }

                setTextReadOnly('msoc_mdr_kode',false);
                if (discrate=='1') {
                    setTextReadOnly('msoc_mdr_kode',true);
                }
            }

            function muncul4(skar_komisi,skar_overreding)
            {
                setTextReadOnly('msoc_mkom_persen', false);
                if (skar_komisi=='1') {
                    setTextReadOnly('msoc_mkom_persen', true);
                }
                setTextReadOnly('msoc_overreding', false);
                if (skar_overreding=='1') {
                    setTextReadOnly('msoc_overreding', true);
                }
            }

            function e_leave(id) {
                var vv='';
                var rms='';
                var url='';

                if (id=="msotd_pk") {
                    var tipe = getText("endors");
                    vv = { res : ''};
                    rms = "mlok="+getText("msotd_mlok_kode")+"&msoc="+getText("msotd_msoc_kode")+"&tipe="+getText("msotd_tipe");
                    url = '{{ url("tehnik/soc/entry-tarifuw-soc/get_kodesocdtluw") }}' + '?' + rms;
                    getJson(url,vv, function(data){
                        if (data) {
                            if (data.msotd_pk!="") {
                                jsonForm('frxx_soc_khusus', data);
                            }
                        }
                    });
                }

                if (id=='msotd_msoc_kode') {
                    var aksess = getText('edit_akses');
                    var tipe = getText('endors');
			        vv = { res : '' };
                    rms = "&pmgpolis="+getText("msoc_mrkn_kode")+"&nopolis="+getText("msotd_msoc_nomor")+"&nasabah="+getText("msoc_mjns_kode")+"&mft="+getText("msoc_mft_kode")+"&mjm="+getText("msoc_mjm_kode")+"&mekanisme="+getText("msoc_mekanisme")+"&jns_bayar="+getText("msoc_jenis_bayar")+"&jns_perusahaan="+getText("msoc_jns_perusahaan")+"&mrkn_nama="+getText("msoc_mrkn_nama")+"&mekanisme2="+getText("msoc_mekanisme2")+"&kode="+getText("msoc_kode")+"&pras="+getText("msoc_mpras_kode");

                    url = '{{ url("tehnik/soc/entry-tarifuw-soc/get_kodesoc") }}' + '?id=' + id + rms;
                    getJson(url, vv, function(data) {
                        // console.log(data);
                        if (data) {
                            if(tipe=="1" && data.msoc_mlsr_kode=="4") {
                                setTextReadOnly("msoc_mkom_persen",true);
                                setTextReadOnly("msoc_overreding",true);
                                setTextReadOnly("msoc_mmfe_persen",false);
                            }

                            if(tipe=="1" && data.msoc_mkar_kode_mkr=="1010003") {
                                setTextReadOnly("msoc_mkom_persen",true);
                                setTextReadOnly("msoc_overreding",true);
                                setTextReadOnly("msoc_mmfe_persen",true);
                            } else {
                                setTextReadOnly("msoc_mkom_persen",false);
                                setTextReadOnly("msoc_overreding",false);
                                setTextReadOnly("msoc_mmfe_persen",false);
                            }

                            if (data.msotd_msoc_kode!="" && tipe=="0") {
                                pesan("info", "Data sudah pernah di input dengan nomor: "+data.msotd_msoc_kode);
                                clear_f();
                            } else {
                                tanya();
                            }

                            if ( tipe!="0") {
                                setText("e_bersih","1");
                                jsonForm('frxx_soc_khusus', data);
                                setText("e_bersih","");
                                setReadEdit(true);
                            }
                        }
                    });
                }
            }

            function tanya() {
                if (getText('e_pras')=='1') {
                    setTextReadOnly('e_pras', true);
                    setTextReadOnly('msoc_mpras_kode',true);
                    setTextReadOnly('msoc_mrkn_nama',true);
                    setTextReadOnly('msoc_mrkn_kode',true);
                    setTextReadOnly('e_nasabah',true);
                    setTextReadOnly('msoc_mspaj_nama',true);
                    setTextReadOnly('msoc_mft_kode',true);
                    setTextReadOnly('e_manfaat',true);
                    setTextReadOnly('e_manfaat_pol',true);
                    setTextReadOnly('msoc_mssp_nama',true);
                    setTextReadOnly('msoc_jenis_bayar',true);
                    setTextReadOnly('msoc_mekanisme',true);
                    messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI ADALAH PROGRAM YANG TIDAK MEMBERIKAN KOMISI KEPADA PEMEGANG POLIS ?', (result) => {
                        if (result.isConfirmed) {
                            setTextReadOnly('e_pras', true);
                        } else if (result.isDenied) {
                            setTextReadOnly('e_pras', false);
                        }
                    });
                }

                if (getText('e_pras')=='2') {
                    setTextReadOnly('e_pras',true);
                    setTextReadOnly('msoc_mpras_kode',true);
                    setTextReadOnly('msoc_mrkn_nama',true);
                    setTextReadOnly('msoc_mrkn_kode',true);
                    setTextReadOnly('e_nasabah',true);
                    setTextReadOnly('e_manfaat_pol',true);
                    setTextReadOnly('msoc_mspaj_nama',true);
                    setTextReadOnly('msoc_mft_kode',true);
                    setTextReadOnly('e_manfaat',true);
                    setTextReadOnly('msoc_mssp_nama',true);
                    messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI MEMBERIKAN KOMISI KEPADA PEMEGANG POLIS ?', (result) => {
                        if (result.isConfirmed) {
                            setTextReadOnly('e_pras',true);
                        } else if (result.isDenied) {
                            setTextReadOnly('e_pras',false);
                        }
                    });
                }

                if (getText('e_pras')=='3') {
                    setTextReadOnly('e_pras',true);
                    setTextReadOnly('msoc_mpras_kode',true);
                    setTextReadOnly('msoc_mrkn_nama',true);
                    setTextReadOnly('msoc_mrkn_kode',true);
                    setTextReadOnly('e_nasabah',true);
                    setTextReadOnly('e_manfaat_pol',true);
                    setTextReadOnly('msoc_mspaj_nama',true);
                    setTextReadOnly('msoc_mft_kode',true);
                    setTextReadOnly('e_manfaat',true);
                    setTextReadOnly('msoc_mssp_nama',true);
                    messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI MEMBERIKAN MANFAAT TAMBAHAN UANG PERTANGGUNGAN DAN KOMISI KEPADA PEMEGANG POLIS ?', (result) => {
                        if (result.isConfirmed) {
                            setTextReadOnly('e_pras', true);
                        } else if (result.isDenied) {
                            setTextReadOnly('e_pras', false);
                        }
                    });
                }

                if (getText('e_pras')=='4') {
                    setTextReadOnly('e_pras',true);
                    setTextReadOnly('msoc_mpras_kode',true);
                    setTextReadOnly('msoc_mrkn_nama',true);
                    setTextReadOnly('msoc_mrkn_kode',true);
                    setTextReadOnly('e_nasabah',true);
                    setTextReadOnly('e_manfaat_pol',true);
                    setTextReadOnly('msoc_mspaj_nama',true);
                    setTextReadOnly('msoc_mft_kode',true);
                    setTextReadOnly('e_manfaat',true);
                    setTextReadOnly('msoc_mssp_nama',true);
                    messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI HANYA MEMBERIKAN MANFAAT TAMBAHAN UANG PERTANGGUNGAN KEPADA PEMEGANG POLIS ?', (result) => {
                        if (result.isConfirmed) {
                            setTextReadOnly('e_pras', true);
                        } else if (result.isDenied) {
                            setTextReadOnly('e_pras', false);
                        }
                    });
                }
            }

            function setReadEdit(sts) {
                setTextReadOnly("e_manfaat",sts);
                setTextReadOnly("e_pras",sts);
                setTextReadOnly("msoc_mft_kode",sts);
                setTextReadOnly("msoc_mjns_kode",sts);
            }

            function cekberlaku(rec) {
                if (rec.value==1) {
                    setTextReadOnly("mpol_tgl1",false);
                    setTextReadOnly("msotd_tgl2",false);
                } else {
                    setTextReadOnly("msotd_tgl1",true);
                    setTextReadOnly("msotd_tgl2",true);
                }
            }

            function clear_f() {
                clearForm('frxx_soc_khusus');
                clearForm('frxx_uitKhusus');
                clearForm('frxx_uiuKhusus');
                bsimpan('btn_simpan', 'Simpan');

                setTextReadOnly('msotd_pk', true);
                setTextReadOnly('msotd_mlok_kode', true);

                setTextReadOnly('msotd_msoc_nomor', true);
                setTextReadOnly('msotd_msoc_kode', true);

                // setText("endors","0");
                setText("msoc_mfee_persen","0");
                setText("msoc_mkom_persen","0");
                setText("msoc_overreding","0");
                setText("msoc_mmfe_persen","0");
                setText("msoc_mujh_persen","0");
                setText("msoc_mujhrf_kode","0");
                setText("msoc_mdr_kode","0");
                setText("msoc_mut_kode","0");
                setText("msoc_ket_endors","-");
                setText("msoc_no_endors","-");
                setText("msoc_tipe_uw","0");
                setText("msotd_tipe","0");
                setText("msotd_tgl1",curDate());

                cekReq();
                cekHide();
                cekHideMess();
                setReadEdit(false);

                var akses = {{ __getHak('sjab_editsoc') }};
                if (akses==true) {
                    akses=1;
                }
                setText('edit_akses', akses);
            }

            function cekReq() {
                // setTextReq
                setTextReq('msoc_mrkn_nama', true);
                setTextReq('e_nasabah', true);
                setTextReq('msoc_mssp_nama', true);
                setTextReq('msoc_mekanisme', true);
                setTextReq('msoc_mekanisme2', true);
                setTextReq('msoc_mft_kode', true);
                setTextReq('msoc_jenis_bayar', true);
                setTextReq('msoc_jns_perusahaan', true);
                setTextReq('e_manfaat', true);
                setTextReq('e_pras', true);

                setTextReq('msotd_status', true);
                setTextReq('msotd_ketentuan', true);
                setTextReq('msotd_berlaku', true);
                setTextReq('msotd_tgl2', true);
                setTextReq('msotd_mdr_persen', true);
                setTextReq('msotd_mdr_berlaku', true);
                setTextReq('msotd_mujh_persen', true);
                setTextReq('msotd_mfee_persen', true);
                setTextReq('msotd_jenis_tarif', true);
                setTextReq('msotd_tipe_uw', true);
                setTextReq('e_tarif', true);
                setTextReq('e_uw', true);
            }

            function cekHide() {
                // setHide
                setHide('msoc_mrkn_kode', true);
                setHide('msoc_mpras_kode', true);
                setHide('msoc_mjns_kode', true);
                setHide('msoc_mjns_mpid_kode', true);
                setHide('e_bersih', true);
                setHide('msoc_mssp_kode', true);
                setHide('mpid_mssp_kode', true);
                setHide('msoc_mjm_kode', true);
                setHide('msoc_mpid_kode', true);
                setHide('msoc_mlok_kode', true);
                setHide('endors', true);

                setHide('msotd_mth_nomor', true);
                setHide('msotd_mpuw_nomor', true);
            }

            function cekHideMess() {
                // change message Form SOC
                // hidePesan('msoc_jenis_bayar');
                // hidePesan('msoc_mslr_kode');
                // hidePesan('msoc_dok');
            }

            function bersih(tipe) {
                if (getText('e_bersih')=='1') {
                    return;
                }
                if (tipe==1) {
                    setText('e_manfaat', '');
                    setText('e_pras', '');
                    setText('msoc_nomor', '');
                    setText('msoc_mpras_kode', '');
                    setText('msoc_mjm_kode', '');
                }
                if (tipe==2) {
                    setText('msoc_mrkn_nama', '');
                }
            }

            function close_mTarif() {
                closeModal('modalUitKhusus');
                clearForm('frxx_uitKhusus');
            }

            function close_mUw() {
                closeModal('modalUwKhusus');
                clearForm('frxx_uiuKhusus');
            }
        </script>
    @endsection

@endif
