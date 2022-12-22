@extends('layouts.main-admin')

@section('title')
    Lihat OJK
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Daftar OJK</h3>
            </div>
        </div>

        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    <div class="input-group input-group-solid">
                        <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control" placeholder="Cari Ojk" />
                        <button type="submit" class="btn btn-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                    </div>
                </div>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                    <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-sharp fa-solid fa-filter"></i> Filter
                    </button>

                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                        </div>
                        <div class="separator border-gray-200"></div>

                        <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">ID Upload:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_id" name="check_id" type="checkbox" data-checkbox="check_id" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih nomor" data-allow-clear="true" data-kt-datatable-table-filter="check_id_upload" data-hide-search="false" id="check_id_upload">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                    {{-- <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Perihal:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_hal_pojk" name="check_hal_pojk" type="checkbox" data-checkbox="check_hal_pojk" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih perihal" data-allow-clear="true" data-kt-datatable-table-filter="check_perihal_pojk" data-hide-search="false" id="check_perihal_pojk">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Jenis:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_jenis" name="check_jenis" type="checkbox" data-checkbox="check_jenis" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih jenis" data-allow-clear="true" data-kt-datatable-table-filter="check_jenis_pojk" data-hide-search="false" id="check_jenis_pojk">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}
                                {{--
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Periode Input:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_periode" name="check_periode" type="checkbox" data-checkbox="check_periode" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih periode input" data-allow-clear="true" data-kt-datatable-table-filter="check_periode_input" data-hide-search="false" id="check_periode_input">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>--}}
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                                <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i class="fa-solid fa-repeat"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    {{-- <div id="kt_table_datatable_export" class="d-none"></div>

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
                    </div> --}}

                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" id="omodTam" data-bs-placement="top" title="Tambah Baru">Tambah OJK</button>
                </div>
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSide_ojk">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                            <th>No.</th>
                            <th>ID</th>
                            <th>Judul</th>
                            <th class="min-w-250px">Jenis Dokumen</th>
                            <th>Ket Dokumen</th>
                            <th>Tahun</th>
                            <th>User Input</th>
                            <th>Tanggal Input</th>
                            <th class="min-w-150px">Jenis Dokumen</th>
                            <th class="min-w-150px">Dokumen</th>
                        </tr>
                    </thead>
                    {{-- <tbody></tbody> --}}
                </table>
            </div>
        </div>
        

        @include('pages.legal.ojk.modal.create')
        @include('pages.legal.ojk.modal.view')
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

            selectSide('check_id_upload', false, '{{ url("api/legal/ojk/selectId") }}', function(d) { return {
                id: d.mojk_pk,
                text: d.mojk_pk
            }}, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            changeSelect('check_id_upload', 'key', '{{ url("api/legal/ojk/getId") }}',function(d) { return {
                id: d.mojk_pk,
                text: d.mojk_pk
            }}, function(res) {
                    // setText('msoc_mssp_kode', res.params.data.id);
                    // setText('msoc_mssp_nama', res.params.data.text);
            });

            filterAll('input[type="search"]', 'serverSide_ojk'); //khusus type search inputan

            serverSide( //datatable serverside
            "serverSide_ojk",
                "{{ url('api/legal/ojk') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.check_id = getText('check_id'),
                    d.mojk_pk = getText('check_id_upload'),
                    d.search = $('input[type="search"]').val()
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        // data: 'mojk_pk'
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="omodEdit" data-resouce="` + row.mojk_pk + `" class="btn btn-light-success" target="blank"> `+ row.mojk_pk +` </button>`
                        }
                    },
                    {
                        data: 'mojk_judul'
                    },
                    {
                        data: 'jenis_mojk'
                    },
                    {
                        data: 'mojk_ket_jenis'
                    },
                    {
                        data: 'mojk_tahun'
                    },
                    {
                        data: 'mojk_ins_user'
                    },
                    {
                        data: 'mojk_ins_date'
                    },
                    {
                        data: 'select',
                        orderable: false,
                        className: 'text-center',
                        render: function (data, type, row) {
                            return `
                            <select class="form-select" id="jenis_dokumen" data-pk="`+row.mojk_pk+`"
                                name="mojk_jenis" data-placeholder="Pilih jenis dokumen" data-allow-clear="true">
                                <option selected>Pilih</option>
                                <option value="1">Tanda Terima</option>
                                <option value="2">Dokumen</option>
                            </select>`
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `<button type="button" onclick="jenisFile('`+row.mojk_file1+`', '`+row.mojk_file2+`')" class="btn btn-light-success"> Lihat</button>`;
                        }

                    },
                ],
            );

            tombol('click', 'omodTam', function() {

            });

            $('body').on('change', '#jenis_dokumen', function() {
                var _this = $(this).val();
                console.log(_this);
            }).change();

            tombol('click', 'omodTam', function() {
                $('#modal').modal('show');
                setHide('btn_reset', false);
                bsimpan('btn_simpan', 'Simpan');
                $('#tMod').text('Tambah data');
                bsimpan('btn_simpan', 'Simpan');
                clearForm('frxx');
                clearSelect();
                
            });

            tombol('click', 'omodEdit', function() {
                $('#tMod').text('Edit Data');
                setHide('btn_reset', true);
                bsimpan('btn_simpan', 'Update');
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/ojk') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    // var key = "{{ url('api/legal/get_mojk_jenis') }}";
                    $('#modal').modal('show');
                    openModal('modal');
                    jsonForm('frxx', res);

                });
            });

            $('#frxx').submit(function(e) {
                // $('#btn_simpan').click(function(e) {
                e.preventDefault();
                // var dataFrx = $('#frxx').serialize();
                var formData = new FormData(this); //jika ada input file atau dokumen
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('legal.ojk.store') }}",
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
                                lodTable('serverSide_ojk');
                                // reset();
                                // $('#frxx').trigger("reset");
                                $('#modal').modal('hide');
                                bsimpan('btn_simpan', 'Simpan');
                                // x();
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
                    url = "{{ url('legal/ojk') }}" + "/" + kode;

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
        
        function jenisFile(jenis1, jenis2) {
            var doc = $('#jenis_dokumen').val();
            var url = '{{ url("storage/legal/ojk") }}' + '/';
            if (doc=='1') {
                $('#view_pdf').attr('src', url+'file1/'+jenis1);
                openModal('modalView');
            } else if (doc=='2') {
                $('#view_pdf').attr('src', url+'file2/'+jenis2);
                openModal('modalView');
            } else {
                pesan('Silahkan pilih jenis file terlebih dahulu!');
            }
        }

    </script>
@endsection
