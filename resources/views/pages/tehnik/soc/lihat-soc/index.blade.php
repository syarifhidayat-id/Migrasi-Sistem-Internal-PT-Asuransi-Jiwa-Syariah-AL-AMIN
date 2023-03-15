@extends('layouts.main-admin')

@section('title')
    Lihat Soc Khusus
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Lihat Soc Khusus</h3>
        </div>
    </div>

    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">
                <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                    <i class="fa-sharp fa-solid fa-filter"></i> Filter Pencarian
                </button>

                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                    </div>
                    <div class="separator border-gray-200"></div>

                    <div class="scroll h-400px px-5">
                        <div data-kt-datatable-table-filter="form">
                            <div class="px-7 py-5">
                                <div class="row">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Berdasarkan Keyboard</label>
                                                <input type="search" data-kt-datatable-table-filter="search" name="seacrh" id="seacrh" class="form-control form-control-solid" placeholder="Cari All" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-10">
                                                <label class="form-label fs-6 fw-bold">Baris yang Tampil</label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_baris" name="e_baris" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_baris" data-placeholder="Pilih jumlah" data-allow-clear="true" data-hide-search="false">
                                                    <option value="20">20</option>
                                                    <option value="50">50</option>
                                                    <option selected value="100">100</option>
                                                    <option value="150">150</option>
                                                    <option value="200">200</option>
                                                    <option value="300">300</option>
                                                    <option value="400">400</option>
                                                    <option value="500">500</option>
                                                    <option value="600">600</option>
                                                    <option value="700">700</option>
                                                    <option value="800">800</option>
                                                    <option value="900">900</option>
                                                    <option value="1000">1000</option>
                                                    <option value="1500">1500</option>
                                                    <option value="2000">2000</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Kode Soc</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_kdsoc" name="c_kdsoc" type="checkbox" data-checkbox="c_kdsoc" />
                                                </label>
                                                <input type="text" id="e_kdsoc" name="e_kdsoc" data-kt-datatable-table-filter="e_kdsoc" class="form-control form-control-solid" placeholder="Kode soc" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Jaminan Asuransi</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_jaminan" name="c_jaminan" type="checkbox" data-checkbox="c_jaminan" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_jaminan" name="e_jaminan" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_jaminan" data-placeholder="Pilih jenis nasabah" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    {{ optSql("SELECT mjm_kode kode,mjm_nama nama FROM emst.mst_jaminan ORDER BY 1", "kode", "nama") }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Jenis Nasabah</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_jnas" name="c_jnas" type="checkbox" data-checkbox="c_jnas" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_jnas" name="e_jnas" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_jnas" data-placeholder="Pilih jenis nasabah" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                    {{ optSql("SELECT mjns_kode kode,mjns_keterangan nama FROM emst.mst_jenis_nasabah ORDER BY 1", "kode", "nama") }}
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-5">
                                            <label class="form-label fs-6 fw-bold">Pemegang Polis</label>
                                            <div class="d-flex flex-stack">
                                                <label class="form-check form-switch form-check-custom form-check-solid me-5">
                                                    <input class="form-check-input" id="c_pmgpolis" name="c_pmgpolis" type="checkbox" data-checkbox="c_pmgpolis" />
                                                </label>
                                                <select class="form-select form-select-solid fw-bolder" id="e_pmgpolis" name="e_pmgpolis" data-control="select2" data-kt-select2="true" data-kt-datatable-table-filter="e_pmgpolis" data-placeholder="Pilih pemegang polis" data-allow-clear="true" data-hide-search="false">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="separator border-gray-200"></div>
                            <div class="px-7 py-5">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary fw-bold btn-sm me-2" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter" if><i class="fa-sharp fa-solid fa-eye"></i> Tampilkan</button>
                                    <button type="reset" class="btn btn-danger btn-active-light-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i class="fa-solid fa-repeat"></i> Reset</button>
                                </div>
                            </div>
                        </div>
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
                        <th class="min-w-400px">Kode SOC</th>
                        <th class="min-w-450px">Nama Pemegang Polis</th>
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
            serverTable(
                "datalistSoc",
                "{{ url('tehnik/soc/lihat-soc-khusus/grd_lihat_soc_khu') }}",
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.e_baris = getText('e_baris'),
                    d.c_kdsoc = getText('c_kdsoc'),
                    d.e_kdsoc = getText('e_kdsoc'),
                    d.c_jaminan = getText('c_jaminan'),
                    d.e_jaminan = getText('e_jaminan'),
                    d.c_jnas = getText('c_jnas'),
                    d.e_jnas = getText('e_jnas'),
                    d.c_pmgpolis = getText('c_pmgpolis'),
                    d.e_pmgpolis = getText('e_pmgpolis'),
                    d.search = $('input[type="search"]').val()
                },
                [
                    {
                        data: "DT_RowIndex",
                        className: "text-center",
                        render: function(data, type, row, meta) {
                            return row.DT_RowIndex+`.`;
                        }
                    },
                    {
                        data: "msli_nomor",
                        className: "dt-body-center",
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-light-primary btn-sm" onclick="socKhusus('${row.msli_nomor}', 0)">${row.msli_nomor}</button>`;
                        }
                    },
                    {
                        data: "msoc_kode",
                        className: "dt-body-center",
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-light-primary btn-sm" onclick="editSoc('${row.msoc_kode}', 0)">${row.msoc_kode}</button> | <button type="button" class="btn btn-light-primary btn-sm" onclick="showUW('${row.msoc_mpuw_nomor}')"><i class="fa-solid fa-eye"></i> Uw Table</button>`;
                        }
                    },
                    { data: "msli_mrkn_nama" },
                    { data: "mjns_nama" },
                    { data: "mssp_nama" },
                    { data: "mkm_nama" },
                    { data: "mkm_ket2" },
                    { data: "mker_nama" },
                    { data: "mft_nama", className: "text-center" },
                    { data: "bayar" },
                    { data: "mjm_nama" },
                    { data: "mpras_nama" },
                    {
                        data: null,
                        className: "dt-body-center",
                        render: function(data, type, row, meta) {
                            return `<button type="button" class="btn btn-light-primary btn-sm" onclick="cetakSoc('${row.msli_nomor}', 0)">Pilih</button>`;
                        }
                    },
                    { data: "msoc_ins_date", className: "text-center" },
                    { data: "umur", className: "text-center" },
                    { data: "msoc_ins_user" },
                    {
                        data: "msoc_approve",
                        className: "text-center",
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
                        className: "text-center",
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
                        className: "text-center",
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
                        className: "text-center",
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
                            getPost("{{ url('api/tehnik/soc/lihat-soc-khusus/update-status-approval') }}" + "/" + kode + "/" + val, '', function(data) {
                                // console.log(data);
                                message(
                                    'success',
                                    'Data berhasil di approve dengan kode ' + kode + ' !',
                                );
                                setCheck(this, true);
                                lodTable('datalistSoc');
                            });
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
