<div class="modal fade" id="modalSkiUwKhusus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalSkiUwKhusus_header">
                <h2 class="fw-bolder" id="titleISkiuKhusus"></h2>
            </div>

            <form id="frxx_skiuKhusus" name="frxx_skiuKhusus" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mx-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalSkiUwKhusus_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalSkiUwKhusus_header" data-kt-scroll-wrappers="#modalSkiUwKhusus_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-12" hidden>
                                <div class="mb-5">
                                    <label class="form-label">Nomor</label>
                                    <input type="text" class="form-control form-control-solid" name="kode_skiuk" id="kode_skiuk" placeholder="Nomor" readonly />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="required form-label">Apakah Data Yang Diupload UW Sudah Benar ?</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mpuw_final" id="mpuw_final" data-dropdown-parent="#modalSkiUwKhusus" data-placeholder="Pilih konfirmasi" data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Ya</option>
                                        <option value="0">Tidak</option>
                                    </select>
                                    <span class="text-danger error-text mpuw_final_err"></span>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <iframe id="showTbUwKhusus" src="" frameborder="0" width="100%" height="450px"></iframe>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btnSkiuKhusus_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
