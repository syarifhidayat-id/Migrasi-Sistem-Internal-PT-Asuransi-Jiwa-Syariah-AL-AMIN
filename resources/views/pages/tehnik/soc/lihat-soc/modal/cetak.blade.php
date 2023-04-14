<div class="modal fade" id="modalCetakSoc" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalCetakSoc_header">
                <h2 class="fw-bolder" id="titleModal"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('modalCetakSoc')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
                {{-- <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div> --}}
            </div>

            <form id="cetakLihatSoc" name="cetakLihatSoc" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalCetakSoc_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalCetakSoc_header"
                        data-kt-scroll-wrappers="#modalCetakSoc_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-8">
                                <div class="mb-5">
                                    <label class="required form-label">Nomor SOC</label>
                                    <div class="input-group input-group-solid">
                                        <input type="text" class="form-control" name="mpap_mpol_kode"
                                            id="mpap_mpol_kode" placeholder="Nomor soc" />
                                        <input type="text" class="form-control" name="kodex_soc" id="kodex_soc"
                                            placeholder="Kode soc" />
                                    </div>
                                    <span class="text-danger error-text mpap_mpol_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <label class="required form-label">Cetak</label>
                                    <select class="form-select form-select-solid" data-control="select2"
                                        name="mpap_mpol_kode" id="mpap_mpol_kode" data-dropdown-parent="#modalCetakSoc"
                                        data-placeholder="Pilih jenis cetak" data-allow-clear="true">
                                        <option></option>
                                        <option value="Disposisi_soc">Disposisi SOC</option>
                                        <option value="SOC">SOC</option>
                                        <option value="SOC_ttd">SOC Ttd</option>
                                    </select>
                                    <span class="text-danger error-text mpap_mpol_kode_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Cetak</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalCetakSoc')"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
