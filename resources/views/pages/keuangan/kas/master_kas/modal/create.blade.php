<div class="modal fade" id="modal_rincian_transaksi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod"></h2>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modal_rincian_transaksi')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_tkad" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            {{-- <input class="form-control" name="mojk_pk" id="mojk_pk" type="hidden"
                                data-allow-clear="false" readonly /> --}}
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Jenis Transaksi</label>
                                    <select class="form-select" data-control="select2" name="e_akun" id="e_akun" type="text"
                                        data-allow-clear="true" data-placeholder="pilih jenis transaksi!" data-dropdown-parent="#modal_rincian_transaksi">
                                        <option></option>
                                        <option value="1">data 1</option>
                                        <option value="2">data 2</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Peruntukan Dana</label>
                                    <select class="form-select" name="tkad_keterangan" data-control="select2" id="tkad_keterangan" type="text" data-dropdown-parent="#modal_rincian_transaksi"
                                        data-allow-clear="true" data-placeholder="Pilih peruntukan dana">
                                    <option></option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tipe Dana</label>
                                    <input class="form-control" name="tkad_tipe_dk" id="tkad_tipe_dk" type="text"
                                        data-allow-clear="true" placeholder="Tipe dana" readonly/>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tipe Dianggaran</label>
                                    <select class="form-select" data-control="select2" name="tkad_mta_pk" id="tkad_mta_pk" type="text"
                                        data-allow-clear="true" data-dropdown-parent="#modal_rincian_transaksi" data-placeholder="Pilih tipe dianggaran">
                                        <option></option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Nilai</label>
                                    <input class="form-control" name="tkad_total" id="tkad_total" type="text"
                                        data-allow-clear="true" data-dropdown-parent="#modal_rincian_transaksi" placeholder="Masukan nilai" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Jenis Realisasi</label>
                                    <div class="input-group">
                                        <select class="form-select" data-control="select2" data-dropdown-parent="#modal_rincian_transaksi" name="tkad_jns_realisasi" id="tkad_jns_realisasi" type="text"
                                        data-allow-clear="true" data-placeholder="Jenis realisasi">
                                        <option></option>
                                    </select>
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text" id="id_jns_realisasi"></span>
                                    </div> --}}
                                        {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">ID Kasbon</label>
                                    <input class="form-control" name="e_kasbon" id="e_kasbon" type="text"
                                        data-allow-clear="true" placeholder="ID kasbon" />
                                    <span class="font-italic">*Diisi jika kasbon dilunasi</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    {{-- <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                            class="fa-solid fa-trash"></i> Hapus</button> --}}
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modal_rincian_transaksi')" id="btn_tutup"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
