@extends('layouts.main-admin')

@section('title')
    Entry Master Polis
@endsection

@section('content')
<div class="card-header">
	<div class="card-toolbar justify-content-center">
		<div class="card-toolbar">
			<div class="d-flex justify-content-center" data-kt-datatable-table-toolbar="base">
                <div class="py-3 px-3">
                    <a type="button" target="newtab"  class="btn btn-primary btn-sm" id="pol_baru"><i
                        class="fa-solid fa-plus text-white"></i> NEW
                    </a>
                 </div>

                 <div class="py-3 px-3">
                    <a type="button" target="newtab"  class="btn btn-success btn-sm" id="pol_edit"><i
                        class="fa-solid fa-pen text-white"></i> EDIT
                    </a>
                 </div>

                 <div class="py-3 px-3">
                    <a type="button" target="newtab" class="btn btn-success btn-sm" id="pol_endors"><i
                        class="fa-solid fa-pen text-white"></i> ENDORS
                    </a>
                 </div>

                 <div class="py-3 px-3">
                    <a type="button" target="newtab"  class="btn btn-danger btn-sm" id="pol_batal"><i
                        class="fa-solid fa-minus text-white"></i> BATAL
                    </a>
                 </div>



            </div>

            <div class="d-flex justify-content-center" data-kt-datatable-table-toolbar="base">
                <div class="py-3 px-3">
                    <h3 class="bg-warning text-danger"></h3>
                 </div>
            </div>

		</div>
	</div>
</div>

<form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
    @csrf
    {{-- TAG AWAL --}}
    <div class="card mb-5 mb-xxl-10">
            <div class="px-7 py-5">

                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-1">
                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="required form-label">Nama Pemegang Polis</label>
                            <input type="text" class="easyui-textbox selectGrid" name="mpol_mrkn_nama" id="mpol_mrkn_nama" data-options="prompt:'Pilih pemegang polis'" style="width: 100%; height: 38px;" />
                            <input type="text" class="form-control form-control-solid" name="mpol_mrkn_kode" id="mpol_mrkn_kode" placeholder="mpol_mrkn_nama" />
                            <span class="text-danger error-text mpol_mrkn_nama_err"></span>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="required form-label">Kode SOC</label>
                            <input type="text" class="easyui-textbox selectGrid" name="mpol_msoc_kode" id="mpol_msoc_kode" data-options="prompt:'Pilih Kode SOC'" style="width: 100%; height: 38px;" />
                            <span class="text-danger error-text mpol_mrkn_nama_err"></span>
                        </div>
                    </div>
                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bold">Nomor SPAJ :</label>
                            <input type="text" class="form-control form-control-solid bg-warning"    name="mpol_mspaj_nomor" id="mpol_mspaj_nomor" readonly/>
                        </div>
                    </div>
                </div>



                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bold">Nasabah Bank/Peserta :</label>

                            <input type="text" class="form-control form-control-solid"    hidden name="mpol_mjns_mpid_kode" id="mpol_mjns_mpid_kode"/>

                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mjns_kode" id="mpol_mjns_kode" data-dropdown-parent="#modal_element_id">
                                    <option></option>
                                    @foreach ($carirekanan as $key=>$data)
                                        <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bold">Segmen Pasar :</label>
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mssp_kode" id="mpol_mssp_kode" data-dropdown-parent="#modal_element_id">
                                    <option></option>
                                    @foreach ($carirekanan as $key=>$data)
                                        <option value="{{ $data->nama }}">{{ $data->nama }}</option>
                                    @endforeach
                                </select>
                        </div>
                    </div>
                </div>


                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bold">Pembayaran Kontribusi :</label>
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_jenis_bayar" id="mpol_jenis_bayar" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mekanisme" id="mpol_mekanisme" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true"  data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mft_kode" id="mpol_mft_kode" data-dropdown-parent="#modal_element_id">
                                    <option selected  value='01'>UM</option>
                                    <option value='02'>UT</option>
                                    <option value='03'>UM FLAT</option>
                                    <option value='04'>UM EFEKTIF</option>
                                    <option value='05'>UM SLIDING</option>
                                    <option value='06'>UT FLAT</option>
                                    <option value='07'>UT EFEKTIF</option>
                                </select>
                        </div>
                    </div>

                    <div class="col">
                        <div class="fv-row mb-7">
                            <label class="form-label fs-6 fw-bold">Penutupan :</label>
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mekanisme2" id="mpol_mekanisme2" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mjm_kode" id="mpol_mjm_kode" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_jns_perusahaan" id="mpol_jns_perusahaan" data-dropdown-parent="#modal_element_id">
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

                            <input type="text" class="form-control form-control-solid"    hidden name="mpol_mpid_kode" id="mpol_mpid_kode"/>

                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_endos" id="mpol_endos" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mpras_kode" id="mpol_mpras_kode" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mslr_kode" id="mpol_mslr_kode" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mlok_kode" id="mpol_mlok_kode" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mkar_kode_mkr" id="mpol_mkar_kode_mkr" data-dropdown-parent="#modal_element_id">
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
                                <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mkar_kode_pim" id="mpol_mkar_kode_pim" data-dropdown-parent="#modal_element_id">
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
    {{-- TAG AKHIR --}}


    {{-- AWAL KETENTUAN UMUM DAN PRODUK --}}
    <div class="card mb-5 mb-xxl-10">
        <div class="card-header" style="background-color: #0350BF;">

            <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >KETENTUAN UMUM DAN PRODUK</h1>
        </div>
        <div class="px-7 py-5">

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-1">
                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Produk Induk OJK :</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Pilih pemegang polis" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mpojk_kode" id="mpol_mpojk_kode">
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
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mja_kode" id="mpol_mja_kode">
                                <option selected value=''>--- pilih jenis asuransi ---</option>
                                <option  value='1'>ASURANSI KUMPULAN</option>
                                <option value='2'>ASURANSI INDIVIDU</option>
                            </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Produk Segmen :</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mgpp_kode" id="mpol_mgpp_kode">
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
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder=" --- pilih kelompok ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mgp_kode" id="mpol_mgp_kode">
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
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mgs_kode" id="mpol_mgs_kode">
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
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mlu_kode" id="mpol_mlu_kode">
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
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mgol_kode" id="mpol_mgol_kode">
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
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_aktif" id="mpol_aktif">
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
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_online" id="mpol_online">
                                <option selected value=''>--- pilih kelompok ---</option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Online Polis Rekan :</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_online_rekan" id="mpol_online_rekan">
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
                        <input type="date" class="form-control form-control-solid" placeholder="Pilih Tanggal"  name="mpol_tgl_terbit" id="mpol_tgl_terbit"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Open Polis :</label>
                            <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_openpolis" id="mpol_openpolis">
                                <option selected value=''>--- pilih kelompok ---</option>
                                <option value="0">NO</option>
                                <option value="1">YES</option>
                            </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Periode Polis :</label>
                        <input type="date" class="form-control form-control-solid" placeholder="Pilih Tanggal"  name="mpol_tgl_awal_polis" id="mpol_tgl_awal_polis"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">s/d </label>
                        <input type="date" class="form-control form-control-solid" placeholder="Pilih Tanggal"  name="mpol_tgl_ahir_polis" id="mpol_tgl_ahir_polis"/>
                    </div>
                </div>

            </div>

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Max Pelaporan Data :</label>
                        <input type="text" class="form-control form-control-solid"    name="mpol_lapor_data" id="mpol_lapor_data"/>
                        <span class="form-label fs-6 fw-bold text-danger" >hari *(dari tanggal pencairan)</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Max Pembayaran Kontribusi :</label>
                        <input type="text" class="form-control form-control-solid"    name="mpol_byr_premi" id="mpol_byr_premi"/>
                        <span class="form-label fs-6 fw-bold text-danger">hari dari tanggal tagihan</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold ">Max Peserta per 1 Tahun :</label>
                        <input type="text" class="form-control form-control-solid bg-warning"    name="mpol_max_pst" id="mpol_max_pst" value="100" readonly/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Auto Approval Freecover :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_aprove_fc" id="mpol_aprove_fc">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_jenis_cetak" id="mpol_jenis_cetak">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_cetak_lunas" id="mpol_cetak_lunas">
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="--- status polis---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_status_polis" id="mpol_status_polis" data-dropdown-parent="#modal_element_id">
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
                        <input type="text" class="form-control form-control-solid"    name="mpol_produkbank" id="mpol_produkbank"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Host to Host Produk Rekanan :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_host2host" id="mpol_host2host">
                            <option selected value=''>--- pilih kelompok ---</option>
                            <option  value='0'>NO</option>
                            <option value='1'>YES</option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Pemasaran Group Usaha :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_pemgroupusaha" id="mpol_pemgroupusaha">
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


     {{-- AWAL STANDAR NILAI POLIS --}}
     <div class="card mb-5 mb-xxl-10">
        <div class="card-header" style="background-color: #0350BF;">
            <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >STANDAR NILAI POLIS</h1>
        </div>
        <div class="px-7 py-5">

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Maksimal Manfaat UP :</label>
                        <input type="text" class="form-control form-control-solid"    name="mpol_max_up" id="mpol_max_up" />
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Nilai Perlindungan :</label>
                        <input type="text" class="form-control form-control-solid"    name="mpol_standar_perlindungan" id="mpol_standar_perlindungan"/>

                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Nilai Kontribusi Standar :</label>
                        <input type="text" class="form-control form-control-solid"    name="mpol_standar_premi" id="mpol_standar_premi"/>
                        <span class="form-label fs-6 fw-bold text-danger" >* Sesuai Jenis pembayaran(bulan/tahun/hari)</span>
                    </div>
                </div>

            </div>

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-6">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Min Usia Masuk :</label>
                        <input type="number" class="form-control form-control-solid"    name="mpol_usia_min" id="mpol_usia_min"/>
                        <span class="form-label fs-6 fw-bold text-danger" >Tahun</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Max Usia Masuk :</label>
                        <input type="number" class="form-control form-control-solid"    name="mpol_usia_max" id="mpol_usia_max"/>
                        <span class="form-label fs-6 fw-bold text-danger" >Tahun</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Usia Jatuh Tempo :</label>
                        <input type="number" class="form-control form-control-solid"    name="mpol_jatuh_tempo" id="mpol_jatuh_tempo"/>
                        <span class="form-label fs-6 fw-bold text-danger" >Tahun</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Max Jangka Waktu :</label>
                        <input type="number" class="form-control form-control-solid"    name="mpol_tenor_max" id="mpol_tenor_max"/>
                        <span class="form-label fs-6 fw-bold text-danger" >Bulan</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Kadaluarsa Klaim :</label>
                        <input type="number" class="form-control form-control-solid"    name="mpol_kadaluarsa_klaim" id="mpol_kadaluarsa_klaim"/>
                        <span class="form-label fs-6 fw-bold text-danger" >Hari</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Pembayaran Klaim :</label>
                        <input type="number" class="form-control form-control-solid"    name="mpol_max_bayar_klaim" id="mpol_max_bayar_klaim"/>
                        <span class="form-label fs-6 fw-bold text-danger" >Hari</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">UP Tambahan :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mut_kode" id="mpol_mut_kode">
                            <option selected value="0">0</option>
                            <option value="2.25">2.25</option>
                        </select>
                        <span class="form-label fs-6 fw-bold text-danger" >%</span>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Ujrah Referal :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mujhrf_kode" id="mpol_mujhrf_kode">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_lapor_stnc" id="mpol_lapor_stnc">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_ujroh_treaty" id="mpol_ujroh_treaty">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_klaim_doc" id="mpol_klaim_doc">
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



    {{-- AWAL STANDAR MANFAAT POLIS --}}
    <div class="card mb-5 mb-xxl-10">
        <div class="card-header" style="background-color: #0350BF;">
            <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >STANDAR MANFAAT POLIS</h1>
        </div>
        <div class="px-7 py-5">

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Penerima Manfaat :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_penerima_manfaat" id="mpol_penerima_manfaat">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mnfa_kode" id="mpol_mnfa_kode">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_gu" id="mpol_mmft_kode_gu">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_wp_swasta" id="mpol_mmft_kode_wp_swasta">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_wp_pns" id="mpol_mmft_kode_wp_pns">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_wp_pensiun" id="mpol_mmft_kode_wp_pensiun">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_phk_swasta" id="mpol_mmft_kode_phk_swasta">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_phk_pns" id="mpol_mmft_kode_phk_pns">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_phk_pensiun" id="mpol_mmft_kode_phk_pensiun">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_fire" id="mpol_mmft_kode_fire">
                            <option selected value=''>--- pilih ujrah ---</option>
                            <option  value='F'>MURNI</option>
                            <option value='G'>SISA ANGSURAN</option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Manfaat Tambahan TLO :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_tlo" id="mpol_mmft_kode_tlo">
                            <option selected value=''>--- pilih ujrah ---</option>
                            <option  value='A'>MURNI </option>
                            <option value='B'>SISA ANGSURAN</option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Manfaat Tambahan Joint Life :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_jl" id="mpol_jl">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_jl_pst" id="mpol_jl_pst">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_jl_pasangan" id="mpol_jl_pasangan">
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
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmft_kode_jiwa" id="mpol_mmft_kode_jiwa">
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


     {{-- AWAL PERHITUNGAN NILAI UW/UJROH/FEE POLIS --}}
    <div class="card mb-5 mb-xxl-10">
        <div class="card-header" style="background-color: #0350BF;">
            <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >PERHITUNGAN NILAI UW/UJROH/FEE POLIS</h1>
        </div>
        <div class="px-7 py-5">

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3" >

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Penanggung Pajak FEE :</label>
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_pajakfee" id="mpol_pajakfee" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_handlingfee" id="mpol_handlingfee" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_pajakfee_persen" id="mpol_pajakfee_persen" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mujh_persen" id="mpol_mujh_persen" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mmfe_persen" id="mpol_mmfe_persen" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_overreding" id="mpol_overreding" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false"
                        name="mpol_mkom_persen" id="mpol_mkom_persen" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="." data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_referal" id="mpol_referal" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="." data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_maintenance" id="mpol_maintenance" disabled>
                            <option selected value=''>--- pilih ujrah ---</option>
                            <option value="0">PEMEGANG POLIS</option>
                            <option value="1">AHLI WARIS</option>
                            <option value="2">PEMEGANG POLIS & AHLI WARIS</option>
                        </select>
                        <span class="form-label fs-6 fw-bold text-black" >%</span>
                    </div>
                </div>

            </div>

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4" >

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Feebase Tidak Potong :</label>
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mfee_persen" id="mpol_mfee_persen" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="O" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mdr_kode" id="mpol_mdr_kode" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="." data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_mkomdisc_persen" id="mpol_mkomdisc_persen" disabled>
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
                        <select class="form-select form-select-solid fw-bolder bg-warning" data-kt-select2="true" data-placeholder="." data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_surplus" id="mpol_surplus">
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


      {{-- AWAL PAYMENT MODE POLIS --}}
      <div class="card mb-5 mb-xxl-10">
        <div class="card-header" style="background-color: #0350BF;">
            <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >PAYMENT MODE POLIS</h1>
        </div>
        <div class="px-7 py-5">

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Virtual Account :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-placeholder="--- pilih ---" data-hide-search="false" name="mpol_va" id="mpol_va">
                            <option  value=''>--- pilih ---</option>
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">VIA :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-allow-clear="true" data-hide-search="false" name="mpol_va_via" id="mpol_va_via" data-placeholder="--- pilih ---">
                            <option value=''>--- pilih metode ---</option>
                            <option value="1">Bank Syariah Mandiri</option>
                            <option value="2">Bank Mandiri</option>
                            <option value="3">Bank Permata</option>
                            <option value="4">Bank Permata Syariah</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Pembayaran Online :</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-allow-clear="true" data-hide-search="false" name="mpol_payonline" id="mpol_payonline" data-placeholder="--- pilih ---">
                            <option  value=''>--- pilih ---</option>
                            <option value="0">NO</option>
                            <option value="1">YES</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="fv-row mb-7">
                        <label for="" class="form-label">VIA</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-allow-clear="true" data-hide-search="false" name="mpol_playonline_via" id="mpol_playonline_via" data-placeholder="--- pilih ---">
                            <option  value=''>--- pilih metode ---</option>
                            <option value="1">GOPAY</option>
                            <option value="2">OVO</option>
                            <option value="3">TOKOPEDIA</option>
                        </select>

                    </div>
                </div>

            </div>




        </div>
      </div>
      {{-- AKHIR PAYMENT MODE POLIS --}}

       {{-- AWAL LAIN-LAIN --}}
       <div class="card mb-5 mb-xxl-10">
        <div class="card-header" style="background-color: #0350BF;">
            <h1 class="d-flex align-items-center text-white fw-bolder fs-3 my-1" >LAIN-LAIN</h1>
        </div>
        <div class="px-7 py-5">

            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Jenis Web Login:</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_jenis_login" id="mpol_jenis_login">
                            <option  value=''>--- pilih ---</option>
                            <option value="0">TIDAK ADA AKSES</option>
                            <option value="1">MENU SISWA</option>
                            <option value="2">MENU MAHASISWA</option>
                            <option value="3">MENU BADAL</option>
                            <option value="4">MENU INDIVIDU </option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Persetujuan Teknis Klaim:</label>
                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="mpol_acc_tek" id="mpol_acc_tek">
                            <option  value=''>--- pilih ---</option>
                            <option value="0">Tampil</option>
                            <option value="1">Tidak Tampil</option>
                        </select>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Catatan :</label>
                        <input type="text" class="form-control form-control-solid"   name="mpol_note" id="mpol_note" />
                    </div>
                </div>

            </div>


            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">No Surat Endors :</label>
                        <input type="text" class="form-control form-control-solid"   name="mpol_no_endors" id="mpol_no_endors" />
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Keterangan Endors :</label>
                        <input type="text" class="form-control form-control-solid"   name="mpol_ket_endors" id="mpol_ket_endors" />
                    </div>
                </div>

            </div>


        </div>
    {{-- AKHIR LAIN-LAIN --}}

     {{-- AWAL BUTTON --}}
    <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                class="fa-solid fa-floppy-disk"></i> Simpan</button>
        <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                class="fa-solid fa-trash"></i> Hapus</button>
        <button type="button" class="btn btn-danger btn-sm" id="btn_tutup"><i
                class="fa-solid fa-xmark"></i> Tutup</button>
    </div>
     {{-- AKHIR BUTTON --}}
</form>
@endsection
@section('script')
<script type="text/javascript">
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        selectGrid(
                'mpol_mrkn_nama',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-pmgpolis") }}',
                'nama',
                'nama',
                [
					{field:'kode',title:'Kode',align:'left',width:180},
					{field:'nama',title:'Nama',align:'left',width:280},
				],
                function(i, row) {
                    hidePesan('mpol_mrkn_nama');
                    var kode = row.kode;
                        setText('mpol_mrkn_kode', kode);

                    //reComboGrid("#mpol_msoc_kode",'/live/ww.load/lod_soc.php?&pmgpolis='+getText("mpol_mrkn_kode"));
                    reSelGrid('mpol_msoc_kode', '{{ url("api/tehnik/polis/entry-master-polis/select-soc") }}' + '?q=' + getText("mpol_mrkn_kode"));

                }
            );

            selectGrid(
                'mpol_msoc_kode',
                'GET',
                '{{ url("api/tehnik/polis/entry-master-polis/select-soc") }}',
                'msoc_kode',
                'mjns_Keterangan',
                'mssp_nama',
                'mkm_nama',
                'mkm_ket2',
                'mker_nama',
                'mft_nama',
                'bayar',
                'msoc_mjm_nama',
                'mpras_nama',
                'msoc_mrkn_nama',
                [
					{field:'msoc_kode',title:'Kode SOC',align:'left',width:180},
					{field:'mjns_Keterangan',title:'Nama Nasabah',align:'left',width:280},
					{field:'mssp_nama',title:'Segemen',align:'left',width:280},
					{field:'mkm_nama',title:'Mekanisme 1',align:'left',width:280},
					{field:'mkm_ket2',title:'Mekanisme 2',align:'left',width:280},
					{field:'mker_nama',title:'Pekerjaan',align:'left',width:280},
					{field:'mft_nama',title:'Manfaat',align:'left',width:280},
					{field:'bayar',title:'Pembayaran',align:'left',width:280},
					{field:'msoc_mjm_nama',title:'Jaminan',align:'left',width:280},
					{field:'mpras_nama',title:'Program Asuransi',align:'left',width:280},
                    {field:'msoc_mrkn_nama',title:'Pmg Polis',width:200,hidden:true},
				],
                function(i, row) {
                    hidePesan('mpol_msoc_kode');
                    var kode = row.kode;
                    setText('mpol_msoc_kode', kode);
                }
            );


        $('#frxx').submit(function(e) {
            // $('#btn_simpan').click(function(e) {
            e.preventDefault();
            // var dataFrx = $('#frxx').serialize();
            var formData = new FormData(this); //jika ada input file atau dokumen
            bsimpan('btn_simpan', 'Please wait..');

            $.ajax({
                url: "{{ route('tehnik.polis.entry-master-polis.store') }}",

                type: "POST",
                data: formData,
                cache: false, //jika ada input file atau dokumen
                contentType: false, //jika ada input file atau dokumen
                processData: false, //jika ada input file atau dokumen
                // dataType: 'json',
                success: function(res) {
                    window.location.reload();
                    // console.log(res);
                    if ($.isEmptyObject(res.error)) {
                        console.log(res);
                        Swal.fire(
                            'Berhasil!',
                            res.success,
                            'success'
                        ).then((res) => {
                            x();
                            // reset();
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
                error: function(err) {
                    console.log('Error:', err);
                    bsimpan('btn_simpan', 'Simpan');
                }
            });
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
            x();
        });
        $('#btn_close4').click(function() {
            $('#modalView').modal('hide');
            x();
        });
        $('#btn_closeCreate').click(function() {
            $('#modalPks').modal('hide');
            x();
        });
        $('#btn_tutup').click(function() {
            $('#modalPks').modal('hide');
            x();
        });

    });

    $(document).ready(function() {
        // setHide
        setHide('mpol_mrkn_kode', true);

        $("#pol_baru").click(function(){
            $("h3").text("POLIS BARU");
        });
        $("#pol_edit").click(function(){
            $("h3").text("POLIS EDIT");
        });
        $("#pol_endors").click(function(){
            $("h3").text("POLIS ENDORS");
        });
        $("#pol_batal").click(function(){
            $("h3").text("POLIS BATAL");
        });
            });

</script>
@endsection
