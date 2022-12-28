@extends('layouts.main-admin')

@section('title')
    APPROVAL KOMISI & OVERRIDING
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>LIST KOMISI & OVERRIDING</h3>
        </div>

        <div class="card-toolbar">
            {{-- <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                <input class="form-check-input" type="checkbox" checked="checked" value="1" />
                <span class="form-check-label text-muted">Test mode</span>
            </label>

            <button type="button" class="btn btn-sm btn-light">
                Action
            </button> --}}
            <div class="card-title">
                <!--   <div class="d-flex align-items-center position-relative my-1">
                      <div class="input-group input-group-solid flex-nowrap">
                          <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control form-control-solid w-250px" placeholder="Cari Soc" />
                          <button type="submit" class="btn btn-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                      </div>
                  </div>-->
              </div>

              <div class="card-toolbar">
                  <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                      <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                          <i class="fa-sharp fa-solid fa-filter"></i> Filter Pencarian
                      </button>

                      <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                          <div class="px-7 py-5">
                              <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                          </div>
                          <div class="separator border-gray-200"></div>

                          <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                              <div class="row">
                                  <div class="col-md-12">
                                      <div class="mb-10">
                                          <label class="form-label fs-6 fw-bold">Cabang Al Amin:</label>
                                          <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih Cabang" data-allow-clear="true" data-kt-datatable-table-filter="cabang" data-hide-search="false" id="cabang" name="cabang">
                                              <option></option>
                                               @foreach ($cabang as $key=>$data)
                                                  <option value="{{ $data->mlok_nama }}">{{ $data->mlok_nama }}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="mb-10">
                                          <label class="form-label fs-6 fw-bold">Periode Input Komisi:</label>
                                          <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih bulan" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="inputbulan1">
                                              <option></option>
                                              {{-- @foreach ($nama_menu as $key=>$data)
                                                  <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                              @endforeach --}}
                                              <option value="01" selected>Januari</option>
                                              <option value="02">Februari</option>
                                              <option value="03">Maret</option>
                                              <option value="04">April</option>
                                              <option value="05">Mei</option>
                                              <option value="06">Juni</option>
                                              <option value="07">Juli</option>
                                              <option value="08">Agustus</option>
                                              <option value="09">September</option>
                                              <option value="10">Oktober</option>
                                              <option value="11">November</option>
                                              <option value="12">Desember</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="mb-10">
                                          <label class="form-label fs-6 fw-bold">s/d</label>
                                          <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih bulan" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="inputbulan2">
                                              <option></option>
                                              {{-- @foreach ($nama_menu as $key=>$data)
                                                  <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                              @endforeach --}}
                                              <option value="01" selected>Januari</option>
                                              <option value="02">Februari</option>
                                              <option value="03">Maret</option>
                                              <option value="04">April</option>
                                              <option value="05">Mei</option>
                                              <option value="06">Juni</option>
                                              <option value="07">Juli</option>
                                              <option value="08">Agustus</option>
                                              <option value="09">September</option>
                                              <option value="10">Oktober</option>
                                              <option value="11">November</option>
                                              <option value="12">Desember</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="mb-10">
                                          <label class="form-label fs-6 fw-bold">Tahun</label>
                                          <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih tahun" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="inputtahun">
                                              <option></option>
                                              {{-- @foreach ($nama_menu as $key=>$data)
                                                  <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                              @endforeach --}}
                                              <option value="2007">2007</option>
                                              <option value="2008">2008</option>
                                              <option value="2009">2009</option>
                                              <option value="2010">2010</option>
                                              <option value="2011">2011</option>
                                              <option value="2012">2012</option>
                                              <option value="2013">2013</option>
                                              <option value="2014">2014</option>
                                              <option value="2015">2015</option>
                                              <option value="2016">2016</option>
                                              <option value="2017">2017</option>
                                              <option value="2018">2018</option>
                                              <option value="2019">2019</option>
                                              <option value="2020">2020</option>
                                              <option value="2021">2021</option>
                                              <option value="2022" selected>2022</option>
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-4">
                                      <div class="mb-10">
                                          <label class="form-label fs-6 fw-bold">Periode Proses Inkaso:</label>
                                          <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih bulan" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="inkasobulan1">
                                              <option></option>
                                              {{-- @foreach ($nama_menu as $key=>$data)
                                                  <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                              @endforeach --}}
                                              <option value="01" selected>Januari</option>
                                              <option value="02">Februari</option>
                                              <option value="03">Maret</option>
                                              <option value="04">April</option>
                                              <option value="05">Mei</option>
                                              <option value="06">Juni</option>
                                              <option value="07">Juli</option>
                                              <option value="08">Agustus</option>
                                              <option value="09">September</option>
                                              <option value="10">Oktober</option>
                                              <option value="11">November</option>
                                              <option value="12">Desember</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="mb-10">
                                          <label class="form-label fs-6 fw-bold">s/d</label>
                                          <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih bulan" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="inkasobulan2">
                                              <option></option>
                                              {{-- @foreach ($nama_menu as $key=>$data)
                                                  <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                              @endforeach --}}
                                              <option value="01" selected>Januari</option>
                                              <option value="02">Februari</option>
                                              <option value="03">Maret</option>
                                              <option value="04">April</option>
                                              <option value="05">Mei</option>
                                              <option value="06">Juni</option>
                                              <option value="07">Juli</option>
                                              <option value="08">Agustus</option>
                                              <option value="09">September</option>
                                              <option value="10">Oktober</option>
                                              <option value="11">November</option>
                                              <option value="12">Desember</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-md-4">
                                      <div class="mb-10">
                                          <label class="form-label fs-6 fw-bold">Tahun</label>
                                          <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih tahun" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false" id="inkasotahun">
                                              <option></option>
                                              {{-- @foreach ($nama_menu as $key=>$data)
                                                  <option value="{{ $data->wmn_descp }}">{{ $data->wmn_descp }}</option>
                                              @endforeach --}}
                                              <option value="2007">2007</option>
                                              <option value="2008">2008</option>
                                              <option value="2009">2009</option>
                                              <option value="2010">2010</option>
                                              <option value="2011">2011</option>
                                              <option value="2012">2012</option>
                                              <option value="2013">2013</option>
                                              <option value="2014">2014</option>
                                              <option value="2015">2015</option>
                                              <option value="2016">2016</option>
                                              <option value="2017">2017</option>
                                              <option value="2018">2018</option>
                                              <option value="2019">2019</option>
                                              <option value="2020">2020</option>
                                              <option value="2021">2021</option>
                                              <option value="2022" selected>2022</option>
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
    </div>

    <div class="card-body py-12">
        <div class="table-responsive">
            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="datalistKomisi">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                        <th>No.</th>
                        <th class="min-w-250px">Pemegang Polis</th>
                        <th>ID</th>
                        <th>Kode Polis</th>
                        <th>Peserta</th>
                        <th>Uang Pertanggungan</th>
                        <th>Kotribusi Tagih</th>
                        <th>Komisi Bruto</th>
                        <th>Tax Komisi</th>
                        <th>Komisi Netto</th>
                        <th>Overriding Bruto</th>
                        <th>Tax Overriding</th>
                        <th>Overriding Netto</th>
                        <th class="min-w-100px">Approval</th>
                        <th>Keterangan</th>
                        <th>Cab. Alamin</th>
                        <th>Approv Kabag</th>
                        <th>Approv Kadiv</th>
                        <th>Approv Direktur</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    @include('pages.keuangan.komisi.modal.approv')
</div>
@endsection

@section('script')
    <script>
         $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            serverSide(
                "datalistKomisi",
                "{{ url('api/keuangan/komisi-overriding/approval-komisi-overriding/list-komisi') }}",
                function(d) {    // di isi sesuai dengan data yang akan di filter ->
                    d.cabang = getText('cabang'),
                    d.bulan1 = $('#inputbulan1').val(),
                    d.bulan2 = $('#inputbulan2').val(),
                    d.tahun = $('#inputtahun').val(),
                    d.inkasobulan1 = $('#inkasobulan1').val(),
                    d.inkasobulan2 = $('#inkasobulan2').val(),
                    d.inkasotahun = $('#inkasotahun').val()
                },
                [
                    { data: "DT_RowIndex", className: "text-center" },
                    { data: "nama" },
                    { data: "id" },
                    { data: "kdpolis"  },
                    { data: "tpst" },
                    { data: "tup" },
                    { data: "ttagih" },
                    { data: "tkomisi" },
                    { data: "ttax" },
                    { data: "tkomisinetto" },
                    { data: "toverreding" },
                    { data: "ttax_overr" },
                    { data: "toverreding_netto" },
                    {
                        data: "id",
                        render: function(data, type, row, meta) {
                            var polis = row.kdpolis;
                            return `<button type="button" id="kode" title="Lihat Detail" kdpolis="`+polis+`" data-kode="`+row.id+`" class="btn btn-sm btn-light-danger"><i class="fa-solid fa-eye"></i> Approval</button>`;
                        }
                    },
                    { data: "ket" },
                    { data: "cabang" },
                    { data: "tkomh_sts1_user" },
                    { data: "tkomh_sts2_user" },
                    { data: "tkomh_sts3_user" },
                ],

            );

            tombol('click', 'kode', function() {
                var kode = $(this).attr('data-kode'),
                    url = "{{ route('keuangan.komisi-overriding.approval-komisi-overriding.index') }}" + "/" + kode + "/edit";
                $.get(url, function(data) {
                    openModal('modalAppKomOver');
                    titleAction('titleMod', 'Approval Tax Komisi & Overriding');
                    jsonForm('formAppKom', data);
                    setText('kdpolis_x', $(this).attr('kdpolis'));
                });


                // setText('tkomh_pk', $(this).attr('data-kode'));
                // setText('kdpolis_x', $(this).attr('kdpolis'));
                // setText('x_giro','');
                // setText('tkomh_penerima','');
                // setText('tkomh_penerima_o','');
                // setText('x_status','');
            });

             // $('#frxx').submit(function(e) {
            submitForm(
                "formAppKom",
                "btn_simpan",
                "POST",
                "{{ route('keuangan.komisi-overriding.approval-komisi-overriding.store') }}",
                (resSuccess) => {
                    lodTable('datalistKomisi');
                    closeModal('modalAppKomOver');
                    bsimpan("btn_simpan", 'Simpan');
                },
                (resError) => {
                    console.log(resError);
                },
            );

        });
/*
        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            filterAll('input[type="search"]', 'datalistSoc');
            serverSide(
                "datalistSoc",
                "{{ url('api/keuangan/komisi-overriding/approval-komisi-overriding/list-komisi') }}",
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

            $('#btn_reset').click(function() {
                resetMod();
            });

            $('#btn_close').click(function() {
                closeModal('#modalMenu');
            });

            $('#btn_close2').click(function() {
                closeModal('#modalMenu');
            });
        });

        function resetMod() {
            $('#frxx').trigger('reset');
            $('#wmn_tipe').val(null).trigger('change');
            $('#wmn_key').val(null).trigger('change');
            // $('#wmn_key').empty();
            // $('#wmn_key').append('<option></option>');
            $('#wmn_mrkn_kode').val(null).trigger('change');
            $('#wmn_mpol_kode').val(null).trigger('change');
        }*/
    </script>
@endsection
