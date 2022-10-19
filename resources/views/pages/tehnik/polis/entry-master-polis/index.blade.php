@extends('layouts.main-admin')

@section('title')
    Entry Master Polis
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">

        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">

                <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <i class="fa-sharp fa-solid fa-filter"></i> New
                </button>

                <div class="menu menu-sub menu-sub-dropdown col-xl-6" data-kt-menu="true">
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Pencarian</div>
                    </div>
                    <div class="separator border-gray-200"></div>

                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
                            <div class="col">
                                <div class="fv-row mb-7">
                                    <label class="form-label fs-6 fw-bold">Jaminan:</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih jaminan" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                                <option></option>
                                {{-- @foreach ($carijaminan as $key=>$data)
                                    <option value="{{ $data->mjm_nama }}">{{ $data->mjm_nama }}</option>
                                @endforeach --}}
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

                <button type="button" id="btn_export" data-title="Data Menu" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i> Edit</button>

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

            </div>


        </div>
        {{-- <marquee behavior="" direction="">Untuk mendaftarkan Polis Produk yang telah di approval/final SOC. Pastikan Entry Data sesuai ketentuan pada hardcopy yang sudah di tandatangani!</marquee> --}}
    </div>


    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-1">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nama Pemegang Polis :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih pemegang polis" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Kode SOC :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih kode soc" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nomor SPAJ :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nasabah Bank/Peserta :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Segmen Pasar :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Pembayaran Kontribusi :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Mekanisme :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Asuransi :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Penutupan :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Jaminan Asuransi :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Jenis Pekerjaan :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Produk Induk Internal :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Program Asuransi :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Saluran Distribusi :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Cabang AL AMIN :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Marketing :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Pimpinan Cabang :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            {{-- @foreach ($carirekanan as $key=>$data)
                                <option value="{{ $data->mrkn_nama }}">{{ $data->mrkn_nama }}</option>
                            @endforeach  --}}
                        </select>
                </div>
            </div>

        </div>


    </div>




</div>

 {{-- KETENTUAN UMUM DAN PRODUK --}}
 <div class="card mb-5 mb-xxl-10">

    <div class="card-header" style="background-color: #0350BF;">

        <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >KETENTUAN UMUM DAN PRODUK</h1>
    </div>


    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-1">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Produk Induk OJK :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih pemegang polis" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            @foreach ($cariojk as $key=>$data)
                                <option value="{{ $data->mpojk_nama }}">{{ $data->mpojk_nama }}</option>
                            @endforeach
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Jenis Asuransi :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih jenis asuransi ---</option>
                            <option  value='1'>ASURANSI KUMPULAN</option>
                            <option value='2'>ASURANSI INDIVIDU</option>
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Produk Segmen :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih jenis asuransi ---</option>
                            <option  value='01'>PEMBIAYAAN BANK UMUM</option>
                            <option value='02'>PEMBIAYAAN BANK UMUM + PA</option>
                            <option value='03'>PEMBIAYAAN BANK UMUM + TERM</option>
                            <option value='04'>PEMBIAYAAN BANK UMUM + PA + TERM</option>
                            <option value='05'>PEMBIAYAAN BANK UMUM + BADAL</option>
                            <option value='06'>PEMBIAYAAN BANK UMUM + BADAL + PA</option>
                            <option value='07'>PEMBIAYAAN BANK UMUM + BADAL + TERM</option>
                            <option value='08'>PEMBIAYAAN BANK UMUM + BADAL + PA + TERM</option>
                            <option value='09'>PEMBIAYAAN BPR/BPRS</option>
                            <option value='10'>PEMBIAYAAN BPR/BPRS + PA</option>
                            <option value='11'>PEMBIAYAAN BPR/BPRS + TERM</option>
                            <option value='12'>PEMBIAYAAN BPR/BPRS + PA + TERM</option>
                            <option value='13'>PEMBIAYAAN BPR/BPRS + BADAL</option>
                            <option value='14'>PEMBIAYAAN BPR/BPRS + BADAL + PA</option>
                            <option value='15'>PEMBIAYAAN BPR/BPRS + BADAL + TERM</option>
                            <option value='16'>PEMBIAYAAN BPR/BPRS + BADAL + PA + TERM</option>
                            <option value='17'>PEMBIAYAAN KOPERASI</option>
                            <option value='18'>PEMBIAYAAN KOPERASI + PA</option>
                            <option value='19'>PEMBIAYAAN KOPERASI + TERM</option>
                            <option value='20'>PEMBIAYAAN KOPERASI + PA + TERM</option>
                            <option value='21'>PEMBIAYAAN KOPERASI + BADAL</option>
                            <option value='22'>PEMBIAYAAN KOPERASI + BADAL + PA</option>
                            <option value='23'>PEMBIAYAAN KOPERASI + BADAL + TERM</option>
                            <option value='24'>PEMBIAYAAN KOPERASI + BADAL + PA + TERM</option>
                            <option value='25'>PEMBIAYAAN BPD</option>
                            <option value='26'>PEMBIAYAAN BPD + PA</option>
                            <option value='27'>PEMBIAYAAN BPD + TERM</option>
                            <option value='28'>PEMBIAYAAN BPD + PA + TERM</option>
                            <option value='29'>PEMBIAYAAN BPD + BADAL</option>
                            <option value='30'>PEMBIAYAAN BPD + BADAL + PA</option>
                            <option value='31'>PEMBIAYAAN BPD + BADAL + TERM</option>
                            <option value='32'>PEMBIAYAAN BPD + BADAL + PA + TERM</option>
                            <option value='33'>PEMBIAYAAN BROKER</option>
                            <option value='34'>PEMBIAYAAN BROKER + PA</option>
                            <option value='35'>PEMBIAYAAN BROKER + TERM</option>
                            <option value='36'>PEMBIAYAAN BROKER + PA + TERM</option>
                            <option value='37'>PEMBIAYAAN BROKER + BADAL</option>
                            <option value='38'>PEMBIAYAAN BROKER + BADAL + PA</option>
                            <option value='39'>PEMBIAYAAN BROKER + BADAL + TERM</option>
                            <option value='40'>PEMBIAYAAN BROKER + BADAL + PA + TERM</option>
                            <option value='41'>PEMBIAYAAN KOAS</option>
                            <option value='42'>PEMBIAYAAN KOAS + PA</option>
                            <option value='43'>PEMBIAYAAN KOAS + TERM</option>
                            <option value='44'>PEMBIAYAAN KOAS + PA + TERM</option>
                            <option value='45'>PEMBIAYAAN KOAS + BADAL</option>
                            <option value='46'>PEMBIAYAAN KOAS + BADAL + PA</option>
                            <option value='47'>PEMBIAYAAN KOAS + BADAL + TERM</option>
                            <option value='48'>PEMBIAYAAN KOAS + BADAL + PA + TERM</option>
                            <option value='49'>PA</option><option value='50'>TERM</option>
                            <option value='51'>BADAL</option>
                        </select>
                </div>
            </div>


        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">

            <div class="col">
                <div class="fv-row mb-7" >
                    <label class="form-label fs-6 fw-bold">Kelompok Produk :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder=" --- pilih kelompok ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih kelompok ---</option>
                            <option  value='01'>PA</option>
                            <option value='02'>EKAWARSA</option>
                            <option value='03'>PEMBIAYAAN</option>
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Rekan Segmen :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih kelompok ---</option>
                            <option  value='01'>BANK SYARIAH
                            </option><option value='02'>BANK KONVEN
                            SIONAL</option><option value='03'>BPR SYARIAH
                            </option><option value='04'>BPR KONVENSIONAL
                            </option><option value='05'>BPD SYARIAH
                            </option><option value='06'>BPD UNIT SYARIAH
                            </option><option value='07'>BPD KONVENSIONAL
                            </option><option value='08'>KOPERASI
                            </option><option value='09'>BMT
                            </option><option value='10'>LEMBAGA PENDIDIKAN
                            </option><option value='11'>ORGANISASI
                            </option><option value='12'>INSTANSI
                            </option><option value='13'>FINANCE
                            </option><option value='14'>PERUSAHAAN (PT/CV)
                            </option><option value='15'>TRAVEL
                            </option><option value='16'>PNM
                            </option><option value='17'>PENJAMINAN
                            </option><option value='18'>BROKER
                            </option><option value='19'>ASURANSI UMUM
                            </option><option value='20'>AL AMIN
                            </option>
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Lini Usaha :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            @foreach ($carilini as $key=>$data)
                                <option value="{{ $data->mlu_nama }}">{{ $data->mlu_nama }}</option>
                            @endforeach
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Golongan :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option></option>
                            @foreach ($carigolongan as $key=>$data)
                                <option value="{{ $data->mgol_nama }}">{{ $data->mgol_nama }}</option>
                            @endforeach
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Status Aktif Polis :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih kelompok ---</option>
                            <option value="0">SUSPEND</option>
                            <option value="1">AKTIFKAN</option>
                            <option value="2">MATIKAN</option>
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Online Polis Cabang :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih kelompok ---</option>
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Online Polis Rekan :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih kelompok ---</option>
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Tanggal Terbit Polis :</label>
                    <input class="form-control form-control-solid" placeholder="Pilih Tanggal" id="kt_datepicker_2"/>
                </div>
            </div>



            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Open Polis :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                            <option selected value=''>--- pilih kelompok ---</option>
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Periode Polis :</label>
                    <input class="form-control form-control-solid" placeholder="Pilih Tanggal" id="kt_datepicker_3"/>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">s/d </label>
                    <input class="form-control form-control-solid" placeholder="Pilih Tanggal" id="kt_datepicker_4"/>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Max Pelaporan Data :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >hari *(dari tanggal pencairan)</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Max Pembayaran Kontribusi :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger">hari dari tanggal tagihan</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold ">Max Peserta per 1 Tahun :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value=""/>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Auto Approval Freecover :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih kelompok ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Cetak Peserta Pengajuan :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih kelompok ---</option>
                        <option  value='0'>COVERNOTE+TAGIHAN</option>
                        <option value='1'>SERTIFIKAT+TAGIHAN</option>
                        <option value='10'>COVERNOTE DAN NOTA TAGIH TLO</option>
                        <option value='11'>COVERNOTE DAN NOTA TAGIH FIRE BSM</option>
                        <option value='15'>CETAK FORMAT BANK ACEH </option>
                        <option value='16'>COVER POLIS BADAL ARAFAH</option>
                        <option value='18'>SERTIFIKAT AT TA`MIN INDIVIDU</option>
                        <option value='19'>COVERNOTE DAN NOTA TAGIH FIRE CHUB</option>
                        <option value='2'>COVERNOTE</option>
                        <option value='20'>CN & TAGIHAN BSM ATRIBUSI</option>
                        <option value='21'>CORVENOTE BRIS KE BSI </option>
                        <option value='22'>SERTIFIKAT MUF</option>
                        <option value='23'>SERTIFIKAT MODEL CN & TAGIHAN</option>
                        <option value='3'>SERTIFIKAT</option>
                        <option value='4'>AKSEPTASI+DAFTAR PESERTA+TAGIHAN</option>
                        <option value='5'>COVERNOTE+TAGIHAN JOINTLIFE</option>
                        <option value='6'>SERTIFIKAT+TAGIHAN JOINTLIFE</option>
                        <option value='7'>SERTIFIKAT INDIVIDUAL</option>
                        <option value='8'>COVERNOTE VERSI 2017.1 (Format BSM)</option>
                        <option value='9'>COVERNOTE DAN NOTA TAGIH FIRE</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Cetak Peserta Lunas :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih kelompok ---</option>
                        <option  value='12'>SERTIFIKAT LUNAS STANDAR</option>
                        <option value='13'>SERTIFIKAT FIRE</option>
                        <option value='14'>SERTIFIKAT TLO</option>
                        <option value='16'>COVER POLIS BADAL ARAFAH</option>
                        <option value='17'>SERTIFIKAT JOINT LIFE</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Status Polis :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- status polis---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih kelompok ---</option>
                        <option value="1">POLIS MIGRASI LAPSE</option>
                        <option value="2">POLIS MIGRASI INFORCE</option>
                        <option value="3">LAPSE</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nama Alias Produk Bank :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value=""/>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Host to Host Produk Rekanan :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih kelompok ---</option>
                        <option  value='0'>NO</option>
                        <option value='1'>YES</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Pemasaran Group Usaha :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih kelompok ---</option>
                        <option  value='0'>NO</option>
                        <option value='1'>YES</option>
                    </select>
                </div>
            </div>

        </div>


    </div>




</div>
 {{-- AKHIR KETENTUAN UMUM DAN PRODUK --}}



  {{-- STANDAR NILAI POLIS --}}
  <div class="card mb-5 mb-xxl-10">

    <div class="card-header" style="background-color: #0350BF;">

        <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >STANDAR NILAI POLIS</h1>
    </div>


    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Maksimal Manfaat UP :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value=""/>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nilai Perlindungan :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value=""/>

                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nilai Kontribusi Standar :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >* Sesuai Jenis pembayaran(bulan/tahun/hari)</span>
                </div>
            </div>


        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-6">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Min Usia Masuk :</label>
                    <input type="number" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >Tahun</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Max Usia Masuk :</label>
                    <input type="number" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >Tahun</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Usia Jatuh Tempo :</label>
                    <input type="number" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >Tahun</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Max Jangka Waktu :</label>
                    <input type="number" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >Bulan</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Kadaluarsa Klaim :</label>
                    <input type="number" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >Hari</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Pembayaran Klaim :</label>
                    <input type="number" class="form-control form-control-solid" name="company_name" value=""/>
                    <span class="form-label fs-6 fw-bold text-danger" >Hari</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">UP Tambahan :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value="0">0</option>
                        <option value="2.25">2.25</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Ujrah Referal :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected  value='0'>0</option>
                        <option value='2.5'>2.5</option>
                        <option value='5'>5</option>
                        <option value='7.5'>7.5</option>
                        <option value='8'>8</option>
                        <option value='10'>10</option>
                        <option value='11.85'>11.85</option>
                        <option value='15'>15</option>
                        <option value='17.5'>17.5</option>
                        <option value='20'>20</option>
                        <option value='22.5'>22.5</option>
                        <option value='25'>25</option>
                        <option value='27.5'>27.5</option>
                        <option value='30'>30</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">STNC Pelaporan :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="pilih stnc" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih kelompok ---</option>
                        <option  value='7'>7</option>
                        <option value='14'>14</option>
                        <option value='21'>21</option>
                        <option value='28'>28</option>
                        <option value='30'>30</option>
                        <option value='60'>60</option>
                        <option value='90'>90</option>
                    </select>
                </div>
            </div>



            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Ujrah Treaty Reas :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="pilih stnc" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='15'>15</option>
                        <option value='17.5'>17.5</option>
                        <option value='20'>20</option>
                        <option value='25'>25</option>
                        <option value='27.5'>27.5</option>
                        <option value='30'>30</option>
                        <option value='35'>35</option>
                        <option value='37.5'>37.5</option>
                        <option value='40'>40</option>
                        <option value='45'>45</option>
                        <option value='50'>50</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Qty Dok Klaim :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="pilih qty" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="8">8</option>
                        <option value="4">4</option>
                        <option value="6">6</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>

        </div>

    </div>
</div>
 {{-- AKHIR STANDAR NILAI POLIS --}}



  {{-- STANDAR MANFAAT POLIS --}}
  <div class="card mb-5 mb-xxl-10">

    <div class="card-header" style="background-color: #0350BF;">

        <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >STANDAR MANFAAT POLIS</h1>
    </div>


    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Penerima Manfaat :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Jiwa :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='AUM'>SISA POKOK + 1 BULAN MARGIN</option>
                        <option value='BUM'>SISA POKOK + 3 BULAN MARGIN</option>
                        <option value='CUM'>ND SISA POKOK</option>
                        <option value='DUM'>SISA POKOK</option>
                        <option value='DUT'>PLAFON AWAL</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Tambahan GU :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='C'>MAXIMAL 6 X ANGSURAN</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-5">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Tambahan WP :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='53'>0</option>
                        <option value='01'>40</option>
                        <option value='02'>45</option>
                        <option value='03'>50</option>
                        <option value='04'>55</option>
                        <option value='05'>60</option>
                        <option value='06'>65</option>
                        <option value='07'>70</option>
                        <option value='28'>72.25</option>
                        <option value='08'>75</option>
                        <option value='09'>80</option>
                        <option value='10'>85</option>
                        <option value='11'>90</option>
                        <option value='12'>95</option>
                        <option value='13'>100</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >%SWASTA</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold text-white">.</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected  value='54'>0</option>
                        <option value='58'>5</option>
                        <option value='14'>40</option>
                        <option value='15'>45</option>
                        <option value='16'>50</option>
                        <option value='17'>55</option>
                        <option value='18'>60</option>
                        <option value='19'>65</option>
                        <option value='20'>70</option>
                        <option value='27'>72.25</option>
                        <option value='21'>75</option>
                        <option value='22'>80</option>
                        <option value='23'>85</option>
                        <option value='24'>90</option>
                        <option value='25'>95</option>
                        <option value='26'>100</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >%PNS</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold text-white">.</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected  value='54'>0</option>
                        <option value='58'>5</option>
                        <option value='14'>40</option>
                        <option value='15'>45</option>
                        <option value='16'>50</option>
                        <option value='17'>55</option>
                        <option value='18'>60</option>
                        <option value='19'>65</option>
                        <option value='20'>70</option>
                        <option value='27'>72.25</option>
                        <option value='21'>75</option>
                        <option value='22'>80</option>
                        <option value='23'>85</option>
                        <option value='24'>90</option>
                        <option value='25'>95</option>
                        <option value='26'>100</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >% *(DIISI JIKA PENSIUN)</span>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-5">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Tambahan PHK :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='55'>0</option>
                        <option value='59'>5</option>
                        <option value='27'>40</option>
                        <option value='28'>45</option>
                        <option value='29'>50</option>
                        <option value='30'>55</option>
                        <option value='31'>60</option>
                        <option value='32'>65</option>
                        <option value='33'>70</option>
                        <option value='34'>75</option>
                        <option value='35'>80</option>
                        <option value='36'>85</option>
                        <option value='37'>90</option>
                        <option value='38'>95</option>
                        <option value='39'>100</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >%SWASTA</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold text-white">.</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected  value='56'>0</option>
                        <option value='60'>5</option>
                        <option value='40'>40</option>
                        <option value='41'>45</option>
                        <option value='42'>50</option>
                        <option value='43'>55</option>
                        <option value='44'>60</option>
                        <option value='45'>65</option>
                        <option value='46'>70</option>
                        <option value='47'>75</option>
                        <option value='48'>80</option>
                        <option value='49'>85</option>
                        <option value='50'>90</option>
                        <option value='51'>95</option>
                        <option value='52'>100</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >%PNS</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold text-white">.</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected  value='56'>0</option>
                        <option value='60'>5</option>
                        <option value='40'>40</option>
                        <option value='41'>45</option>
                        <option value='42'>50</option>
                        <option value='43'>55</option>
                        <option value='44'>60</option>
                        <option value='45'>65</option>
                        <option value='46'>70</option>
                        <option value='47'>75</option>
                        <option value='48'>80</option>
                        <option value='49'>85</option>
                        <option value='50'>90</option>
                        <option value='51'>95</option>
                        <option value='52'>100</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-danger" >% *(DIISI JIKA PENSIUN)</span>
                </div>
            </div>

        </div>


        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Tambahan Fire :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='F'>MURNI</option>
                        <option value='G'>SISA ANGSURAN</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Tambahan TLO :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='A'>MURNI </option>
                        <option value='B'>SISA ANGSURAN</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Tambahan Joint Life :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='0'>-</option>
                        <option value='J'>JIKA SALAH SATU MENINGGAL DIBAYARKAN 100%</option>
                        <option value='K'>AT TA`MIN BEASISWA</option>
                    </select>
                </div>
            </div>

        </div>



        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Joint Life Peserta :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">0</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="70">70</option>
                        <option value="80">80</option>
                        <option value="90">90</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Joint Life Pasangan :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">0</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="70">70</option>
                        <option value="80">80</option>
                        <option value="90">90</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manfaat Tambahan Jiwa :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option  value='D'>SANTUNAN KEMATIAN</option>
                        <option value='E'>CACAT TETAP</option>
                    </select>
                </div>
            </div>

        </div>









    </div>
</div>
 {{-- AKHIR STANDAR MANFAAT POLIS --}}


 {{-- PERHITUNGAN NILAI UW/UJROH/FEE POLIS --}}
 <div class="card mb-5 mb-xxl-10">

    <div class="card-header" style="background-color: #0350BF;">

        <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >PERHITUNGAN NILAI UW/UJROH/FEE POLIS</h1>
    </div>


    <div class="px-7 py-5" data-kt-datatable-table-filter="form" style="background-color: rgb(252, 196, 94)">
        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Penanggung Pajak FEE :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">FEE PPN :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">FEE PPH 23 :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-6" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Ujrah :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Manajemen FEE :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Overreding :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Komisi Tidak Potong :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Referal :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Maintenance :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

        </div>


        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-6" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Feebase Tidak Potong :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Feebase Potong :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Komisi Potong Lang :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="." data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Berlaku Surplus U/W :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="." data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">PEMEGANG POLIS</option>
                        <option value="1">AHLI WARIS</option>
                        <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                    </select>
                    <span class="form-label fs-6 fw-bold text-black" >%</span>
                </div>
            </div>



        </div>



    </div>
</div>
 {{-- AKHIR PERHITUNGAN NILAI UW/UJROH/FEE POLIS --}}


 {{-- PAYMENT MODE POLIS --}}
 <div class="card mb-5 mb-xxl-10">

    <div class="card-header" style="background-color: #0350BF;">

        <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >PAYMENT MODE POLIS</h1>
    </div>


    <div class="px-7 py-5" data-kt-datatable-table-filter="form" >
        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Virtual Account :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">VIA :</label>
                    <input class="form-control form-control-solid" name="tagify_input" value="" id="kt_VA" />
                </div>
            </div>

            {{-- <div class="col">
                <div class="fv-row mb-7 py-10">
                    <button type="button" class="btn btn-success me-3 btn-sm " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-plus fa-solid fa-filter"></i> ADD
                    </button>
                </div>
            </div> --}}

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Pembayaran Online :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">VIA :</label>
                    <input class="form-control form-control-solid" name="tagify_input" value="" id="kt_Online" />
                </div>
            </div>

            {{-- <div class="col">
                <div class="fv-row mb-7 py-10">
                    <button type="button" class="btn btn-success me-3 btn-sm " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-plus fa-solid fa-filter"></i> ADD
                    </button>
                </div>
            </div> --}}

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7 ">
                    <label class="form-label fs-6 fw-bold">Pembayaran Retail/Agent :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7" >
                    <label class="form-label fs-6 fw-bold">VIA :</label>
                    <input class="form-control form-control-solid" name="tagify_input" value="" id="kt_Retail" />
                </div>
            </div>

            {{-- <div class="col">
                <div class="fv-row mb-7 py-10">
                    <button type="button" class="btn btn-success me-3 btn-sm " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-plus fa-solid fa-filter"></i> ADD
                    </button>
                </div>
            </div> --}}

        </div>


    </div>
</div>
 {{-- AKHIR PAYMENT MODE POLIS --}}


 {{-- LAIN-LAIN --}}
 <div class="card mb-5 mb-xxl-10">

    <div class="card-header" style="background-color: #0350BF;">

        <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >LAIN-LAIN</h1>
    </div>


    <div class="px-7 py-5" data-kt-datatable-table-filter="form" >
        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Jenis Web Login:</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Persetujuan Teknis Klaim:</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>


        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Catatan :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value="" />
                </div>
            </div>


        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">No Surat Endors :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value="" />
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Keterangan Endors :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value="" />
                </div>
            </div>


        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Berlaku Untuk Provinsi :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>


            <div class="col">
                <div class="fv-row mb-7 py-10">
                    <button type="button" class="btn btn-success me-3 btn-sm " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-plus fa-solid fa-filter"></i> ADD
                    </button>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-1" >
            <hr>
        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nomor Polis :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value="" />
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Nomor Cetak :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value="" />
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Kode Polis :</label>
                    <input type="text" class="form-control form-control-solid" name="company_name" value="" />
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Import Tarif :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold text-white">.</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>


            <div class="col">
                <div class="fv-row mb-7 py-10">
                    <button type="button" class="btn btn-success me-3 btn-sm " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-eye fa-solid fa-filter"></i> LIHAT
                    </button>
                </div>
            </div>

        </div>

        <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold">Import Underwriting :</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="fv-row mb-7">
                    <label class="form-label fs-6 fw-bold text-white">.</label>
                    <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false">
                        <option selected value=''>--- pilih ujrah ---</option>
                        <option value="0">NO</option>
                        <option value="1">YES</option>
                    </select>
                </div>
            </div>


            <div class="col">
                <div class="fv-row mb-7 py-10">
                    <button type="button" class="btn btn-success me-3 btn-sm " data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="fa-eye fa-solid fa-filter"></i> LIHAT
                    </button>
                </div>
            </div>

        </div>



    </div>
</div>
 {{-- AKHIR LAIN-LAIN --}}
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

        $("#kt_datepicker_2").flatpickr();
        $("#kt_datepicker_3").flatpickr();
        $("#kt_datepicker_4").flatpickr();

        const form = document.getElementById('kt_docs_formvalidation_tagify');


var tags = new Tagify(document.querySelector("#kt_VA"), {
    whitelist: ["Bank Syariah Mandiri", "Bank Mandiri", "Bank Permata", "Bank Permata Syariah"],
    maxTags: 4,
    dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
    }
});

var tags = new Tagify(document.querySelector("#kt_Online"), {
    whitelist: ["GOPAY", "OVO", "TOKOPEDIA"],
    maxTags: 4,
    dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
    }
});

var tags = new Tagify(document.querySelector("#kt_Retail"), {
    whitelist: ["ALFAMART", "INDOMART", "PT.POS INDONESIA"],
    maxTags: 4,
    dropdown: {
        maxItems: 20,           // <- mixumum allowed rendered suggestions
        classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
        enabled: 0,             // <- show suggestions on focus
        closeOnSelect: false    // <- do not hide the suggestions dropdown once an item has been selected
    }
});
    </script>
@endsection
