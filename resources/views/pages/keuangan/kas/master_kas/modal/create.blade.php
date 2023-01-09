<div class="modal fade" id="modal_rincian_transaksi" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalMenu_header">
                <h2 class="fw-bolder" id="tMod"></h2>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeMod()"><i
                        class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_tkad" name="frxx" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalMenu_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalMenu_header" data-kt-scroll-wrappers="#modalMenu_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <input class="form-control" name="e_pk" id="e_pk" data-allow-clear="false"
                                value="{{ $kode }}" readonly />
                                
                            <input class="form-control" id="nama_akun" name="nama_akun" readonly />
                            <input class="form-control" id="tkad_approvkeu1_user" name="tkad_approvkeu1_user" value="{{ Auth::user()->email }}" readonly />
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Jenis Transaksi</label>
                                    <select class="form-select" data-control="select2" name="e_akun" id="e_akun"
                                        type="text" data-allow-clear="true" data-placeholder="pilih jenis transaksi!"
                                        data-dropdown-parent="#modal_rincian_transaksi">
                                        <option></option>
                                        <option value="1">data 1</option>
                                        <option value="2">data 2</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>

                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Peruntukan Dana</label>
                                    <select class="form-select" name="tkad_keterangan" data-control="select2"
                                        id="tkad_keterangan" type="text"
                                        data-dropdown-parent="#modal_rincian_transaksi" data-allow-clear="true"
                                        data-placeholder="Pilih peruntukan dana">
                                        <option></option>
                                        <option value='belanja bulanan'>belanja bulanan</option>
                                        <option value='biaya admin'>biaya admin</option>
                                        <option value='biaya agenda'>biaya agenda</option>
                                        <option value='biaya air galon'>biaya air galon</option>
                                        <option value='biaya asosiasi asuransi'>biaya asosiasi asuransi</option>
                                        <option value='biaya atk'>biaya atk</option>
                                        <option value='biaya bahan bangunan '>biaya bahan bangunan </option>
                                        <option value='biaya bbm'>biaya bbm</option>
                                        <option value='biaya bina relasi'>biaya bina relasi</option>
                                        <option value='biaya bingkisan'>biaya bingkisan</option>
                                        <option value='biaya buku'>biaya buku</option>
                                        <option value='biaya cetak kartu nama'>biaya cetak kartu nama</option>
                                        <option value='biaya cuci mobil'>biaya cuci mobil</option>
                                        <option value='biaya dana bakti sosial'>biaya dana bakti sosial</option>
                                        <option value='biaya dinas'>biaya dinas</option>
                                        <option value='biaya e-toll'>biaya e-toll</option>
                                        <option value='biaya fotocopy'>biaya fotocopy</option>
                                        <option value='biaya gaji'>biaya gaji</option>
                                        <option value='biaya gas'>biaya gas</option>
                                        <option value='biaya golf'>biaya golf</option>
                                        <option value='biaya hp'>biaya hp</option>
                                        <option value='biaya iklan'>biaya iklan</option>
                                        <option value='biaya isi tinta'>biaya isi tinta</option>
                                        <option value='biaya isi ulang gas '>biaya isi ulang gas </option>
                                        <option value='biaya iuran asuransi'>biaya iuran asuransi</option>
                                        <option value='biaya iuran bulanan '>biaya iuran bulanan </option>
                                        <option value='biaya iuran gedung '>biaya iuran gedung </option>
                                        <option value='biaya iuran keamanan'>biaya iuran keamanan</option>
                                        <option value='biaya iuran kebersihan'>biaya iuran kebersihan</option>
                                        <option value='biaya iuran langganan'>biaya iuran langganan</option>
                                        <option value='biaya iuran lingkungan'>biaya iuran lingkungan</option>
                                        <option value='biaya iuran pemeliharaan'>biaya iuran pemeliharaan</option>
                                        <option value='biaya iuran retribusi'>biaya iuran retribusi</option>
                                        <option value='biaya iuran RTRW'>biaya iuran RTRW</option>
                                        <option value='biaya konsumsi '>biaya konsumsi </option>
                                        <option value='biaya koran'>biaya koran</option>
                                        <option value='biaya lembur'>biaya lembur</option>
                                        <option value='biaya makan'>biaya makan</option>
                                        <option value='biaya materai'>biaya materai</option>
                                        <option value='biaya parkir'>biaya parkir</option>
                                        <option value='biaya pengiriman dokumen'>biaya pengiriman dokumen</option>
                                        <option value='biaya pengobatan'>biaya pengobatan</option>
                                        <option value='biaya persalinan'>biaya persalinan</option>
                                        <option value='biaya service kendaraan'>biaya service kendaraan</option>
                                        <option value='biaya snack'>biaya snack</option>
                                        <option value='biaya sponshorsip'>biaya sponshorsip</option>
                                        <option value='biaya toll'>biaya toll</option>
                                        <option value='pembayaran komisi bank'>pembayaran komisi bank</option>
                                        <option value='pembayaran pdam'>pembayaran pdam</option>
                                        <option value='pembayaran sewa lapangan '>pembayaran sewa lapangan </option>
                                        <option value='pembayaran telepon'>pembayaran telepon</option>
                                        <option value='pembayaran trasnport'>pembayaran trasnport</option>
                                        <option value='pembayaran uang saku'>pembayaran uang saku</option>
                                        <option value='pembayaran utang komis br'>pembayaran utang komis br</option>
                                        <option value='penerimaan kas'>penerimaan kas</option>
                                        <option value='pengembalian atas'>pengembalian atas</option>
                                        <option value='pengisian petty cash'>pengisian petty cash</option>
                                        <option value='pengisian saldo bank'>pengisian saldo bank</option>
                                    </select>
                                    </span></td>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tipe Dana</label>
                                    <input class="form-control" name="tkad_tipe_dk" id="tkad_tipe_dk" type="text"
                                        data-allow-clear="true" placeholder="Tipe dana" value="D"/>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Tipe Dianggaran</label>
                                    <select class="form-select" data-control="select2" name="tkad_mta_pk"
                                        id="tkad_mta_pk" type="text" data-allow-clear="true"
                                        data-dropdown-parent="#modal_rincian_transaksi"
                                        data-placeholder="Pilih tipe dianggaran">
                                        <option></option>
                                        <option value='01'>Komisi</option>
                                        <option value='02'>Transport</option>
                                        <option value='03'>Tunjangan Kesehatan</option>
                                        <option value='04'>Perjalanan Dinas</option>
                                        <option value='05'>Tagihan Rutin</option>
                                        <option value='06'>Kendaraan</option>
                                        <option value='07'>Pemasaran</option>
                                        <option value='08'>Materai</option>
                                        <option value='09'>Fotocopy</option>
                                        <option value='10'>Pengiriman Dokumen</option>
                                        <option value='11'>Cetak</option>
                                        <option value='12'>Biaya Umum dan Lain-lain</option>
                                        <option value='13'>Biaya Tak Terduga</option>
                                        <option value='14'>Anggaran Korwil</option>
                                        <option value='15'>Biaya Administrasi Bank</option>
                                        <option value='16'>Penerimaan Jasa Giro</option>
                                        <option value='17'>Lembur</option>
                                        <option value='18'>Pembelian Aktiva</option>
                                        <option value='19'>Pengajuan Dana</option>
                                        <option value='20'>Biaya Genset</option>
                                        <option value='21'>Pemeliharaan Gedung</option>
                                        <option value='22'>Reward Penilaian</option>
                                        <option value='23'>Pembukaan Rekening</option>
                                        <option value='xx'>-</option>
                                    </select>
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Nilai</label>
                                    <input class="form-control" name="tkad_total" id="tkad_total" type="text"
                                        data-allow-clear="true" data-dropdown-parent="#modal_rincian_transaksi"
                                        placeholder="Masukan nilai" />
                                    {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}

                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">Jenis Realisasi</label>
                                    <div class="input-group">
                                        <select class="form-select" data-control="select2"
                                            data-dropdown-parent="#modal_rincian_transaksi" name="tkad_jns_realisasi"
                                            id="tkad_jns_realisasi" type="text" data-allow-clear="true"
                                            data-placeholder="Jenis realisasi">
                                            <option></option>
                                        </select>
                                        {{-- <div class="input-group-append">
                                        <span class="input-group-text" id="id_jns_realisasi"></span>
                                    </div> --}}
                                        {{-- <span class="text-danger error-text mpojk_tentang_err"></span> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <div class="mb-5">
                                    <label class="required form-label">ID Kasbon</label>
                                    <input class="form-control" name="e_kasbon" id="e_kasbon" type="text"
                                        data-allow-clear="true" placeholder="ID kasbon" />
                                    <span class="font-italic">*Diisi jika kasbon dilunasi</span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    {{-- <button class="btn btn-primary btn-sm" onclick="grd_submit()" id="btn_simpan"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button> --}}
                    {{-- <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                            class="fa-solid fa-trash"></i> Hapus</button> --}}
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeMod()" id="btn_tutup"><i
                            class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
