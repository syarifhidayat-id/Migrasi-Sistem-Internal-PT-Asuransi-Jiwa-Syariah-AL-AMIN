<div class="modal fade" id="modalUw" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalUw_header">
                <h2 class="fw-bolder" id="titleUw"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="close_mUw()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_uploadUw" name="frxx_uploadUw" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body mx-5">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Diperuntukan</label>
                                <select class="form-select form-select-solid" data-control="select2" name="mpuw_tipe_pertanggungan" id="mpuw_tipe_pertanggungan" data-dropdown-parent="#modalUw" data-placeholder="Pilih diperuntukan" data-allow-clear="true">
                                    <option></option>
                                    <option value="0">PESERTA</option>
                                    <option value="1">REASURANSI</option>
                                </select>
                                <span class="text-danger error-text mpuw_tipe_pertanggungan_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-5">
                                <label class="form-label">Keterangan</label>
                                <input type="text" class="form-control form-control-solid" name="mpuw_nama" id="mpuw_nama" placeholder="Maukkan keterangan"/>
                                <span class="text-danger error-text mpuw_nama_err"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="form-label">Tipe Uw</label>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-5">
                                            <select class="form-select form-select-solid" data-control="select2" name="mpuw_type_uw" id="mpuw_type_uw" data-dropdown-parent="#modalUw" data-placeholder="Pilih tipe UW" data-allow-clear="true">
                                                <option></option>
                                                <option value="0">STANDAR</option>
                                                <option value="1">OKUPASI</option>
                                            </select>
                                            <span class="text-danger error-text mpuw_type_uw_err"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-5">
                                            <div class="input-group input-group-solid flex-nowrap">
                                                <div class="overflow-hidden flex-grow-1">
                                                    <select class="form-select form-select-solid" name="mpuw_baris" id="mpuw_baris" data-dropdown-parent="#modalUw" data-placeholder="Pilih jumlah" data-allow-clear="true">
                                                        <option></option>
                                                        <option selected value="5">5</option>
                                                        <option value="15">15</option>
                                                        <option value="25">25</option>
                                                        <option value="35">35</option>
                                                        <option value="60">40</option>
                                                        <option value="80">50</option>
                                                        <option value="100">60</option>
                                                        <option value="200">90</option>
                                                        <option value="250">100</option>
                                                        <option value="300">200</option>
                                                    </select>
                                                    <span class="text-danger error-text mpuw_baris_err"></span>
                                                </div>
                                                <span class="input-group-text">Max Baris</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-5">
                                <label class="form-label">File</label>
                                <input type="file" class="form-control form-control-solid" name="mpuw_file" id="mpuw_file" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" />
                                <span class="text-danger error-text mpuw_file_err"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    {{-- <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary btn-sm" id="btnImportUw_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="clearForm('frxx_uploadUw')"><i class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="close_mUw()"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
