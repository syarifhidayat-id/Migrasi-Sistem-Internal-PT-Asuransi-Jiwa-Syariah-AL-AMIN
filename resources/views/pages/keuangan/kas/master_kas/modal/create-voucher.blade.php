<div class="modal fade" id="modal_voucher" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod_vcr"></h2>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModalVcr()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_vcr" name="frxx_vcr" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Nomor Voucher</label>
                                    
                                    <input class="form-control" name="tkav_nomor" id="tkav_nomor" type="text" data-allow-clear="true" readonly/>
                                    {{-- <input class="form-control" name="e_nopk" id="e_nopk" data-allow-clear="false" readonly /> --}}
                                    {{-- <input class="form-control" name="tkav_pk" id="tkav_pk" data-allow-clear="false" readonly /> --}}
                                    <input class="form-control" name="tkav_tdna_pk" id="tkav_tdna_pk" data-allow-clear="false" value="{{ $kode }}" readonly />
                                    <input class="form-control" name="tkav_akun" id="tkav_akun" data-allow-clear="false" readonly />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tgl. Voucher</label>
                                    <input class="form-control" name="tkav_tanggal" id="tkav_tanggal" type="date"
                                        data-allow-clear="true" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Nilai</label>
                                    <input class="form-control" name="tkav_total" id="tkav_total" type="text"
                                        data-allow-clear="true" placeholder="Nilai voucher"/>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tipe Transaksi</label>
                                    <select class="form-select" data-control="select2" name="tkav_tipe_kas" id="tkav_tipe_kas" type="text"
                                        data-allow-clear="true" data-dropdown-parent="#modal_voucher" data-placeholder="Tipe transaksi">
                                        <option></option>
                                        <option value="K">Dibayarkan Kepada</option>
                                        <option value="D">Diterima Dari</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Penerima Dana</label>
                                    <input class="form-control" name="tkav_penerima" id="tkav_penerima" type="text"
                                        data-allow-clear="true" placeholder="Masukan penerima dana" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Cara Pembayaran</label>
                                        <select class="form-select" data-control="select2" name="tkav_tipe_bayar" id="tkav_tipe_bayar" type="text"
                                        data-allow-clear="true" data-dropdown-parent="#modal_voucher" data-placeholder="Cara pembayaran">
                                        <option></option>
                                        <option value="0">Tunai</option>
                                    </select>
                                        {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Peruntukan Dana</label>
                                        <select class="form-select" data-control="select2" name="tkav_ket" id="tkav_ket" type="text"
                                        data-allow-clear="true" data-dropdown-parent="#modal_voucher" data-placeholder="Peruntukan dana">
                                        <option></option>
                                        <option value="belanja bulanan">Belanja Bulanan</option>
                                    </select>
                                        {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
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
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModalVcr()" id="btn_tutup"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
