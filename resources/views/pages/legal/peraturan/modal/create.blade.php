<div class="modal fade" id="modal_peraturan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModCreate()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_peraturan" name="frxx_peraturan" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">

                            <input class="form-control" name="map_pk" id="map_pk" type="hidden"
                                data-allow-clear="false" readonly />
                            <div class="col-md-6 mb-5">
                                <div class="mb-5 ">
                                    <label class="required form-label">Nomor</label>
                                    <input class="form-control" name="map_nomor" id="map_nomor" type="text"
                                        data-allow-clear="true" placeholder="Masukan nomor" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Bulan</label>
                                    <select class="form-select" name="map_bulan" id="map_bulan" type="text"
                                        data-allow-clear="true" placeholder="Masukan bulan">
                                    <option selected disabled value="">pilih bulan</option>
                                    <option value="1">Januari</option>
                                    <option value="2">Februari</option>
                                    <option value="3">Maret</option>
                                    <option value="4">April</option>
                                    <option value="5">Mei</option>
                                    <option value="6">Juni</option>
                                    <option value="7">Juli</option>
                                    <option value="8">Agustus</option>
                                    <option value="9">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tahun</label>
                                    <select class="form-select" name="map_tahun" id="map_tahun" type="text"
                                        data-allow-clear="true" placeholder="Masukan tahun">
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
                                        <option value="" selected disabled>pilih tahun</option>                
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Tentang</label>
                                    <input class="form-control" name="map_tentang" id="map_tentang" type="text"
                                        data-allow-clear="true" placeholder="Masukan tentang surat / dokumen" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="mb-5">
                                <label class="required form-label">Jenis</label>
                                <select class="form-select" name="map_jenis" id="map_jenis" type="text"
                                    data-allow-clear="true" placeholder="Pilih jenis" >
                                    <option value="" selected disabled> - pilih -</option>
                                    <option value="0"> Peraturan Perusahaan </option>
                                    <option value="1"> SOP </option>
                                    <option value="2"> SK </option>
                                    <option value="3"> Pedoman </option>
                                    <option value="4"> Job Desc </option>
                                </select>
                                {{-- <span class="text-danger error-text mpojk_jenis_err"></span> --}}
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="mb-5">
                                <label class="required form-label">Tipe Online</label>
                                <select class="form-select" name="map_online" id="map_online" type="text"
                                    data-allow-clear="true" placeholder="Pilih tipe online" >
                                    <option value="" selected disabled> - pilih -</option>
                                    <option value="0"> Online </option>
                                    <option value="1"> Offline </option>
                                </select>
                                {{-- <span class="text-danger error-text mpojk_jenis_err"></span> --}}
                            </div>
                        </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Upload Dokumen</label>
                                    <input type="file" class="form-control" name="map_dokumen"
                                        placeholder="pilih file" id="map_dokumen" />
                                    {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" id="btn_reset" onclick="clearForm('frxx_peraturan')"><i
                            class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" id="btn_tutup" onclick="closeModCreate()"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
