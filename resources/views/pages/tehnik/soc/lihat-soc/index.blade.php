@extends('layouts.main-admin')

@section('title')
    Lihat SOC
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Lihat SOC</h3>
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
            <div class="d-flex align-items-center position-relative my-1">
                <div class="input-group input-group-solid flex-nowrap">
                    <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control form-control-solid w-250px" placeholder="Cari Soc" />
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
                                    <label class="form-label fs-6 fw-bold">Kode SOC:</label>
                                    <input type="text" class="form-control form-control-solid" name="msoc_kode" id="msoc_kode" data-kt-datatable-table-filter="search" placeholder="Kode SOC" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-10">
                                    <label class="form-label fs-6 fw-bold">Jaminan Asuransi:</label>
                                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih menu" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="key">
                                        <option></option>
                                        {{-- @foreach ($nama_menu as $key=>$data)
                                            <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                        @endforeach --}}
                                    </select>
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

                <button type="button" id="btn_export" data-title="Data List SOC" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button>

                <div id="kt_table_datatable_export_menu" title-kt-export="Data List SOC" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
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
            </div>
        </div>
    </div>

    <div class="card-body py-10">
        <div class="table-responsive">
            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="datalistSoc">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                        <th class="min-w-80px">No.</th>
                        <th>No SOC</th>
                        <th class="min-w-300px">Kode SOC</th>
                        <th class="min-w-250px">Nama Pemegang Polis</th>
                        <th class="min-w-250px">Jenis Nasabah</th>
                        <th class="min-w-250px">Segmen Pasar</th>
                        <th class="min-w-250px">Mekanisme 1 (Umum)</th>
                        <th class="min-w-250px">Mekanisme 2 (Penutupan)</th>
                        <th class="min-w-250px">Jenis Pekerjaan</th>
                        <th class="min-w-150px">Manfaat Asuransi</th>
                        <th class="min-w-150px">Pembayaran</th>
                        <th class="min-w-150px">Jaminan</th>
                        <th class="min-w-150px">Program Asuransi</th>
                        <th class="min-w-100px">Cetak</th>
                        <th class="min-w-150px">Tanggal Input</th>
                        <th class="min-w-125px">Umur Input</th>
                        <th class="min-w-125px">User Input</th>
                        <th class="min-w-125px">Status Approval</th>
                        <th class="min-w-150px">Kode Polis</th>
                        <th class="min-w-125px">Approval Polis</th>
                        <th class="min-w-125px">Status Polis</th>
                        <th class="min-w-125px">Online Polis</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('pages.tehnik.soc.lihat-soc.modal.cetak')
</div>
@endsection

@section('script')
    <script>

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            filterAll('input[type="search"]', 'datalistSoc');
            serverSide(
                "datalistSoc",
                "{{ url('api/tehnik/soc/lihat-soc/list-soc') }}",
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    // d.wmn_tipe = $('#tipe_menu').val(),
                    d.msoc_kode = $('#msoc_kode').val(),
                    d.search = $('input[type="search"]').val()
                },
                [
                    { data: "DT_RowIndex", className: "text-center" },
                    { data: "msli_nomor" },
                    {
                        data: "msoc_kode",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            var sts = row.msoc_approve;
                            var kode = row.msoc_kode;
                            if (sts == "belum") {
                                var html = `
                                    <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                        <input class="form-check-input" id="approv_soc" data-kode="`+kode+`" type="checkbox" value="1" />
                                        <span class="form-check-label fw-bold text-muted">
                                            Approve
                                        </span>
                                    </label>
                                `;
                            } else if (sts == "sudah") {
                                var html = `
                                    <button type="button" id="kode" title="Lihat Detail" class="btn btn-sm btn-light-primary">`+kode+`</button>
                                `;
                            }
                            return `
                            <div class="input-group input-group-solid flex-nowrap">
                                `+html+`
                                <span class="input-group-text"> | </span>
                                <button type="button" id="lihatUwTb" title="Lihat Table" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Uw Table</button>
                            </div>
                            `;
                        }
                    },
                    // { data: "msoc_kode" },
                    { data: "msli_mrkn_nama" },
                    { data: "mjns_nama" },
                    { data: "mssp_nama" },
                    { data: "mkm_nama" },
                    { data: "mkm_ket2" },
                    { data: "mker_nama" },
                    { data: "mft_nama" },
                    { data: "bayar" },
                    { data: "mjm_nama" },
                    { data: "mpras_nama" },
                    {
                        data: null,
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-primary btn-sm" onclick="aprovalsoc('`+row.msli_nomor+`', 0)">Pilih</button>`;
                        }
                    },
                    { data: "ins_date" },
                    { data: "umur" },
                    { data: "msoc_ins_user" },
                    {
                        data: "msoc_approve",
                        render: function(data, type, row, meta) {
                            var sts = row.msoc_approve;
                            if (sts == "sudah") {
                                var text = "success";
                            } else if (sts == "belum") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.msoc_approve+`</div>`;
                        }
                    },
                    { data: "mpol_kode" },
                    {
                        data: "mpol_approve",
                        render: function(data, type, row, meta) {
                            var sts = row.mpol_approve;
                            if (sts == "sudah") {
                                var text = "success";
                            } else if (sts == "belum") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.mpol_approve+`</div>`;
                        }
                    },
                    {
                        data: "aktif",
                        render: function(data, type, row, meta) {
                            var sts = row.aktif;
                            if (sts == "aktif") {
                                var text = "success";
                            } else if (sts == "suspend") {
                                var text = "warning";
                            } else if (sts == "mati") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.aktif+`</div>`;
                        }
                    },
                    {
                        data: "online",
                        render: function(data, type, row, meta) {
                            var sts = row.online;
                            if (sts == "aktif") {
                                var text = "success";
                            } else if (sts == "mati") {
                                var text = "danger";
                            }
                            return `<div class="badge badge-light-`+text+` fw-bolder">`+row.online+`</div>`;
                        }
                    },
                ],
            );

            tombol ('change', 'approv_soc', function () {
                var kode = $(this).attr('data-kode');
                var val = $(this).val();
                validate(
                    "Data dengan kode berikut " + kode + " akan di approve!",
                    (result) => {
                        if (result.isConfirmed) {
                            post(
                                "{{ url('api/tehnik/soc/lihat-soc/update-status-approval') }}" + "/" + kode + "/" + val,
                                function(data) {
                                    // console.log(data);
                                    message(
                                        'success',
                                        'Data berhasil di approve dengan kode ' + kode + ' !',
                                    );
                                    setCheck(this, true);
                                    lodTable('datalistSoc');
                                },
                            );
                        } else {
                            setCheck(this, false);
                        }
                    }
                );
            });

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
        });

        function aprovalsoc(kodepolis,tipe) {
            vv={ res : ''};
            rms = "kodepolis="+kodepolis;
            url = '{{ url("api/tehnik/polis/approval-master-polis/get-kode-soc") }}' + '?' + rms;
            $.get(url,vv, function(data) {
                if (data) {
                    if(tipe="0") {
                        titleAction('titleModal', 'From Cetak');
                        openModal('modalCetakSoc');
                        setText("mpap_mpol_kode",kodepolis);
                        setText("kodex_soc",data.msoc_kode);
                        jsonForm('cetakLihatSoc', data);
                    }
                }
            });
	    }
    </script>
@endsection
