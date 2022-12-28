<div class="modal fade" id="modalAppKomOver" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalAppKomOver_header">
                <h2 class="fw-bolder" id="titleMod"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalAppKomOver')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="formAppKom" name="formAppKom" method="post">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalAppKomOver_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalAppKomOver_header" data-kt-scroll-wrappers="#modalAppKomOver_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-12">
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">ID</label>
                                    <input type="text" class="form-control form-control-solid bg-warning" name="tkomh_pk" id="tkomh_pk" placeholder="ID PK">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Kode Polis</label>
                                    <input type="text" class="form-control form-control-solid bg-warning" name="kdpolis_x" id="kdpolis_x" placeholder="Kode Polis">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Rekening Pembayaran</label>
                                    <!--<select class="form-select form-select-solid required_sel" name="x_giro" id="x_giro" data-dropdown-parent="#modalAppKomOver_header" data-placeholder="ex. MAIN" data-allow-clear="true">-->
                                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih Rekening" data-allow-clear="true" data-dropdown-parent="#modalAppKomOver_header" data-hide-search="false" id="x_giro" name="x_giro" required>

                                        <option></option>
                                        @foreach ($bankgiro as $key=>$data)
                                           <option value="{{ $data->kode }}">{{ $data->nama }}</option>
                                       @endforeach
                                    </select>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Penerima Komisi</label>
                                    <select class="form-select form-select-solid fw-bolder" name="tkomh_penerima" id="tkomh_penerima" data-dropdown-parent="#modalAppKomOver_header" data-placeholder="Pilih Penerima Komisi" data-allow-clear="true" required>
                                        <option></option>
                                        @foreach ($karyawan as $key=>$datas)
                                           <option value="{{ $datas->kode }}">{{ $datas->nama }}</option>
                                       @endforeach
                                    </select>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Penerima Overidding</label>
                                   <!-- <select class="form-select form-select-solid fw-bolder" name="tkomh_penerima_o" id="tkomh_penerima_o" data-dropdown-parent="#modalAppKomOver_header" data-placeholder="Pilih Penerima Overridding" data-allow-clear="true">-->
                                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih Penerima Overidding" data-allow-clear="true" data-dropdown-parent="#modalAppKomOver_header" data-hide-search="false" id="tkomh_penerima_o" name="tkomh_penerima_o">
                                        <option></option>
                                        @foreach ($karyawan as $key=>$datax)
                                           <option value="{{ $datax->kode }}">{{ $datax->nama }}</option>
                                       @endforeach
                                    </select>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Status Approval</label>
                                    <select class="form-select form-select-solid required_sel" name="x_status" id="x_status" data-dropdown-parent="#modalAppKomOver_header" data-placeholder="Pilih Status Approval" data-allow-clear="true" required>
                                        <option value="0">Pospone</option>
                                        <option value="1">Disetujui</option>
                                        <option value="2">Tolak</option>
                                    </select>
                                    </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    {{-- <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <!--<button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i class="fa-solid fa-trash"></i> Hapus</button>-->
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalAppKomOver')"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
