<div class="modal fade" id="modalAppSoc" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalAppSoc_header">
                <h2 class="fw-bolder" id="titleModal"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalAppSoc')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
                {{-- <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div> --}}
            </div>

            <form id="apprSoc" name="apprSoc" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalAppSoc_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalAppSoc_header" data-kt-scroll-wrappers="#modalAppSoc_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="required form-label">Nomor SOC</label>
                                    <input type="text" class="form-control form-control-solid" name="mpap_msoc_kode" id="mpap_msoc_kode" placeholder="Nomor soc" />
                                    <span class="text-danger error-text mpap_msoc_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="required form-label">Status SOC</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mpap_status2" id="mpap_status2" data-dropdown-parent="#modalAppSoc" data-placeholder="Pilih status" data-allow-clear="true">
                                        <option></option>
                                        <option value="N">NO</option>
                                        <option value="Y">YES</option>
                                    </select>
                                    <span class="text-danger error-text mpap_status2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="required form-label">Ditujukan</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="tmp_kpd2" id="tmp_kpd2" data-dropdown-parent="#modalAppSoc" data-placeholder="Pilih diajukan" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text tmp_kpd2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="required form-label">Ketarangan</label>
                                    <textarea class="form-control form-control-solid" name="mpap_note2" id="mpap_note2" cols="3" rows="3" placeholder="Keterangan"></textarea>
                                    <span class="text-danger error-text mpap_note2_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalAppSoc')"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
