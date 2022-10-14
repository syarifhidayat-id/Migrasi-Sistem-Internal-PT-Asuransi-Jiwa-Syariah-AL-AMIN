@extends('layouts.main-admin')

@section('title')
    Wewenang Jabatan
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>List Wewenang Jabatan</h3>
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
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <i class="fa-sharp fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" data-kt-datatable-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari wewenang jabatan" />
            </div>
        </div>

        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="fa-sharp fa-solid fa-filter"></i> Filter
                </button>

                {{-- <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"> --}}
                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-500px" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <div class="separator border-gray-200"></div>

                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">Jabatan:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih menu" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false">
                                <option></option>
                                @foreach ($form_jab as $key=>$data)
                                    <option value="{{ $data->sjab_kode }}">{{ $data->sjab_kode }} - {{ $data->sjab_ket }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">Jenis Menu:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih jenis menu" data-allow-clear="true" data-kt-datatable-table-filter="jenis-menu" data-hide-search="false">
                                <option></option>
                                @foreach ($jns_menu as $key=>$data)
                                    <option value="{{ $data->wmt_kode }}">{{ $data->wmt_nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-10">
                            <label class="form-label fs-6 fw-bold">Main Menu:</label>
                            <input type="text" class="form-control form-control-solid" placeholder="Pilih jenis menu" data-kt-datatable-table-filter="main-menu" />
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="reset" class="btn btn-light btn-active-light-primary fw-bold me-2 px-6" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="reset">Reset</button>
                            <button type="submit" class="btn btn-primary fw-bold px-6" data-kt-menu-dismiss="true" data-kt-datatable-table-filter="filter">Apply</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                <div id="kt_table_datatable_export" class="d-none"></div>

                <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Export</button>

                <div id="kt_table_datatable_export_menu" title-kt-export="Data Menu" class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4" data-kt-menu="true">
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

                <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-sharp fa-solid fa-plus"></i> Tambah Wewenang</button>
            </div>

            @include('pages.utility.wewenang-jabatan.modal.create')
        </div>
    </div>

    <div class="card-body py-10">
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_datatable">
            <thead>
                <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                    <th>No.</th>
                    <th>Kode</th>
                    <th>Nama Menu</th>
                    <th>Tipe</th>
                    <th>Jabatan</th>
                    <th>Aktif</th>
                    {{-- <th class="text-end min-w-100px">Aksi</th> --}}
                </tr>
            </thead>
            <tbody id="dataShow" class="text-gray-600 fw-bold">
                @foreach ($list as $key=>$data)
                    <tr>
                        <td>{{ ++$key }}.</td>
                        <td>{{ $data->wmj_wmn_kode }}</td>
                        <td>{{ $data->wmn_descp }}</td>
                        <td>
                            <div class="badge badge-light-success fw-bolder">{{ $data->wmn_tipe }}</div>
                        </td>
                        <td>
                            <div class="badge badge-light fw-bolder">{{ $data->wmj_sjab_kode }}</div>
                        </td>
                        <td class="text-end">
                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                <input class="form-check-input" id="check_menu" type="checkbox" value="{{ $data->wmj_aktif }}" @if ($data->wmj_aktif == 1) checked="checked" @endif />
                                <span class="form-check-label fw-bold text-muted">
                                    Aktif
                                </span>
                            </label>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    {{-- <div class="card-footer">
        <div align="center">
            <button type="button" class="btn btn-primary btn-sm"><i class="fa-sharp fa-solid fa-floppy-disk"></i> Simpan</button>&nbsp;
            <button type="button" class="btn btn-danger btn-sm"><i class="fa-sharp fa-solid fa-trash"></i> Hapus</button>
        </div>
    </div> --}}
</div>
@endsection

@section('script')
    <script>
        $('#wmj_wmn_kode').select2();
        $('#wmj_sjab_kode').select2();
        $('#wmj_aktif').select2();

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('body').on('click', '#omodTam', function() {
                $('#modalWewenang').modal('show');
                $('#tModWewenang').text('Tambah Wewenang');
                // resetMod();
                bsimpan('btn_simpan', 'Simpan');
                $('#btn_reset').show();
            });

            $('#btn_simpan').click(function(e) {
                e.preventDefault();
                var dataFrx = $('#frxx').serialize();
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('utility.wewenang-jabatan.store') }}",
                    type: "POST",
                    data: dataFrx,
                    dataType: 'json',
                    success: function (res) {
                        if ($.isEmptyObject(res.error)){
                            console.log(res);
                            Swal.fire(
                                'Berhasil!',
                                res.success,
                                'success'
                            ).then((res) => {
                                reset();
                                resetMod();
                                $('#modalWewenang').modal('hide');
                                bsimpan('btn_simpan', 'Simpan');
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

            $('#btn_reset').click(function() {
                resetMod();
            });

            $('#btn_close').click(function() {
                reset();
            });

            $('#btn_close2').click(function() {
                reset();
            });
        });

        function resetMod() {
            $('#frxx').trigger('reset');
            $('#wmj_wmn_kode').val(null).trigger('change');
            $('#wmj_sjab_kode').val(null).trigger('change');
            $('#wmj_aktif').val(null).trigger('change');
        }
    </script>
@endsection
