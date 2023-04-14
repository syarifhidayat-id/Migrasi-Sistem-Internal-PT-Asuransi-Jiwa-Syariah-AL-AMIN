<div class="modal fade" id="modalFilter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalFilter_header">
                <h2 class="fw-bolder">Filter Soc Belum Terbit Polis</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('modalFilter')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body scroll-y mx-5 my-5">
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalFilter_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#modalFilter_header" data-kt-scroll-wrappers="#modalFilter_scroll"
                    data-kt-scroll-offset="300px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="form-label fs-6 fw-bold">Status Approval</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_status" name="c_status"
                                                        type="checkbox" value="0" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_status"
                                                    name="e_status" data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih status" data-allow-clear="true"
                                                    data-hide-search="false">
                                                    <option></option>
                                                    <option value="0">BELUM DISETUJUI</option>
                                                    <option value="1">DISETUJUI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <div class="d-flex flex-stack">
                                                <label
                                                    class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_terbit" name="c_terbit"
                                                        type="checkbox" value="1" checked />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_terbit"
                                                    name="e_terbit" data-control="select2" data-kt-select2="true"
                                                    data-placeholder="Pilih jenis nasabah" data-allow-clear="true"
                                                    data-hide-search="false">
                                                    <option></option>
                                                    <option value="0" selected>BELUM TERBIT</option>
                                                    <option value="1">TELAH TERBIT</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-bs-dismiss="modal">
                    <i class="fa-sharp fa-solid fa-eye"></i>
                    Tampilkan
                </button>
                <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalFilter')">
                    <i class="fa-solid fa-xmark"></i>
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>
