@extends('layouts.main-admin')

@section('title')
    Entry SOC
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>Entry SOC</h3>
        </div>

        <div class="card-toolbar">
            {{-- <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" checked="checked" value="1" />
                <span class="form-check-label text-muted">Test mode</span>
            </label>

            <button type="button" class="btn btn-sm btn-light">
                Action
            </button> --}}
        </div>
    </div>

    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1"></div>
        </div>

        <div class="card-toolbar">
            <div class="d-flex align-items-center">
                <span class="fs-7 text-gray-700 fw-bolder pe-3">Quick Tools:</span>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-success me-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" id="btn_simpan"><i class="fa-solid fa-file-circle-plus fs-2x"></i></button>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-success me-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Endors" id="btn_endors"><i class="fa-solid fa-file-circle-question fs-2x"></i></button>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-success me-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Edit" id="btn_edit"><i class="fa-solid fa-file-circle-check fs-2x"></i></button>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-success" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Batal" id="btn_Batal"><i class="fa-solid fa-file-circle-minus fs-2x"></i></button>
            </div>

        </div>
    </div>

    <div class="card-body py-10">
        <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="required form-label">Menu Tipe</label>
                        <select class="form-select form-select-solid readonly" name="wmn_tipe" id="wmn_tipe" data-placeholder="Pilih tipe menu" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text wmn_tipe_err"></span>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <label class="form-label">PK Menu</label>
                    <div class="input-group input-group-solid">
                        <input type="text" class="form-control form-control-solid" name="wmn_kode" id="wmn_kode" placeholder="PK Menu"/>
                        <div class="input-group-append">
                            {{-- <button class="btn btn-primary" type="button"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></button> --}}
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">
                                <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                            </button> --}}
                        </div>
                    </div>
                    <label class="required form-label">kosongkan jika baru</label>
                    {{-- <label class="required form-label sm">kosongkan jika tidak edit</label> --}}
                </div>
                <div class="col-md-6 mb-5">
                    <div class="mb-5">
                        <label class="required form-label">Menu Main</label>
                        <select class="form-select form-select-solid readonly" name="wmn_key" id="wmn_key" data-placeholder="ex. MAIN" data-allow-clear="true">
                            {{-- <option></option> --}}
                        </select>
                        <span class="text-danger error-text wmn_key_err"></span><br>
                        <label class="required form-label">Isi MAIN jika menu utama</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Icon Menu</label>
                        <div class="input-group input-group-solid">
                            <input type="text" class="form-control form-control-solid" name="wmn_icon" id="wmn_icon" placeholder="ex. fa-solid fa-house"/>
                            <div class="input-group-append">
                                <a href="https://fontawesome.com/search?s=solid&f=classic&o=r" class="btn btn-primary" target="_blank"><i class="fa-sharp fa-solid fa-magnifying-glass"></i></a>
                            </div>
                        </div>
                        {{-- <span class="text-danger error-text wmn_icon_err"></span> --}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="required form-label">Nama Menu</label>
                        <input type="text" class="form-control form-control-solid readonly" name="wmn_descp" id="wmn_descp" placeholder="ex. Sekper"/>
                        <span class="text-danger error-text wmn_descp_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Route Menu</label>
                        <input type="text" class="form-control form-control-solid" name="wmn_url_n" id="wmn_url_n" placeholder="ex. utility.menu.create"/>
                        <span class="text-danger error-text wmn_url_n_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Alamat Menu</label>
                        <textarea class="form-control form-control-solid" rows="3" name="wmn_urlkode" id="wmn_urlkode" placeholder="Alamat"></textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Tips Menu</label>
                        <input type="text" class="form-control form-control-solid" name="wmn_info" id="wmn_info" placeholder="Tips Menu"/>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class="mb-5">
                        <label class="required form-label">URL Menu</label>
                        <input type="text" class="form-control form-control-solid readonly" name="wmn_url_o_n" id="wmn_url_o_n" placeholder="ex. utility/menu"/>
                        <span class="text-danger error-text wmn_url_o_n_err"></span><br>
                        <label class="required form-label">jika main, ex. utility/*</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="required form-label">Menu Urut</label>
                        <input type="number" class="form-control form-control-solid readonly" name="wmn_urut" id="wmn_urut" placeholder="Urutan Menu"/>
                        <span class="text-danger error-text wmn_urut_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Pemegang Polis</label>
                        {{-- <input type="text" class="form-control form-control-solid" name="wmn_mrkn_kode" id="wmn_mrkn_kode" placeholder="Pemegang Polis"/> --}}
                        <select class="form-select form-select-solid" name="wmn_mrkn_kode" id="wmn_mrkn_kode" data-placeholder="pilih Pemegang Polis" data-allow-clear="true">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Nomor Polis</label>
                        {{-- <input type="text" class="form-control form-control-solid" name="wmn_mpol_kode" id="wmn_mpol_kode" placeholder="Nomor Polis"/> --}}
                        <select class="form-select form-select-solid" name="wmn_mpol_kode" id="wmn_mpol_kode" data-placeholder="pilih Nomor Polis" data-allow-clear="true">
                            <option></option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card-footer text-center">
        <button type="submit" class="btn btn-primary btn-sm me-3" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
        <button type="button" class="btn btn-warning btn-sm me-3" id="btn_reset"><i class="fa-solid fa-trash"></i> Hapus</button>
        <button type="button" class="btn btn-danger btn-sm" id="btn_close2"><i class="fa-solid fa-xmark"></i> Tutup</button>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#tipe').select2();
        $('#key').select2();
        $('#wmn_tipe').select2();
        $('#wmn_key').select2({
            tags: true,
        });
        $('#wmn_mrkn_kode').select2();
        $('#wmn_mpol_kode').select2();

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            serverSide(
                "#serverSide",
                "{{ url('api/utility/menu/lihat-menu') }}",
                [
                    { data: "DT_RowIndex", className: "text-center" },
                    {
                        data: "wmn_icon",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<i class="`+row.wmn_icon+`"></i>`;
                        }
                    },
                    { data: "wmn_descp" },
                    { data: "wmn_tipe" },
                    {
                        data: "wmn_url_n",
                        render: function(data, type, row, meta) {
                            var route = row.wmn_url_n;
                            if (route !== "" && route !== null) {
                                return `<div class="badge badge-light-success fw-bolder">`+row.wmn_url_n+`</div>`;
                            } else {
                                return `<div class="badge badge-light-success fw-bolder">-</div>`;
                            }
                        }
                    },
                    {
                        data: "wmn_url_o_n",
                        render: function(data, type, row, meta) {
                            var url = row.wmn_url_o_n;
                            if (url !== "" && url !== null) {
                                return `<div class="badge badge-light fw-bolder">`+row.wmn_url_o_n+`</div>`;
                            } else {
                                return `<div class="badge badge-light fw-bolder">-</div>`;
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="`+row.wmn_kode+`">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="`+row.wmn_kode+`">Delete</a>
                                    </div>
                                </div>
                            `;
                        },
                    },
                ],
            );

            $('body').on('click', '#omodTam', function() {
                openModal('#modalMenu');
                $('#tModMenu').text('Tambah Menu');
                resetMod();
                bsimpan('btn_simpan', 'Simpan');
                $('#btn_reset').show();
                menuMain();
            });

            $('body').on('click', '#omodEdit', function() {
                $('#tModMenu').text('Edit Menu');
                bsimpan('btn_simpan', 'Update');
                // resetMod();
                // $('#wmn_key').empty();
                $('#wmn_key').val(null).trigger('change');
                $('#btn_reset').hide();

                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.index') }}" + "/" + kode + "/edit";
                    // url = "{{ url('api/utility/menu/edit') }}" + "/" + kode;

                $.get(url, function(res) {
                    menuMain();
                    var key = "{{ url('api/utility/menu/keyMenu') }}" + "/" + res.wmn_key;
                    // var key = "{{ route('utility.menu.store') }}" + "/" + res.wmn_key + "/keyMenu";
                    openModal('#modalMenu');
                    $('#wmn_kode').val(res.wmn_kode);
                    $('#wmn_tipe').val(res.wmn_tipe).trigger('change');
                    $.get(key, function(data) {
                        $('#wmn_key').val(data.wmn_kode).trigger('change');
                    });
                    $('#wmn_descp').val(res.wmn_descp);
                    $('#wmn_icon').val(res.wmn_icon);
                    $('#wmn_url_n').val(res.wmn_url_n);
                    $('#wmn_urlkode').val(res.wmn_urlkode);
                    $('#wmn_info').val(res.wmn_info);
                    $('#wmn_url_o_n').val(res.wmn_url_o_n);
                    $('#wmn_urut').val(res.wmn_urut);
                    $('#wmn_mrkn_kode').val(res.wmn_mrkn_kode);
                    $('#wmn_mpol_kode').val(res.wmn_mpol_kode);
                });
            });

            // $('#frxx').submit(function(e) {
            $('#btn_simpan').click(function(e) {
                e.preventDefault();
                var dataFrx = $('#frxx').serialize();
                // var formData = new FormData(this);
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('utility.menu.store') }}",
                    type: "POST",
                    data: dataFrx,
                    dataType: 'json',
                    success: function (res) {
                        if ($.isEmptyObject(res.error)){
                            // console.log(res);
                            Swal.fire(
                                'Berhasil!',
                                res.success,
                                'success'
                            ).then((res) => {
                                resetMod();
                                bsimpan('btn_simpan', 'Simpan');
                                lodTable("#serverSide");
                                closeModal('#modalMenu');
                            });
                        } else {
                            bsimpan('btn_simpan', 'Simpan');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Field harus ter isi!',
                            });
                            messages(res.error);
                        }

                    },
                    error: function (err) {
                        console.log('Error:', err);
                        bsimpan('btn_simpan', 'Simpan');
                    }
                });
            });

            $('body').on('click', '#omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.store') }}" + "/" + kode;

                // console.log(kode);
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Akan menghapus data menu dengan kode " + kode + " !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Terhapus!',
                        'Anda berhasil menghapus data menu dengan kode ' + kode + ".",
                        'success'
                        ).then((result) => {
                            console.log(kode);
                            $.ajax({
                                url: url,
                                type: "DELETE",
                                success: function(res) {
                                    lodTable("#serverSide");
                                },
                                error: function(err) {
                                    // console.log('Error', err);
                                }
                            });
                        })
                    }
                })
            });

            $('#btn_reset').click(function() {
                resetMod();
            });

            $('#btn_close').click(function() {
                closeModal('#modalMenu');
            });

            $('#btn_close2').click(function() {
                closeModal('#modalMenu');
            });
        });

        function resetMod() {
            $('#frxx').trigger('reset');
            $('#wmn_tipe').val(null).trigger('change');
            $('#wmn_key').val(null).trigger('change');
            // $('#wmn_key').empty();
            // $('#wmn_key').append('<option></option>');
            $('#wmn_mrkn_kode').val(null).trigger('change');
            $('#wmn_mpol_kode').val(null).trigger('change');
        }
    </script>
@endsection
