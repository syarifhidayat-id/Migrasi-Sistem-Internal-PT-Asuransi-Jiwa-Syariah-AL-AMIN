<div class="modal fade" id="modal_approv" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod_approv"></h2>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="close_approv()"><i
                        class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_approv" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-5">
                            <input type="hidden" id="tdna_pk" name="tdna_pk">
                                <div class="mb-5">
                                    <label class="form-label">Kantor Al-Amin</label>
                                    <input class="form-control" name="mlok_nama" id="mlok_nama" type="text"
                                        data-allow-clear="true" />
                                    {{-- <span class="text-danger error-text mpks_mrkn_kode_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Tgl. Pengajuan</label>
                                    <input class="form-control" name="tdna_tgl_aju" id="tdna_tgl_aju" type="date"
                                        data-allow-clear="true" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Peruntukan Dana</label>
                                    <input class="form-control" name="tdna_ket" id="tdna_ket" type="text"
                                        data-allow-clear="true" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Penerima Dana</label>
                                    <input class="form-control" name="tdna_penerima" id="tdna_penerima" type="text"
                                        data-allow-clear="true" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Nilai Dana</label>
                                    <input class="form-control" name="tdna_total" id="tdna_total" type="text"
                                        data-allow-clear="true" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Pesetujuan Dana Kas</label>
                                    <select class="form-select" name="e_status" data-control="select2"  id="e_status" data-dropdown-parent="#modal_approv" data-placeholder="approv dana kas!" type="text" data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Setuju</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

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
                    <button type="button" class="btn btn-danger btn-sm" onclick="close_approv()">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
