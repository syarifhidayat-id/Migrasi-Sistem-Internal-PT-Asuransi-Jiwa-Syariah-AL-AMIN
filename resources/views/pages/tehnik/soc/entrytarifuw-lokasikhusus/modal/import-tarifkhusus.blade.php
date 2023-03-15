<div class="modal fade" id="modalUitKhusus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalUitKhusus_header">
                <h2 class="fw-bolder" id="titleItKhusus"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="close_mTarif()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_uitKhusus" name="frxx_uitKhusus" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mx-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalUitKhusus_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalUitKhusus_header" data-kt-scroll-wrappers="#modalUitKhusus_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Diperuntukan</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mth_tipe_pertanggungan" id="mth_tipe_pertanggungan" data-dropdown-parent="#modalUitKhusus" data-placeholder="Pilih tipe" data-allow-clear="true">
                                        <option></option>
                                        <option value="0">PESERTA</option>
                                        <option value="1">REASURANSI</option>
                                    </select>
                                    <span class="text-danger error-text mth_tipe_pertanggungan_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Keterangan</label>
                                    <input type="text" class="form-control form-control-solid" name="mth_ket" id="mth_ket" placeholder="Maukkan keterangan"/>
                                    <span class="text-danger error-text mth_ket_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Tipe Perhitungan Tarif</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <select class="form-select form-select-solid" data-control="select2" name="mth_tipe_rumus" id="mth_tipe_rumus" data-dropdown-parent="#modalUitKhusus" data-placeholder="Pilih tarif perhitungan" data-allow-clear="true">
                                                    <option></option>
                                                    <option value="0">TARIF USIA(TAHUN)</option>
                                                    <option value="1">TARIF USIA(BULAN)</option>
                                                    <option value="2">FIRE</option>
                                                    <option value="3">TLO</option>
                                                    <option value="4">PLAN / BADAL (UP)</option>
                                                    <option value="5">KODE HARI</option>
                                                    <option value="6">MPP WP+PHK</option>
                                                    <option value="7">MASA BULAN DARI UW</option>
                                                    <option value="8">PLAN / BADAL (USIA)</option>
                                                    <option value="9">PLAN / BADAL (USIA+UP)</option>
                                                    <option value="10">MASA BULAN DARI UW (HARI)</option>
                                                    <option value="11">TARIF USIA(TAHUN) SESUAI UP & TENOR</option>
                                                </select>
                                                <span class="text-danger error-text mth_tipe_rumus_err"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-5">
                                                <div class="input-group input-group-solid flex-nowrap">
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid rounded-0 border-start border-end" name="mth_kolom" id="mth_kolom" data-dropdown-parent="#modalUitKhusus" data-placeholder="Pilih" data-allow-clear="true">
                                                            <option></option>
                                                            <option selected value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="12">12</option>
                                                            <option value="20">20</option>
                                                            <option value="24">24</option>
                                                            <option value="30">30</option>
                                                            <option value="36">36</option>
                                                            <option value="48">48</option>
                                                            <option value="60">60</option>
                                                            <option value="64">64</option>
                                                            <option value="65">65</option>
                                                            <option value="70">70</option>
                                                            <option value="71">71</option>
                                                            <option value="100">100</option>
                                                            <option value="120">120</option>
                                                            <option value="180">180</option>
                                                            <option value="240">240</option>
                                                            <option value="245">245</option>
                                                            <option value="250">250</option>
                                                            <option value="290">290</option>
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">Max Kolom</span>
                                                    <div class="overflow-hidden flex-grow-1">
                                                        <select class="form-select form-select-solid rounded-0 border-start border-end" name="mth_baris" id="mth_baris" data-dropdown-parent="#modalUitKhusus" data-placeholder="Pilih" data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="12">12</option>
                                                            <option value="20">20</option>
                                                            <option value="24">24</option>
                                                            <option value="30">30</option>
                                                            <option value="36">36</option>
                                                            <option value="48">48</option>
                                                            <option value="60">60</option>
                                                            <option value="64">64</option>
                                                            <option value="65">65</option>
                                                            <option value="70">70</option>
                                                            <option selected value="80">80</option>
                                                            <option value="100">100</option>
                                                            <option value="120">120</option>
                                                            <option value="180">180</option>
                                                            <option value="240">240</option>
                                                            <option value="245">245</option>
                                                            <option value="250">250</option>
                                                            <option value="290">290</option>
                                                        </select>
                                                    </div>
                                                    <span class="input-group-text">Max Baris</span>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <span class="text-danger error-text mth_kolom_err"></span>
                                                    </div>
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-5">
                                                        <span class="text-danger error-text mth_baris_err"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">File</label>
                                    <input type="file" class="form-control form-control-solid" name="mth_file" id="mth_file" />
                                    <span class="text-danger error-text mth_file_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_uitKhusus_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="clear_f()"><i class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="close_mTarif()"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
