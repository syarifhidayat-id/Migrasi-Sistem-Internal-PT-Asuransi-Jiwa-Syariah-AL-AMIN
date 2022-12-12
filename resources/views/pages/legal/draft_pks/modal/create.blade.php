<div class="modal fade" id="modalDraftPks" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tmod"></h2>
                
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalDraftPks')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_draft" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">

                            <input class="form-control" name="mdp_pk" id="mdp_pk" type="hidden"
                                data-allow-clear="false" placeholder="Masukan instansi" readonly />
                            <div class="col-md-6 mb-5">
                                <label class="required form-label">Segmen Pasar</label>
                                <select class="form-select" data-dropdown-parent="#modalDraftPks" id="mdp_mssp_kode"
                                    name="mdp_mssp_kode" data-placeholder="Pilih segmen pasar" data-allow-clear="true" required>
                                    <option></option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Tentang</label>
                                    <input class="form-control" name="mdp_tentang" id="mdp_tentang" type="text"
                                        data-allow-clear="true" placeholder="Masukan instansi" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="mdp_dokumen" placeholder="pilih file"
                                        id="mdp_dokumen" />
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
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalDraftPks')"> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
