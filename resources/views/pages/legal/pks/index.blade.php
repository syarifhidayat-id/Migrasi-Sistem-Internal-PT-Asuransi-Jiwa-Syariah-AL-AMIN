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
                </div>

                @include('pages.legal.pks.modal.create')
                @include('pages.legal.pks.modal.view')
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="kt_table_datatable">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>No. PKS</th>
                            <th class="min-w-250px">Pemegang Polis</th>
                            <th>Instansi</th>
                            <th>Perihal</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>PIC</th>
                            <th class="min-w-125px">Status PKS</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $pks)
                            <tr>
                                <td class="text-center">
                                    {{ ++$key }}
                                </td>
                                <td class="text-center">
                                    <a href="#" id="bmoDetail" data-resouce="{{ $pks->mpks_pk }}"
                                        class="btn btn-light-success"> {{ $pks->mpks_nomor }}</a>
                                </td>
                                <td class="text-center">
                                    {{ $pks->mrkn_nama_induk }}
                                </td>
                                <td class="text-center">
                                    {{ $pks->mpks_instansi }}
                                </td>
                                <td class="text-center">
                                    {{ $pks->mpks_tentang }}
                                </td>
                                <td class="text-center">
                                    {{ $pks->awal_date }}
                                </td>
                                <td class="text-center">
                                    {{ $pks->akhir_date }}
                                </td>
                                <td class="text-center">
                                    {{ $pks->mpks_pic }}
                                </td>
                                <td class="text-center">
                                    Edit
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                        <span class="svg-icon svg-icon-5 m-0">
                                            <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                        </span>
                                    </a>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="#" id="omodEdit" class="menu-link px-3"
                                                data-resouce="{{ $pks->mpks_pk }}">Edit</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" id="omodDelete" class="menu-link px-3"
                                                data-resouce="{{ $pks->mpks_pk }}">Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
      

      $('#dd_polis').select2({
        placeholder: 'pilih pemegang polis',
        allowClear: true,
        });

      $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '#omodTam', function() {
                $('#modalPks').modal('show');
                $('#tModPks').text('Tambah PKS');

                // $.get('http://127.0.0.1:8000/api/legal/pks/polis', function(res) {

                //     console.log(res);
                // })
                // resetMod();
                // bsimpan('btn_simpan', 'Simpan');
                //$('#btn_reset').show();
                // viewMain();
            });

            $('body').on('click', '#bmoDetail', function() {
                $('#tModView').text('Rincian PKS');
                // bsimpan('btn_simpan', 'Update');
                // resetMod();
                // $('#wmn_key').empty();
                // $('#wmn_key').val(null).trigger('change');
                // $('#btn_reset').hide();

                var kode = $(this).attr('data-resouce')
                // console.log(kode);
                url = "{{ url('legal/pks/lihat/pks') }}" + "/" + kode;
                // url = "{{ url('api/legal/pks/view-pks') }}" + "/" + kode;


                console.log(url);

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
                });
            });

            // $('body').on('click', '#omodEdit', function() {
            //     $('#tModMenu').text('Edit Menu');
            //     bsimpan('btn_simpan', 'Update');
            //     // resetMod();
            //     // $('#wmn_key').empty();
            //     $('#wmn_key').val(null).trigger('change');
            //     $('#btn_reset').hide();

            //     var kode = $(this).attr('data-resouce'),
            //         url = "{{ route('utility.menu.index') }}" + "/" + kode + "/edit";
            //     // url = "{{ url('api/utility/menu/edit') }}" + "/" + kode;

            //     $.get(url, function(res) {
            //         viewMain();
            //         var key = "{{ url('api/utility/menu/keyMenu') }}" + "/" + res.wmn_key;
            //         // var key = "{{ route('utility.menu.store') }}" + "/" + res.wmn_key + "/keyMenu";
            //         $('#modalMenu').modal('show');
            //         $('#wmn_kode').val(res.wmn_kode);
            //         $('#wmn_tipe').val(res.wmn_tipe).trigger('change');
            //         $.get(key, function(data) {
            //             $('#wmn_key').val(data.wmn_kode).trigger('change');
            //         });
            //         $('#wmn_descp').val(res.wmn_descp);
            //         $('#wmn_icon').val(res.wmn_icon);
            //         $('#wmn_url').val(res.wmn_url);
            //         $('#wmn_urlkode').val(res.wmn_urlkode);
            //         $('#wmn_info').val(res.wmn_info);
            //         $('#wmn_url_o').val(res.wmn_url_o);
            //         $('#wmn_urut').val(res.wmn_urut);
            //         $('#wmn_mrkn_kode').val(res.wmn_mrkn_kode);
            //         $('#wmn_mpol_kode').val(res.wmn_mpol_kode);
            //     });
            // });

            // // $('#frxx').submit(function(e) {
            // $('#btn_simpan').click(function(e) {
            //     e.preventDefault();
            //     var dataFrx = $('#frxx').serialize();
            //     // var formData = new FormData(this);
            //     bsimpan('btn_simpan', 'Please wait..');

            //     $.ajax({
            //         url: "{{ route('utility.menu.store') }}",
            //         type: "POST",
            //         data: dataFrx,
            //         // cache: false,
            //         // contentType: false,
            //         // processData: false,
            //         dataType: 'json',
            //         success: function(res) {
            //             // window.location.reload();
            //             if ($.isEmptyObject(res.error)) {
            //                 console.log(res);
            //                 Swal.fire(
            //                     'Berhasil!',
            //                     res.success,
            //                     'success'
            //                 ).then((res) => {
            //                     reset();
            //                     $('#frxx').trigger("reset");
            //                     $('#modalMenu').modal('hide');
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

            // $('body').on('click', '#omodDelete', function() {
            //     var kode = $(this).attr('data-resouce'),
            //         url = "{{ route('utility.menu.store') }}" + "/" + kode;

            //     console.log(kode);
            //     Swal.fire({
            //         title: 'Apakah anda yakin?',
            //         text: "Akan menghapus data menu dengan kode " + kode + " !",
            //         icon: 'warning',
            //         showCancelButton: true,
            //         confirmButtonColor: '#3085d6',
            //         cancelButtonColor: '#d33',
            //         confirmButtonText: 'Ya, hapus!'
            //     }).then((result) => {
            //         if (result.isConfirmed) {
            //             Swal.fire(
            //                 'Terhapus!',
            //                 'Anda berhasil menghapus data menu dengan kode ' + kode + ".",
            //                 'success'
            //             ).then((result) => {
            //                 console.log(kode);
            //                 $.ajax({
            //                     url: url,
            //                     type: "DELETE",
            //                     success: function(res) {
            //                         reset();
            //                         console.log('Success', res);
            //                     },
            //                     error: function(err) {
            //                         reset();
            //                         console.log('Error', err);
            //                     }
            //                 });
            //             })
            //         }
            //     })
            // });



            function x() {
                $(document).ready(function() {
                    $("button").click(function() {
                        //$("#d").trigger("reset");
                        //$("#d").get(0).reset();
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
                $('#modalPks').modal('hide');
                x();
            });
            $('#btn_tutup').click(function() {
                $('#modalPks').modal('hide');
                x();
            });

        });
    </script>
@endsection
