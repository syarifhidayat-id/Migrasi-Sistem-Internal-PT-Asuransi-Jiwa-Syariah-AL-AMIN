@extends('layouts.main-admin')

@section('title')
    Menu
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>List Menu</h3>
            </div>
        </div>
        <form id="frxrpt" name="frxrpt" action="{{ url('utility/menu/lihat-menu') }}" method="get"
            onSubmit="return form_submit(this,0);">
            @csrf
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">
                        <button type="button" class="btn btn-light-primary me-3 btn-sm"
                            onclick="openModal('modalFilter')"><i class="fa-sharp fa-solid fa-filter"></i> Filter
                            Pencarian</button>
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                        <div id="kt_table_datatable_export" class="d-none"></div>

                        <button type="button" id="btn_export" data-title="Data Menu"
                            class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i>
                            Export</button>

                        <div id="kt_table_datatable_export_menu" title-kt-export="Data Menu"
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
                                class="fa-sharp fa-solid fa-plus"></i> Tambah Menu</button>
                    </div>

                </div>
            </div>

            <div class="card-body py-10">
                <div class="fw-bold fs-6 text-gray-800 text-center mb-5">DAFTAR MENU</div>
                <div class="table-responsive" id="dtTable"></div>
                @include('pages.utility.membuat-menu.modal.filter')
            </div>
        </form>

        @include('pages.utility.membuat-menu.modal.create')
    </div>
@endsection

@section('script')
    <script>
        setHide('kode_tipe', false);
        $('#wmn_key').select2({
            tags: true,
        });
        $('#wmn_mrkn_kode').select2();
        $('#wmn_mpol_kode').select2();

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            loadMenu();

            selectSide('e_tipe', false, "{{ url('api/utility/menu/select-tipemenu') }}", function(d) {
                return {
                    id: d.wmt_kode,
                    text: d.wmt_nama
                }
            }, function(e) {
                var data = e.params.data.id;
                selectSide('e_des', false, "{{ url('api/utility/menu/select-menu') }}" + "?tipe=" + data,
                    function(d) {
                        return {
                            // selectSide('key', false, '{{ url('api/utility/menu/select-menu') }}' + '?tipe=' + getText('tipe_menu'), function(d) { return {
                            id: d.wmn_kode,
                            text: d.wmn_descp
                        }
                    });
            });

            // onSelect('wmn_tipe', function(e) {
            //     var kode = e.params.data.id;
            //     console.log(kode);
            //     selectSide('wmn_key', false, "{{ url('api/utility/menu/select-menu') }}" + '?tipe=' + kode,
            //         function(d) {
            //             return {
            //                 id: d.wmn_descp,
            //                 text: d.wmn_descp
            //             }
            //         });
            // });

            selectGrid('wmn_tipe', 'GET', "{{ url('api/utility/menu/lod_menutipe') }}", 'kode', 'nama',
                [{
                        field: 'kode',
                        title: 'Kode',
                        align: 'left',
                        width: 180
                    },
                    {
                        field: 'nama',
                        title: 'Nama',
                        align: 'left',
                        width: 280
                    },
                ],
                function(i, row) {
                    hidePesan('msoc_mrkn_nama');
                    reSelBox('wmn_key', "{{ url('api/utility/menu/lod_mainmenu') }}" + '?' +
                        '&mjns=' + getText("e_nasabah"));
                });

            selectGrid('wmn_key', 'GET', "{{ url('api/utility/menu/lod_mainmenu') }}", 'nama', 'nama',
                [{
                        field: 'kode',
                        title: 'Kode',
                        align: 'left',
                        width: 180
                    },
                    {
                        field: 'nama',
                        title: 'Nama',
                        align: 'left',
                        width: 280
                    },
                ],
                function(i, row) {
                    hidePesan('msoc_mrkn_nama');
                    reSelBox('msoc_mssp_nama', '{{ url('tehnik/soc/entry-soc/grd_segmen') }}' + '?' +
                        '&mjns=' + getText("e_nasabah"));
                });

            // selectSide('wmn_tipe', false, "{{ url('api/utility/menu/select-tipemenu') }}", function(d) {
            //     return {
            //         id: d.wmt_kode,
            //         text: d.wmt_nama
            //     }
            // }, function(e) {
            //     var data = e.params.data.id;
            //     selectSide('wmn_key', false, "{{ url('api/utility/menu/select-menu') }}" + '?tipe=' + data,
            //         function(d) {
            //             return {
            //                 // selectSide('wmn_key', false, '{{ url('api/utility/menu/select-menu') }}' + '?tipe=' + getText('wmn_tipe'), function(d) { return {
            //                 id: d.wmn_descp,
            //                 text: d.wmn_descp
            //             }
            //         });
            // });

            tombol('click', 'omodTam', function() {
                openModal('modalMenu');
                titleAction('tModMenu', 'Tambah Menu');
                clearForm("formMenu");
                clearSelect();
                bsimpan('btn_simpan', 'Simpan');
                setHide('btn_reset', false);
            });

            submitForm("formMenu", "btn_simpan", "POST", "{{ route('utility.menu.store') }}", (resSuccess) => {
                clearForm("formMenu");
                bsimpan('btn_simpan', 'Simpan');
                // lodTable("lihatMenu");
                loadMenu();
                closeModal('modalMenu');
            });
        });

        function loadMenu() {
            setLoad("#dtTable", "{{ url('utility/menu/lihat-menu') }}" + "?e_baris=" +
                getText('e_baris'));
        }

        function editMenu(kode) {
            // var kode = $(this).attr('data-resouce');
            lodJson("GET", "{{ url('api/utility/menu/edit') }}" + "?kode=" + kode, function(data) {
                openModal('modalMenu');
                titleAction('tModMenu', 'Edit Menu');
                bsimpan('btn_simpan', 'Update');
                setHide('btn_reset', true);

                var tipe = "{{ url('api/utility/menu/tipe-menu') }}" + "/" + data.wmn_tipe;
                var key = "{{ url('api/utility/menu/key-menu') }}" + "/" + data.wmn_key;
                jsonForm('formMenu', data);
                // lodJson("GET", "{{ url('api/utility/menu/tipe-menu') }}" + "/" + data.wmn_tipe,
                //     function(res) {
                //         if ($('#wmn_tipe').find("option[value='" + res.wmt_kode + "']")
                //             .length) {
                //             $('#wmn_tipe').val(res.wmt_kode).trigger('change');
                //         } else {
                //             selectEdit('wmn_tipe', res.wmt_kode, res.wmt_nama);
                //         }
                //     });
                // if (data.wmn_key == "MAIN") {
                //     selectEdit('wmn_key', 'MAIN', 'MAIN');
                // } else {
                //     lodJson("GET", "{{ url('api/utility/menu/key-menu') }}" + "/" + data.wmn_key, function(res) {
                //         if ($('#wmn_key').find("option[value='" + res.wmn_kode + "']")
                //             .length) {
                //             $('#wmn_key').val(res.wmn_kode).trigger('change');
                //         } else {
                //             selectEdit('wmn_key', res.wmn_kode, res.wmn_descp);
                //         }
                //     });
                // }
            });
        };

        function deleteMenu(kode) {
            var url = "{{ route('utility.menu.store') }}" + "/" + kode;
            submitDelete(kode, url, function(resSuccess) {
                // lodTable("lihatMenu");
                loadMenu();
                // console.log(resSuccess);
            }, function(resError) {
                // console.log(resError);
            });
        }

        function closeBtnModal() {
            closeModal('modalMenu');
            clearForm("formMenu");
        };

        hidePesan('wmn_tipe');
        hidePesan('wmn_key');
        hidePesan('wmn_descp');
        hidePesan('wmn_url_o_n');
        hidePesan('wmn_urut');

        function form_submit(form, ids) {
            filter(form, ids, function(res) {
                setHtml("#dtTable", res);
                return false;
            }, function(errr) {
                pesan("error", "Data gagal dimasukkan. \n cek koneksi jaringan");
            });
            return false;
        }
    </script>
@endsection
