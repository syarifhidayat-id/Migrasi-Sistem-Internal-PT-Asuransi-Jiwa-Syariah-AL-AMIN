<div class="modal fade" id="modalMenu" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tModMenu"></h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="btn_close">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>

            <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Menu Tipe</label>
                                    <select class="form-select form-select-solid required_sel" name="wmn_tipe" id="wmn_tipe" data-dropdown-parent="#modalMenu" data-placeholder="Pilih tipe menu" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text wmn_tipe_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <label class="form-label">PK Menu</label>
                                <div class="input-group input-group-solid">
                                    <input type="text" class="form-control form-control-solid" name="wmn_kode" id="wmn_kode" placeholder="PK Menu"/>
                                    <div class="input-group-append">
                                        {{-- <button class="btn btn-primary" type="button"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button> --}}
                                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                            <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                                        </button> --}}
                                    </div>
                                </div>
                                <label class="required form-label">kosongkan jika baru</label>
                                {{-- <label class="required form-label sm">kosongkan jika tidak edit</label> --}}
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Menu Main</label>
                                    <select class="form-select form-select-solid required_sel" name="wmn_key" id="wmn_key" data-dropdown-parent="#modalMenu" data-placeholder="ex. MAIN" data-allow-clear="true">
                                        {{-- <option></option> --}}
                                    </select>
                                    <span class="text-danger error-text wmn_key_err"></span><br>
                                    <label class="required form-label">Isi MAIN jika menu utama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Icon Menu</label>
                                    <div class="input-group input-group-solid">
                                        <input type="text" class="form-control form-control-solid" name="wmn_icon" id="wmn_icon" placeholder="ex. fa-solid fa-house"/>
                                        <div class="input-group-append">
                                            <a href="https://fontawesome.com/search?s=solid&f=classic&o=r" class="btn btn-primary" target="_blank"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
                                        </div>
                                    </div>
                                    {{-- <span class="text-danger error-text wmn_icon_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Nama Menu</label>
                                    <input type="text" class="form-control form-control-solid required_sel" name="wmn_descp" id="wmn_descp" placeholder="ex. Sekper"/>
                                    <span class="text-danger error-text wmn_descp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Route Menu</label>
                                    <input type="text" class="form-control form-control-solid" name="wmn_url_n" id="wmn_url_n" placeholder="ex. utility.menu.create"/>
                                    <span class="text-danger error-text wmn_url_n_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Alamat Menu</label>
                                    <textarea class="form-control form-control-solid" rows="3" name="wmn_urlkode" id="wmn_urlkode" placeholder="Alamat"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Tips Menu</label>
                                    <input type="text" class="form-control form-control-solid" name="wmn_info" id="wmn_info" placeholder="Tips Menu"/>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">URL Menu</label>
                                    <input type="text" class="form-control form-control-solid required_sel" name="wmn_url_o_n" id="wmn_url_o_n" placeholder="ex. utility/menu"/>
                                    <span class="text-danger error-text wmn_url_o_n_err"></span><br>
                                    <label class="required form-label">jika main, ex. utility/*</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Menu Urut</label>
                                    <input type="number" class="form-control form-control-solid required_sel" name="wmn_urut" id="wmn_urut" placeholder="Urutan Menu"/>
                                    <span class="text-danger error-text wmn_urut_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Pemegang Polis</label>
                                    {{-- <input type="text" class="form-control form-control-solid" name="wmn_mrkn_kode" id="wmn_mrkn_kode" placeholder="Pemegang Polis"/> --}}
                                    <select class="form-select form-select-solid" name="wmn_mrkn_kode" id="wmn_mrkn_kode" data-dropdown-parent="#modalMenu" data-placeholder="pilih Pemegang Polis" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nomor Polis</label>
                                    {{-- <input type="text" class="form-control form-control-solid" name="wmn_mpol_kode" id="wmn_mpol_kode" placeholder="Nomor Polis"/> --}}
                                    <select class="form-select form-select-solid" name="wmn_mpol_kode" id="wmn_mpol_kode" data-dropdown-parent="#modalMenu" data-placeholder="pilih Nomor Polis" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    {{-- <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" id="btn_close2"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
