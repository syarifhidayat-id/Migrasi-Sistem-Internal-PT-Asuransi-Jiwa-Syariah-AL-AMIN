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
                    <div class="input-group input-group-solid">
                        <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control" placeholder="Cari pks" />
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
                                        <label class="form-label fs-6 fw-bold">Intansi:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_instansi" name="check_instansi" type="checkbox" data-checkbox="check_instansi" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih instansi" data-allow-clear="true" data-kt-datatable-table-filter="check_pks_instansi" data-hide-search="false" id="check_pks_instansi">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Nomor PKS:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_no_pks" name="check_no_pks" type="checkbox" data-checkbox="check_no_pks" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih nomor pks" data-allow-clear="true" data-kt-datatable-table-filter="check_pks_no" data-hide-search="false" id="check_pks_no">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">PIC Reminder:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_pic" name="check_pic" type="checkbox" data-checkbox="check_pic" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih PIC" data-allow-clear="true" data-kt-datatable-table-filter="check_pic_pks" data-hide-search="false" id="check_pic_pks">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-bold">Status Berlaku:</label>
                                        <div class="d-flex flex-stack">
                                            <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                <input class="form-check-input" id="check_status" name="check_status" type="checkbox" data-checkbox="check_status" />
                                            </label>
                                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih status berlaku" data-allow-clear="true" data-kt-datatable-table-filter="check_status_berlaku" data-hide-search="false" id="check_status_berlaku">
                                                <option></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                                <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i class="fa-solid fa-repeat"></i> Reset</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                    <div id="kt_table_datatable_export" class="d-none"></div>

                    {{-- <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i
                            class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button> --}}

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
                        data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" onclick="tombolAct(0)">Tambah</button>
                    <button type="button" class="btn btn-light-primary btn-sm me-3" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" data-bs-placement="top" title="Tambah Addendum" onclick="tombolAct(2)">Addendum</button>
                    <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="tooltip"
                        data-bs-trigger="hover" data-bs-placement="top" title="Batal" onclick="tombolAct(3)">Batal</button>
                </div>

                
            </div>
        </div>

        <div class="card-body py-10">
            <div class="table-responsive">
                <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="serverSidePks">
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

        @include('pages.legal.pks.modal.create')
        @include('pages.legal.pks.modal.view')
        @include('pages.legal.pks.modal.pdf')
        @include('pages.legal.pks.modal.addendum')
        @include('pages.legal.pks.modal.batal')
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


            //SELECT FILTER

            selectSide('check_pks_instansi', false, '{{ url("api/legal/pks/select-instansi") }}', function(d) { return {
                id: d.mpks_instansi,
                text: d.mpks_instansi
            }}, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('check_pks_no', false, '{{ url("api/legal/pks/select-no-pks") }}', function(d) { return {
                id: d.mpks_nomor,
                text: d.mpks_nomor
            }}, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('check_pic_pks', false, '{{ url("api/legal/pks/selectPic") }}', function(d) { return {
                id: d.mpks_pic,
                text: d.mpks_pic
            }}, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('check_ins_user', false, '{{ url("api/legal/pks/selectInsUser") }}', function(d) { return {
                id: d.mpks_ins_user,
                text: d.mpks_ins_user
            }}, function(res) {
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });


            //SELECT FORM

            selectSide('mpks_mrkn_kode_test', false, '{{ url("api/legal/pks/polis") }}', function(data) { return {
                text: data.mrkn_nama, // text nama
                id: data.mrkn_kode // kode value
            }}, function(res){
                // setText('msoc_mssp_kode', res.params.data.id);
                // setText('msoc_mssp_nama', res.params.data.text);
            });

            selectSide('cari_pk', false, '{{ url("api/legal/get_select_pks") }}', function(d) { return {
                text: d.mpks_nomor, // text nama
                // text: d.mpks_nomor + '|' + d.mpks_nama, // text nama
                id: d.mpks_pk, // kode value
            }},
            function(res) {
                var key = '{{ url('api/legal/pks/get_all_pks') }}' + '/' + res.params.data.id;
                $.get(key, function(a) {
                    $('#frxx_add').formToJson(a);
                    if (a.mpks_mrkn_kode !== "") {
                        var mrkn = "{{ url('api/legal/pks/get_edit_polis') }}" + "/" + a.mpks_mrkn_kode;
                        $.get(mrkn, function(b) {
                            selectEdit('mpks_mrkn_kode_test', b.mrkn_kode, b.mrkn_nama);

                        });
                    }
                });
            },
        );

            filterAll('input[type="search"]', 'serverSidePks'); //khusus type search inputan

            serverSide( //datatable serverside
                "serverSidePks",
                "{{ url('api/legal/api_pks') }}", //url api/route
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    d.check_instansi = getText('check_instansi');
                    d.mpks_instansi = getText('check_pks_instansi');
                    d.check_no_pks = getText('check_no_pks');
                    d.mpks_nomor = getText('check_pks_no');
                    d.check_pic = getText('check_pic');
                    d.mpks_pic = getText('check_pic_pks');
                    d.check_user_ins = getText('check_user_ins');
                    d.mpks_ins_user = getText('check_ins_user');
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
                        <button type="button" id="omodEdit" data-resouce="` + row.mpks_pk +
                                `" class="btn btn-light-success" onclick="tombolAct(1)"> <i class="fa-solid fa-pen"></i> </button>`
                        }

                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" id="bmoDetail" data-resouce="` + row.mpks_pk +
                                `" class="btn btn-light-success" target="blank"> ` + row.mpks_nomor +
                                ` </button>`
                        }

                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                        <button type="button" data-resouce="` + row.mpks_pk + `" onclick="jenisFile('`+row.mpks_dokumen+`')" class="btn btn-light-primary" target="blank"> ` + row.kode_rekanan + ` </button>`
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
                        render: function() {
                            return `edit`
                        }
                    },
                ],
            );



            $('body').on('click', '#bmoDetail', function() {
                $('#tModView').text('Rincian PKS');
                var kode = $(this).attr('data-resouce')
                url = "{{ url('api/legal/pks/lihat/pks') }}" + "/" + kode;
                $.get(url, function(res) {
                    console.log(res);
                    $('#modalView').modal('show');
                    // var key = "{{ route('utility.menu.store') }}" + "/" + res.wmn_key + "/keyMenu";
                    $('#frxx1').formToJson(res);
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
            submitForm(
                "frxx",
                "btn_simpan",
                "POST",
                "{{ route('legal.pks.lihat.store') }}",
                (resSuccess) => {
                    clearForm("frxx");
                    clearSelect();
                    lodTable('serverSide');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modalPks');
                },
                (resError) => {
                    console.log(resError);
                },
            );
            submitForm(
                "frxx_add",
                "btn_simpan",
                "POST",
                "{{ route('legal.pks.lihat.store') }}",
                (resSuccess) => {
                    clearForm("frxx_add");
                    clearSelect();
                    lodTable('serverSide');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modalAddendum');
                },
                (resError) => {
                    console.log(resError);
                },
            );

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
        });

        // function closeMod (id, tipe) {
        //     closeModal(id);
        //     clearForm(tipe);
        // }

        function tombolAct(tipe) {
            clearForm('frxx_add');
            setHide('mpks_pk', true);

            if (tipe == "0") {
                setHide('btnBersih', false);
                setHide('hidePk', true);
                setHide('hideField', true);
                openModal('modalAddendum');
                titleAction('tModAddendum', 'Tambah');
            }

            if (tipe == "1") {
                setHide('hidePk', true);
                setHide('btnBersih', true);
                setHide('hideField', true);
                var kode = $('#omodEdit').attr('data-resouce'),
                    url = "{{ url('legal/pks/lihat') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    openModal('modalAddendum');
                    titleAction('tModAddendum', 'Edit PKS');
                    var key = "{{ url('api/legal/pks/get_edit_polis') }}" + "/" + res
                        .mpks_mrkn_kode;
                    $('#frxx_add').formToJson(res);
                    $.get(key, function(data) {
                        selectEdit('mpks_mrkn_kode_test', data.mrkn_kode, data.mrkn_nama);
                        // var op = new Option(data.mrkn_nama, data.mrkn_kode, true, true);
                        // $('#mpks_mrkn_kode').append(op).trigger('change');
                        // console.log(data);
                    });
                });
            }

            if (tipe == "2") {
                setHide('hidePk', false);
                setHide('btnBersih', true);
                setHide('hideField', true);
                // var eds = setText('eds', '0');
                // endos(eds);
                openModal('modalAddendum');
                titleAction('tModAddendum', 'Addendum');
            }

            if (tipe == "3") {
                setHide('hidePk', false);
                setHide('btnBersih', true);
                setHide('hideField', true);
                // var eds = setText('eds', '2');
                // endos(eds);
                openModal('modalAddendum');
                titleAction('tModAddendum', 'Batal');
            }
            setText('eds', tipe);
        }

        function jenisFile(jenis1) {
            var url = '{{ url("storage/legal/pks") }}' + '/';
                $('#view_pdf').attr('src', url + jenis1);
                openModal('modalPdf');
            }

        // hidePesan('wmn_tipe');
    </script>
@endsection
