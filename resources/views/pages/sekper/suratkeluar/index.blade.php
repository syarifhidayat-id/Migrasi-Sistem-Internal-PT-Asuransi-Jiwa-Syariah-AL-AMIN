@extends('layouts.main-admin')

@section('title')
    Lihat Surat Keluar
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Surat Keluar</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" data-kt-datatable-table-filter="search" id="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Cari surat keluar" />
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
                            class="fa-sharp fa-solid fa-plus"></i> Buat & Upload Surat</button>
                    <button type="button" id="omodTtd" class="btn btn-primary me-3 btn-sm"><i
                            class="fa-sharp fa-solid fa-plus"></i> Master TTD</button>
                    <button type="button" id="omodBackdate" class="btn btn-primary me-3 btn-sm"><i
                            class="fa-sharp fa-solid fa-plus"></i> Surat Keluar Backdate</button>
                </div>

                @include('pages.sekper.suratkeluar.modal.create')
                @include('pages.sekper.suratkeluar.modal.backdate')
                @include('pages.sekper.suratkeluar.modal.master_ttd')
                @include('pages.sekper.suratkeluar.modal.view')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>Nomor Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Dokumen</th>
                            <th>Cab. Alamin</th>
                            <th>Jenis Surat</th>
                            <th>Direktorat</th>
                            <th>Surat Referensi</th>
                            <th>No Referensi</th>
                            <th>Kepada</th>
                            <th>Perihal</th>
                            <th>Keterangan</th>
                            <th>User Input</th>
                            <th>Tgl Input</th>
                            <th>User Approv</th>
                            <th>Pembuat</th>
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
                "{{ url('api/sekper/suratkeluar/surat_keluar') }}", //url api/route
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
                        data: 'tsin_nomor'
                    },
                    {
                        data: 'tsin_tanggal'
                    },
                    {
                        data: 'tsin_doksurat'
                    },
                    {
                        data: null,
                        render: function() {
                            return `Kantor Pusat`
                        }
                    },
                    {
                        data: 'tsin_js'
                    },
                    {
                        data: 'tsin_direktorat'
                    },
                    {
                        data: 'tsin_referensi'
                    },
                    {
                        data: 'tsin_noreferensi'
                    },
                    {
                        data: 'tsin_tujuan'
                    },
                    {
                        data: 'tsin_hal'
                    },
                    {
                        data: 'tsin_approval_note'
                    },
                    {
                        data: 'tsin_ins_user'
                    },
                    {
                        data: 'tsin_ins_date'
                    },
                    {
                        data: 'tsin_user_approv'
                    },
                    {
                        data: 'tsin_pembuat'
                    },
                    // {
                    //     data: null,
                    //     orderable: false,
                    //     className: 'text-center',
                    //     render: function(data, type, row) {
                    //         return `
                //     <button type="button" id="bmoViewPdf" data-resouce="` + row.tsm_pk + `" data-show-pdf="` + row
                    //             .tsm_disposisi + `"
                //                     class="btn btn-light-success" target="blank"> Lihat </button>`}
                    //     },

                    // {
                    //     data: null,
                    //     orderable: false,
                    //     className: 'text-center',
                    //     render: function(data, type, row) {
                    //         return `
                //         <select class="form-select" id="jenis_dokumen"
                //                     name="mojk_jenis" data-placeholder="Pilih jenis dokumen" data-allow-clear="true">
                //                     <option value="1">Dokumen</option>
                //                     <option value="2">Tanda Terima</option>
                //                 </select>`
                    //     }
                    // },
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
                                        <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="` + row
                                .tsin_pk + `">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="` + row
                                .tsin_pk + `">Delete</a>
                                    </div>
                                </div>
                            `;
                        },
                    },
                ],
            );

            // function getTsinJenis () {
            //     selectServerSide( //select server side with api/route
            //         'tsin_js', //kode select
            //         '{{ url('api/sekper/suratkeluar/get_js') }}', //url
            //         function(data) {
            //             return {
            //                 results: $.map(data, function(d) {
            //                     return {
            //                         text: d.msrt_nama, // text nama
            //                         id: d.msrt_kode // kode value
            //                     }
            //                 })
            //             };
            //         },
            //     );
            // }
            selectServerSide( //select server side with api/route
                'tsin_js', //kode select
                '{{ url('api/sekper/suratkeluar/get_js') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.msrt_nama, // text nama
                                id: d.msrt_kode // kode value
                            }
                        })
                    };
                },
            );
            selectServerSide( //select server side with api/route
                'tsin_direktorat', //kode select
                '{{ url('api/sekper/suratkeluar/get_surat_dir') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.msrt_nama, // text nama
                                id: d.msrt_kode // kode value
                            }
                        })
                    };
                },
            );
            selectServerSide( //select server side with api/route
                'tsin_pembuat', //kode select
                '{{ url('api/sekper/suratkeluar/get_aju_surat') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.mas_keterangan, // text nama
                                id: d.mas_kode // kode value
                            }
                        })
                    };
                },
            );
            selectServerSide( //select server side with api/route
                'tsin_referensi', //kode select
                '{{ url('api/sekper/suratkeluar/get_ref_surat') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.tsm_dr_instansi, // text nama
                                id: d.tsm_pk, // kode value
                                nomor: d.tsm_nomor, // kode value
                            }
                        })
                    };
                },
                function (res) {
                    $('#tsin_noreferensi').val(res.params.data.nomor);
                    console.log(res.params.data.nomor);
                },
            );
            selectServerSide( //select server side with api/route
                'tsin_ttd', //kode select
                '{{ url('api/sekper/suratkeluar/get_setuju_surat') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.mtujs_nama, // text nama
                                id: d.mtujs_kode, // kode value
                            }
                        })
                    };
                },
            );

            selectServerSide( //select server side with api/route
                'mtujs_id', //kode select
                '{{ url('api/sekper/suratkeluar/get_user_ttd') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.name, // text nama
                                id: d.id, // kode value
                            }
                        })
                    };
                },
            );

            selectServerSide( //select server side with api/route
                'tsin_js_bd', //kode select
                '{{ url('api/sekper/suratkeluar/get_js') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.msrt_nama, // text nama
                                id: d.msrt_kode // kode value
                            }
                        })
                    };
                },
            );

            selectServerSide( //select server side with api/route
                'tsin_direktorat_bd', //kode select
                '{{ url('api/sekper/suratkeluar/get_surat_dir') }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.msrt_nama, // text nama
                                id: d.msrt_kode // kode value
                            }
                        })
                    };
                },
            );


            $('body').on('click', '#omodTam', function() {
                $('#modal').modal('show');
                bsimpan('btn_simpan', 'Simpan');
                $('#tMod').text('Tambah data');
                bsimpan('btn_simpan', 'Simpan');
            });

            $('body').on('click', '#omodTtd', function() {
                $('#modal_ttd').modal('show');
                bsimpan('btn_simpan_ttd', 'Simpan');
                $('#tMod_ttd').text('Tambah data ttd master');
                bsimpan('btn_simpan_ttd', 'Simpan');

            });

            $('body').on('click', '#omodBackdate', function() {
                $('#modal_bd').modal('show');
                bsimpan('btn_simpan_bd', 'Simpan');
                $('#tMod_bd').text('Tambah data surat keluar backdate');
                bsimpan('btn_simpan_bd', 'Simpan');

            });

            $('body').on('click', '#bmoViewPdf', function() {
                // $('#tModView').text('Rincian PKS');
                var kode = $(this).attr('data-show-pdf');
                var loc2 = $(location).attr('origin') + '/storage/sekper/suratmasuk/' + kode;
                $('#modalView').modal('show')
                $('#tModView').text('File : ' + kode);
                $('#pdf').attr('data', loc2);

                // $("#modalView").on("hidden.bs.modal", function() {
                //     $("#modal-body").html("");
                //     $('#pdf').attr('data', loc2);
                // });
                console.log(loc2);
            });

            $('body').on('click', '#omodEdit', function() {
                $('#tMod').text('Edit Data');
                bsimpan('btn_simpan', 'Update');
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('sekper/suratkeluar') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    // getTsinJenis();
                    // var key = "{{ url('api/sekper/suratkeluar/gettsjs-edit') }}" + "/" + res.tsin_js;
                    $('#modal').modal('show');
                    $('#tsin_pk').val(kode);
                    $('#tsin_nomor').val(res.tsin_nomor);
                    $('#tsin_direktorat').val(res.tsin_direktorat);
                    $('#tsin_tanggal').val(res.tsin_tanggal);
                    $('#tsin_hal').val(res.tsin_hal);
                    $('#tsin_tujuan').val(res.tsin_tujuan);
                    $('#tsin_pegang_polis').val(res.tsin_pegang_polis);
                    $('#tsin_referensi').val(res.tsin_referensi);
                    $('#tsin_noreferensi').val(res.tsin_noreferensi);
                    $('#tsin_pembuat').val(res.tsin_pembuat);
                    $('#tsin_ttd').val(res.tsin_ttd);
                    // $.get(key, function(respon) {
                    //     // getTsinJenis();
                    //     $('#tsin_js').val(respon.msrt_kode).trigger('change');
                    //     // $('#tsin_js').append('<option value="'+ respon.msrt_kode +'">'+ respon.msrt_nama +'</option>');
                    // });
                });
            });

            $('#frxx_bd').submit(function(e) {
                // $('#btn_simpan').click(function(e) {
                e.preventDefault();
                // var dataFrx = $('#frxx').serialize();
                var formData = new FormData(this); //jika ada input file atau dokumen
                bsimpan('btn_simpan_bd', 'Please wait..');

                $.ajax({
                    url: "{{ route('sekper.suratkeluar.backdate_surat') }}",
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
                                // $('#modal_bd').modal('hide');
                                // bsimpan('btn_simpan_bd', 'Simpan');
                                // $("#frxx_bd")[0].reset();
                            });
                        } else {
                            bsimpan('btn_simpan_bd', 'Simpan');
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
                // e.preventDefault();
            });

            $('#frxx_ttd').submit(function(e) {
                // $('#btn_simpan').click(function(e) {
                e.preventDefault();
                // var dataFrx = $('#frxx').serialize();
                var formData = new FormData(this); //jika ada input file atau dokumen
                bsimpan('btn_simpan_ttd', 'Please wait..');

                $.ajax({
                    url: "{{ route('sekper.suratkeluar.ttd_surat') }}",
                    type: "POST",
                    data: formData,
                    cache: false, //jika ada input file atau dokumen
                    contentType: false, //jika ada input file atau dokumen
                    processData: false, //jika ada input file atau dokumen
                    // dataType: 'json',
                    success: function(res) {
                        window.location.reload();
                        if ($.isEmptyObject(res.error)) {
                            console.log(res);
                            Swal.fire(
                                'Berhasil!',
                                res.success,
                                'success'
                            ).then((res) => {
                                $('#modal_ttd').modal('hide');
                                bsimpan('btn_simpan_ttd', 'Simpan');
                                $("#frxx_ttd")[0].reset();
                            });
                        } else {
                            bsimpan('btn_simpan_ttd', 'Simpan');
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
                // e.preventDefault();
            });

            $('#frxx').submit(function(e) {
                // $('#btn_simpan').click(function(e) {
                e.preventDefault();
                // var dataFrx = $('#frxx').serialize();
                var formData = new FormData(this); //jika ada input file atau dokumen
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('sekper.suratkeluar.store') }}",
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
                                // $('#modal').modal('hide');
                                // bsimpan('btn_simpan', 'Simpan');
                                // $("#frxx")[0].reset();
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
                // e.preventDefault();
            });

            $('body').on('click', '#omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('sekper/suratkeluar') }}" + "/" + kode;

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
                                    // reset();
                                    lodTable();

                                    console.log('Success', res);
                                },
                                error: function(err) {
                                    // reset();
                                    lodTable();

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
            $('#btn_reset_ttd').click(function() {
                $(document).ready(function() {
                    $("button").click(function() {
                        $("#frxx_ttd")[0].reset();
                    });
                });
                // clearError();
            });
            $('#btn_close3').click(function() {
                $('#modalView').modal('hide');
                // lodTable();
                x();
            });
            $('#btn_close4').click(function() {
                $('#modalView').modal('hide');
                x();

            });

            $('#btn_closeCreate').click(function() {
                $('#modal').modal('hide');
                x();
            });
            $('#btn_close_ttd').click(function() {
                $('#modal_ttd').modal('hide');
                $("#frxx_ttd")[0].reset();
            });
            
            
            $('#btn_tutup_ttd').click(function() {
                $('#modal_ttd').modal('hide');
                $("#frxx_ttd")[0].reset();
            });

            $('#btn_close_bd').click(function() {
                $('#modal_bd').modal('hide');
                $("#frxx_bd")[0].reset();
            });
            $('#btn_tutup_bd').click(function() {
                $('#modal_bd').modal('hide');
                $("#frxx_bd")[0].reset();
            });
            $('#btn_reset_bd').click(function() {
                $(document).ready(function() {
                    $("button").click(function() {
                        $("#frxx_bd")[0].reset();
                    });
                });
                // clearError();
            });
        });

        // function close_pojk () {
        //     $('#modalView').modal('hide');
        //     $('#pdf').attr('data', '');
        // }
    </script>
@endsection
