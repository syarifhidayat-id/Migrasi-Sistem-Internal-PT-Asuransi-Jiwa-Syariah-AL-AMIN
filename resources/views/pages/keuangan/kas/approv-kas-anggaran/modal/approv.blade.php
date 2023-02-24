<div class="modal fade" id="dlg_approv" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="dlg_approv_header">
                <h2 class="fw-bolder" id="title_mod"></h2>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="close_dlg_approv()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="ff_dlg_approv" name="ff_dlg_approv" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="dlg_approv_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#dlg_approv_header" data-kt-scroll-wrappers="#dlg_approv_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            {{-- <input class="form-control" name="tkad_pk" id="tkad_pk" type="hidden" placeholder="PK"
                                data-allow-clear="true" />
                            <input type="hidden" id="tkad_atjh_pk" name="tkad_atjh_pk" />
                            <input type="hidden" id="tkad_jns_realisasi" name="tkad_jns_realisasi" />
                            <input type="hidden" id="tkad_askn_kode" name="tkad_askn_kode" /> --}}
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Peruntukan Dana</label>
                                    <select class="form-select form-select-solid" data-kt-select2="true"
                                        name="tkad_keterangan" data-control="select2" id="tkad_keterangan"
                                        data-dropdown-parent="#dlg_approv" data-placeholder="pilih" type="text"
                                        data-allow-clear="true">
                                        <option></option>
                                        @foreach ($slc_ket as $key => $data)
                                            <option value="{{ $data->kode }}">{{ $data->ket }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Tipe Dianggaran</label>
                                    <select class="form-select" name="tkad_mta_pk" data-control="select2"
                                        id="tkad_mta_pk" data-dropdown-parent="#dlg_approv"  data-placeholder="-"
                                        type="text" data-allow-clear="true">
                                        <option></option>
                                        {{ optSql('SELECT mta_pk kode,mta_keterangan ket FROM epms.mst_tipe_anggaran   ORDER BY 1 ', 'kode', 'ket') }}
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Nilai</label>
                                    <input class="form-control" name="tkad_total" id="tkad_total" type="text" data-allow-clear="true" />

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Realisasi</label>
                                    <input class="form-control" name="e_realisasi" id="e_realisasi" type="text" data-allow-clear="true" />
                                 

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Keterangan REL OPS</label>
                                    <input class="form-control" name="e_relops" id="e_relops" type="text" data-allow-clear="true" />
                                 

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Kelompok KAS</label>
                                    <select class="form-select" name="tkad_kelompokas" data-control="select2"
                                        id="tkad_kelompokas" data-placeholder="-" data-dropdown-parent="#dlg_approv" type="text" data-allow-clear="true">
                                        <option></option>
                                        {{ optSql('SELECT mkk_pk kode,mkk_nama ket FROM epms.mst_kelompok_kas ORDER BY 1 ', 'kode', 'ket') }}
                                    </select>
                                   
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="form-label">Status Approval</label>
                                    <select class="form-select" name="statusx" data-control="select2" id="statusx"
                                        data-dropdown-parent="#dlg_approv" 
                                        type="text" data-allow-clear="true">
                                        <option value="0" select>Pospone</option>
                                        <option value="1">Disetujui</option>
                                    </select>
                                    <input type="text" id="tkad_relops" name="tkad_relops">

                                    
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    {{-- <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                            class="fa-solid fa-trash"></i> Hapus</button> --}}
                    <button type="button" class="btn btn-danger btn-sm" onclick="close_dlg_approv()">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
