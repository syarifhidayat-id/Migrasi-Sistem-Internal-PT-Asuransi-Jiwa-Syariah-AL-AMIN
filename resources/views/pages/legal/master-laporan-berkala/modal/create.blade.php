<div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModLap()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">

                            <input class="form-control" name="mlapbkl_pk" id="mlapbkl_pk" type="hidden"
                                data-allow-clear="false" readonly />
                            <div class="col-md-6 mb-5">
                                <div class="mb-5 ">
                                    <label class="required form-label">Jenis Laporan</label>
                                    <input class="form-control" name="mlapbkl_jenis" id="mlapbkl_jenis" type="text"
                                        data-allow-clear="true" placeholder="Masukan jenis laporan" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Laporan Kepada</label>
                                    <input class="form-control" name="mlapbkl_kepada" id="mlapbkl_kepada" type="text"
                                        data-allow-clear="true" placeholder="Masukan laporan kepada" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Batas Waktu Penyampaian</label>
                                    <input class="form-control" name="mlapbkl_batas" id="mlapbkl_batas" type="text"
                                        data-allow-clear="true" placeholder="Masukan batas waktu" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                    <label class="required form-label">Unit Kerja PJ Laporan</label>
                                    <select class="form-select" data-control="select2" data-dropdown-parent="#modal" id="mlapbkl_unit"
                                        name="mlapbkl_unit" data-placeholder="Pilih unit kerja pj laporan"
                                        data-allow-clear="true" required>
                                        <option value='01' selected>TEHNIK</option>
                                        <option value='02'>AKTUARIA</option>
                                        <option value='03'>KEPESERTAAN</option>
                                        <option value='04'>IT</option>
                                        <option value='05'>KEPATUHAN & LEGAL</option>
                                        <option value='06'>SEKPER</option>
                                        <option value='07'>AKUNTANSI</option>
                                        <option value='08'>KEUANGAN</option>
                                        <option value='10'>SDM</option>
                                        <option value='11'>INTERNAL AUDIT</option>
                                        <option value='12'>INVESTASI</option>
                                        <option value='13'>PEMASARAN</option>
                                        <option value='14'>PENGEMBANGAN BISNIS</option>
                                        <option value='16'>MANAJEMEN RISIKO</option>
                                        <option value='17'>ADVISOR</option>
                                        <option value='18'>AKTUARIS PERUSAHAAN</option>
                                        <option value='19'>DIREKSI</option>
                                        <option value='20'>DPS</option>
                                        <option value='21'>KOMISARIS</option>
                                        <option value='22'>KOMITE</option>
                                        <option value='BIS'>BISNIS</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Persetujuan</label>
                                    <input class="form-control" name="mlapbkl_persetujuan" id="mlapbkl_persetujuan"
                                        type="text" data-allow-clear="true" placeholder="Masukan persetujuan" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>

                            <div class="col-md-12 mb-5">
                                <hr />
                            </div>

                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Reminder</label>
                                    <select class="form-select" name="mlapbkl_aktif" id="mlapbkl_aktif"
                                        type="text" data-allow-clear="true" placeholder="Pilih reminder">
                                        <option value="0" selected>Tidak Aktif</option>
                                        <option value="1">Aktif</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Periode</label>
                                    <select class="form-select" name="mlapbkl_periode" id="mlapbkl_periode"
                                        type="text" data-allow-clear="true" placeholder="Masukan periode">
                                        <option value="1" selected>Bulanan</option>
                                        <option value="2">Triwulan</option>
                                        <option value="3">Semester</option>
                                        <option value="4">Tahunan</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Bulan</label>
                                    <select class="form-select" name="mlapbkl_bulan" id="mlapbkl_bulan"
                                        type="text" data-allow-clear="true" placeholder="Masukan bulan">
                                        <option value="1" selected>Januari</option>
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
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Tanggal</label>
                                    <select class="form-select" name="mlapbkl_tgl" id="mlapbkl_tgl" type="text"
                                        data-allow-clear="true" placeholder="Masukan tanggal">
                                        <option value="1" selected>1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">Email Penanggungjawab</label>
                                    <input class="form-control" name="mlapbkl_pic_email" id="mlapbkl_pic_email"
                                        type="text" data-allow-clear="true" placeholder="Masukan email" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="required form-label">No WA Penanggungjawab</label>
                                    <input class="form-control" name="mlapbkl_pic_hp" id="mlapbkl_pic_hp"
                                        type="text" data-allow-clear="true" placeholder="Masukan no wa." />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

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
                    <button type="button" class="btn btn-danger btn-sm"  onclick="closeModLap()"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>