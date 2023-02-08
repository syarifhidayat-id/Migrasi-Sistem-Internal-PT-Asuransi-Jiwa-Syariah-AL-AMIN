<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod"></h2>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeMod()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <input class="form-control" name="mojk_pk" id="mojk_pk" type="hidden"
                                data-allow-clear="false" readonly />
                                <div class="col-md-6 mb-5">
                                    <label class="form-label">Jenis Dokumen</label>
                                    <select class="form-select" data-dropdown-parent="#modal" id="mojk_jenis"
                                        name="mojk_jenis" data-placeholder="Pilih pemegang polis" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text mojk_jenis_err"></span>
                                </div>
                            <div class="col-md-6 mb-5">
                                    <label class="required form-label">Keterangan Dokumen</label>
                                    <input class="form-control" name="mojk_ket_jenis" id="mojk_ket_jenis" type="text"
                                        data-allow-clear="true" placeholder="Masukan ket jenis" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tahun</label>
                                    <select class="form-select" data-control="select2" data-dropdown-parent="#modal" name="mojk_tahun" id="mojk_tahun" type="text" data-allow-clear="true" data-placeholder="Masukan tahun">
                                        <option></option>
                                    <option value="2007">2007</option>
                                    <option value="2008">2008</option>
                                    <option value="2009">2009</option>
                                    <option value="2010">2010</option>
                                    <option value="2011">2011</option>
                                    <option value="2012">2012</option>
                                    <option value="2013">2013</option>
                                    <option value="2014">2014</option>
                                    <option value="2015">2015</option>
                                    <option value="2016">2016</option>
                                    <option value="2017">2017</option>
                                    <option value="2018">2018</option>
                                    <option value="2019">2019</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="mojk_file1"
                                        placeholder="pilih file" id="mojk_file1" />
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
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeMod()"> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
