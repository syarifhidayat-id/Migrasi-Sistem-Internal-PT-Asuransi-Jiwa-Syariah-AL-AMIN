@extends('layouts.main-admin')

@section('title')
    Polis
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>Lihat Polis</h3>
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
                <input type="text" data-kt-datatable-table-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="Cari polis" />
            </div>
        </div>

        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="fa-sharp fa-solid fa-filter"></i> Filter
                </button>

                <div class="menu menu-sub menu-sub-dropdown col-xl-6" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                    </div>
                    <div class="separator border-gray-200"></div>

                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            {{-- <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Cabang AL AMIN:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih Cabang" data-allow-clear="true" data-kt-datatable-table-filter="nama-menu" data-hide-search="false">
                                <option></option>
                                @foreach ($carilokasi as $key=>$data)
                                    <option value="{{ $data->mlok_nama }}">{{ $data->mlok_nama }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div> --}}

                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Jaminan:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih jaminan" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                <option></option>
                                @foreach ($carijaminan as $key=>$data)
                                    <option value="{{ $data->mjm_nama }}">{{ $data->mjm_nama }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Nasabah:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih nasabah" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                <option></option>
                                @foreach ($carinasabah as $key=>$data)
                                    <option value="{{ $data->mjns_keterangan }}">{{ $data->mjns_keterangan }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Pemegang Polis:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih pemegang polis" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                <option></option>
                                @foreach ($carirekanan as $key=>$data)
                                    <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Program Asuransi:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih program" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                <option></option>
                                @foreach ($cariprogram as $key=>$data)
                                    <option value="{{ $data->mpras_nama }}">{{ $data->mpras_nama }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Nomor Polis:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih nomor polis" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                <option></option>
                                @foreach ($caripolis as $key=>$data)
                                    <option value="{{ $data->mpol_kode }}">{{ $data->mpol_kode }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>

                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Nomor SOC:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih nomor soc" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                <option></option>
                                @foreach ($carisoc as $key=>$data)
                                    <option value="{{ $data->mpol_msoc_kode }}">{{ $data->mpol_msoc_kode }}</option>
                                @endforeach
                            </select>
                                </div>
                            </div>


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
{{--
                <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i class="fa-sharp fa-solid fa-plus"></i> Tambah Menu</button> --}}
            </div>

            {{-- @include('pages.utility.membuat-menu.modal.create') --}}
        </div>
    </div>

    <div class="card-body py-10">
        <div class="table-responsive">
            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="kt_table_datatable">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle" >
                        <th >No.</th>
                        <th>Cabang</th>
                        <th hidden="true">PK</th>
                        <th>Pemegang Polis</th>
                        <th>Nasabah Bank/Peserta</th>
                        <th>Segmen Pasar</th>
                        <th>Mekanisme 1</th>
                        <th>Mekanisme 2</th>
                        <th>Pekerjaan</th>
                        <th>Manfaat</th>
                        <th>Pembayaran</th>
                        <th>Jaminan</th>
                        <th>Program Asuransi</th>
                        <th>Produk Induk</th>
                        <th>Produk Induk OJK</th>
                        <th>Kode Polis</th>
                        <th>Kode SOC</th>


                    </tr>
                </thead>
                <tbody>
                    @foreach ($listpolis as $key=>$data)
                        <tr>
                            <td class="text-center">{{ ++$key }}.</td>

                            <td>{{ $data->mlok_nama }}</td>
                            <td hidden="true">{{ $data->mpol_kode }}</td>
                            <td>{{ $data->mpol_mrkn_nama }}</td>
                            <td>{{ $data->mjns_keterangan }}</td>
                            <td>{{ $data->mssp_nama }}</td>
                            <td>{{ $data->mkm_nama }}</td>
                            <td>{{ $data->mkm_ket2 }}</td>
                            <td>{{ $data->mker_nama }}</td>
                            <td>{{ $data->mft_nama }}</td>
                            <td>{{ $data->Bayar }}</td>
                            <td>{{ $data->mjm_nama }}</td>
                            <td>{{ $data->mpras_nama }}</td>
                            <td>{{ $data->mpid_nama }}</td>
                            <td>{{ $data->mpojk_nama }}</td>
                            <td> <button type="button" id="kt_drawer_chat_toggle" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ $data->mpol_kode }}</button></td>
                            <td>{{ $data->mpol_msoc_kode }}</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="kt_drawer_chat" class="bg-body" data-kt-drawer="true" data-kt-drawer-name="chat" data-kt-drawer-activate="true" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_drawer_chat_toggle" data-kt-drawer-close="#kt_drawer_chat_close">
        <div class="card w-100 rounded-0 border-0" id="kt_drawer_chat_messenger">
            <div class="card-header pe-5" id="kt_drawer_chat_messenger_header">
                <div class="card-title">
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#" class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-2 lh-1">Polis</a>
                        <div class="mb-0 lh-1">
                            <span class="badge badge-success badge-circle w-10px h-10px me-1"></span>
                            <span class="fs-7 fw-bold text-muted">Kode Polis : </span>
                        </div>
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="kt_drawer_chat_close">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body" id="kt_drawer_chat_messenger_body">
                <div class="scroll-y me-n5 pe-5" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_drawer_chat_messenger_header, #kt_drawer_chat_messenger_footer" data-kt-scroll-wrappers="#kt_drawer_chat_messenger_body" data-kt-scroll-offset="0px">

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Nama Pemegang Polis</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Kode Soc</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Nomor SPAJ</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Nasabah Bank/Peserta</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Segmen pasar</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Manfaat Asuransi</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Jaminan Asuransi</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Jenis Pekerjaan</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Jenis Produk</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Program Asuransi</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Saluran Distribusi</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Cabang AL AMIN</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Marketing</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Pimpinan Cabang</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-start mb-10">
                        <div class="d-flex flex-column align-items-start">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Status Aktif Polis</a>
                                </div>
                            </div>
                            <div class="p-5 rounded   text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>

                        <div class="d-flex flex-column align-items-start px-5">
                            <div class="d-flex align-items-center mb-2">
                                <div class="ms-3">
                                    <a href="#" class="fs-5 fw-bolder text-gray-900 text-hover-primary me-1">Status Online Polis</a>
                                </div>
                            </div>
                            <div class="p-5 rounded text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text" style="background-color: rgba(255, 166, 0, 0.699)">Company BBQ to celebrate the last quater</div>
                        </div>
                    </div>




                </div>

            </div>

            {{-- <div class="card-footer pt-4" id="kt_drawer_chat_messenger_footer">
                <textarea class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
                <div class="d-flex flex-stack justify-content-end">
                    <button class="btn btn-primary" type="button" data-kt-element="send">Send</button>
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('#wmn_tipe').select2();
        $('#wmn_key').select2({
            tags: true,
        });
        $('#wmn_mrkn_kode').select2();
        $('#wmn_mpol_kode').select2();

        function menuMain() {
            $('#wmn_tipe').change(function() {
                // e.preventDefault();
                var tipe = $(this).val(),
                    url = "{{ url('api/utility/menu/getTipe') }}" + "/" + tipe;
                if (tipe !== "") {
                    $.get(url, function(res) {
                        $('#wmn_key').empty();
                        // $('#wmn_key').val(null).trigger('change');
                        $('#wmn_key').append('<option></option>');
                        $.each(res, function(key, val) {
                            $('#wmn_key').append('<option value="'+ val.wmn_kode +'">'+ val.wmn_descp +'</option>');
                        });
                    });
                } else {
                    $('#wmn_key').empty();
                    // $('#wmn_key').val(null).trigger('change');
                    $('#wmn_key').append('<option></option>');
                }
            });
        }

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $('body').on('click', '#omodTam', function() {
                $('#modalMenu').modal('show');
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
                    $('#modalMenu').modal('show');
                    $('#wmn_kode').val(res.wmn_kode);
                    $('#wmn_tipe').val(res.wmn_tipe).trigger('change');
                    $.get(key, function(data) {
                        $('#wmn_key').val(data.wmn_kode).trigger('change');
                    });
                    $('#wmn_descp').val(res.wmn_descp);
                    $('#wmn_icon').val(res.wmn_icon);
                    $('#wmn_url').val(res.wmn_url);
                    $('#wmn_urlkode').val(res.wmn_urlkode);
                    $('#wmn_info').val(res.wmn_info);
                    $('#wmn_url_o').val(res.wmn_url_o);
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
                    // cache: false,
                    // contentType: false,
                    // processData: false,
                    dataType: 'json',
                    success: function (res) {
                        // window.location.reload();
                        if ($.isEmptyObject(res.error)){
                            console.log(res);
                            Swal.fire(
                                'Berhasil!',
                                res.success,
                                'success'
                            ).then((res) => {
                                reset();
                                $('#frxx').trigger("reset");
                                $('#modalMenu').modal('hide');
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

            $('body').on('click', '#omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ route('utility.menu.store') }}" + "/" + kode;

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
            $('#wmn_tipe').val(null).trigger('change');
            $('#wmn_key').val(null).trigger('change');
            // $('#wmn_key').empty();
            // $('#wmn_key').append('<option></option>');
            $('#wmn_mrkn_kode').val(null).trigger('change');
            $('#wmn_mpol_kode').val(null).trigger('change');
        }
    </script>
@endsection
