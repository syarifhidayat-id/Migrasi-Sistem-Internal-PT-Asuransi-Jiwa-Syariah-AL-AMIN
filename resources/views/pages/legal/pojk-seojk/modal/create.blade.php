<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod"></h2>

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

                            <input class="form-control" name="mpojk_pk" id="mpojk_pk" type="hidden"
                                data-allow-clear="false" readonly />
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Nomor</label>
                                    <input class="form-control" name="mpojk_nomor" id="mpojk_nomor" type="text"
                                        data-allow-clear="true" placeholder="Masukan nomor pojk / seojk" />
                                    <span class="text-danger error-text mpojk_nomor_err"></span>

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Jenis</label>
                                    <select class="form-control" name="mpojk_jenis" id="mpojk_jenis" type="text"
                                        data-allow-clear="true" placeholder="Masukan nomor pks" >
                                        <option value="" selected disabled> - pilih -</option>
                                        <option value="1"> SEOJK </option>
                                        <option value="2"> POJK </option>
                                    </select>
                                    <span class="text-danger error-text mpojk_jenis_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Tentang</label>
                                    <input class="form-control" name="mpojk_tentang" id="mpojk_tentang" type="text"
                                        data-allow-clear="true" placeholder="Masukan perihal surat / dokumen" />
                                    <span class="text-danger error-text mpojk_tentang_err"></span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="mpojk_dokumen"
                                        placeholder="pilih file" id="mpojk_dokumen" />
                                    <span class="text-danger error-text mpojk_dokumen_err"></span>
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
