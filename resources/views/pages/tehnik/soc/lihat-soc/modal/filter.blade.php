<div class="modal fade" id="modalFilter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalFilter_header">
                <h2 class="fw-bolder">Filter Lihat Soc</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('modalFilter')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body scroll-y mx-5 my-5">
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalFilter_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#modalFilter_header" data-kt-scroll-wrappers="#modalFilter_scroll"
                    data-kt-scroll-offset="300px">
                    <div class="row">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                    <input type="search" data-kt-datatable-table-filter="search" name="seacrh"
                                        id="seacrh" class="form-control form-control-solid" placeholder="Cari All" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Baris yang Tampil</label>
                                    <select class="form-select form-select-solid fw-bolder" id="e_baris"
                                        name="e_baris" data-control="select2" data-kt-select2="true"
                                        data-kt-datatable-table-filter="e_baris" data-placeholder="Pilih jumlah"
                                        data-allow-clear="true" data-hide-search="false">
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option selected value="100">100</option>
                                        <option value="150">150</option>
                                        <option value="200">200</option>
                                        <option value="300">300</option>
                                        <option value="400">400</option>
                                        <option value="500">500</option>
                                        <option value="600">600</option>
                                        <option value="700">700</option>
                                        <option value="800">800</option>
                                        <option value="900">900</option>
                                        <option value="1000">1000</option>
                                        <option value="1500">1500</option>
                                        <option value="2000">2000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fs-6 fw-bold">Kode Soc</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_kdsoc" name="c_kdsoc" type="checkbox"
                                            data-checkbox="c_kdsoc" />
                                    </label>
                                    <input type="text" id="e_kdsoc" name="e_kdsoc"
                                        data-kt-datatable-table-filter="e_kdsoc" class="form-control form-control-solid"
                                        placeholder="Kode soc" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fs-6 fw-bold">Jaminan Asuransi</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_jaminan" name="c_jaminan" type="checkbox"
                                            data-checkbox="c_jaminan" />
                                    </label>
                                    <select class="form-select form-select-solid fw-bolder" id="e_jaminan"
                                        name="e_jaminan" data-control="select2" data-kt-select2="true"
                                        data-kt-datatable-table-filter="e_jaminan"
                                        data-placeholder="Pilih jenis nasabah" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                        {{ optSql('SELECT mjm_kode kode,mjm_nama nama FROM emst.mst_jaminan ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label fs-6 fw-bold">Jenis Nasabah</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_jnas" name="c_jnas"
                                            type="checkbox" data-checkbox="c_jnas" />
                                    </label>
                                    <select class="form-select form-select-solid fw-bolder" id="e_jnas"
                                        name="e_jnas" data-control="select2" data-kt-select2="true"
                                        data-kt-datatable-table-filter="e_jnas" data-placeholder="Pilih jenis nasabah"
                                        data-allow-clear="true" data-hide-search="false">
                                        <option></option>
                                        {{ optSql('SELECT mjns_kode kode,mjns_keterangan nama FROM emst.mst_jenis_nasabah ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="form-label fs-6 fw-bold">Pemegang Polis</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_pmgpolis" name="c_pmgpolis"
                                            type="checkbox" data-checkbox="c_pmgpolis" />
                                    </label>
                                    <select class="form-select form-select-solid fw-bolder" id="e_pmgpolis"
                                        name="e_pmgpolis" data-control="select2" data-kt-select2="true"
                                        data-kt-datatable-table-filter="e_pmgpolis"
                                        data-placeholder="Pilih pemegang polis" data-allow-clear="true"
                                        data-hide-search="false">
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
