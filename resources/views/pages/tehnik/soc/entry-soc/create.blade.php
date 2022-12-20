@extends('layouts.main-admin')

@section('title')
    Entry SOC
@endsection

@section('content')
<div class="card mb-5 mb-xxl-10">

    <div class="card-header">
        <div class="card-title">
            <h3>Entry SOC</h3>
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
                <button type="button" class="btn btn-light-primary" disabled id="title_action">Buat SOC Baru</button>
            </div>
        </div>

        <div class="card-toolbar">
            <div class="input-group input-group-solid">
                <button type="button" id="btnBru" class="btn btn-light-primary active" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" onclick="cekForm(0)">Baru</button>
                <button type="button" id="btnEds" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Endors" onclick="cekForm(2)">Endors</button>
                <button type="button" id="btnEdt" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Edit" onclick="cekForm(1)">Edit</button>
                <button type="button" id="btnBtl" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Batal" onclick="cekForm(3)">Batal</button>
            </div>
        </div>
    </div>

    <form id="frxx_soc" name="frxx_soc" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card-body py-10">
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nama Pemegang Polis</label>
                        <input type="text" class="easyui-textbox selectGrid" name="msoc_mrkn_nama" id="msoc_mrkn_nama" data-options="prompt:'Pilih pemegang polis'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mrkn_kode" id="msoc_mrkn_kode" placeholder="msoc_mrkn_kode" />
                        <span class="text-danger error-text msoc_mrkn_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nasabah Bank/Peserta</label>
                        <input type="text" class="easyui-textbox selectGrid" name="e_nasabah" id="e_nasabah" data-options="prompt:'Pilih nasabah bank'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="e_bersih" id="e_bersih" placeholder="e_bersih" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mjns_kode" id="msoc_mjns_kode" placeholder="msoc_mjns_kode" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mjns_mpid_kode" id="msoc_mjns_mpid_kode" placeholder="msoc_mjns_mpid_kode" />
                        <span class="text-danger error-text e_nasabah_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Segmen Pasar</label>
                        <input type="text" class="easyui-combobox" name="msoc_mssp_nama" id="msoc_mssp_nama" data-options="prompt:'Pilih segmen pasar'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mssp_kode" id="msoc_mssp_kode" placeholder="msoc_mssp_kode" />
                        <input type="text" class="form-control form-control-solid" name="mpid_mssp_kode" id="mpid_mssp_kode" placeholder="mpid_mssp_kode" />
                        <span class="text-danger error-text msoc_mssp_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-5">
                        <label class="form-label">Nomor SPAJ</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <input type="text" class="easyui-textbox selectGrid" name="msoc_mspaj_nama" id="msoc_mspaj_nama" data-options="prompt:'Pilih nomor spaj'" style="width: 100%; height: 38px;" />
                                    <span class="text-danger error-text msoc_mspaj_nama_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <input type="text" class="form-control form-control-solid" name="msoc_mspaj_nomor" id="msoc_mspaj_nomor" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Mekanisme 1 (Umum)</label>
                        {{-- <select class="form-select form-select-solid" data-control="select2" name="msoc_mekanisme" id="msoc_mekanisme" data-placeholder="Pilih jenis pekerjaan" data-allow-clear="true">
                            <option></option>
                            @foreach ($mks1 as $key => $data)
                                <option value="{{ $data->mkm_kode }}">{{ $data->mkm_nama }}</option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="easyui-combobox" name="msoc_mekanisme" id="msoc_mekanisme" data-options="prompt:'Pilih mkanisme 1'" style="width: 100%; height: 38px;" />
                        <span class="text-danger error-text msoc_mekanisme_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="form-label">Mekanisme 2 (Penutupan)</label>
                        {{-- <select class="form-select form-select-solid" data-control="select2" name="msoc_mekanisme2" id="msoc_mekanisme2" data-placeholder="Pilih jenis pekerjaan" data-allow-clear="true">
                            <option></option>
                            @foreach ($mks2 as $key => $data)
                                <option value="{{ $data->mkm_kode2 }}">{{ $data->mkm_ket2 }}</option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="easyui-combobox" name="msoc_mekanisme2" id="msoc_mekanisme2" data-options="prompt:'Pilih mkanisme 2'" style="width: 100%; height: 38px;" />
                        <span class="text-danger error-text msoc_mekanisme2_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Manfaat Asuransi</label>
                        <input type="text" class="easyui-textbox selectGrid" name="e_manfaat_pol" id="e_manfaat_pol" data-options="prompt:'Pilih manfaat asuransi'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_approve" id="msoc_approve" placeholder="msoc_approve" />
                        <input type="text" class="form-control form-control-solid" name="edit_akses" id="edit_akses" placeholder="edit_akses" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mft_kode" id="msoc_mft_kode" placeholder="msoc_mft_kode" />
                        <span class="text-danger error-text e_manfaat_pol_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Pembayaran Kontribusi</label>
                        {{-- <select class="form-select form-select-solid" data-control="select2" name="msoc_jenis_bayar" id="msoc_jenis_bayar" data-placeholder="Pilih jenis pekerjaan" data-allow-clear="true">
                            <option></option>
                            <option value="0">Sekaligus</option>
                            <option value="1">Per Tahun</option>
                            <option value="2">Per Bulan</option>
                        </select> --}}
                        <select class="easyui-combobox" name="msoc_jenis_bayar" id="msoc_jenis_bayar" data-options="prompt:'Pilih kontribusi'" style="width: 100%; height: 38px;">
                            <option value="0">Sekaligus</option>
                            <option value="1">Per Tahun</option>
                            <option value="2">Per Bulan</option>
                        </select>
                        <span class="text-danger error-text msoc_jenis_bayar_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="form-label">Jenis Pekerjaan</label>
                        <input type="text" class="easyui-combobox" name="msoc_jns_perusahaan" id="msoc_jns_perusahaan" data-options="prompt:'Pilih jenis pekerjaan'" style="width: 100%; height: 38px;" />
                        {{-- <select class="form-select form-select-solid" data-control="select2" name="msoc_jns_perusahaan" id="msoc_jns_perusahaan" data-placeholder="Pilih jenis pekerjaan" data-allow-clear="true">
                            <option></option>
                            @foreach ($jnskerja as $key => $data)
                                <option value="{{ $data->mker_kode }}">{{ $data->mker_nama }}</option>
                            @endforeach
                        </select> --}}
                        <span class="text-danger error-text msoc_jns_perusahaan_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Jaminan Asuransi</label>
                        <input type="text" class="easyui-textbox selectGrid" name="e_manfaat" id="e_manfaat" data-options="prompt:'Pilih jaminan asuransi'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mjm_kode" id="msoc_mjm_kode" placeholder="msoc_mjm_kode" />
                        <span class="text-danger error-text e_manfaat_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Jenis Produk</label>
                        <input type="text" class="form-control form-control-solid" name="mpid_nama" id="mpid_nama" placeholder="jenis produk" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mpid_kode" id="msoc_mpid_kode" placeholder="msoc_mpid_kode" />
                        <span class="text-danger error-text mpid_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-5">
                        <label class="required form-label">Program Asuransi</label>
                        <input type="text" class="easyui-textbox selectGrid" name="e_pras" id="e_pras" data-options="prompt:'Pilih program asuransi'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mpras_kode" id="msoc_mpras_kode" placeholder="msoc_mpras_kode" />
                        <label class="required form-label">Urutan Nomor filter/penyaringan harus benar !</label></br>
                        <span class="text-danger error-text e_pras_err"></span>
                    </div>
                </div>
            </div>

            <div class="separator my-7"></div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Saluran Distribusi</label>
                        {{-- <select class="form-select form-select-solid" data-control="select2" name="msoc_mslr_kode" id="msoc_mslr_kode" data-placeholder="Pilih jenis pekerjaan" data-allow-clear="true">
                            <option></option>
                            @foreach ($jnskerja as $key => $data)
                                <option value="{{ $data->mker_kode }}">{{ $data->mker_nama }}</option>
                            @endforeach
                        </select> --}}
                        <input type="text" class="easyui-combobox" name="msoc_mslr_kode" id="msoc_mslr_kode" data-options="prompt:'Pilih jenis pekerjaan'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="endors" id="endors" placeholder="endors" />
                        <span class="text-danger error-text msoc_mslr_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nama Produk Ojk</label>
                        <input type="text" class="easyui-combobox" name="msoc_mpojk_kode" id="msoc_mpojk_kode" data-options="prompt:'Pilih produk ojk'" style="width: 100%; height: 38px;" />
                        <span class="text-danger error-text msoc_mpojk_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Cabang Alamin</label>
                        <input type="text" class="easyui-textbox selectGrid" name="e_cabalamin" id="e_cabalamin" data-options="prompt:'Pilih cabang alamin'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mlok_kode" id="msoc_mlok_kode" placeholder="msoc_mlok_kode" />
                        <span class="text-danger error-text e_cabalamin_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Marketing</label>
                        <input type="text" class="easyui-textbox selectGrid" name="e_marketing" id="e_marketing" data-options="prompt:'Pilih marketing'" style="width: 100%; height: 38px;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_mkr" id="msoc_mkar_kode_mkr" placeholder="msoc_mkar_kode_mkr" />
                        <span class="text-danger error-text e_marketing_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Pimpinan Cabang</label>
                        <input type="text" class="form-control form-control-solid" name="e_pinca" id="e_pinca" placeholder="Pimpinan cabang" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_pim" id="msoc_mkar_kode_pim" placeholder="msoc_mkar_kode_pim" />
                        <span class="text-danger error-text e_pinca_err"></span>
                    </div>
                </div>
            </div>

            <div class="separator my-10"></div>

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Penanggung Pajak Fee</label>
                            <select class="form-select form-select-solid" data-control="select2" name="msoc_pajakfee" id="msoc_pajakfee" data-placeholder="Pilih pajak fee" data-allow-clear="true">
                                <option></option>
                                <option value="0">-</option>
                                <option value="1">PPN & PPH Tidak Potongan/Nambah Kontribusi</option>
                                <option value="2">Rekanan</option>
                                <option value="3">PPN Potong Kontribusi & PPH Tambah Kontribusi</option>
                            </select>
                            <span class="text-danger error-text msoc_pajakfee_err"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="required form-label">Fee PPN</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                {{-- <input type="text" class="easyui-combobox" name="msoc_handlingfee" id="msoc_handlingfee" data-options="prompt:'Pilih'" style="width: 100%; height: 38px;" /> --}}
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_handlingfee" id="msoc_handlingfee" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($feeppn as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tampil }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_handlingfee_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="required form-label">Fee PPH 23</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_handlingfee2" id="msoc_handlingfee2" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($feepph as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tampil }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_handlingfee2_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Ujrah</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mujh_persen" id="msoc_mujh_persen" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($ujroh as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tampil }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mujh_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="required form-label">Managemen Fee</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mmfe_persen" id="msoc_mmfe_persen" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($mnfee as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tampil }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mmfe_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Overreding</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_overreding" id="msoc_overreding" data-placeholder="Pilih">
                                    <option></option>
                                    <option value="0">0</option>
                                    <option value="25">25</option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_overreding_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Kom. Tidak Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mkom_persen" id="msoc_mkom_persen" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($komtidakpot as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tipe }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mkom_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Kom. Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mkomdisc_persen" id="msoc_mkomdisc_persen" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($kompot as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tipe }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mkomdisc_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Referal</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_referal" id="msoc_referal" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($referal as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tipe }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="easyui-combobox" name="msoc_referal" id="msoc_referal" data-options="prompt:'Pilih',
                                url: '{{ url("api/tehnik/soc/entry-soc/select-referal") }}',
                                method: 'GET',
                                valueField: 'persen',
                                textField: 'tipe'," style="width: 100%; height: 38px;" /> --}}
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_referal_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Maintenance</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_maintenance" id="msoc_maintenance" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($maintenence as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tipe }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="easyui-combobox" name="msoc_maintenance" id="msoc_maintenance" data-options="prompt:'Pilih',
                                url: '{{ url("api/tehnik/soc/entry-soc/select-maintenence") }}',
                                method: 'GET',
                                valueField: 'persen',
                                textField: 'tipe'," style="width: 100%; height: 38px;" /> --}}
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_maintenance_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Fee Base Tidak Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mfee_persen" id="msoc_mfee_persen" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($fbtpot as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tipe }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="easyui-combobox" name="msoc_mfee_persen" id="msoc_mfee_persen" data-options="prompt:'Pilih',
                                url: '{{ url("api/tehnik/soc/entry-soc/select-feebtidakpotong") }}',
                                method: 'GET',
                                valueField: 'persen',
                                textField: 'tipe',
                                onSelect: function(rec){
                                    cekdiscrate();
                                }" style="width: 100%; height: 38px;" /> --}}
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mfee_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-5">
                        <label class="form-label">Fee Base Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mdr_kode" id="msoc_mdr_kode" data-placeholder="Pilih" data-allow-clear="true">
                                    <option></option>
                                    @foreach ($fbpot as $key => $data)
                                        <option value="{{ $data->persen }}">{{ $data->tipe }}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="easyui-combobox" name="msoc_mdr_kode" id="msoc_mdr_kode" data-options="prompt:'Pilih',
                                url: '{{ url("api/tehnik/soc/entry-soc/select-feebpotong") }}',
                                method: 'GET',
                                valueField: 'persen',
                                textField: 'tipe',
                                onSelect: function(rec){
                                    cekfeebase();
                                }" style="width: 100%; height: 38px;" /> --}}
                            </div>
                            <span class="input-group-text" style="height: 38px;">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mdr_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="form-label">Status SOC</label>
                            <select class="form-select form-select-solid" data-control="select2" name="msoc_status" id="msoc_status" data-placeholder="Pilih status SOC" data-allow-clear="true">
                                <option></option>
                                <option selected value="0">-</option>
                                <option value="1">SOC Migrasi Lapse</option>
                                <option value="2">SOC Migrasi Inforce</option>
                                <option value="3">Lapse</option>
                            </select>
                            <span class="text-danger error-text msoc_status_err"></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">No Surat Endors</label>
                        <input type="text" class="form-control form-control-solid" name="msoc_no_endors" id="msoc_no_endors" placeholder="No surat endors" />
                        <span class="text-danger error-text msoc_no_endors_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Keterangan Endors</label>
                        <textarea class="form-control form-control-solid" name="msoc_ket_endors" id="msoc_ket_endors" cols="3" rows="3" placeholder="Keterangan endors"></textarea>
                        <span class="text-danger error-text msoc_ket_endors_err"></span>
                    </div>
                </div>
            </div>

            <div class="separator my-10"></div>

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Nomor SOC</label>
                        <input type="text" class="form-control form-control-solid" name="msoc_nomor" id="msoc_nomor" placeholder="Nomor SOC" />
                        <span class="text-danger error-text msoc_nomor_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Kode SOC</label>
                        <input type="text" class="form-control form-control-solid" name="msoc_kode" id="msoc_kode" placeholder="Kode SOC" />
                        <span class="text-danger error-text msoc_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-5">
                        <label class="form-label">Import Tarif</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <select class="form-select form-select-solid" data-control="select2" name="msoc_jenis_tarif" id="msoc_jenis_tarif" data-placeholder="Pilih">
                                        <option></option>
                                        <option value="0">Usia</option>
                                        <option value="1">Masa</option>
                                    </select>
                                    <span class="text-danger error-text msoc_jenis_tarif_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="easyui-combobox" name="e_tarif" id="e_tarif" data-options="prompt:'Pilih jenis tarif'" style="width: 100%; height: 38px;" />
                                            {{-- <select class="form-select form-select-solid" data-control="select2" name="e_tarif" id="e_tarif" data-placeholder="Pilih tarif" data-allow-clear="true">
                                                <option></option>
                                                @foreach ($e_tarif as $key => $data)
                                                    <option value="{{ $data->kode }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select> --}}
                                            <input type="text" class="form-control form-control-solid" name="msoc_mth_nomor" id="msoc_mth_nomor" placeholder="msoc_mth_nomor" />
                                        </div>
                                    </div>
                                    <span class="text-danger error-text e_tarif_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <button type="button" id="importTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                    <button type="button" id="lihatTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-5">
                        <label class="form-label">Import Underwriting</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <select class="form-select form-select-solid" data-control="select2" name="msoc_tipe_uw" id="msoc_tipe_uw" data-placeholder="Pilih">
                                        <option></option>
                                        <option value="0">Usia</option>
                                        <option value="1">X+N</option>
                                    </select>
                                    <span class="text-danger error-text msoc_tipe_uw_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="text" class="easyui-combobox" name="e_uw" id="e_uw" data-options="prompt:'Pilih jenis underwriting'" style="width: 100%; height: 38px;" />
                                            {{-- <select class="form-select form-select-solid" data-control="select2" name="e_uw" id="e_uw" data-placeholder="Pilih underwriting" data-allow-clear="true">
                                                <option></option>
                                                @foreach ($e_uw as $key => $data)
                                                    <option value="{{ $data->kode }}">{{ $data->nama }}</option>
                                                @endforeach
                                            </select> --}}
                                            <input type="text" class="form-control form-control-solid" name="msoc_mpuw_nomor" id="msoc_mpuw_nomor" placeholder="msoc_mpuw_nomor" />
                                        </div>
                                    </div>
                                    <span class="text-danger error-text e_uw_err"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <button type="button" id="importUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                    <button type="button" id="lihatUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-5">
                        <label class="form-label">Dokumen SOC</label>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group input-group-solid mb-5">
                                    <input type="file" class="form-control" name="msoc_dok" id="msoc_dok" accept="application/pdf" placeholder="pilih file" />
                                    <button type="button" id="lihatDocSoc" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                </div>
                                <span class="text-danger error-text msoc_dok_err"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer text-center">
            <button type="submit" class="btn btn-primary btn-sm me-3" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
            <button type="button" class="btn btn-warning btn-sm" onclick="clear_f()"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </form>
    @include('pages.tehnik.soc.entry-soc.modal.program-asuransi')
    @include('pages.tehnik.soc.entry-soc.modal.import-tarif')
    @include('pages.tehnik.soc.entry-soc.modal.show-konfirmtarif')
    @include('pages.tehnik.soc.entry-soc.modal.lihat-tarif')
    @include('pages.tehnik.soc.entry-soc.modal.import-uw')
    @include('pages.tehnik.soc.entry-soc.modal.lihat-uw')
    @include('pages.tehnik.soc.entry-soc.modal.show-konfirmuw')
    @include('pages.tehnik.soc.entry-soc.modal.lihat-docsoc')
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            setTextReadOnly('mpid_nama', true);
            setTextReadOnly('e_pinca', true);
            setTextReadOnly('msoc_nomor', true);
            setTextReadOnly('msoc_kode', true);
            selectOpTag('mth_kolom');
            selectOpTag('mth_baris');
            selectOpTag('mpuw_baris');

            // setTextReq
            setTextReq('msoc_mrkn_nama', true);
            setTextReq('e_nasabah', true);
            setTextReq('msoc_mssp_nama', true);
            setTextReq('msoc_mekanisme', true);
            setTextReq('e_manfaat_pol', true);
            setTextReq('msoc_jenis_bayar', true);
            setTextReq('msoc_jns_perusahaan', true);
            setTextReq('e_manfaat', true);
            setTextReq('e_pras', true);
            setTextReq('msoc_mslr_kode', true);
            setTextReq('msoc_mpojk_kode', true);
            setTextReq('e_cabalamin', true);
            setTextReq('msoc_pajakfee', true);
            setTextReq('msoc_handlingfee', true);
            setTextReq('msoc_handlingfee2', true);
            setTextReq('e_tarif', true);
            setTextReq('e_uw', true);

            // setHide
            setHide('msoc_mrkn_kode', true);
            setHide('msoc_mpras_kode', true);
            setHide('msoc_mjns_kode', true);
            setHide('msoc_mjns_mpid_kode', true);
            setHide('e_bersih', true);
            setHide('msoc_mssp_kode', true);
            setHide('mpid_mssp_kode', true);
            setHide('msoc_approve', true);
            setHide('edit_akses', true);
            setHide('msoc_mft_kode', true);
            setHide('msoc_mjm_kode', true);
            setHide('msoc_mpid_kode', true);
            setHide('msoc_mlok_kode', true);
            setHide('endors', true);
            setHide('msoc_mkar_kode_mkr', true);
            setHide('msoc_mkar_kode_pim', true);
            setHide('msoc_mth_nomor', true);
            setHide('msoc_mpuw_nomor', true);

            cekForm(0);
            // change message Form SOC
            hidePesan('msoc_jenis_bayar');
            hidePesan('msoc_mslr_kode');
            hidePesan('msoc_dok');

            // Form Upload Tarif
            hidePesan('mth_tipe_pertanggungan');
            hidePesan('mth_ket');
            hidePesan('mth_tipe_rumus');
            hidePesan('mth_kolom');
            hidePesan('mth_baris');
            hidePesan('mth_file');

            // Form Update Upload Tarif
            hidePesan('mth_final');

            // Form Upload Uw
            hidePesan('mpuw_tipe_pertanggungan');
            hidePesan('mpuw_nama');
            hidePesan('mpuw_type_uw');
            hidePesan('mpuw_baris');
            hidePesan('mpuw_file');
        });

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });
            onSelect('msoc_jns_perusahaan', function(e) {
                var row = e.params.data;
                cekpolis();
            });
            // onSelect('msoc_mslr_kode', function(e) {
            //     var row = e.params.data;
            //     cekmanajemenfee();
            // });
            onSelect('msoc_mkom_persen', function(e) {
                var row = e.params.data;
                cekkomisi();
            });
            onSelect('msoc_mkomdisc_persen', function(e) {
                var row = e.params.data;
                cekkomisi();
            });
            onSelect('msoc_mfee_persen', function(e) {
                var row = e.params.data;
                cekdiscrate();
            });
            onSelect('msoc_mdr_kode', function(e) {
                var row = e.params.data;
                cekfeebase();
            });
            // onSelect('e_tarif', function(e) {
            //     var row = e.params.data;
            //     setText('msoc_mth_nomor', row.id);
            // });
            // onSelect('e_uw', function(e) {
            //     var row = e.params.data;
            //     setText('msoc_mth_nomor', row.id);
            //     setText('msoc_mpuw_nomor', row.id);
            // });

            selectGrid(
                'msoc_mrkn_nama',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-pmgpolis") }}',
                'nama',
                'nama',
                [
					{field:'kode',title:'Kode',align:'left',width:180},
					{field:'nama',title:'Nama',align:'left',width:280},
				],
                function(i, row) {
                    hidePesan('msoc_mrkn_nama');
                    var kode = row.kode;
                    if (getText('msoc_nomor')=='') {
                        setText('msoc_mrkn_kode', kode);
                        bersih(2);
                        bersih(1);
                    }
                }
            );
            selectGrid(
                'e_nasabah',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-jnsnasabah") }}',
                'mjns_kode',
                'mjns_keterangan',
                [
					{field:'mjns_keterangan',title:'Jenis Nasabah',align:'left',width:280},
					{field:'mjns_kode',title:'Kode Jns Nasabah',width:50,hidden:true},
					{field:'mjns_jl',title:'Joint Life',width:80,hidden:true},
					{field:'mjns_jl_pst',title:'Joint Life Peserta',width:80,hidden:true},
					{field:'mjns_jl_pas',title:'Joint Life Pasangan',width:80,hidden:true},
					{field:'mjns_wp_pens',title:'WP Pensiun',width:80,hidden:true},
					{field:'mjns_phk_pens',title:'PHK Pensiun',width:80,hidden:true},
				],
                function(i, row) {
                    hidePesan('e_nasabah');
                    setText('msoc_mjns_kode', row.mjns_kode);
                    setText('msoc_mjns_mpid_kode', row.mjns_mpid_nomor);

                    setText('msoc_mssp_nama', '');
                    reSelBox('msoc_mssp_nama', '{{ url("api/tehnik/soc/entry-soc/select-segmen") }}' + '?' + '&mjns=' + getText("e_nasabah"));

                    var rms = '&mjns='+getText("msoc_mjns_kode")+'&mft='+getText("msoc_mft_kode")+'&mrkn='+getText("msoc_mrkn_kode")+'&mssp='+getText("msoc_mssp_kode")+'&mkm='+getText("msoc_mekanisme")+'&mkm2='+getText("msoc_mekanisme2")+'&perush='+getText("msoc_jns_perusahaan")+'&byr='+getText("msoc_jenis_bayar")+'&mjm='+getText("msoc_mjm_kode")+'&mpid='+getText("msoc_mpid_kode");

                    reSelGrid('e_pras', '{{ url("api/tehnik/soc/entry-soc/pilih-program-asuransi") }}' + '?' + rms);
				    reSelGrid('e_manfaat_pol','{{ url("api/tehnik/soc/entry-soc/select-manasu") }}' + '?' + '&mjns=' + getText("msoc_mjns_kode"));
                }
            );
            selectBox('msoc_mssp_nama', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-segmen") }}', 'value', 'text', function(rec) {
                hidePesan('msoc_mssp_nama');
                setsegmen(rec);
            }, 'group');
            selectGrid(
                'msoc_mspaj_nama',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-nospaj") }}',
                'mspaj_nomor',
                'mspaj_nomor',
                [
                    {field:'mspaj_keterangan',title:'Keterangan',width:120},
					{field:'mspaj_nomor',title:'Nomor Spaj',width:300},
				],
                function(i, row) {
                    setText('msoc_mspaj_nomor', row.mspaj_nomor);
                }
            );
            selectBox('msoc_mekanisme', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-meka1") }}', 'mkm_kode', 'mkm_nama', function(rec) {
                hidePesan('msoc_mekanisme');
            });
            selectBox('msoc_mekanisme2', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-meka2") }}', 'mkm_kode2', 'mkm_ket2');
            selectBox('msoc_jns_perusahaan', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-jnskerja") }}', 'mker_kode', 'mker_nama', function(rec) {
                hidePesan('msoc_jns_perusahaan');
                cekpolis();
            });
            selectGrid(
                'e_manfaat_pol',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-manasu") }}',
                'kode',
                'nama',
                [
					{field:'kode',title:'Kode',width:120},
					{field:'nama',title:'Manfaat',width:300},
				],
                function(i, row) {
                    hidePesan('e_manfaat_pol');
				    setText("msoc_mft_kode",row.kode);
                }
            );
            selectGrid(
                'e_manfaat',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-jamiasu") }}',
                'mjm_kode',
                'mjm_nama',
                [
					{field:'mjm_nama',title:'Manfaat',align:'left',width:80},
					{field:'mpid_nama',title:'Produk Induk',align:'left',width:280},
					{field:'mjm_kode',title:'Kode',width:60,hidden:true},
					{field:'mjm_bundling',title:'Bundling',width:80,hidden:true},
					{field:'mjm_jiwa',title:'jiwa',width:180,hidden:true},
					{field:'mjm_gu',title:'gu',width:50,hidden:true},
					{field:'mjm_phk',title:'phk',width:50,hidden:true},
					{field:'mjm_tlo',title:'tlo',width:50,hidden:true},
					{field:'mjm_fire',title:'fire',width:50,hidden:true},
					{field:'mjm_wp',title:'wp',width:50,hidden:true},
					{field:'mjm_umut',title:'umut',width:50,hidden:true},
					{field:'mjm_wp_pensiun',title:'wp_pens',width:50,hidden:true},
					{field:'mjm_phk_pensiun',title:'phk_pens',width:50,hidden:true},
				],
                function(i, row) {
                    hidePesan('e_manfaat');
                    setText('msoc_mjm_kode', row.mjm_kode);
                    setText('msoc_mpid_kode', row.mpid_kode);
                    setText('mpid_nama', row.mpid_nama);

                    var rms = '&mjns='+getText("msoc_mjns_kode")+'&mft='+getText("msoc_mft_kode")+'&mrkn='+getText("msoc_mrkn_kode")+'&mssp='+getText("msoc_mssp_kode")+'&mkm='+getText("msoc_mekanisme")+'&mkm2='+getText("msoc_mekanisme2")+'&perush='+getText("msoc_jns_perusahaan")+'&byr='+getText("msoc_jenis_bayar")+'&mjm='+getText("msoc_mjm_kode")+'&mpid='+getText("msoc_mpid_kode");

                    reSelGrid('e_pras', '{{ url("api/tehnik/soc/entry-soc/pilih-program-asuransi") }}' + '?' + rms);

				    muncul(row.mjm_bundling,row.mjm_jiwa,row.mjm_gu,row.mjm_phk,row.mjm_tlo,row.mjm_fire,row.mjm_wp,row.mjm_umut,row.mjm_wp_pensiun,row.mjm_phk_pensiun);
                }
            );
            selectGrid(
                'e_pras',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/pilih-program-asuransi") }}',
                'mpras_kode',
                'mpras_nama',
                [
					{field:'mpras_nama',title:'Program Asuransi',align:'left',width:280},
					{field:'msoc_kode',title:'Nomor SOC',align:'left',width:280},
					{field:'mpras_kode',title:'Kode Program Asuransi',width:50,hidden:false},
					{field:'mpras_uptambah',title:'UP Tambahan',width:80,hidden:false},
					{field:'mpras_ujrah_referal',title:'Ujrah Referal',width:80,hidden:false},
					{field:'mpras_disc_rate',title:'Discount Rate',width:50,hidden:false},
					{field:'mpras_mmft_kode_jiwa',title:'Tambahan Jiwa',width:50,hidden:false},
				],
                function(i, row) {
                    hidePesan('e_pras');
                    var kode_soc = row.msoc_kode;
                    setText('msoc_mpras_kode', row.mpras_kode);
                    setText("mpras_ket", row.mpras_info);
                    setText("msoc_kode", row.msoc_kode);
                    muncul1(row.mpras_uptambah,row.mpras_ujrah_referal,row.mpras_discrate,row.mpras_mmft_kode_jiwa);
                    e_leave('msoc_kode');
                }
            );
            selectBox('msoc_mslr_kode', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-salurandistribusi") }}', 'mslr_kode', 'mslr_ket', function(rec) {
                hidePesan('msoc_mslr_kode');
                cekmanajemenfee();
            });
            selectBox('msoc_mpojk_kode', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-prodojk") }}', 'mpojk_kode', 'mpojk_nama', function(rec) {
                hidePesan('msoc_mpojk_kode');
            });
            selectGrid(
                'e_cabalamin',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-cabalamin") }}',
                'kode',
                'nama',
                [
					{field:'kode',title:'Kode Cabang',width:60},
					{field:'nama',title:'Nama Cabang',align:'left',width:150},
				],
                function(i, row) {
                    hidePesan('e_cabalamin');
                    var kode = row.kode;
                    setText("msoc_mlok_kode",kode);
                    setText("msoc_mkar_kode_pim",row.kd_pinca);
                    setText("e_pinca",row.nm_pinca);
                    reSelGrid("e_marketing",'{{ url("api/tehnik/soc/entry-soc/select-marketing") }}' + '?mlok=' + kode);
                }
            );
            selectGrid(
                'e_marketing',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-marketing") }}',
                'kode',
                'nama',
                [
					{field:'kode',title:'NIP',width:60},
					{field:'nama',title:'Nama Marketing',align:'left',width:280},
					{field:'skar_komisi',title:'Tipe Komisi',width:50,hidden:true},
					{field:'skar_overreding',title:'Tipe Overreding',width:50,hidden:true},
				],
                function(i, row) {
                    hidePesan('e_marketing');
                    var kode = row.kode;
                    setText("msoc_mkar_kode_mkr",kode);
                    muncul4(row.skar_komisi,row.skar_overreding);
                }
            );
            // selectBox('msoc_handlingfee', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-feeppn") }}', 'persen', 'tampil', function(rec) {
            //     hidePesan('msoc_handlingfee');
            // });
            // selectBox('msoc_handlingfee2', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-feepph23") }}', 'persen', 'tampil', function(rec) {
            //     hidePesan('msoc_handlingfee2');
            // });
            // selectBox('msoc_mujh_persen', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-ujroh") }}', 'persen', 'tampil');
            // selectBox('msoc_mmfe_persen', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-mnfee") }}', 'persen', 'tampil');
            // selectBox('msoc_mkom_persen', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-komtidakpot") }}', 'persen', 'tipe', function(rec) {
            //     cekkomisi();
            // });
            // selectBox('msoc_mkomdisc_persen', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-kompot") }}', 'persen', 'tipe', function(rec) {
            //     cekkomisi();
            // });
            // selectBox('msoc_referal', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-referal") }}', 'persen', 'tipe');
            // selectBox('msoc_maintenance', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-maintenence") }}', 'persen', 'tipe');
            // selectBox('msoc_mfee_persen', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-feebtidakpotong") }}', 'persen', 'tipe', function(rec) {
            //     cekdiscrate();
            // });
            // selectBox('msoc_mdr_kode', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-feebpotong") }}', 'persen', 'tipe', function(rec) {
            //     cekfeebase();
            // });
            selectBox('e_tarif', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-tarifimport") }}', 'kode', 'nama', function(rec) {
                hidePesan('e_tarif');
                setText('msoc_mth_nomor', rec.kode);
            });
            selectBox('e_uw', 'POST', '{{ url("api/tehnik/soc/entry-soc/select-underwritingimport") }}', 'kode', 'nama', function(rec) {
                hidePesan('e_tarif');
                setText('msoc_mpuw_nomor', rec.kode);
            });

            $('body').on('click', '#importTarif', function() {
                openModal('modalTarif');
                titleAction('titleTarif', 'Upload File Table Tarif');
                clearForm('frxx_uploadTarif');
            });

            $('body').on('click', '#lihatTarif', function() {
                var kode = getText('msoc_mth_nomor');
                if (kode !== "" && kode !== null) {
                    openModal('modalLihatTarif');
                    titleAction('titleLihatTarif', 'Table Tarif');
                    showTarifTable("listTableTarif", kode);
                } else {
                    message(
                        'error',
                        'Oops...',
                        'Pilih dulu ketentuan tarif!'
                    );
                }
            });

            $('body').on('click', '#lihatUw', function() {
                var kode = getText('msoc_mpuw_nomor');
                if (kode !== "" && kode !== null) {
                    openModal('modalLihatUw');
                    titleAction('titleLihatUw', 'Table Uw');
                    showUwTable("listTableUw", kode);
                } else {
                    message(
                        'error',
                        'Oops...',
                        'Pilih dulu ketentuan uw!'
                    );
                }
            });

            $('body').on('click', '#importUw', function() {
                openModal('modalUw');
                titleAction('titleUw', 'Upload File Table Uw');
                clearForm('frxx_uploadUw');
            });

            $('body').on('click', '#lihatDocSoc', function() {
                var file = getText('msoc_dok');
                if (file == null || file == "") {
                    message(
                        "error",
                        "Ops..",
                        "File dokumen kosong, harap di isi dulu!"
                    );
                } else {
                    openModal('modalLihatDoc');
                    titleAction('titleLihatDoc', 'Lihat Dokumen');
                    setText('current_page', 1);
                }
            });

            viewPdf(
                "msoc_dok",
                "viewPdfFile",
                "go_previous",
                "go_next",
                "current_page",
                "tot_page",
                "zoom_in",
                "zoom_out"
            );

            submitForm(
                "frxx_soc",
                "btn_simpan",
                "POST",
                "{{ route('tehnik.soc.entry-soc.store') }}",
                (resSuccess) => {
                    var getEds = getText('endors');
                    cekForm(getEds);
                    bsimpan("btn_simpan", 'Simpan');
                },
                (resError) => {
                    console.log(resError);
                },
            );

            submitImportSoc(
                "frxx_uploadTarif",
                "btnImportTarif_simpan",
                "Apakah data yang di upload sudah benar?",
                "{{ url('api/tehnik/soc/entry-soc/upload-tarif') }}",
                "kode_import_tarif",
                (res) => {
                    clearForm("frxx_uploadTarif");
                    bsimpan('btnImportTarif_simpan', 'Simpan');
                    closeModal("modalTarif");
                    openModal("modalShowKonfirmTarif");
                    titleAction("titleShowKonfirmTarif", "Konfirmasi Tabel Tarif");
                    var kode = getText("kode_import_tarif");
                    showTarifTable("showTarif", kode);
                    reSelBox('e_tarif', '{{ url("api/tehnik/soc/entry-soc/select-tarifimport") }}');
                },
            );

            submitForm(
                "frxx_tarifKonfim",
                "btnTarifKonfim_simpan",
                "POST",
                "{{ url('api/tehnik/soc/entry-soc/update-upload-tarif') }}",
                (resSukses) => {
                    clearForm("frxx_tarifKonfim");
                    bsimpan('btnTarifKonfim_simpan', 'Simpan');
                    closeModal("modalShowKonfirmTarif");
                    reSelBox('e_tarif', '{{ url("api/tehnik/soc/entry-soc/select-tarifimport") }}');
                },
                (resError) => {
                    console.log(resError);
                },
            );

            submitImportSoc(
                "frxx_uploadUw",
                "btnImportUw_simpan",
                "Apakah data yang di upload sudah benar?",
                "{{ url('api/tehnik/soc/entry-soc/upload-uw') }}",
                "kode_import_uw",
                (res) => {
                    clearForm("frxx_uploadUw");
                    bsimpan('btnImportUw_simpan', 'Simpan');
                    closeModal("modalUw");
                    openModal("modalShowKonfirmUw");
                    titleAction("titleShowKonfirmUw", "Konfirmasi Tabel UW");
                    var kode = getText("kode_import_uw");
                    showUwTable("showUw", kode);
                    reSelBox('e_uw', '{{ url("api/tehnik/soc/entry-soc/select-underwritingimport") }}');
                },
            );

            submitForm(
                "frxx_uwKonfim",
                "btnUwKonfim_simpan",
                "POST",
                "{{ url('api/tehnik/soc/entry-soc/update-upload-uw') }}",
                (resSukses) => {
                    clearForm("frxx_uwKonfim");
                    bsimpan('btnUwKonfim_simpan', 'Simpan');
                    closeModal("modalShowKonfirmUw");
                    reSelBox('e_uw', '{{ url("api/tehnik/soc/entry-soc/select-underwritingimport") }}');
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });


        function cekForm(tipe) {
            clear_f();
            if (tipe=='0') {
                $('#btnBru').addClass('active');
                $('#btnEds').removeClass('active');
                $('#btnEdt').removeClass('active');
                $('#btnBtl').removeClass('active');
                toster('success', 'Tombol Buat SOC Baru Telah Aktif', 5000, 2);
                titleAction('title_action', 'Buat SOC Baru');
                // setTextReadOnly('msoc_mrkn_nama',false);
                // setTextReadOnly('e_manfaat_pol',false);
                // setTextReadOnly('e_nasabah',false);
                // setTextReadOnly('msoc_mssp_nama',false);
                // setTextReadOnly('msoc_jns_perusahaan',false);
                setTextReadOnly('msoc_mpras_kode',false);
                setTextReadOnly('msoc_mrkn_nama',false);
                setTextReadOnly('msoc_mrkn_kode',false);
                setTextReadOnly('e_nasabah',false);
                setTextReadOnly('msoc_mspaj_nama',false);
                setTextReadOnly('msoc_mft_kode',false);
                setTextReadOnly('e_manfaat',false);
                setTextReadOnly('e_manfaat_pol',false);
                setTextReadOnly('msoc_mssp_nama',false);
                setTextReadOnly('msoc_jenis_bayar',false);
                setTextReadOnly('msoc_mekanisme',false);
                setTextReadOnly('msoc_mspaj_nomor',true);
            }

            if (tipe=='1') {
                $('#btnEdt').addClass('active');
                $('#btnBru').removeClass('active');
                $('#btnEds').removeClass('active');
                $('#btnBtl').removeClass('active');
                toster('success', 'Tombol SOC Edit Telah Aktif', 5000, 2);
                titleAction('title_action', 'SOC Edit');
                // setTextReadOnly('e_manfaat_pol',false);
                // setTextReadOnly('msoc_mrkn_nama',false);
                // setTextReadOnly('e_nasabah',false);
                setTextReadOnly('msoc_mspaj_nomor',false);
                // setTextReadOnly('msoc_mssp_nama',false);
                // setTextReadOnly('msoc_jns_perusahaan',false);
                setTextReadOnly('msoc_mpras_kode',false);
                setTextReadOnly('msoc_mrkn_nama',false);
                setTextReadOnly('msoc_mrkn_kode',false);
                setTextReadOnly('e_nasabah',false);
                setTextReadOnly('msoc_mspaj_nama',false);
                setTextReadOnly('msoc_mft_kode',false);
                setTextReadOnly('e_manfaat',false);
                setTextReadOnly('e_manfaat_pol',false);
                setTextReadOnly('msoc_mssp_nama',false);
                setTextReadOnly('msoc_jenis_bayar',false);
                setTextReadOnly('msoc_mekanisme',false);
            }

            if (tipe=='2') {
                $('#btnEds').addClass('active');
                $('#btnBru').removeClass('active');
                $('#btnEdt').removeClass('active');
                $('#btnBtl').removeClass('active');
                toster('success', 'Tombol SOC Endors Telah Aktif', 5000, 2);
                titleAction('title_action', 'SOC Endors');
                // setTextReadOnly('msoc_mrkn_nama',false);
                // setTextReadOnly('e_nasabah',false);
                // setTextReadOnly('e_manfaat_pol',false);
                setTextReadOnly('msoc_mspaj_nomor',false);
                // setTextReadOnly('msoc_mssp_nama',false);
                // setTextReadOnly('msoc_jns_perusahaan',false);
                setTextReadOnly('msoc_mpras_kode',false);
                setTextReadOnly('msoc_mrkn_nama',false);
                setTextReadOnly('msoc_mrkn_kode',false);
                setTextReadOnly('e_nasabah',false);
                setTextReadOnly('msoc_mspaj_nama',false);
                setTextReadOnly('msoc_mft_kode',false);
                setTextReadOnly('e_manfaat',false);
                setTextReadOnly('e_manfaat_pol',false);
                setTextReadOnly('msoc_mssp_nama',false);
                setTextReadOnly('msoc_jenis_bayar',false);
                setTextReadOnly('msoc_mekanisme',false);
            }

            if (tipe=='3') {
                $('#btnBtl').addClass('active');
                $('#btnBru').removeClass('active');
                $('#btnEdt').removeClass('active');
                $('#btnEds').removeClass('active');
                toster('success', 'Tombol SOC Batal Telah Aktif', 5000, 2);
                titleAction('title_action', 'SOC Batal');
                // setTextReadOnly('msoc_mrkn_nama',false);
                // setTextReadOnly('e_nasabah',false);
                setTextReadOnly('msoc_mspaj_nomor',false);
                // setTextReadOnly('e_manfaat_pol',false);
                // setTextReadOnly('msoc_mssp_nama',false);
                // setTextReadOnly('msoc_jns_perusahaan',false);
                setTextReadOnly('msoc_mpras_kode',false);
                setTextReadOnly('msoc_mrkn_nama',false);
                setTextReadOnly('msoc_mrkn_kode',false);
                setTextReadOnly('e_nasabah',false);
                setTextReadOnly('msoc_mspaj_nama',false);
                setTextReadOnly('msoc_mft_kode',false);
                setTextReadOnly('e_manfaat',false);
                setTextReadOnly('e_manfaat_pol',false);
                setTextReadOnly('msoc_mssp_nama',false);
                setTextReadOnly('msoc_jenis_bayar',false);
                setTextReadOnly('msoc_mekanisme',false);
            }
            setText('endors',tipe);
	        // reSelGrid('msoc_mrkn_nama','{{ url("api/tehnik/soc/entry-soc/select-pmgpolis") }}' + '?tipe=' + tipe);
        }

        function setsegmen(rec) {
            setText('msoc_mssp_kode', rec.value);
            reSelGrid('e_manfaat','{{ url("api/tehnik/soc/entry-soc/select-jamiasu") }}' + '?' + '&mssp=' + rec.value + '&mjns=' + getText("msoc_mjns_kode"));
        }

        function cekpolis() {
            rms = '&pmgpolis='+getText('msoc_mrkn_kode')+'&perus='+getText('msoc_jns_perusahaan')+'&mekanisme2='+getText('msoc_mekanisme2')+'&mekanisme='+getText('msoc_mekanisme')+'&jns_bayar='+getText('msoc_jenis_bayar')+'&nasabah='+getText('msoc_mjns_kode')+'&mrkn_nama='+getText('msoc_mrkn_nama')+'&mft='+getText('msoc_mft_kode');

            url = '{{ url("api/tehnik/soc/entry-soc/get-nosoc") }}' + '?' + rms;
            $.get(url, function(data){
                if (data) {
                    jsonForm('frxx_soc', data);
                }
            });
        }

        function muncul(bandling,jiwa,gu,phk,tlo,fire,wp,umut,ujrf,discrate,wp_pens,phk_pens) {
            setTextReadOnly('msoc_mmft_kode_gu',true);
            if (gu=='1') {
                setTextReadOnly('msoc_mmft_kode_gu',false);
            }

            setTextReadOnly('msoc_mmft_kode_wp_pensiun',false);
            if (wp_pens=='1') {
                setTextReadOnly('msoc_mmft_kode_wp_pensiun',true);
            }

            setTextReadOnly('msoc_mmft_kode_wp_swasta',true);
            if (wp=='1') {
                setTextReadOnly('msoc_mmft_kode_wp_swasta',false);
            }

            setTextReadOnly('msoc_mmft_kode_wp_pns',true);
            if (wp=='1') {
                setTextReadOnly('msoc_mmft_kode_wp_pns',false);
            }

            setTextReadOnly('msoc_mmft_kode_phk_pensiun',false);
            if (phk_pens=='1') {
                setTextReadOnly('msoc_mmft_kode_phk_pensiun',true);
            }

            setTextReadOnly('msoc_mmft_kode_phk_swasta',true);
            if (phk=='1') {
                setTextReadOnly('msoc_mmft_kode_phk_swasta',false);
            }

            setTextReadOnly('msoc_mmft_kode_phk_pns',true);
            if (phk=='1') {
                setTextReadOnly('msoc_mmft_kode_phk_pns',false);
            }

            setTextReadOnly('msoc_mmft_kode_tlo',true);
            if (tlo=='1') {
                setTextReadOnly('msoc_mmft_kode_tlo',false);
            }

            setTextReadOnly('msoc_mmft_kode_fire',true);
            if (fire=='1') {
                setTextReadOnly('msoc_mmft_kode_fire',false);
            }
        }

        function muncul1(uptambah,ujrah_referal,discrate,mmft_kode_jiwa) {
            setTextReadOnly('msoc_mmft_kode_jiwa',true);
            if (mmft_kode_jiwa=='1') {
                setTextReadOnly('msoc_mmft_kode_jiwa',false);
            }

            setTextReadOnly('msoc_mut_kode',true);
            if (uptambah=='1') {
                setTextReadOnly('msoc_mut_kode',false);
            }

            setTextReadOnly('msoc_mujhrf_kode',true);
            if (ujrah_referal=='1') {
                setTextReadOnly('msoc_mujhrf_kode',false);
            }

            setTextReadOnly('msoc_mdr_kode',false);
            if (discrate=='1') {
                setTextReadOnly('msoc_mdr_kode',true);
            }
        }

        function muncul4(skar_komisi,skar_overreding)
        {
            setTextReadOnly('msoc_mkom_persen', false);
            if (skar_komisi=='1') {
                setTextReadOnly('msoc_mkom_persen', true);
            }
            setTextReadOnly('msoc_overreding', false);
            if (skar_overreding=='1') {
                setTextReadOnly('msoc_overreding', true);
            }
        }

        function e_leave(id) {
            var rms='';
            var url='';

            if (id=='msoc_kode') {
                var aksess = getText('edit_akses');
                var tipe = getText('endors');
                rms = '&pmgpolis='+getText('msoc_mrkn_kode')+'&nopolis='+getText('msoc_nomor')+'&nasabah='+getText('msoc_mjns_kode')+'&mft='+getText('msoc_mft_kode')+'&mjm='+getText('msoc_mjm_kode')+'&mekanisme='+getText('msoc_mekanisme')+'&jns_bayar='+getText('msoc_jenis_bayar')+'&jns_perusahaan='+getText('msoc_jns_perusahaan')+'&mrkn_nama='+getText('msoc_mrkn_nama')+'&mekanisme2='+getText('msoc_mekanisme2')+'&kode='+getText('msoc_kode')+'&pras='+getText('msoc_mpras_kode')+'&endos='+getText('endors');

                url = '{{ url("api/tehnik/soc/entry-soc/get-kodesoc") }}' + '?id=' + id + rms;
                $.get(url, function(data) {
                    // console.log(data);
                    if (data) {
                        if(tipe=='1' && data.msoc_mlsr_kode=='4') {
                            setTextReadOnly('msoc_mkom_persen',true);
                            setTextReadOnly('msoc_overreding',true);
                            setTextReadOnly('msoc_mmfe_persen',false);
                        }

                        if(tipe=='1' && data.msoc_mkar_kode_mkr=='1010003') {
                            setTextReadOnly('msoc_mkom_persen',true);
                            setTextReadOnly('msoc_overreding',true);
                            setTextReadOnly('msoc_mmfe_persen',true);
                        } else {
                            setTextReadOnly('msoc_mkom_persen',false);
                            setTextReadOnly('msoc_overreding',false);
                            setTextReadOnly('msoc_mmfe_persen',false);
                        }

                        if (tipe=='1' && aksess=='0') {
                            pesan('Maaf Anda Tidak Punya Hak Akses');
                            clear_f();
                        } else {
                            if (getText('msoc_kode')!="" && tipe=="0") {
                                pesan('Data sudah pernah di input dengan nomor: '+getText('msoc_kode'));
                                clear_f();
                            } else {
                                tanya();
                            }

                            if (tipe!='0') {
                                setText('e_bersih','1');
                                jsonForm('frxx_soc', data);
                                console.log(data);
                                //coba form file
                                // $('#ffile').form('load',data);
                                setText('e_bersih','');
                                setReadEdit(true);
                            }
                        }
                    }
                });
            }
        }

        function tanya() {
            if (getText('e_pras')=='1') {
                setTextReadOnly('e_pras', true);
                setTextReadOnly('msoc_mpras_kode',true);
                setTextReadOnly('msoc_mrkn_nama',true);
                setTextReadOnly('msoc_mrkn_kode',true);
                setTextReadOnly('e_nasabah',true);
                setTextReadOnly('msoc_mspaj_nama',true);
                setTextReadOnly('msoc_mft_kode',true);
                setTextReadOnly('e_manfaat',true);
                setTextReadOnly('e_manfaat_pol',true);
                setTextReadOnly('msoc_mssp_nama',true);
                setTextReadOnly('msoc_jenis_bayar',true);
                setTextReadOnly('msoc_mekanisme',true);
                messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI ADALAH PROGRAM YANG TIDAK MEMBERIKAN KOMISI KEPADA PEMEGANG POLIS ?', (result) => {
                    if (result.isConfirmed) {
                        setTextReadOnly('e_pras', true);
                    } else if (result.isDenied) {
                        setTextReadOnly('e_pras', false);
                    }
                });
            }

            if (getText('e_pras')=='2') {
                setTextReadOnly('e_pras',true);
                setTextReadOnly('msoc_mpras_kode',true);
                setTextReadOnly('msoc_mrkn_nama',true);
                setTextReadOnly('msoc_mrkn_kode',true);
                setTextReadOnly('e_nasabah',true);
                setTextReadOnly('e_manfaat_pol',true);
                setTextReadOnly('msoc_mspaj_nama',true);
                setTextReadOnly('msoc_mft_kode',true);
                setTextReadOnly('e_manfaat',true);
                setTextReadOnly('msoc_mssp_nama',true);
                messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI MEMBERIKAN KOMISI KEPADA PEMEGANG POLIS ?', (result) => {
                    if (result.isConfirmed) {
                        setTextReadOnly('e_pras',true);
                    } else if (result.isDenied) {
                        setTextReadOnly('e_pras',false);
                    }
                });
            }

            if (getText('e_pras')=='3') {
                setTextReadOnly('e_pras',true);
                setTextReadOnly('msoc_mpras_kode',true);
                setTextReadOnly('msoc_mrkn_nama',true);
                setTextReadOnly('msoc_mrkn_kode',true);
                setTextReadOnly('e_nasabah',true);
                setTextReadOnly('e_manfaat_pol',true);
                setTextReadOnly('msoc_mspaj_nama',true);
                setTextReadOnly('msoc_mft_kode',true);
                setTextReadOnly('e_manfaat',true);
                setTextReadOnly('msoc_mssp_nama',true);
                messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI MEMBERIKAN MANFAAT TAMBAHAN UANG PERTANGGUNGAN DAN KOMISI KEPADA PEMEGANG POLIS ?', (result) => {
                    if (result.isConfirmed) {
                        setTextReadOnly('e_pras', true);
                    } else if (result.isDenied) {
                        setTextReadOnly('e_pras', false);
                    }
                });
            }

            if (getText('e_pras')=='4') {
                setTextReadOnly('e_pras',true);
                setTextReadOnly('msoc_mpras_kode',true);
                setTextReadOnly('msoc_mrkn_nama',true);
                setTextReadOnly('msoc_mrkn_kode',true);
                setTextReadOnly('e_nasabah',true);
                setTextReadOnly('e_manfaat_pol',true);
                setTextReadOnly('msoc_mspaj_nama',true);
                setTextReadOnly('msoc_mft_kode',true);
                setTextReadOnly('e_manfaat',true);
                setTextReadOnly('msoc_mssp_nama',true);
                messageValid('APAKAH ANDA YAKIN PROGRAM ASURANSI INI HANYA MEMBERIKAN MANFAAT TAMBAHAN UANG PERTANGGUNGAN KEPADA PEMEGANG POLIS ?', (result) => {
                    if (result.isConfirmed) {
                        setTextReadOnly('e_pras', true);
                    } else if (result.isDenied) {
                        setTextReadOnly('e_pras', false);
                    }
                });
            }
        }

        function cekkomisi() {
            var xkompot=getText("msoc_mkomdisc_persen");
            var xkomtdkpot=getText("msoc_mkom_persen");

            if(xkomtdkpot==0) {
                setTextReadOnly("msoc_mkomdisc_persen",false);
                setTextReadOnly("msoc_mkom_persen",false);
            }

            if(xkomtdkpot>0) {
                setTextReadOnly("msoc_mkom_persen",false);
                setTextReadOnly("msoc_mkomdisc_persen",true);
                setText("msoc_mkomdisc_persen","0");
            }

            if(xkompot>0) {
                setTextReadOnly("msoc_mkom_persen",true);
                setTextReadOnly("msoc_mkomdisc_persen",false);
                setText("msoc_mkom_persen","0");
                pesan("Apakah anda yakin komisi mengurangi kontribusi Tagih/Netto ??");
            }
        }

        function cekdiscrate() {
            setTextReadOnly('msoc_mdr_kode', true);
            if (getText('msoc_mfee_persen')==0) {
                setTextReadOnly('msoc_mfee_persen', true);
                setTextReadOnly('msoc_mdr_kode', false);
                pesan('Silakan Isi Discount Rate Jika anda yakin kontribusi dibayarkan Nett');
            } else {
                pesan('Apakah Anda Yakin kontribusi dibayarkan Gross?? ');
            }
        }

        function cekfeebase() {
            setTextReadOnly('msoc_mfee_persen', true);
            if (getText('msoc_mdr_kode')==0) {
                setTextReadOnly('msoc_mdr_kode', true);
                setTextReadOnly('msoc_mfee_persen', false);
                pesan('Silakan Isi Fee Base Jika anda yakin kontribusi dibayarkan Gross');
            } else {
                pesan('Apakah Anda Yakin kontribusi dibayarkan Nett?? ');
            }
        }

        function setReadEdit(sts) {
            setTextReadOnly('e_manfaat', sts);
            setTextReadOnly('e_pras', sts);
            setTextReadOnly('msoc_mft_kode', sts);
            setTextReadOnly('msoc_mjns_kode', sts);
        }

        function cekmanajemenfee() {
            if (getText("msoc_mslr_kode")!=="4") {
                setTextReadOnly("msoc_mmfe_persen",true);
            } else {
                setTextReadOnly("msoc_mmfe_persen",false);
            }
        }

        function clear_f() {
            clearForm('frxx_soc');
            clearForm('frxx_uploadTarif');
            clearForm('frxx_uploadUw');
            bsimpan('btn_simpan', 'Simpan');
            setText('sjab_editsoc','1');

            setText('msoc_mujh_persen', '0');
            setText('msoc_mmfe_persen', '0');
            setText('msoc_overreding', '0');
            setText('msoc_mkom_persen', '0');
            setText('msoc_referal', '0');
            setText('msoc_maintenance', '0');
            setText('msoc_mfee_persen', '0');
            setText('msoc_mdr_kode', '0');

            setText('msoc_mujhrf_kode', '0');
            setText('msoc_mut_kode', '0');
            //setText('msoc_pajakfee','0');
            //setText('msoc_ket_endors','-');
            setText('msoc_no_endors', '-');
            setText('msoc_tipe_uw', '0');
            // setCombo('typerpt', 'web');
            //$("#xtanya").hide();
            setReadEdit(false);
        }

        // function e_pras() {
        //     setTextReadOnly('e_pras', false);
        //     setTextReadOnly('msoc_mpras_kode',false);
        //     setTextReadOnly('msoc_mrkn_nama',false);
        //     setTextReadOnly('msoc_mrkn_kode',false);
        //     setTextReadOnly('e_nasabah',false);
        //     setTextReadOnly('msoc_mspaj_nama',false);
        //     setTextReadOnly('msoc_mft_kode',false);
        //     setTextReadOnly('e_manfaat',false);
        //     setTextReadOnly('e_manfaat_pol',false);
        //     setTextReadOnly('msoc_mssp_nama',false);
        //     setTextReadOnly('msoc_jenis_bayar',false);
        //     setTextReadOnly('msoc_mekanisme',false);
        // }

        function bersih(tipe) {
            if (getText('e_bersih')=='1') {
                return;
            }
            if (tipe==1) {
                setText('e_manfaat', '');
                setText('e_pras', '');
                setText('msoc_nomor', '');
                setText('msoc_mpras_kode', '');
                setText('msoc_mjm_kode', '');
            }
            if (tipe==2) {
                setText('msoc_mrkn_nama', '');
            }
        }

        function close_mTarif() {
            closeModal('modalTarif');
            clearForm('frxx_uploadTarif');
        }

        function close_mUw() {
            closeModal('modalUw');
            clearForm('frxx_uploadUw');
        }

        function close_lihatDoc() {
            closeModal('modalLihatDoc');
            $('#lihatFileDoc').attr("data","");
        }

        function close_mTarif() {
            closeModal('modalTarif');
            clearForm('frxx_uploadTarif');
        }

        function close_mUw() {
            closeModal('modalUw');
            clearForm('frxx_uploadUw');
        }

        function close_lihatDoc() {
            closeModal('modalLihatDoc');
            $('#lihatFileDoc').attr("data","");
        }

        function showTarifTable(idTable, kode) {
            dtTable(
                idTable,
                false,
                "{{ url('api/tehnik/soc/entry-soc/lihat-tarif') }}" + "/" + kode,
                [
                    { data: "DT_RowIndex", className: "text-center" },
                    { data: "mstuj_1", className: "text-center" },
                    { data: "mstuj_2", className: "text-center" },
                    { data: "mstuj_3", className: "text-center" },
                    { data: "mstuj_4", className: "text-center" },
                    { data: "mstuj_5", className: "text-center" },
                    { data: "mstuj_6", className: "text-center" },
                    { data: "mstuj_7", className: "text-center" },
                    { data: "mstuj_8", className: "text-center" },
                    { data: "mstuj_9", className: "text-center" },
                    { data: "mstuj_10", className: "text-center" },
                    { data: "mstuj_11", className: "text-center" },
                    { data: "mstuj_12", className: "text-center" },
                    { data: "mstuj_13", className: "text-center" },
                    { data: "mstuj_14", className: "text-center" },
                    { data: "mstuj_15", className: "text-center" },
                    { data: "mstuj_16", className: "text-center" },
                    { data: "mstuj_17", className: "text-center" },
                    { data: "mstuj_18", className: "text-center" },
                    { data: "mstuj_19", className: "text-center" },
                    { data: "mstuj_20", className: "text-center" },
                    { data: "mstuj_21", className: "text-center" },
                    { data: "mstuj_22", className: "text-center" },
                    { data: "mstuj_23", className: "text-center" },
                    { data: "mstuj_24", className: "text-center" },
                    { data: "mstuj_25", className: "text-center" },
                    { data: "mstuj_26", className: "text-center" },
                    { data: "mstuj_27", className: "text-center" },
                    { data: "mstuj_28", className: "text-center" },
                    { data: "mstuj_29", className: "text-center" },
                    { data: "mstuj_30", className: "text-center" },
                    { data: "mstuj_31", className: "text-center" },
                    { data: "mstuj_32", className: "text-center" },
                    { data: "mstuj_33", className: "text-center" },
                    { data: "mstuj_34", className: "text-center" },
                    { data: "mstuj_35", className: "text-center" },
                    { data: "mstuj_36", className: "text-center" },
                    { data: "mstuj_37", className: "text-center" },
                    { data: "mstuj_38", className: "text-center" },
                    { data: "mstuj_39", className: "text-center" },
                    { data: "mstuj_40", className: "text-center" },
                    { data: "mstuj_41", className: "text-center" },
                    { data: "mstuj_42", className: "text-center" },
                    { data: "mstuj_43", className: "text-center" },
                    { data: "mstuj_44", className: "text-center" },
                    { data: "mstuj_45", className: "text-center" },
                    { data: "mstuj_46", className: "text-center" },
                    { data: "mstuj_47", className: "text-center" },
                    { data: "mstuj_48", className: "text-center" },
                    { data: "mstuj_49", className: "text-center" },
                    { data: "mstuj_50", className: "text-center" },
                    { data: "mstuj_51", className: "text-center" },
                    { data: "mstuj_52", className: "text-center" },
                    { data: "mstuj_53", className: "text-center" },
                    { data: "mstuj_54", className: "text-center" },
                    { data: "mstuj_55", className: "text-center" },
                    { data: "mstuj_56", className: "text-center" },
                    { data: "mstuj_57", className: "text-center" },
                    { data: "mstuj_58", className: "text-center" },
                    { data: "mstuj_59", className: "text-center" },
                    { data: "mstuj_60", className: "text-center" },
                    { data: "mstuj_61", className: "text-center" },
                    { data: "mstuj_62", className: "text-center" },
                    { data: "mstuj_63", className: "text-center" },
                    { data: "mstuj_64", className: "text-center" },
                    { data: "mstuj_65", className: "text-center" },
                    { data: "mstuj_66", className: "text-center" },
                    { data: "mstuj_67", className: "text-center" },
                    { data: "mstuj_68", className: "text-center" },
                    { data: "mstuj_69", className: "text-center" },
                    { data: "mstuj_70", className: "text-center" },
                    // { data: "mstuj_71", className: "text-center" },
                    // { data: "mstuj_72", className: "text-center" },
                    // { data: "mstuj_73", className: "text-center" },
                    // { data: "mstuj_74", className: "text-center" },
                    // { data: "mstuj_75", className: "text-center" },
                    // { data: "mstuj_76", className: "text-center" },
                    // { data: "mstuj_77", className: "text-center" },
                    // { data: "mstuj_78", className: "text-center" },
                    // { data: "mstuj_79", className: "text-center" },
                    // { data: "mstuj_80", className: "text-center" },
                    // { data: "mstuj_81", className: "text-center" },
                    // { data: "mstuj_82", className: "text-center" },
                    // { data: "mstuj_83", className: "text-center" },
                    // { data: "mstuj_84", className: "text-center" },
                    // { data: "mstuj_85", className: "text-center" },
                    // { data: "mstuj_86", className: "text-center" },
                ],
                [0, 'asc'],
            );
        }

        function showUwTable(idTable, kode) {
            dtTable(
                idTable,
                false,
                "{{ url('api/tehnik/soc/entry-soc/lihat-uw') }}" + "/" + kode,
                [
                    { data: "mrmp_urut", className: "text-center" },
                    { data: "mrmp_tipe_peserta", className: "text-center" },
                    { data: "mrmp_ket1", className: "text-center" },
                    { data: "mrmp_ket2", className: "text-left" },
                    { data: "mrmp_min_umur", className: "text-center" },
                    { data: "mrmp_max_umur", className: "text-center" },
                    { data: "mrmp_total_min", className: "text-center" },
                    { data: "mrmp_total_max", className: "text-center" },
                    { data: "mrmp_xn_max", className: "text-center" },
                ],
                [0, 'asc'],
            );
        }
    </script>
@endsection
