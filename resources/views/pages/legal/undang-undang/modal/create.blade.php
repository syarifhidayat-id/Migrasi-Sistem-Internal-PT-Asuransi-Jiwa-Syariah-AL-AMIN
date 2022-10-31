<div class="modal fade" id="modalPks" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tModPks"></h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="btn_closeCreate">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>

            <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">

                            <input class="form-control" name="mua_pk" id="mua_pk" type="hidden"
                                data-allow-clear="false" placeholder="Masukan instansi" readonly />
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Undang-undang Nomor</label>
                                    <input class="form-control" name="mua_nomor" id="mua_nomor" type="text"
                                        data-allow-clear="true" placeholder="Masukan nomor undang-undang" />
                                    <span class="text-danger error-text mua_nomor_err"></span>

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tentang</label>
                                    <input class="form-control" name="mua_tentang" id="mua_tentang" type="text"
                                        data-allow-clear="true" placeholder="Masukan nomor pks" />
                                    <span class="text-danger error-text mua_tentang_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="mua_dokumen"
                                        placeholder="pilih file" id="mua_dokumen" />
                                    <span class="text-danger error-text mua_dokumen_err"></span>
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
                    <button type="button" class="btn btn-danger btn-sm" id="btn_tutup"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
