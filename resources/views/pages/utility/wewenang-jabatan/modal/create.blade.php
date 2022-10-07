<div class="modal fade" id="modalWewenang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-700px">
        <div class="modal-content">
            <div class="modal-header" id="modalWewenang_header">
                <h2 class="fw-bolder" id="tModWewenang"></h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" id="btn_close">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>

            <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalWewenang_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalWewenang_header" data-kt-scroll-wrappers="#modalWewenang_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Menu</label>
                                    <select class="form-select form-select-solid readonly" name="wmj_wmn_kode" id="wmj_wmn_kode" data-dropdown-parent="#modalWewenang" data-placeholder="Pilih Nama Menu" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($form_menu as $key=>$data)
                                            <option value="{{ $data->wmn_kode }}">{{ $data->wmn_descp }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text wmj_wmn_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Wewenang Jabatan</label>
                                    <select class="form-select form-select-solid readonly" name="wmj_sjab_kode" id="wmj_sjab_kode" data-dropdown-parent="#modalWewenang" data-placeholder="Pilih Hak Jabatan" data-allow-clear="true">
                                        <option></option>
                                        @foreach ($form_jab as $key=>$data)
                                            <option value="{{ $data->sjab_kode }}">{{ $data->sjab_kode }} - {{ $data->sjab_ket }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text wmj_sjab_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="mb-5">
                                    <label class="form-label">Menu Aktif</label>
                                    <select class="form-select form-select-solid readonly" name="wmj_aktif" id="wmj_aktif" data-dropdown-parent="#modalWewenang" data-placeholder="Pilih Hak Jabatan" data-allow-clear="true">
                                        <option></option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    <span class="text-danger error-text wmj_aktif_err"></span>
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
