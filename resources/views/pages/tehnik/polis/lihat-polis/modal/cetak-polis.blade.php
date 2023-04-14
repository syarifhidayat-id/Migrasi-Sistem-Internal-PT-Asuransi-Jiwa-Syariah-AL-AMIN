<div class="modal fade" id="modalCetak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalCetak_header">
                <h2 class="fw-bolder" id="titleCetak"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalCetak')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_cetakpolis" name="frxx_cetakpolis" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mx-5">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Kode Polis</label>
                                <input type="text" class="form-control form-control-solid" name="mpap_mpol_kode" id="mpap_mpol_kode" placeholder="Kode soc" />
                                <span class="text-danger error-text mpap_mpol_kode_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Nomor Polis</label>
                                <input type="text" class="form-control form-control-solid" name="kodex_soc" id="kodex_soc" placeholder="Nomor soc" />
                                <span class="text-danger error-text kodex_soc_err"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="form-label">Cetak</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-5">
                                            <select class="form-select form-select-solid" data-control="select2" name="jns_cetak" id="jns_cetak" data-placeholder="Pilih jenis cetak" data-allow-clear="true">
                                                <option value="Disposisi">Disposisi Polis</option>
                                                <option value="Cover">Cover</option>
                                                <option value="Disposisi_soc">Disposisi SOC</option>
                                                <option value="SOC">SOC</option>
                                            </select>
                                            <span class="text-danger error-text jns_cetak_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-5">
                                            <select class="form-select form-select-solid" data-control="select2" name="typerpt" id="typerpt" data-placeholder="Pilih jenis cetak" data-allow-clear="true">
                                                <option value="web">WEB</option>
                                                <option value="pdf">PDF</option>
                                            </select>
                                            <span class="text-danger error-text typerpt_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-5">
                                            <button type="button" class="btn btn-light-primary btn-sm d-block" onclick=""><i class="fa-solid fa-eye"></i> Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalCetak')"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
