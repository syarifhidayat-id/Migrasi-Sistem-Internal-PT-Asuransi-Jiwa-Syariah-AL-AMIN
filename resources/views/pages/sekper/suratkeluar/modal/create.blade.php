<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod"></h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="btn_closeCreate">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>

            <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">

                            <input class="form-control" name="tsin_pk" id="tsin_pk" type="hidden"
                                data-allow-clear="false" readonly />
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Jenis Surat</label>
                                    <select class="form-select" data-dropdown-parent="#modal" id="tsin_js"
                                    name="tsin_js" data-placeholder="Pilih jenis surat" data-allow-clear="true">
                                    <option ></option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Surat Direktorat</label>
                                    <select class="form-select" data-dropdown-parent="#modal" name="tsin_direktorat" id="tsin_direktorat"  data-placeholder="Masukan surat direktorat!" data-allow-clear="true">
                                    <option></option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>

                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tanggal Surat</label>
                                    <input class="form-control" name="tsin_tanggal" id="tsin_tanggal" type="date"
                                        data-allow-clear="true" placeholder="Masukan tanggal surat!" />
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
                                    <label class="required form-label">Surat Kepada</label>
                                    <input type="text" class="form-control" name="tsin_tujuan"
                                        placeholder="Masukan instansi tujuan surat!" id="tsin_tujuan" />
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">PIC</label>
                                    <input type="text" class="form-control" name="tsin_pegang_polis"
                                        placeholder="Masukan pic dari instansi asal surat!" id="tsin_pegang_polis" />
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Referensi Dari Surat</label>
                                    <select class="form-select" data-dropdown-parent="#modal"
                                    data-allow-clear="true" name="tsin_referensi"
                                        data-placeholder="Masukan instansi referensi surat!" id="tsin_referensi"></select>
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">No Referensi</label>
                                    <input type="text" class="form-control" name="tsin_noreferensi"
                                        placeholder="Masukan no referensi surat!" id="tsin_noreferensi" readonly/>
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Yang Mengajukan</label>
                                    <select class="form-select" name="tsin_pembuat" data-dropdown-parent="#modal" data-allow-clear="true" data-placeholder="Pilih yang mengajukan!" id="tsin_pembuat" >
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Disetujui/TTD</label>
                                    <select class="form-select" name="tsin_ttd" data-allow-clear="true" data-dropdown-parent="#modal"
                                        data-placeholder="Pilih yang menyetujui!" id="tsin_ttd"></select>
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="tsin_doksurat"
                                        placeholder="pilih file" id="tsin_doksurat" />
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                            class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" id="btn_tutup"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
