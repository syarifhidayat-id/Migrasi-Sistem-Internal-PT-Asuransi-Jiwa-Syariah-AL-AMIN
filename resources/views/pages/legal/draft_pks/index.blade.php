@extends('layouts.main-admin')

@section('title')
    Lihat Draft PKS
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Draft PKS</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" data-kt-datatable-table-filter="search" id="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Cari draft pks" />
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                    <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="fa-sharp fa-solid fa-filter"></i> Filter
                    </button>

                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                        </div>
                        <div class="separator border-gray-200"></div>

                        <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Nama Menu:</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                    data-placeholder="Pilih menu" data-allow-clear="true"
                                    data-kt-datatable-table-filter="nama-menu" data-hide-search="false">
                                    <option></option>
                                    {{-- @foreach ($list_menu as $key => $data)
                                    <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                @endforeach --}}
                                </select>
                            </div>
                            <div class="mb-10">
                                <label class="form-label fs-6 fw-bold">Nama Route:</label>
                                <select class="form-select form-select-solid fw-bolder" data-kt-select2="true"
                                    data-placeholder="Pilih route" data-allow-clear="true"
                                    data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                    <option></option>
                                    {{-- @foreach ($list_menu as $key => $data)
                                    <option value="{{ $data->wmn_url }}">{{ $data->wmn_url }}</option>
                                @endforeach --}}
                                </select>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6"
                                    data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset">Reset</button>
                                <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true"
                                    data-kt-datatable-table-filter="filter">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <div id="kt_table_datatable_export" class="d-none"></div>

                    <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i
                            class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button>

                    <div id="kt_table_datatable_export_menu" title-kt-export="Data PKS"
                        class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="copy">Copy to clipboard</a>
                        </div>

                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="excel">Export as Excel</a>
                        </div>

                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="csv">Export as CSV</a>
                        </div>

                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3" data-kt-export="pdf">Export as PDF</a>
                        </div>
                    </div>

                    <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i
                            class="fa-sharp fa-solid fa-plus"></i> Tambah PKS</button>
                </div>

                @include('pages.legal.draft_pks.modal.create')
                @include('pages.legal.draft_pks.modal.view')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                {{-- <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="kt_table_datatable"> --}}
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>Nomor</th>
                            <th class="min-w-250px">Tentang</th>
                            <th>User Input</th>
                            <th>Tanggal Input</th>
                            <th>Dokumen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    {{-- <tbody></tbody> --}}
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            filterOp('input[type="search"]'); //khusus type search inputan

            serverSide( //datatable serverside
                "{{ url('api/legal/pks/draft_pks') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.wmn_tipe = $('#tipe_menu').val(),
                        d.wmn_descp = $('#key').val(),
                        d.search = $('input[type="search"]').val()
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: 'mdp_pk'
                    },
                    {
                        data: 'mdp_tentang'
                    },
                    {
                        data: 'mdp_ins_user'
                    },
                    {
                        data: 'ins_date'
                    },
                    {
                        data: 'mdp_dokumen'
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="` + row.mdp_pk + `">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="` + row
                                .mdp_pk + `">Delete</a>
                                    </div>
                                </div>
                            `;
                        },
                    },
                ],
            );

            selectServerSide( //select server side with api/route
                'mdp_mssp_kode', //kode select
                '{{ url('api/legal/pks/mssp_kode') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.mssp_nama, // text nama
                                id: d.mssp_kode // kode value
                            }
                        })
                    };
                },
            );

            $('body').on('click', '#omodTam', function() {
                $('#modalDraftPks').modal('show');
                bsimpan('btn_simpan', 'Simpan');
                $('#judul').text('Form Upload Draft PKS');
                bsimpan('btn_simpan', 'Simpan');
            });

            $('body').on('click', '#bmoDetail', function() {
                $('#tModView').text('Rincian PKS');
                var kode = $(this).attr('data-resouce')
                url = "{{ url('legal/pks/lihat/pks') }}" + "/" + kode;
                $.get(url, function(res) {
                    console.log(res);
                    $('#modalView').modal('show');
                    // var key = "{{ route('utility.menu.store') }}" + "/" + res.wmn_key + "/keyMenu";
                    $('#mpks_instansi').val(res.mpks_instansi);
                    $('#mpks_mrkn_kode').val(res.mrkn_nama_induk);
                    $('#mpks_nomor').val(res.mpks_nomor);
                    $('#mpks_tentang').val(res.mpks_tentang);
                    $('#mpks_tgl_mulai').val(res.awal_date);
                    $('#mpks_tgl_akhir').val(res.akhir_date);
                    $('#mpks_pic').val(res.mpks_pic);
                    $('#mpks_pic_hp').val(res.mpks_pic_hp);
                    $('#mpks_pic_email').val(res.mpks_pic_email);
                    $('#mpks_atasan_hp').val(res.mpks_atasan_hp);
                    $('#mpks_atasan_email').val(res.mpks_atasan_email);
                    $('#mpks_ket').val(res.pks_ket);
                });
            });

            $('body').on('click', '#omodEdit', function() {
                $('#judul').text('Form Edit Draft PKS');
                bsimpan('btn_simpan', 'Update');
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/pks/draft') }}" + "/" + kode + "/edit";
                // url = "{{ url('api/utility/menu/edit') }}" + "/" + kode;
                $.get(url, function(res) {

                    console.log(res);
                    $('#modalDraftPks').modal('show');
                    $('#mdp_pk').val(kode);
                    $('#mdp_mssp_kode').val(res.mdp_mssp_kode);
                    $('#mdp_tentang').val(res.mdp_tentang);

                });
            });

            $('#frxx').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this); //jika ada input file atau dokumen
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('legal.pks.draft.store') }}",
                    type: "POST",
                    data: formData,
                    cache: false, //jika ada input file atau dokumen
                    contentType: false, //jika ada input file atau dokumen
                    processData: false, //jika ada input file atau dokumen
                    success: function(res) {
                        // window.location.reload();
                        if ($.isEmptyObject(res.error)) {
                            console.log(res);
                            Swal.fire(
                                'Berhasil!',
                                res.success,
                                'success'
                            ).then((res) => {
                                reset();
                                $('#frxx').trigger("reset");
                                $('#modalDraftPks').modal('hide');
                                bsimpan('btn_simpan', 'Simpan');
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
                    error: function(err) {
                        console.log('Error:', err);
                        bsimpan('btn_simpan', 'Simpan');
                    }
                });
            });

            $('body').on('click', '#omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/pks/draft') }}" + "/" + kode;

                console.log(kode);
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
                                    reset();
                                    console.log('Success', res);
                                },
                                error: function(err) {
                                    reset();
                                    console.log('Error', err);
                                }
                            });
                        })
                    }
                })
            });



            function x() {
                $(document).ready(function() {
                    $("button").click(function() {
                        $("#frxx")[0].reset()
                    });
                });
            }

            $('#btn_reset').click(function() {
                x();
            });
            $('#btn_close3').click(function() {
                $('#modalView').modal('hide');
                x();
            });
            $('#btn_close4').click(function() {
                $('#modalView').modal('hide');
                x();
            });
            $('#btn_closeCreate').click(function() {
                $('#modalDraftPks').modal('hide');
                x();
            });
            $('#btn_tutup').click(function() {
                $('#modalDraftPks').modal('hide');
                x();
            });

        });
    </script>
@endsection
