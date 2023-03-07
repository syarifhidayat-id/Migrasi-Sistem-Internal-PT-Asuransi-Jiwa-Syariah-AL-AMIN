<div class="modal fade" id="modalTamKasbon" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalTamKasbon">
                <h2 class="fw-bolder" id="tModKasbon"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeMod()"><i
                        class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_kasbon" name="frxx_kasbon" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalTamKasbon" data-kt-scroll-wrappers="#modalTamKasbon_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Cabang Al Amin</label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-kt-select2="true" data-placeholder="Pilih cabang alamin"
                                        data-allow-clear="true" data-hide-search="false" id="e_cabalamin"
                                        data-dropdown-parent="#modalTamKasbon" name="e_cabalamin">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text e_cabalamin_err"></span>
                                    <input type="hidden" name="tkb_pk" id="tkb_pk" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Penerima</label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-kt-select2="true" data-placeholder="Pilih penerima"
                                        data-dropdown-parent="#modalTamKasbon" data-allow-clear="true"
                                        data-hide-search="false" id="e_karyawan" name="e_karyawan">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text e_karyawan_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Jenis Realisasi</label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-kt-select2="true" data-placeholder="Pilih realisasi"
                                        data-dropdown-parent="#modalTamKasbon" data-allow-clear="true"
                                        data-hide-search="false" id="e_realisasi" name="e_realisasi">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text e_realisasi_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Akun Kas</label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-kt-select2="true" data-placeholder="Pilih realisasi"
                                        data-dropdown-parent="#modalTamKasbon" data-allow-clear="true"
                                        data-hide-search="false" id="e_akunkas" name="e_akunkas">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text e_akunkas_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Tanggal</label>
                                    <input class="form-control form-control-solid fw-bolder" data-placeholder="Tanggal"
                                        data-allow-clear="true" type="date" data-hide-search="false" id="tkb_tanggal"
                                        name="tkb_tanggal" />
                                        <span class="text-danger error-text tkb_tanggal_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Nominal</label>
                                    <input class="form-control form-control-solid fw-bolder text-end"
                                        data-placeholder="Masukan nominal" data-allow-clear="true" type="text"
                                        data-hide-search="false" id="tkb_nominal" name="tkb_nominal" />
                                        <span class="text-danger error-text tkb_nominal_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label fs-6 fw-bold">Peruntukan</label>
                                    <input class="form-control form-control-solid fw-bolder"
                                        data-placeholder="Masukan peruntukan" data-allow-clear="true" type="textarea"
                                        data-hide-search="false" id="tkb_peruntukan_dana" name="tkb_peruntukan_dana" />
                                        <span class="text-danger error-text tkb_peruntukan_dana_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                            class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" id="btn_tutup" onclick="closeMod()"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
