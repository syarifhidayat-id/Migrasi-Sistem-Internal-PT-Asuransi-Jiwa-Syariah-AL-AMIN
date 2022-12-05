@extends('layouts.main-admin')

@section('title')
    Lihat PKS
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar PKS</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" data-kt-datatable-table-filter="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Cari menu" />
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
                    <button type="button" id="omodAdd" class="btn btn-primary me-3 btn-sm"><i
                            class="fa-sharp fa-solid fa-plus"></i> Addendum</button>
                </div>

                @include('pages.legal.pks.modal.create')
                @include('pages.legal.pks.modal.view')
                @include('pages.legal.pks.modal.pdf')
                @include('pages.legal.pks.modal.addendum')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>&nbsp;</th>
                            <th>No. PKS</th>
                            <th class="min-w-250px">Pemegang Polis</th>
                            <th>Instansi</th>
                            <th>Perihal</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>PIC</th>
                            <th class="min-w-125px">Status PKS</th>
                            {{-- <th>Aksi</th> --}}
                        </tr>
                    </thead>
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

            serverSide( //datatable serverside
                "{{ url('api/legal/api_pks') }}", //url api/route
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
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="omodEdit" data-resouce="` + row.mpks_pk + `" class="btn btn-light-success" target="blank"> <i class="fa-solid fa-pen"></i> </button>`
                        }

                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="bmoDetail" data-resouce="` + row.mpks_pk + `" class="btn btn-light-success" target="blank"> `+row.mpks_nomor+` </button>`
                        }

                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="bmoViewPdf" data-resouce="` + row.mpks_pk + `" data-show-pdf="` + row
                                .mpks_dokumen + `"
                                        class="btn btn-light-primary" target="blank"> `+row.kode_rekanan+` </button>`
                        }
                    },
                    {
                        data: 'mpks_instansi'
                    },
                    {
                        data: 'mpks_tentang'
                    },
                    {
                        data: 'mpks_tgl_mulai'
                    },
                    {
                        data: 'mpks_tgl_akhir'
                    },
                    {
                        data: 'mpks_pic'
                    },
                    {
                        data: null,
                        render: function(){
                            return `edit`
                        }
                    },
                    
                    // {
                    //     data: null,
                    //     orderable: false,
                    //     className: 'text-center',
                    //     render: function(data, type, row) {
                    //         return `
                    //             <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                    //                 <span class="svg-icon svg-icon-5 m-0">
                    //                     <i class="fa-sharp fa-solid fa-chevron-down"></i>
                    //                 </span>
                    //             </a>
                    //             <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                    //                 <div class="menu-item px-3">
                    //                     <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="` + row.mpojk_pk + `">Edit</a>
                    //                 </div>
                    //                 <div class="menu-item px-3">
                    //                     <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="` + row
                    //             .mpojk_pk + `">Delete</a>
                    //                 </div>
                    //             </div>
                    //         `;
                    //     },
                    // },
                ],
            );

            selectServerSide( //select server side with api/route
                'mpks_mrkn_kode', //kode select
                '{{ url('api/legal/pks/polis') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.mrkn_nama, // text nama
                                id: d.mrkn_kode // kode value
                            }
                        })
                    };
                },
            );
            selectServerSide( //select server side with api/route
                'cari_pk', //kode select
                '{{ url('api/legal/get_select_pks') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.mpks_nomor, // text nama
                                id: d.mpks_pk // kode value
                            }
                        })
                    };
                },
            );
            

           

            $('body').on('click', '#omodTam', function() {
                $('#modalPks').modal('show');
                bsimpan('btn_simpan', 'Simpan');
                $('#tModPks').text('Tambah PKS');
                bsimpan('btn_simpan', 'Simpan');
            });


            //     selectServerSide( //select server side with api/route
            //     'mpks_mrkn_kode_test', //kode select
            //     '{{ url('api/legal/pks/polis') }}', //url
            //     function(data) {
            //         return {
            //             results: $.map(data, function(d) {
            //                 return {
            //                     text: d.mrkn_nama, // text nama
            //                     id: d.mrkn_kode // kode value
            //                 }
            //             })
            //         };
            //     },
            // );

            selectServerSide( //select server side with api/route
                'mpks_mrkn_kode_test', //kode select
                '{{ url('api/legal/pks/polis') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.mrkn_nama, // text nama
                                id: d.mrkn_kode, // kode value
                                // nomor: d.tsm_nomor, // kode value
                            }
                        })
                    };
                },
                function (res) {
                    // $('#tsin_noreferensi').val(res.params.data.nomor);
                    console.log(res.params.data.id);
                },
            );

            $('body').on('click', '#omodAdd', function() {
                $('#modalAddendum').modal('show');
                $('#tModAddendum').text('Addendum');

                // var kode = $(this).attr('data-resouce')
                // url = "{{ url('api/legal/pks/lihat/pks') }}" + "/" + kode;
                // $.get(url, function(res) {
                //     console.log(res);
                //     $('#modalView').modal('show');
                //     // var key = "{{ route('utility.menu.store') }}" + "/" + res.wmn_key + "/keyMenu";
                //     $('#view_mpks_instansi').val(res.mpks_instansi);
                //     $('#view_mpks_mrkn_kode').val(res.mrkn_nama_induk);
                //     $('#view_mpks_nomor').val(res.mpks_nomor);
                //     $('#view_mpks_tentang').val(res.mpks_tentang);
                //     $('#view_mpks_tgl_mulai').val(res.awal_date);
                //     $('#view_mpks_tgl_akhir').val(res.akhir_date);
                //     $('#view_mpks_pic').val(res.mpks_pic);
                //     $('#view_mpks_pic_hp').val(res.mpks_pic_hp);
                //     $('#view_mpks_pic_email').val(res.mpks_pic_email);
                //     $('#view_mpks_atasan_hp').val(res.mpks_atasan_hp);
                //     $('#view_mpks_atasan_email').val(res.mpks_atasan_email);
                //     $('#view_mpks_ket').val(res.pks_ket);
                // });
            });

            $('body').on('click', '#bmoDetail', function() {
                $('#tModView').text('Rincian PKS');
                var kode = $(this).attr('data-resouce')
                url = "{{ url('api/legal/pks/lihat/pks') }}" + "/" + kode;
                $.get(url, function(res) {
                    console.log(res);
                    $('#modalView').modal('show');
                    // var key = "{{ route('utility.menu.store') }}" + "/" + res.wmn_key + "/keyMenu";
                    $('#view_mpks_instansi').val(res.mpks_instansi);
                    $('#view_mpks_mrkn_kode').val(res.mrkn_nama_induk);
                    $('#view_mpks_nomor').val(res.mpks_nomor);
                    $('#view_mpks_tentang').val(res.mpks_tentang);
                    $('#view_mpks_tgl_mulai').val(res.awal_date);
                    $('#view_mpks_tgl_akhir').val(res.akhir_date);
                    $('#view_mpks_pic').val(res.mpks_pic);
                    $('#view_mpks_pic_hp').val(res.mpks_pic_hp);
                    $('#view_mpks_pic_email').val(res.mpks_pic_email);
                    $('#view_mpks_atasan_hp').val(res.mpks_atasan_hp);
                    $('#view_mpks_atasan_email').val(res.mpks_atasan_email);
                    $('#view_mpks_ket').val(res.pks_ket);
                });
            });

            $('body').on('click', '#bmoViewPdf', function() {
                // $('#tModView').text('Rincian PKS');
                var kode = $(this).attr('data-show-pdf');
                var loc = $(location).attr('origin') + '/storage/legal/pks/' + kode;
                $('#modalPdf').modal('show')
                $('#tModPdf').text('File : ' + kode);
                $('#pdf').attr('data', loc);

                // $("#modalView").on("hidden.bs.modal", function() {
                // $("#modal-body").html("");
                // $('#pdf').attr('data', loc);
                // });
                console.log(loc);
            });

            $('body').on('click', '#omodEdit', function() {
                $('#tModPks').text('Edit PKS');
                bsimpan('btn_simpan', 'Update');
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/pks/lihat') }}" + "/" + kode + "/edit";
                // url = "{{ url('api/utility/menu/edit') }}" + "/" + kode;
                $.get(url, function(res) {
                    $('#modalPks').modal('show');
                    $('#mpks_pk').val(kode);
                    $('#mpks_instansi').val(res.mpks_instansi);
                    $('#mpks_mrkn_kode').val(res.mpks_mrkn_kode);
                    $('#mpks_nomor').val(res.mpks_nomor);
                    $('#mpks_tentang').val(res.mpks_tentang);
                    $('#mpks_tgl_mulai').val(res.awal_date);
                    $('#mpks_tgl_akhir').val(res.akhir_date);
                    $('#mpks_pic').val(res.mpks_pic);
                    $('#mpks_pic_hp').val(res.mpks_pic_hp);
                    $('#mpks_pic_email').val(res.mpks_pic_email);
                    $('#mpks_atasan_hp').val(res.mpks_atasan_hp);
                    $('#mpks_atasan_email').val(res.mpks_atasan_email);
                    $('#mpks_ket').val(res.mpks_ket);
                });
            });

            $('#frxx').submit(function(e) {
                // $('#btn_simpan').click(function(e) {
                e.preventDefault();
                // var dataFrx = $('#frxx').serialize();
                var formData = new FormData(this); //jika ada input file atau dokumen
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('legal.pks.lihat.store') }}",
                    type: "POST",
                    data: formData,
                    cache: false, //jika ada input file atau dokumen
                    contentType: false, //jika ada input file atau dokumen
                    processData: false, //jika ada input file atau dokumen
                    // dataType: 'json',
                    success: function(res) {
                        // window.location.reload();
                        if ($.isEmptyObject(res.error)) {
                            console.log(res);
                            Swal.fire(
                                'Berhasil!',
                                res.success,
                                'success'
                            ).then((res) => {
                                x();
                                // reset();
                                // $('#frxx').trigger("reset");
                                $('#modalPks').modal('hide');
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
                    url = "{{ url('legal/pks/lihat') }}" + "/" + kode;

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
                        $("#frxx")[0].reset();
                    });
                });
            }

            $('#btn_reset').click(function() {
                x();
                // clearError();
            });
            $('#btn_close3').click(function() {
                $('#modalView').modal('hide');
                x();
            });
            $('#btn_close4').click(function() {
                $('#modalView').modal('hide');
                x();
            });
            $('#btn_close5').click(function(){
                $('#modalPdf').modal('hide');
            });
            $('#btn_closeCreate').click(function() {
                $('#modalPks').modal('hide');
                x();
            });
            $('#btn_tutup').click(function() {
                $('#modalPks').modal('hide');
                x();
            });
            $('#btn_tutup_a').click(function() {
                $('#modalAddendum').modal('hide');
                x();
            });
            $('#btn_tutup_b').click(function() {
                $('#modalAddendum').modal('hide');
                x();
            });

        });
    </script>
@endsection
