<div class="modal fade" id="modalUpdateTax" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalUpdateTax_header">
                <h2 class="fw-bolder" id="titleMod"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeBtnUpdate()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="formUpdateTax" name="formUpdateTax" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalUpdateTax_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalUpdateTax_header" data-kt-scroll-wrappers="#modalUpdateTax_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <span class="input-group-text">Tahun</span>
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" id="x_tahun" name="x_tahun" data-dropdown-parent="#modalUpdateTax" data-placeholder="Pilih Tahun" data-allow-clear="true" data-hide-search="false">
                                                <option></option>
                                                @for ($tahun; $tahun <= date('Y'); $tahun++)
                                                    <option value="{{ $tahun }}">{{ $tahun }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <span class="input-group-text">Nama Pic</span>
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid" data-control="select2" name="cari_tax" id="cari_tax" data-dropdown-parent="#modalUpdateTax" data-placeholder="Cari pic" data-allow-clear="true" data-hide-search="false">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Kode Pic (NIK)</label>
                                    <input type="text" class="form-control form-control-solid" name="x_kode" id="x_kode" placeholder="Masukkan kode user/nik" maxlength="16" />
                                    <span class="text-danger error-text x_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">NPWP</label>
                                    <input type="text" class="form-control form-control-solid" name="x_npwp" id="x_npwp" placeholder="Masukkan Npwp" maxlength="20" />
                                    <span class="text-danger error-text x_npwp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Nama User</label>
                                    <input type="text" class="form-control form-control-solid" name="x_nama" id="x_nama" placeholder="Masukkan Nama User"/>
                                    <span class="text-danger error-text x_nama_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Status User</label>
                                    <input type="text" class="form-control form-control-solid" name="x_status" id="x_status" placeholder="Pilih status user"/>
                                    <span class="text-danger error-text x_status_err"></span><br>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Total Komisi Bruto</label>
                                    <input type="text" class="form-control form-control-solid" name="x_saldo" id="x_saldo" placeholder="ex. 250,078.00" data-type="rupiah" />
                                    <span class="text-danger error-text x_saldo_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeBtnUpdate()"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
