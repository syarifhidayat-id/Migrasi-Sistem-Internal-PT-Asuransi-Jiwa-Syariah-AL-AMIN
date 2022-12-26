<div class="modal fade" id="modalUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalUser_header">
                <h2 class="fw-bolder" id="tModUser"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeBtnModal()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_user" name="frxx_user" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalUser_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalUser_header" data-kt-scroll-wrappers="#modalUser_scroll" data-kt-scroll-offset="300px">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="form-label">Username</label>
                                <input type="text" class="form-control form-control-solid" name="email" id="email" placeholder="Username" />
                                <span class="text-danger error-text email_err"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Password</label>
                                    <input type="text" class="form-control form-control-solid" name="password_n" id="password_n" placeholder="Password" />
                                    <label class="required form-label">Standar Password 9</label>
                                    <span class="text-danger error-text password_n_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control form-control-solid" name="name" id="name" placeholder="Nama Lengkap" />
                                    <span class="text-danger error-text name_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Email User</label>
                                    <div class="input-group input-group-solid">
                                        <input type="text" class="form-control" name="email_user" id="email_user" placeholder="Email User" />
                                        <span class="input-group-text">@alamin.co.id</span>
                                    </div>
                                    <span class="text-danger error-text email_user_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Email Cabang/ PIC/ CC</label>
                                    <input type="text" class="form-control form-control-solid" name="email_cc" id="email_cc" placeholder="Email Cabang/ PIC/ CC" />
                                    <span class="text-danger error-text email_cc_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Nomor HP</label>
                                    <div class="input-group input-group-solid">
                                        <span class="input-group-text">+62</span>
                                        {{-- <input type="text" class="form-control" name="phone" id="phone" placeholder="Nomor HP" /> --}}
                                        <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="Nomor HP" />
                                    </div>
                                    <span class="text-danger error-text no_hp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Daftar Pemegang Polis/ Reas</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mrkn_kode_induk" id="mrkn_kode_induk" data-dropdown-parent="#modalUser" data-placeholder="Pilih Daftar Pemegang Polis/ Reas" data-allow-clear="true">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text mrkn_kode_induk_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Daftar Cabang Pemegang Polis/ Reas</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mrkn_kode" id="mrkn_kode" data-dropdown-parent="#modalUser" data-placeholder="Pilih Daftar Cabang Pemegang Polis/ Reas" data-allow-clear="true">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text mrkn_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Jenis Nasabah</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mjns_kode" id="mjns_kode" data-dropdown-parent="#modalUser" data-placeholder="Pilih Jenis Nasabah" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text mjns_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Mekanisme 1 (Umum)</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mkm_kode" id="mkm_kode" data-dropdown-parent="#modalUser" data-placeholder="Pilih Mekanisme 1 (Umum)" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text mkm_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Mekanisme 2 (Penutupan)</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="mkm_kode2" id="mkm_kode2" data-dropdown-parent="#modalUser" data-placeholder="Pilih Mekanisme 2 (Penutupan)" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text mkm_kode2_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Kode Polis</label>
                                    <input type="text" class="form-control form-control-solid" name="mpol_kode" id="mpol_kode" placeholder="Kode Polis" />
                                    <span class="text-danger error-text mpol_kode_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Menu Tipe</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="menu_tipe" id="menu_tipe" data-dropdown-parent="#modalUser" data-placeholder="Pilih Menu Tipe" data-allow-clear="true">
                                        <option></option>
                                    </select>
                                    <span class="text-danger error-text menu_tipe_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Home Dashboard Tipe</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="dboard" id="dboard" data-dropdown-parent="#modalUser" data-placeholder="Pilih Home Dashboard Tipe" data-allow-clear="true">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text dboard_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Akses Berita Dashboard</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="isnews" id="isnews" data-dropdown-parent="#modalUser" data-placeholder="Pilih Akses Berita Dashboard" data-allow-clear="true">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text isnews_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Akses Live Conference</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="livevideo_hak" id="livevideo_hak" data-dropdown-parent="#modalUser" data-placeholder="Pilih Akses Live Conference" data-allow-clear="true">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text livevideo_hak_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Hak Session Live Conference</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="livevideo_ses" id="livevideo_ses" data-dropdown-parent="#modalUser" data-placeholder="Pilih Hak Session Live Conference" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text livevideo_ses_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Jabatan User</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="jabatan" id="jabatan" data-dropdown-parent="#modalUser" data-placeholder="Pilih Jabatan User" data-allow-clear="true">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text jabatan_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Hak Akses Chat User</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="chat_tipe" id="chat_tipe" data-dropdown-parent="#modalUser" data-placeholder="Pilih Hak Akses Chat User" data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text chat_tipe_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Hak Akses File Share Public</label>
                                    <select class="form-select form-select-solid" data-control="select2" name="dirshare" id="dirshare" data-dropdown-parent="#modalUser" data-placeholder="Pilih Hak Akses File Share Public" data-allow-clear="true">
                                        <option></option>
                                        {{-- @foreach ($type_menu as $type)
                                            <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                        @endforeach --}}
                                    </select>
                                    <span class="text-danger error-text dirshare_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <label class="form-label">Form Pendaftaran</label>
                                    <input type="file" class="form-control form-control-solid" name="img_bukti" id="img_bukti" placeholder="Form Pendaftaran" />
                                    <span class="text-danger error-text img_bukti_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                {{-- <div class="mb-5">
                                    <label class="form-label">Foto</label>
                                    <input type="file" class="form-control form-control-solid" name="img_foto" id="img_foto" placeholder="Kode Polis" />
                                    <span class="text-danger error-text img_foto_err"></span>
                                </div> --}}
                                <div class="mb-5">
                                    <label class="d-block fw-bold fs-6 mb-5">Foto</label>
                                    <div class="image-input image-input-circle" data-kt-image-input="true" style="background-image: url({{ asset('assets/media/svg/avatars/blank.svg') }})">
                                        <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ asset('assets/media/svg/avatars/blank.svg') }});"></div>
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Ganti Foto">
                                            <i class="bi bi-pencil-fill fs-7"></i>
                                            <input type="file" name="img_foto" id="img_foto" accept=".png, .jpg, .jpeg" />
                                            {{-- <input type="hidden" name="avatar_remove" /> --}}
                                        </label>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Batal">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Hapus">
                                            <i class="bi bi-x fs-2"></i>
                                        </span>
                                    </div>
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                    <button type="button" class="btn btn-warning btn-sm" id="btn_reset" onclick="clearForm('frxx_user')"><i class="fa-solid fa-trash"></i> Hapus</button>
                    <button type="button" class="btn btn-danger btn-sm" onclick="closeBtnModal()"><i class="fa-solid fa-xmark"></i> Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
