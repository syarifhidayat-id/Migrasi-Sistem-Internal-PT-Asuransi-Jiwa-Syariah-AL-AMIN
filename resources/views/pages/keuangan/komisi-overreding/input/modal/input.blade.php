<div class="modal fade" id="modalInputTax" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalInputTax_header">
                <h2 class="fw-bolder" id="tModInputTax"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeBtnModal()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="formInputTax" name="formInputTax" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalInputTax_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalInputTax_header" data-kt-scroll-wrappers="#modalInputTax_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Kode User (NIK)</label>
                                    <input type="number" class="form-control form-control-solid" name="mtx_kode" id="mtx_kode" placeholder="Masukkan kode user/nik" maxlength="16" />
                                    <span class="text-danger error-text mtx_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">NPWP</label>
                                    <input type="number" class="form-control form-control-solid" name="mtx_npwp" id="mtx_npwp" placeholder="Masukkan Npwp" maxlength="20" />
                                    <span class="text-danger error-text mtx_npwp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Nama User</label>
                                    <input type="text" class="form-control form-control-solid" name="mtx_nama" id="mtx_nama" placeholder="Masukkan Nama User"/>
                                    <span class="text-danger error-text mtx_nama_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Status User</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mtx_status" id="mtx_status" data-dropdown-parent="#modalInputTax" data-placeholder="Pilih status user" data-allow-clear="true">
                                        <option></option>
                                        <option value="0">Karyawan Al Amin</option>
                                        <option value="1">Non Karyawan Al Amin</option>
                                    </select>
                                    <span class="text-danger error-text mtx_status_err"></span><br>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="clearForm('formInputTax')"><i class="fa-solid fa-trash"></i> Bersih</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeBtnModal()"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
