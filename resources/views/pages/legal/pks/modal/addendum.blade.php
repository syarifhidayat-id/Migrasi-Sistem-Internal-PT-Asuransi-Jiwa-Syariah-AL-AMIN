<div class="modal fade" id="modalAddendum" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tModAddendum"></h2>
                
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalAddendum')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_add" name="frxx_add" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-5" id="hidePk">
                                <label class="form-label">Cari PK</label>
                                <select class="form-select" data-dropdown-parent="#modalAddendum" id="cari_pk"
                                    name="cari_pk" data-placeholder="Cari PK" data-allow-clear="true">
                                    <option></option>
                                </select>
                                {{-- <input type="text" class="form-control" name="eds" id="eds"> --}}
                                <span class="text-danger error-text cari_pk_err"></span>
                            </div>
                            <div class="col-md-6 mb-5" id="hideField">
                                <label class="form-label">Hidden</label>
                                <input type="text" class="form-control" name="mpks_pk" id="mpks_pk">
                                <input type="text" class="form-control" name="eds" id="eds">
                                <span class="text-danger error-text mpks_mrkn_kode_err"></span>
                            </div>
                            <div class="col-md-6 mb-5">
                                <label class="form-label">Pemegang Polis</label>
                                <select class="form-select" data-dropdown-parent="#modalAddendum" id="mpks_mrkn_kode_test"
                                    name="mpks_mrkn_kode" data-placeholder="Pilih pemegang polis" data-allow-clear="true">
                                    <option></option>
                                </select>
                                <span class="text-danger error-text mpks_mrkn_kode_err"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Instansi</label>
                                    <input class="form-control" name="mpks_instansi" id="mpks_instansi" type="text"
                                        data-allow-clear="true" placeholder="Masukan instansi" />
                                <span class="text-danger error-text mpks_instansi_err"></span>

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Nomor PKS</label>
                                    <input class="form-control" name="mpks_nomor" id="mpks_nomor" type="text"
                                        data-allow-clear="true" placeholder="Masukan nomor pks" />
                                        <span class="text-danger error-text mpks_nomor_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Perihal</label>
                                    <input type="text" class="form-control" name="mpks_tentang" id="mpks_tentang"
                                        data-allow-clear="true" type="text" placeholder="Masukan perihal" />
                                        <span class="text-danger error-text mpks_tentang_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="required form-label">Tgl Mulai</label>
                                    <input type="date" class="form-control" name="mpks_tgl_mulai" id="mpks_tgl_mulai"
                                     />
                                     <span class="text-danger error-text mpks_tgl_mulai_err"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-5">
                                    <label class="required form-label">Tgl Akhir</label>
                                    <input type="date" class="form-control" name="mpks_tgl_akhir" id="mpks_tgl_akhir"
                                     />
                                     <span class="text-danger error-text mpks_tgl_akhir_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">PIC Reminder</label>
                                    <input type="text" class="form-control" name="mpks_pic" id="mpks_pic"
                                        placeholder="Masukan pic" />
                                        <span class="text-danger error-text mpks_pic_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">No. HP PIC</label>
                                    <input type="text" class="form-control" name="mpks_pic_hp" id="mpks_pic_hp"
                                        placeholder="Masukan hp pic" />
                                        <span class="text-danger error-text mpks_pic_hp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Email PIC</label>
                                    <input type="text" class="form-control" name="mpks_pic_email"
                                        id="mpks_pic_email" placeholder="Masukan email pic" />
                                        <span class="text-danger error-text mpks_pic_email_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">No. HP Atasan</label>
                                    <input type="text" class="form-control" name="mpks_atasan_hp"
                                        placeholder="Masukan hp atasan" id="mpks_atasan_hp" />
                                        <span class="text-danger error-text mpks_atasan_hp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Email Atasan</label>
                                    <input type="text" class="form-control" name="mpks_atasan_email"
                                        placeholder="Masukan email atasan" id="mpks_atasan_email" />
                                        <span class="text-danger error-text mpks_atasan_email_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Ket/Catatan</label>
                                    <input type="text" class="form-control" name="mpks_ket"
                                        placeholder="Masukan keterangan" id="mpks_ket" />
                                        <span class="text-danger error-text mpks_ket_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="mpks_dokumen" placeholder="pilih file"
                                        id="mpks_dokumen" />
                                        <span class="text-danger error-text mpks_dokumen_err"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" onclick="clearForm('frxx_add')" id="btnBersih" name="btnBersih"><i
                            class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalAddendum')"> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
