<div class="modal fade" id="approv" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalView_header">
                <h4 class="fw-bolder" id="tMod"></h4>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('approv')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="ff" name="ff" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Tgl. Jurnal</label>
                                    <input class="form-control" name="atjh_tanggal" id="atjh_tanggal" type="text" />
                                    <input class="form-control" name="ket_1" id="ket_1" type="hidden" />
                                    <input class="form-control" name="d_1" id="d_1" type="hidden" />
                                    <input class="form-control" name="k_1" id="k_1" type="hidden" />
                                    <input class="form-control" name="a_1" id="a_1" type="hidden" />
                                    <input class="form-control" name="namakun_1" id="namakun_1" type="hidden" />

                                    <input class="form-control" name="ket_2" id="ket_2" type="hidden" />
                                    <input class="form-control" name="d_2" id="d_2" type="hidden" />
                                    <input class="form-control" name="k_2" id="k_2" type="hidden" />
                                    <input class="form-control" name="a_2" id="a_2" type="hidden" />
                                    <input class="form-control" name="namakun_2" id="namakun_2" type="hidden" />

                                    <input class="form-control" name="hdrpk" id="hdrpk" type="hidden" />
                                    <input class="form-control" name="vinal" id="vinal" type="hidden" />
                                    <input class="form-control" name="tdna_dk" id="tdna_dk" type="hidden" />
                                    <input class="form-control" name="mlok_kode" id="mlok_kode" type="hidden" />
                                    <input class="form-control" name="tkad_pk" id="tkad_pk" type="hidden" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Jurnal</label>
                                    <input class="form-control" name="atjh_amjb_kode" id="atjh_amjb_kode"
                                        type="text" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Keterangan</label>
                                    <input class="form-control" name="atjh_keterangan" id="atjh_keterangan"
                                        type="textarea" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">No Reff</label>
                                    <input class="form-control" name="atjh_nomor" id="atjh_nomor" type="text" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-body py-10">
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border cell-border align-middle gy-5 gs-5"
                            id="serverSide_ff">
                            <thead>
                                <tr
                                    class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                    <th class="min-w-200px">No.</th>
                                    <th class="min-w-50px">Uraian</th>
                                    <th class="min-w-100px">D/K</th>
                                    <th class="min-w-100px">Jumlah</th>
                                    <th class="min-w-150px">Kode Akun</th>
                                    <th class="min-w-150px">Nama Akun</th>
                                </tr>
                            </thead>
                            {{-- <tbody></tbody> --}}
                        </table>
                    </div>
                </div>



                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    {{-- <button class="btn btn-primary btn-sm" onclick="grd_submit()" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button> --}}
                    {{-- <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                            class="fa-solid fa-trash"></i> Hapus</button> --}}
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('approv')"
                        id="btn_tutup"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
