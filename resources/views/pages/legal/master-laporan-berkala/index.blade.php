@extends('layouts.main-admin')

@section('title')
    Lihat Master Laporan Berkala
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar Master Laporan Berkala</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="search" data-kt-datatable-table-filter="search" id="search"
                        class="form-control form-control-solid w-250px ps-14" placeholder="Cari master laporan berkala" />
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

                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" id="omodTam" data-bs-placement="top" title="Tambah Baru">Tambah</button>
                </div>

                @include('pages.legal.master-laporan-berkala.modal.create')
                @include('pages.legal.master-laporan-berkala.modal.view')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_mst_lap_ber">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>Nomor PK</th>
                            <th class="min-w-250px">Jenis Laporan</th>
                            <th>Laporan Kepada</th>
                            <th>Batas Waktu Penyampaian</th>
                            <th>Unit Kerja Penanggungjawab Laporan</th>
                            <th>Persetujuan</th>
                            <th>Email PIC</th>
                            <th>WA PIC</th>
                            <th>Reminder</th>
                            <th>Last Update</th>
                            {{-- <th>Aksi</th> --}}
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

            filterAll('input[type="search"]', 'serverSide_mst_lap_ber'); //khusus type search inputan

            serverSide( //datatable serverside
            'serverSide_mst_lap_ber',
                "{{ url('api/legal/m_laporan_berkala') }}", //url api/route
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
                    // {
                    //     data: null,
                    //     orderable: false,
                    //     className: 'text-center',
                    //     render: function(data, type, row) {
                    //         return `
                    //     <button type="button" id="bmoViewPdf" data-resouce="` + row.mpojk_pk + `" data-show-pdf="` + row
                    //             .mpojk_dokumen + `"
                    //                     class="btn btn-light-success" target="blank"> Lihat </button>`
                    //     }

                    // },
                    {
                        // data: 'mlapbkl_pk'
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="omodEdit" data-resouce="` + row.mlapbkl_pk + `" class="btn btn-light-success" target="blank"> `+ row.mlapbkl_pk +` </button>`
                        }
                    },
                    {
                        data: 'mlapbkl_jenis'
                    },
                    {
                        data: 'mlapbkl_kepada'
                    },
                    {
                        data: 'mlapbkl_batas'
                    },
                    {
                        data: 'unit'
                    },
                    {
                        data: 'mlapbkl_persetujuan'
                    },
                    {
                        data: 'mlapbkl_pic_email'
                    },
                    {
                        data: 'mlapbkl_pic_hp'
                    },
                    {
                        data: 'aktif'
                    },
                    {
                        data: 'mlapbkl_update'
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
                    //                     <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="` + row.mlapbkl_pk + `">Edit</a>
                    //                 </div>
                    //                 <div class="menu-item px-3">
                    //                     <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="` + row
                    //             .mlapbkl_pk + `">Delete</a>
                    //                 </div>
                    //             </div>
                    //         `;
                    //     },
                    // },
                ],
            );

            // selectServerSide( //select server side with api/route
            //     'mlapbkl_unit', //kode select
            //     '{{ url('api/legal/unit_laporan_berkala') }}', //url
            //     function(data) {
            //         return {
            //             results: $.map(data, function(d) {
            //                 return {
            //                     text: d.nama, // text nama
            //                     id: d.id // kode value
            //                 }
            //             })
            //         };
            //     },
            // );

            $('body').on('click', '#omodTam', function() {
                $('#modal').modal('show');
                bsimpan('btn_simpan', 'Simpan');
                $('#tMod').text('Tambah data');
                bsimpan('btn_simpan', 'Simpan');
            });

            // $('body').on('click', '#bmoViewPdf', function() {
            //     // $('#tModView').text('Rincian PKS');
            //     var kode = $(this).attr('data-show-pdf');
            //     var loc2 = $(location).attr('origin') + '/storage/legal/peraturan/' + kode;
            //     $('#modalView').modal('show')
            //     $('#tModView').text('File : ' + kode);
            //     $('#pdf').attr('data', loc2);

            //     $("#modalView").on("hidden.bs.modal", function() {
            //     $("#modal-body").html("");
            //     $('#pdf').attr('data', loc2);
            //     });
            //     console.log(loc2);
            // });

            $('body').on('click', '#omodEdit', function() {
                $('#tMod').text('Edit Data');
                bsimpan('btn_simpan', 'Update');
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/master-laporan') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    $('#modal').modal('show');
                    // $('#mlapbkl_pk').val(kode);
                    // $('#mlapbkl_jenis').val(res.mlapbkl_jenis);
                    // $('#mlapbkl_kepada').val(res.mlapbkl_kepada);
                    // $('#mlapbkl_batas').val(res.mlapbkl_batas);
                    // $('#mlapbkl_unit').val(res.mlapbkl_unit);
                    // $('#mlapbkl_persetujuan').val(res.mlapbkl_persetujuan);
                    // $('#mlapbkl_aktif').val(res.mlapbkl_aktif);
                    // $('#mlapbkl_periode').val(res.mlapbkl_periode);
                    // $('#mlapbkl_bulan').val(res.mlapbkl_bulan);
                    // $('#mlapbkl_tgl').val(res.mlapbkl_tgl);
                    // $('#mlapbkl_pic_email').val(res.mlapbkl_pic_email);
                    // $('#mlapbkl_pic_hp').val(res.mlapbkl_pic_hp);
                    $('#frxx').formToJson(res);

                });
            });
            

            submitForm(
                    "frxx",
                    "btn_simpan",
                    "POST",
                    "{{ route('legal.master-laporan.store') }}",
                    (resSuccess) => {
                        clearForm("frxx");
                        clearSelect();
                        lodTable('serverSide_mst_lap_ber');
                        bsimpan("btn_simpan", 'Simpan');
                        closeModal('modal');
                    },
                    (resError) => {
                        console.log(resError);
                    },
                );


            // $('#frxx').submit(function(e) {
            //     // $('#btn_simpan').click(function(e) {
            //     e.preventDefault();
            //     // var dataFrx = $('#frxx').serialize();
            //     var formData = new FormData(this); //jika ada input file atau dokumen
            //     bsimpan('btn_simpan', 'Please wait..');

            //     $.ajax({
            //         url: "{{ route('legal.master-laporan.store') }}",
            //         type: "POST",
            //         data: formData,
            //         cache: false, //jika ada input file atau dokumen
            //         contentType: false, //jika ada input file atau dokumen
            //         processData: false, //jika ada input file atau dokumen
            //         // dataType: 'json',
            //         success: function(res) {
            //             // window.location.reload();
            //             if ($.isEmptyObject(res.error)) {
            //                 console.log(res);
            //                 Swal.fire(
            //                     'Berhasil!',
            //                     res.success,
            //                     'success'
            //                 ).then((res) => {
            //                     clearForm("frxx");
            //                     // clearSelect();
            //                     lodTable('serverSide_mst_lap_ber');
            //                     $('#modal').modal('hide');
            //                     bsimpan('btn_simpan', 'Simpan');
            //                 });
            //             } else {
            //                 bsimpan('btn_simpan', 'Simpan');
            //                 Swal.fire({
            //                     icon: 'error',
            //                     title: 'Oops...',
            //                     text: 'Field harus ter isi!',
            //                 });
            //                 messages(res.error);
            //             }
            //         },
            //         error: function(err) {
            //             console.log('Error:', err);
            //             bsimpan('btn_simpan', 'Simpan');
            //         }
            //     });
            // });

            $('body').on('click', '#omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/master-laporan') }}" + "/" + kode;

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
            $('#btn_close3').click(function() {
                $('#modalView').modal('hide');
                // lodTable();
                x();
            });
            $('#btn_close4').click(function() {
                // var kode = $(this).attr('data-resouce'),
                // var loc2 = $(location).attr('origin') + '/storage/legal/pojk/' + kode;
                $('#modalView').modal('hide');
                x();
                
            });

            $('#btn_closeCreate').click(function() {
                $('#modal').modal('hide');
                x();
            });
            $('#btn_tutup').click(function() {
                $('#modal').modal('hide');
                x();
            });

        });

        // function close_pojk () {
        //     $('#modalView').modal('hide');
        //     $('#pdf').attr('data', '');
        // }
    </script>
@endsection
