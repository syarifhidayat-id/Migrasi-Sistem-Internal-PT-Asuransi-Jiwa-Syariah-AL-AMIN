<div class="modal fade" id="modalFilter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalFilter_header">
                <h2 class="fw-bolder">Filter Polis Asuransi</h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('modalFilter')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body scroll-y mx-5 my-5">
                <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalFilter_scroll" data-kt-scroll="true"
                    data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                    data-kt-scroll-dependencies="#modalFilter_header" data-kt-scroll-wrappers="#modalFilter_scroll"
                    data-kt-scroll-offset="300px">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-10">
                                <label class="form-label">Berdasarkan Keyboard</label>
                                <input type="search" name="seacrh" id="seacrh"
                                    class="form-control form-control-solid" placeholder="Cari All" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-10">
                                <label class="form-label">Baris yang Tampil</label>
                                <select class="form-select form-select-solid" id="e_baris"
                                    name="e_baris"data-control="select2" data-dropdown-parent="#modalFilter"
                                    data-placeholder="Pilih jumlah" data-allow-clear="false" data-hide-search="false">
                                    <option value="20">20</option>
                                    <option selected value="50">50</option>
                                    <option value="100">100</option>
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
                                    <option value="10000">10,000</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Jaminan</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_jaminan" name="c_jaminan" type="checkbox"
                                            data-checkbox="c_jaminan" />
                                    </label>
                                    <select class="form-select form-select-solid" id="e_jaminan" name="e_jaminan"
                                        data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-placeholder="Pilih Jaminan" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                        {{ optSql('SELECT mjm_kode kode,mjm_nama nama FROM emst.mst_jaminan ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Pemegang Polis</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_pmgpolis" name="c_pmgpolis"
                                            type="checkbox" data-checkbox="c_pmgpolis" />
                                    </label>
                                    <select class="form-select form-select-solid" id="e_pmgpolis" name="e_pmgpolis"
                                        data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-placeholder="Pilih pemegang polis" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Nasabah</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_nasabah" name="c_nasabah"
                                            type="checkbox" data-checkbox="c_nasabah" />
                                    </label>
                                    <select class="form-select form-select-solid" id="e_nasabah" name="e_nasabah"
                                        data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-placeholder="Pilih nasabah" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                        {{ optSql('SELECT mjns_kode kode,mjns_keterangan nama FROM emst.mst_jenis_nasabah ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Program Asuransi</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_progasu" name="c_progasu"
                                            type="checkbox" data-checkbox="c_progasu" />
                                    </label>
                                    <select class="form-select form-select-solid" id="e_progasu" name="e_progasu"
                                        data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-placeholder="Pilih program asuransi" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                        {{ optSql('SELECT mpras_kode kode,mpras_nama nama FROM emst.mst_program_asuransi ORDER BY 1', 'kode', 'nama') }}
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Template Reas</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_kelreas" name="c_kelreas"
                                            type="checkbox" data-checkbox="c_kelreas" />
                                    </label>
                                    <select class="form-select form-select-solid" id="e_kelreas" name="e_kelreas"
                                        data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-placeholder="Pilih template reas" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                        <option value="0">BELUM</option>
                                        <option value="1">SUDAH</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Nomor Polis</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_nopolis" name="c_nopolis"
                                            type="checkbox" data-checkbox="c_nopolis" />
                                    </label>
                                    <input type="text" name="e_nopolis" id="e_nopolis"
                                        class="form-control form-control-solid" placeholder="Nomor polis" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Status Polis</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_stspolis" name="c_stspolis"
                                            type="checkbox" data-checkbox="c_stspolis" />
                                    </label>
                                    <select class="form-select form-select-solid" id="e_stspolis" name="e_stspolis"
                                        data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-placeholder="Pilih status polis" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                        <option value="0">INFORCE</option>
                                        <option value="1">LAPSE</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Nomor Soc</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_nosoc" name="c_nosoc"
                                            type="checkbox" data-checkbox="c_nosoc" />
                                    </label>
                                    <input type="text" name="e_nosoc" id="e_nosoc"
                                        class="form-control form-control-solid" placeholder="Nomor soc" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Status Aktif</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_stsaktif" name="c_stsaktif"
                                            type="checkbox" data-checkbox="c_stsaktif" />
                                    </label>
                                    <select class="form-select form-select-solid" id="e_stsaktif" name="e_stsaktif"
                                        data-control="select2" data-dropdown-parent="#modalFilter"
                                        data-placeholder="Pilih status aktif" data-allow-clear="true"
                                        data-hide-search="false">
                                        <option></option>
                                        <option value="0">SUSPEND</option>
                                        <option value="1">AKTIF</option>
                                        <option value="2">MATIKAN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Tanggal Terbit</label>
                                <div class="d-flex flex-stack">
                                    <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                        <input class="form-check-input" id="c_tglterbit" name="c_tglterbit"
                                            type="checkbox" data-checkbox="c_tglterbit" />
                                    </label>
                                    <input type="date" name="e_tglterbit1" id="e_tglterbit1"
                                        class="form-control form-control-solid me-5" placeholder="dd/mm/yyyy" />
                                    <input type="date" name="e_tglterbit2" id="e_tglterbit2"
                                        class="form-control form-control-solid" placeholder="dd/mm/yyyy" />
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
