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
                <div class="card-title">
                    <!--   <div class="d-flex align-items-center position-relative my-1">
                          <div class="input-group input-group-solid flex-nowrap">
                              <input type="search" data-kt-datatable-table-filter="search" id="seacrh" class="form-control form-control-solid w-250px" placeholder="Cari Soc" />
                              <button type="submit" class="btn btn-primary fw-bold btn-sm" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                          </div>
                      </div>-->
                </div>

                <div class="card-toolbar">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">

                                <button type="button" class="btn btn-light-primary me-3 btn-sm"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start">
                                    <i class="fa-sharp fa-solid fa-filter"></i> Filter Pencarian
                                </button>

                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>

                                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                                        {{-- Start Row --}} <div class="row">
                                            <input type="hidden" data-kt-datatable-table-filter="search" id="search"
                                                class="form-control form-control-solid" placeholder="Search" />

                                            <div class="col-md-12">
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bold">Tahun</label>
                                                    <div class="d-flex flex-stack">
                                                        <select class="form-select form-select-solid fw-bolder"
                                                            data-kt-select2="true" data-placeholder="Pilih tahun"
                                                            data-allow-clear="true" data-hide-search="false" id="tahun"
                                                            name="tahun">
                                                            <option></option>
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

                                            <div class="col-md-12">
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bold">Bulan</label>
                                                    <div class="d-flex flex-stack">
                                                        <select class="form-select form-select-solid fw-bolder"
                                                            data-kt-select2="true" data-placeholder="Pilih bulan"
                                                            data-allow-clear="true" data-hide-search="false" id="bulan1"
                                                            name="bulan1">
                                                            <option></option>
                                                            <option value="1" selected>Januari</option>
                                                            <option value="2">Februari</option>
                                                            <option value="3">Maret</option>
                                                            <option value="4">April</option>
                                                            <option value="5">Mei</option>
                                                            <option value="6">Juni</option>
                                                            <option value="7">Juli</option>
                                                            <option value="8">Agustus</option>
                                                            <option value="9">September</option>
                                                            <option value="10">Oktober</option>
                                                            <option value="11">November</option>
                                                            <option value="12">Desember</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mb-5">
                                                    <label class="form-label fs-6 fw-bold">Bulan</label>
                                                    <div class="d-flex flex-stack">
                                                        <select class="form-select form-select-solid fw-bolder"
                                                            data-kt-select2="true" data-placeholder="Pilih bulan"
                                                            data-allow-clear="true" data-hide-search="false" id="bulan2"
                                                            name="bulan2">
                                                            <option></option>
                                                            <option value="1">Januari</option>
                                                            <option value="2" selected>Februari</option>
                                                            <option value="3">Maret</option>
                                                            <option value="4">April</option>
                                                            <option value="5">Mei</option>
                                                            <option value="6">Juni</option>
                                                            <option value="7">Juli</option>
                                                            <option value="8">Agustus</option>
                                                            <option value="9">September</option>
                                                            <option value="10">Oktober</option>
                                                            <option value="11">November</option>
                                                            <option value="12">Desember</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary fw-bold btn-sm me-2"
                                                data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter"><i
                                                    class="fa-sharp fa-solid fa-magnifying-glass"></i> Cari</button>
                                            <button type="reset"
                                                class="btn btn-danger btn-active-light-primary fw-bold btn-sm"
                                                data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset"><i
                                                    class="fa-solid fa-repeat"></i> Reset</button>
                                        </div>
                                    </div>

                                </div>
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
                            <th class="min-w-250px">ID</th>
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
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            serverSide(
                "datalistKomisi",
                "{{ url('api/keuangan/komisi-overriding/approval-komisi-overriding/list-komisi') }}",
                function(d) { // di isi sesuai dengan data yang akan di filter ->
                    // d.check_1 = getText('check_1');
                    // d.check_2 = getText('check_2');
                    // d.check_3 = getText('check_3');
                    //d.cabang = getText('cabang');
                    d.bulan1 = getText('bulan1');
                    d.bulan2 = getText('bulan2');
                    d.tahun = getText('tahun');
                    //d.inkasobulan1 = getText('inkasobulan1');
                    //d.inkasobulan2 = getText('inkasobulan2');
                    //d.inkasotahun = getText('inkasotahun');
                },
                [{
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: "nama",
                        render: function(data, type, row, meta) {
                            var id = row.id;
                            var polis = row.kdpolis;
                            return `<a href="{{ url('keuangan/komisi-overriding/export/`+id+`/`+polis+`') }}">` +
                                row.nama + `</a>`;
                        }
                    },
                    {
                        data: "id",
                        render: function(data, type, row, meta) {
                            return `` + row.id +
                                ` <i class="fa-solid fa-trash" style="color:red" id="kodehapus" title="Hapus PK" data-kode="` +
                                row.id + `"></i>`;
                        }
                    },
                    {
                        data: "kdpolis"
                    },
                    {
                        data: "tpst"
                    },
                    {
                        data: "tup"
                    },
                    {
                        data: "ttagih"
                    },
                    {
                        data: "tkomisi"
                    },
                    {
                        data: "ttax"
                    },
                    {
                        data: "tkomisinetto"
                    },
                    {
                        data: "toverreding"
                    },
                    {
                        data: "ttax_overr"
                    },
                    {
                        data: "toverreding_netto"
                    },
                    {
                        data: "id",
                        render: function(data, type, row, meta) {
                            var polis = row.kdpolis;
                            return `<button type="button" id="kode" title="Lihat Detail" kdpolis="` +
                                polis + `" data-kode="` + row.id +
                                `" class="btn btn-sm btn-light-success"><i class="fa-solid fa-eye"></i> Approval</button>`;
                        }
                    },
                    {
                        data: "ket"
                    },
                    {
                        data: "cabang"
                    },
                    {
                        data: "tkomh_sts1_user"
                    },
                    {
                        data: "tkomh_sts2_user"
                    },
                    {
                        data: "tkomh_sts3_user"
                    },
                ],

            );

            tombol('click', 'kode', function() {
                var kode = $(this).attr('data-kode'),
                    url = "{{ route('keuangan.komisi-overriding.approval-komisi-overriding.index') }}" +
                    "/" + kode + "/edit";
                $.get(url, function(data) {
                    openModal('modalAppKomOver');
                    titleAction('titleMod', 'Approval Tax Komisi & Overriding');
                    jsonForm('formAppKom', data);
                });
                setText('kdpolis_x', $(this).attr('kdpolis'));

            });

            tombol('click', 'kodehapus', function() {
                var kode = $(this).attr('data-kode');
                //alert(kode);
                url = "{{ route('keuangan.komisi-overriding.approval-komisi-overriding.store') }}" + "/" +
                    kode;
                submitDelete(kode, url, function(resSuccess) {
                    lodTable("datalistKomisi");
                    console.log(resSuccess);
                }, function(resError) {
                    console.log(resError);
                });
            });

            submitForm("formAppKom", "btn_simpan", "POST",
                "{{ route('keuangan.komisi-overriding.approval-komisi-overriding.store') }}", (resSuccess) => {
                    clearForm("formAppKom");
                    bsimpan('btn_simpan', 'Simpan');
                    lodTable("datalistKomisi");
                    closeModal('modalAppKomOver');
                });

        });
    </script>
@endsection
