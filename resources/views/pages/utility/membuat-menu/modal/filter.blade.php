<div class="modal fade" id="modalFilter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalFilter_header">
                <h2 class="fw-bolder">Filter Menu</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('modalFilter')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalFilter_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#modalFilter_header" data-kt-scroll-wrappers="#modalFilter_scroll"
                    data-kt-scroll-offset="300px">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                    <input type="search" id="e_keyboard" name="e_keyboard" id="seacrh"
                                        class="form-control form-control-solid" placeholder="Cari All" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Baris yang Tampil</label>
                                    <select class="form-select form-select-solid fw-bolder" id="e_baris"
                                        name="e_baris" data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-kt-datatable-table-filter="e_baris" data-placeholder="Pilih jumlah"
                                        data-allow-clear="true" data-hide-search="true">
                                        <option value="20">20</option>
                                        <option selected value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="150">150</option>
                                        <option value="200">200</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fs-6 fw-bold">Tipe Menu</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_tipe" name="c_tipe" type="checkbox"
                                            data-checkbox="c_tipe" />
                                    </label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-dropdown-parent="#modalFilter" data-placeholder="Pilih route"
                                        data-allow-clear="true" id="e_tipe" name="e_tipe">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fs-6 fw-bold">Nama Menu</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_des" name="c_des" type="checkbox"
                                            data-checkbox="c_des" />
                                    </label>
                                    <select class="form-select form-select-solid fw-bolder" data-control="select2"
                                        data-dropdown-parent="#modalFilter" data-placeholder="Pilih menu"
                                        data-allow-clear="true" id="e_des" name="e_des">
                                        <option></option>
                                    </select>
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
