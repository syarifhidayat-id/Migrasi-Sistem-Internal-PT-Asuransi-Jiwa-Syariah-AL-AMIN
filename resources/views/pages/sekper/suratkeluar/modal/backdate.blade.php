<div class="modal fade" id="modal_bd" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod_bd"></h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="btn_close_bd">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>

            <form id="frxx_bd" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">

                            {{-- <input class="form-control" name="tsin_pk" id="tsin_pk" type="hidden"
                                data-allow-clear="false" readonly /> --}}
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Jenis Surat</label>
                                    <select class="form-select" data-dropdown-parent="#modal_bd" id="tsin_js_bd"
                                    name="tsin_js" data-placeholder="Masukan jenis surat" data-allow-clear="true">
                                    <option ></option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Dari/untuk Direktorat</label>
                                    <select class="form-select" data-dropdown-parent="#modal_bd" name="tsin_direktorat" id="tsin_direktorat_bd"  data-placeholder="Masukan surat direktorat!" data-allow-clear="true">
                                    <option></option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>

                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tanggal Buat</label>
                                    <input class="form-control" name="tsin_tanggal" id="tsin_tanggal" type="date"
                                        data-allow-clear="true" placeholder="Masukan tanggal surat!" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>

                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Nomor Referensi</label>
                                    <input class="form-control" name="tsin_referensi" id="tsin_referensi" type="date"
                                        data-allow-clear="true" placeholder="Masukan referensi surat!" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Perihal</label>
                                    <input class="form-control" name="tsin_hal" id="tsin_hal" type="text"
                                        data-allow-clear="true" placeholder="Masukan perihal surat!" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Tujuan</label>
                                    <input type="text" class="form-control" name="tsin_tujuan"
                                        placeholder="Masukan instansi tujuan surat!" id="tsin_tujuan" />
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">U/P</label>
                                    <input type="text" class="form-control" name="tsin_perhatian"
                                        placeholder="Masukan pic dari instansi asal surat!" id="tsin_perhatian" />
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Tanda Tangan</label>
                                    <input class="form-control" name="tsin_tertanda" data-allow-clear="true"
                                        placeholder="Masukan tanda tangan!" id="tsin_tertanda"/>
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Urgensi</label>
                                    <select class="form-select" name="tsin_urgen" data-allow-clear="true"
                                        data-placeholder="Pilih yang menyetujui!" id="tsin_urgen">
                                    <option value="" disabled selected>Pilih urgensi!</option>
                                    <option value="0">Normal</option>
                                    <option value="1">Sangat Penting</option>
                                    <option value="2">Sampah</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Nama Pembuat</label>
                                    <input class="form-control" name="tsin_pembuat" data-allow-clear="true"
                                        placeholder="Masukan nama pembuat!" id="tsin_pembuat"/>
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan_bd"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" id="btn_reset_bd"><i
                            class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" id="btn_tutup_bd"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
