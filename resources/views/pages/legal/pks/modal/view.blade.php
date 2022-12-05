<div class="modal fade" id="modalView" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalView_header">
                <h2 class="fw-bolder" id="tModView"></h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="btn_close3">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>

            <form id="frxx1" name="frxx1" method="post" enctype="multipart/form-data">
                @csrf

                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalView_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalView_header" data-kt-scroll-wrappers="#modalView_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Instansi</label>
                                    <input class="form-control form-control-solid" name="mpks_instansi"
                                        id="view_mpks_instansi" type="text" data-allow-clear="true" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <label class="form-label">Pemegang Polis</label>
                                <input type="text" class="form-control form-control-solid" name="mpks_mrkn_kode"
                                    id="view_mpks_mrkn_kode" data-allow-clear="true" readonly />
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Nomor PKS</label>
                                    <input class="form-control form-control-solid" name="mpks_nomor" id="view_mpks_nomor"
                                        type="text" data-allow-clear="true" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Perihal</label>
                                    <input type="text" class="form-control form-control-solid" name="mpks_tentang"
                                        id="view_mpks_tentang" data-allow-clear="true" type="text" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Tgl Mulai</label>
                                    <input type="text" class="form-control form-control-solid" name="mpks_tgl_mulai"
                                        id="view_mpks_tgl_mulai" readonly />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="form-label">Tgl Akhir</label>
                                    <input type="text" class="form-control form-control-solid" name="mpks_tgl_akhir"
                                        id="view_mpks_tgl_akhir" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">PIC Reminder</label>
                                    <input type="text" class="form-control form-control-solid" name="mpks_pic"
                                        id="view_mpks_pic" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">No. HP PIC</label>
                                    <input type="text" class="form-control form-control-solid" name="mpks_pic_hp"
                                        id="view_mpks_pic_hp" readonly />
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Email PIC</label>
                                    <input type="text" class="form-control form-control-solid" name="mpks_pic_email"
                                        id="view_mpks_pic_email" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">No. HP Atasan</label>
                                    <input type="text" class="form-control form-control-solid" name="mpks_atasan_hp"
                                        id="view_mpks_atasan_hp" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Email Atasan</label>
                                    <input type="text" class="form-control form-control-solid"
                                        name="mpks_atasan_email" id="view_mpks_atasan_email" readonly />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    {{-- <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button> --}}
                    <button type="button" class="btn btn-danger btn-sm" id="btn_close4"><i
                            class="fa-solid fa-xmark" ></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
