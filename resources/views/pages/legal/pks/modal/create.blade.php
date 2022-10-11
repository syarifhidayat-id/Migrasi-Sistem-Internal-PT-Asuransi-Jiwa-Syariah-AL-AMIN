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
                            <div class="col-md-6 mb-5">
                                <label class="form-label">Pemegang Polis</label>
                                <select class="form-select" data-dropdown-parent="#modalPks" data-control="select2" data-placeholder="Select an option">
                                    <option></option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                    <option value="4">Option 4</option>
                                    <option value="5">Option 5</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Instansi</label>
                                    <input class="form-control" name="pks_instansi" id="pks_instansi" type="text"
                                        data-allow-clear="true" required />
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Nomor PKS</label>
                                    <input class="form-control" name="pks_nomor" id="pks_nomor" type="text"
                                        data-allow-clear="true" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Perihal</label>
                                    <input type="text" class="form-control" name="pks_tentang" id="pks_tentang"
                                        data-allow-clear="true" type="text" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="required form-label">Tgl Mulai</label>
                                    <input type="date" class="form-control" name="pks_tgl_mulai" id="pks_tgl_mulai"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="required form-label">Tgl Akhir</label>
                                    <input type="date" class="form-control" name="pks_tgl_akhir" id="pks_tgl_akhir"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">PIC Reminder</label>
                                    <input type="email" class="form-control" name="pks_pic" id="pks_pic"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">No. HP PIC</label>
                                    <input type="text" class="form-control" name="pks_pic_hp" id="pks_pic_hp"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Email PIC</label>
                                    <input type="email" class="form-control" name="pks_pic_email" id="pks_pic_email"
                                        required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">No. HP Atasan</label>
                                    <input type="text" class="form-control" name="pks_atasan_hp"
                                        id="pks_atasan_hp" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Email Atasan</label>
                                    <input type="text" class="form-control" name="pks_atasan_email"
                                        id="pks_atasan_email" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Ket/Catatan</label>
                                    <input type="text" class="form-control" name="pks_ket" id="pks_ket" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="pks_dokumen"
                                        id="pks_dokumen" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    {{-- <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button> --}}
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
