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
            {{-- <div class="d-flex align-items-center">

            </div> --}}
            <div class="input-group input-group-solid">
                <button type="button" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" onclick="cekTombol(0)">Baru</button>
                <button type="button" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Endors" onclick="cekTombol(2)">Endors</button>
                <button type="button" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Edit" onclick="cekTombol(1)">Edit</button>
                <button type="button" class="btn btn-light-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Batal" onclick="cekTombol(3)">Batal</button>
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
                        {{-- <select class="form-select form-select-solid" name="msoc_mrkn_nama" id="msoc_mrkn_nama" data-placeholder="Pilih pemegang polis" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <input type="text" class="easyui-textbox" name="msoc_mrkn_nama" id="msoc_mrkn_nama" data-options="prompt:'Pilih pemegang polis'" style="width: 100%;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mrkn_kode" id="msoc_mrkn_kode" placeholder="msoc_mrkn_nama" />
                        <span class="text-danger error-text msoc_mrkn_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nasabah Bank/Peserta</label>
                        {{-- <select class="form-select form-select-solid" name="e_nasabah" id="e_nasabah" data-placeholder="Pilih nasabah bank" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <input type="text" class="easyui-textbox" name="e_nasabah" id="e_nasabah" data-options="prompt:'Pilih nasabah bank'" style="width: 100%;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mjns_kode" id="msoc_mjns_kode" placeholder="msoc_mjns_kode" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mjns_mpid_kode" id="msoc_mjns_mpid_kode" placeholder="msoc_mjns_mpid_kode" />
                        <span class="text-danger error-text e_nasabah_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Segmen Pasar</label>
                        {{-- <select class="form-select form-select-solid required_sel" data-control="select2" name="mpid_mssp_kode" id="mpid_mssp_kode" data-placeholder="Pilih segmen pasar" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <input type="text" class="easyui-combobox" name="msoc_mssp_nama" id="msoc_mssp_nama" data-options="prompt:'Pilih segmen pasar',
                        url: '{{ url("api/tehnik/soc/entry-soc/select-segmen") }}',
                        method: 'get',
                        valueField: 'value',
                        textField: 'text',
                        groupField:'group',
                        onSelect: function(rec){
                          setsegmen(rec);
                        }" style="width: 100%;" />
                        {{-- <input type="text" class="easyui-textbox" name="msoc_mssp_nama" id="msoc_mssp_nama" data-options="prompt:'Pilih segmen pasar'" style="width: 100%;" /> --}}
                        <input type="text" class="form-control form-control-solid" name="msoc_mssp_kode" id="msoc_mssp_kode" placeholder="msoc_mssp_kode" hidden />
                        <input type="text" class="form-control form-control-solid" name="mpid_mssp_kode" id="mpid_mssp_kode" placeholder="msoc_mssp_nama" hidden />
                        <span class="text-danger error-text mpid_mssp_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-5">
                        <label class="form-label">Nomor SPAJ</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-5">
                                    <select class="form-select form-select-solid" data-control="select2" name="msoc_mspaj_nama" id="msoc_mspaj_nama" data-placeholder="Pilih nomor spaj" data-allow-clear="true">
                                        <option></option>
                                    </select>
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
                        {{-- <select class="form-select form-select-solid" name="msoc_mekanisme" id="msoc_mekanisme" data-placeholder="Pilih mkanisme 1" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <select class="easyui-combobox" name="msoc_mekanisme" id="msoc_mekanisme" data-options="prompt:'Pilih mkanisme 1'" style="width: 100%;">
                            <option selected disabled>Pilih mkanisme 1</option>
                            @foreach ($meka1 as $key => $data)
                                <option value="{{ $data->kode }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text msoc_mekanisme_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="form-label">Mekanisme 2 (Penutupan)</label>
                        {{-- <select class="form-select form-select-solid" name="msoc_mekanisme2" id="msoc_mekanisme2" data-placeholder="Pilih mekanisme 2" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <select class="easyui-combobox" name="msoc_mekanisme2" id="msoc_mekanisme2" data-options="prompt:'Pilih mkanisme 2'" style="width: 100%;">
                            <option selected disabled>Pilih mkanisme 2</option>
                            @foreach ($meka2 as $key => $data)
                                <option value="{{ $data->kode }}">{{ $data->nama }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text msoc_mekanisme2_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Manfaat Asuransi</label>
                        {{-- <select class="form-select form-select-solid required_sel" data-control="select2" name="e_manfaat_pol" id="e_manfaat_pol" data-placeholder="Pilih manfaat asuransi" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <input type="text" class="easyui-textbox" name="e_manfaat_pol" id="e_manfaat_pol" data-options="prompt:'Pilih manfaat asuransi'" style="width: 100%;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_approve" id="msoc_approve" placeholder="msoc_approve" hidden />
                        <input type="text" class="form-control form-control-solid" name="edit_akses" id="edit_akses" placeholder="edit_akses" hidden />
                        <input type="text" class="form-control form-control-solid" name="msoc_mft_kode" id="msoc_mft_kode" placeholder="msoc_mft_kode" hidden />
                        <span class="text-danger error-text e_manfaat_pol_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Pembayaran Kontribusi</label>
                        <select class="form-select form-select-solid" name="msoc_jenis_bayar" id="msoc_jenis_bayar" data-placeholder="Pilih kontribusi" data-allow-clear="true">
                            <option></option>
                            <option value="0">Sekaligus</option>
                            <option value="1">Per Tahun</option>
                            <option value="2">Per Bulan</option>
                        </select>
                        <span class="text-danger error-text msoc_jenis_bayar_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Jenis Pekerjaan</label>
                        {{-- <select class="form-select form-select-solid" name="msoc_jns_perusahaan" id="msoc_jns_perusahaan" data-placeholder="Pilih jenis pekarjaan" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <select class="easyui-combobox" name="msoc_jns_perusahaan" id="msoc_jns_perusahaan" data-options="prompt:'Pilih jenis pekarjaan', onSelect: function(rec){ cekpolis(); }" style="width: 100%;">
                            <option selected disabled>Pilih jenis pekarjaan</option>
                            @foreach ($jnsKer as $key => $data)
                                <option value="{{ $data->kode }}">{{ $data->ket }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text msoc_jns_perusahaan_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Jaminan Asuransi</label>
                        {{-- <select class="form-select form-select-solid required_sel" data-control="select2" name="e_manfaat" id="e_manfaat" data-placeholder="Pilih jaminan asuransi" data-allow-clear="true">
                            <option></option>
                        </select> --}}
                        <input type="text" class="easyui-textbox" name="e_manfaat" id="e_manfaat" data-options="prompt:'Pilih jaminan asuransi'" style="width: 100%;" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mjm_kode" id="msoc_mjm_kode" placeholder="msoc_mjm_kode" hidden />
                        <span class="text-danger error-text e_manfaat_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Jenis Produk</label>
                        <input type="text" class="form-control form-control-solid" name="mpid_nama" id="mpid_nama" placeholder="jenis produk" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mpid_kode" id="msoc_mpid_kode" placeholder="msoc_mpid_kode" hidden />
                        <span class="text-danger error-text mpid_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="mb-5">
                        <label class="required form-label">Program Asuransi</label>

                        <input type="text" class="easyui-textbox" name="e_pras" id="e_pras" data-options="prompt:'Pilih program asuransi'" style="width: 100%" />
                        {{-- <div class="input-group input-group-solid flex-nowrap">
                            <input type="text" class="form-control form-control-solid" name="e_pras" id="e_pras" placeholder="Pilih program asuransi" />
                            <button type="button" id="programAsur" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-search"></i> Pilih</button>
                        </div> --}}
                        <input type="text" class="form-control form-control-solid" name="msoc_mpras_kode" id="msoc_mpras_kode" placeholder="msoc_mpras_kode" />
                        <span class="text-danger error-text e_pras_err"></span>
                        <label class="required form-label">Urutan Nomor filter/penyaringan harus benar !</label>
                    </div>
                </div>
            </div>

            <div class="separator my-7"></div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Saluran Distribusi</label>
                        <select class="form-select form-select-solid required_sel" data-control="select2" name="msoc_mslr_kode" id="msoc_mslr_kode" data-placeholder="Pilih saluran distribusi" data-allow-clear="true">
                            <option></option>
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_endos" id="msoc_endos" placeholder="msoc_endos" hidden />
                        <span class="text-danger error-text msoc_mslr_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nama Produk Ojk</label>
                        <select class="form-select form-select-solid" name="msoc_mpojk_kode" id="msoc_mpojk_kode" data-placeholder="Pilih produk ojk" data-allow-clear="true">
                            <option></option>
                        </select>
                        <span class="text-danger error-text msoc_mpojk_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Cabang Alamin</label>
                        <select class="form-select form-select-solid" name="e_cabalamin" id="e_cabalamin" data-placeholder="Pilih cabang alamin" data-allow-clear="true">
                            <option></option>
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_mlok_kode" id="msoc_mlok_kode" placeholder="msoc_mlok_kode" hidden />
                        <span class="text-danger error-text e_cabalamin_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Marketing</label>
                        <select class="form-select form-select-solid required_sel" data-control="select2" name="e_marketing" id="e_marketing" data-placeholder="Pilih marketing" data-allow-clear="true">
                            <option></option>
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_mkr" id="msoc_mkar_kode_mkr" placeholder="msoc_mkar_kode_mkr" hidden />
                        <span class="text-danger error-text e_marketing_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Pimpinan Cabang</label>
                        <input type="text" class="form-control form-control-solid" name="e_pinca" id="e_pinca" placeholder="Pimpinan cabang" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_pim" id="msoc_mkar_kode_pim" placeholder="msoc_mkar_kode_pim" hidden />
                        <span class="text-danger error-text e_pinca_err"></span>
                    </div>
                </div>
            </div>

            <div class="separator my-10"></div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Penanggung Pajak Fee</label>
                        <select class="form-select form-select-solid" name="msoc_pajakfee" id="msoc_pajakfee" data-placeholder="Pilih pajak fee" data-allow-clear="true">
                            <option></option>
                            <option value="0">-</option>
                            <option value="1">PPN & PPH Tidak Potongan/Nambah Kontribusi</option>
                            <option value="2">Rekanan</option>
                            <option value="3">PPN Potong Kontribusi & PPH Tambah Kontribusi</option>
                        </select>
                        <span class="text-danger error-text msoc_pajakfee_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="required form-label">Fee PPN</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid required_sel" data-control="select2" name="msoc_handlingfee" id="msoc_handlingfee" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_handlingfee_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="required form-label">Fee PPH 23</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid required_sel" data-control="select2" name="msoc_handlingfee2" id="msoc_handlingfee2" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_handlingfee2_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="form-label">Ujrah</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mujh_persen" id="msoc_mujh_persen" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mujh_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="required form-label">Managemen Fee</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mmfe_persen" id="msoc_mmfe_persen" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mmfe_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
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
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="form-label">Kom. Tidak Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mkom_persen" id="msoc_mkom_persen" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mkom_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="form-label">Kom. Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mkomdisc_persen" id="msoc_mkomdisc_persen" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mkomdisc_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="form-label">Referal</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_referal" id="msoc_referal" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_referal_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="form-label">Maintenance</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_maintenance" id="msoc_maintenance" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_maintenance_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="form-label">Fee Base Tidak Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mfee_persen" id="msoc_mfee_persen" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mfee_persen_err"></span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-5">
                        <label class="form-label">Fee Base Potong</label>
                        <div class="input-group input-group-solid flex-nowrap">
                            <div class="overflow-hidden flex-grow-1">
                                <select class="form-select form-select-solid" data-control="select2" name="msoc_mdr_kode" id="msoc_mdr_kode" data-placeholder="Pilih">
                                    <option></option>
                                </select>
                            </div>
                            <span class="input-group-text">%</span>
                        </div>
                        <span class="text-danger error-text msoc_mdr_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
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
                            <div class="col-md-8">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid required_sel" data-control="select2" name="e_tarif" id="e_tarif" data-placeholder="Pilih">
                                                <option></option>
                                            </select>
                                            <input type="text" class="form-control form-control-solid" name="msoc_mth_nomor" id="msoc_mth_nomor" placeholder="msoc_mth_nomor" hidden />
                                            <span class="text-danger error-text e_tarif_err"></span>
                                        </div>
                                        <button type="button" id="importTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                        <button type="button" id="lihatTarif" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                    </div>
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
                            <div class="col-md-8">
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <select class="form-select form-select-solid required_sel" data-control="select2" name="e_uw" id="e_uw" data-placeholder="Pilih">
                                                <option></option>
                                            </select>
                                            <input type="text" class="form-control form-control-solid" name="msoc_mpuw_nomor" id="msoc_mpuw_nomor" placeholder="msoc_mpuw_nomor" hidden />
                                            <span class="text-danger error-text e_uw_err"></span>
                                        </div>
                                        <button type="button" id="importUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                        <button type="button" id="lihatUw" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                    </div>
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
            <button type="button" class="btn btn-warning btn-sm me-3" onclick="clear_f()"><i class="fa-solid fa-trash"></i> Hapus</button>
        </div>
    </form>
    @include('pages.tehnik.soc.modal.program-asuransi')
    @include('pages.tehnik.soc.modal.import-tarif')
    @include('pages.tehnik.soc.modal.show-konfirmtarif')
    @include('pages.tehnik.soc.modal.lihat-tarif')
    @include('pages.tehnik.soc.modal.import-uw')
    @include('pages.tehnik.soc.modal.lihat-uw')
    @include('pages.tehnik.soc.modal.show-konfirmuw')
    @include('pages.tehnik.soc.modal.lihat-docsoc')
</div>
@endsection

@section('script')
    <script>
        // implement select2 : ambil nama id saja
        // selectOp() select2 jika not required
        // selectOpReq() select2 jika required
        // setTextReq() inputan jika required
        // setTextReadOnly() inputan jika required + readonly
        // setSelectReadOnly() select2 jika required + readonly
        // selectServerSide() select2 jika not required ambil data dari api/route
        // selectServerSideReq() select2 jika required ambil data dari api/route
        selectOpReq('msoc_jenis_bayar');
        // setTextReadOnly('e_manfaat_pol', true);
        // setTextReadOnly('e_pras', true);
        setTextReadOnly('mpid_nama', true);
        selectOpReq('msoc_mpojk_kode');
        setTextReadOnly('e_pinca', true);

        selectOpReq('msoc_pajakfee');

        setText('msoc_no_endors', '-');
        setTextReadOnly('msoc_nomor', true);
        setTextReadOnly('msoc_kode', true);
        selectOpTag('mth_kolom');
        selectOpTag('mth_baris');
        selectOpTag('mpuw_baris');

        // setRequired
        setRequired('msoc_mrkn_nama');
        setRequired('e_nasabah');
        setRequired('msoc_mssp_nama');
        setRequired('msoc_mekanisme');
        setRequired('e_manfaat_pol');
        setRequired('msoc_jenis_bayar');
        setRequired('msoc_jns_perusahaan');
        setRequired('e_manfaat');
        setRequired('e_pras');

        // setHide
        setHide('msoc_mpras_kode', true);
        setHide('msoc_mrkn_kode', true);
        setHide('msoc_mjns_kode', true);
        setHide('msoc_mjns_mpid_kode', true);

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

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
                    setText('msoc_mrkn_kode', row.kode);
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
                    setText('msoc_mjns_kode', row.mjns_kode);
                    setText('msoc_mjns_mpid_kode', row.mjns_mpid_nomor);

                    setText('msoc_mssp_nama', '');
                    reSelBox('msoc_mssp_nama', '{{ url("api/tehnik/soc/entry-soc/select-segmen") }}' + '?' + '&mjns=' + getText('e_nasabah'));
                    var rms = '&mjns='+getText("msoc_mjns_kode")+'&mft='+getText("msoc_mft_kode")+'&mrkn='+getText("msoc_mrkn_kode")+'&mssp='+getText("msoc_mssp_kode")+'&mkm='+getText("msoc_mekanisme")+'&mkm2='+getText("msoc_mekanisme2")+'&perush='+getText("msoc_jns_perusahaan")+'&byr='+getText("msoc_jenis_bayar")+'&mjm='+getText("msoc_mjm_kode")+'&mpid='+getText("msoc_mpid_kode")
                    reSelGrid('e_pras', '{{ url("api/tehnik/soc/entry-soc/pilih-program-asuransi") }}' + '?' + rms);
				    reSelGrid('e_manfaat_pol','{{ url("api/tehnik/soc/entry-soc/select-manasu") }}' + '?' + '&mjns=' + getText("msoc_mjns_kode"));
                }
            );
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
				    setText("msoc_mft_kode",row.kode);
                }
            );
            // selectServerSide(
            //     'msoc_mspaj_nama',
            //     '{{ url("api/tehnik/soc/entry-soc/select-nospaj") }}',
            //     function(data) {
            //         return {
            //             results: $.map(data, function(d) {
            //                 return {
            //                     id: d.mspaj_nomor,
            //                     text: d.mspaj_nomor
            //                 }
            //             })
            //         };
            //     },
            //     function(res) {
            //         setText('msoc_mspaj_nomor', res.params.data.id);
            //     },
            // );
            selectGrid(
                'e_manfaat',
                'GET',
                '{{ url("api/tehnik/soc/entry-soc/select-jamiasu") }}',
                'kode',
                'nama',
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
                    setText('msoc_mjm_kode', row.mjm_kode);
                    setText('msoc_mpid_kode', row.mpid_kode);
                    setText('mpid_nama', row.mpid_nama);
                }
            );
            // changeSelect2(
            //     'e_nasabah',
            //     'mpid_mssp_kode',
            //     'e_manfaat',
            //     '{{ url("api/tehnik/soc/entry-soc/select-jamiasu") }}',
            //     function(data) {
            //         return {
            //             results: $.map(data, function(d) {
            //                 return {
            //                     id: d.mjm_kode,
            //                     text: d.mjm_nama + ' | ' + d.mpid_nama,
            //                     mpid_kode: d.mpid_kode,
            //                     mpid_nama: d.mpid_nama,
            //                 }
            //             })
            //         };
            //     },
            //     function(res) {
            //         setText('msoc_mft_kode', res.params.data.id);
            //         setText('msoc_mjm_kode', res.params.data.id);
            //         setText('msoc_mpid_kode', res.params.data.mpid_kode);
            //         setText('mpid_nama', res.params.data.mpid_nama);
            //     },
            // );
            selectServerSide(
                'msoc_mslr_kode',
                '{{ url("api/tehnik/soc/entry-soc/select-salurandistribusi") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.mslr_kode,
                                text: d.mslr_ket
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_mpojk_kode',
                '{{ url("api/tehnik/soc/entry-soc/select-prodojk") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.mpojk_kode,
                                text: d.mpojk_nama
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'e_cabalamin',
                '{{ url("api/tehnik/soc/entry-soc/select-cabalamin") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.kode,
                                text: d.nama,
                                kd_pinca: d.kd_pinca,
                                nm_pinca: d.nm_pinca,
                            }
                        })
                    };
                },
                function(res) {
                    setText('msoc_mlok_kode', res.params.data.id);
                    setText('msoc_mkar_kode_pim', res.params.data.kd_pinca);
                    setText('e_pinca', res.params.data.nm_pinca);
                },
            );
            changeSelect(
                'e_cabalamin',
                'e_marketing',
                '{{ url("api/tehnik/soc/entry-soc/select-marketing") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.kode,
                                text: d.nama
                            }
                        })
                    };
                },
                function(res) {
                    setText('msoc_mkar_kode_mkr', res.params.data.id);
                },
            );
            selectServerSide(
                'msoc_handlingfee',
                '{{ url("api/tehnik/soc/entry-soc/select-feeppn") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tampil,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_handlingfee2',
                '{{ url("api/tehnik/soc/entry-soc/select-feepph23") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tampil,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_mujh_persen',
                '{{ url("api/tehnik/soc/entry-soc/select-ujroh") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tampil,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_mmfe_persen',
                '{{ url("api/tehnik/soc/entry-soc/select-mnfee") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tampil,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_mkom_persen',
                '{{ url("api/tehnik/soc/entry-soc/select-komtidakpot") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tipe,
                            }
                        })
                    };
                },
                function(res) {
                    cekkomisi();
                },
            );
            selectServerSide(
                'msoc_mkomdisc_persen',
                '{{ url("api/tehnik/soc/entry-soc/select-kompot") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tipe,
                            }
                        })
                    };
                },
                function(res) {
                    cekkomisi();
                },
            );
            selectServerSide(
                'msoc_referal',
                '{{ url("api/tehnik/soc/entry-soc/select-referal") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tipe,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_maintenance',
                '{{ url("api/tehnik/soc/entry-soc/select-maintenence") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tipe,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_mfee_persen',
                '{{ url("api/tehnik/soc/entry-soc/select-feebtidakpotong") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tipe,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'msoc_mdr_kode',
                '{{ url("api/tehnik/soc/entry-soc/select-feebpotong") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.persen,
                                text: d.tipe,
                            }
                        })
                    };
                },
            );
            selectServerSide(
                'e_tarif',
                '{{ url("api/tehnik/soc/entry-soc/select-tarifimport") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.kode,
                                text: d.nama,
                            }
                        })
                    };
                },
                function(res) {
                    setText('msoc_mth_nomor', res.params.data.id);
                },
            );
            selectServerSide(
                'e_uw',
                '{{ url("api/tehnik/soc/entry-soc/select-underwritingimport") }}',
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                id: d.kode,
                                text: d.nama,
                            }
                        })
                    };
                },
                function(res) {
                    setText('msoc_mpuw_nomor', res.params.data.id);
                },
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
					{field:'mpras_kode',title:'Kode Program Asuransi',width:50},
					{field:'mpras_uptambah',title:'UP Tambahan',width:80},
					{field:'mpras_ujrah_referal',title:'Ujrah Referal',width:80},
					{field:'mpras_disc_rate',title:'Discount Rate',width:50},
					{field:'mpras_mmft_kode_jiwa',title:'Tambahan Jiwa',width:50},
				],
                function(i, row) {
                    setText('msoc_mpras_kode', row.mpras_kode);
                }
            );

            // $('body').on('click', '#programAsur', function() {
            //     const mpid = document.getElementById("mpid").value = getText('msoc_mpid_kode'),
            //         // mkm = document.getElementById("mkm").value = getText('msoc_mekanisme'),
            //         mkm2 = document.getElementById("mkm2").value = getText('msoc_mekanisme2'),
            //         mft = document.getElementById("mft").value = getText('msoc_mft_kode'),
            //         mrkn = document.getElementById("mrkn").value = getText('msoc_mrkn_kode'),
            //         mssp = document.getElementById("mssp").value = getText('msoc_mssp_kode'),
            //         mjm = document.getElementById("mjm").value = getText('msoc_mjm_kode'),
            //         mjns = document.getElementById("mjns").value = getText('msoc_mjns_kode'),
            //         // byr = document.getElementById("byr").value = getText('msoc_jenis_bayar'),
            //         perush = document.getElementById("perush").value = getText('msoc_jns_perusahaan');

            //     // if (mpid !=="" && mkm !=="" && mkm2 !=="" && mft !=="" && mrkn !=="" && mssp !=="" && mjm !=="" && mjns !=="" && byr !=="" && perush !=="") {
            //     // if (mpid !=="") {
            //         openModal('modalProg');
            //         titleAction('titleModal', 'Pilih Program Asuransi');
            //         dtTable(
            //             "progAsur",
            //             false,
            //             "{{ url('api/tehnik/soc/entry-soc/pilih-program-asuransi') }}",
            //             [
            //                 {
            //                     data: "mpras_nama",
            //                     className: "text-center",
            //                     render: function(data, type, row, meta) {
            //                         return `<button type="button" id="btn_pilih" data-key="`+row.mpras_kode+`" data-name="`+row.mpras_nama+`" data-info="`+row.mpras_info+`" class="btn btn-primary btn-sm">`+row.mpras_nama+`</button>`;
            //                     }
            //                 },
            //                 {
            //                     data: "msoc_kode",
            //                     className: "text-center",
            //                     render: function(data, type, row, meta) {
            //                         return `<div class="badge badge-light-success fw-bolder">`+row.msoc_kode+`</div>`;
            //                     }
            //                 },
            //                 { data: "mpras_kode", className: "text-center" },
            //                 { data: "mpras_uptambah", className: "text-center" },
            //                 { data: "mpras_ujrah_referal", className: "text-center" },
            //                 { data: "mpras_disc_rate", className: "text-center" },
            //                 { data: "mpras_mmft_kode_jiwa", className: "text-center" },
            //             ],
            //             [2, 'asc'],
            //         );
            //     // } else {
            //     //     message(
            //     //         'error',
            //     //         'Oops...',
            //     //         'Isian form masih ada yang kosong, isi terlebih dahulu.'
            //     //     );
            //     // }
            // });

            // $('body').on('click', '#btn_pilih', function() {
            //     const id = $(this).attr('data-key'),
            //         name = $(this).attr('data-name'),
            //         info = $(this).attr('data-info');
            //     closeModal('modalProg');
            //     messageValidate(
            //         info,
            //         'warning',
            //         'Oke..!',
            //         'Tidak..!',
            //         (result) => {
            //             if (result.isConfirmed) {
            //                 setText('e_pras', name);
            //                 setText('msoc_mpras_kode', id);
            //                 setTextReadOnly('e_pras', true);
            //             } else if (result.isDenied) {
            //                 setText('e_pras', name);
            //                 setText('msoc_mpras_kode', id);
            //                 setTextReadOnly('e_pras', false);
            //             }
            //         },
            //     );
            // });

            $('body').on('click', '#importTarif', function() {
                openModal('modalTarif');
                titleAction('titleTarif', 'Upload File Table Tarif');
                clearForm('frxx_uploadTarif');
            });

            $('body').on('click', '#lihatTarif', function() {
                var kode = document.getElementById("mth_nomor").value = getText('msoc_mth_nomor');
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
                var kode = document.getElementById("mpuw_nomor").value = getText('msoc_mpuw_nomor');
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
                    clearForm("frxx_soc");
                    clearSelect();
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
                    clearSelect();
                    bsimpan('btnImportTarif_simpan', 'Simpan');
                    closeModal("modalTarif");
                    openModal("modalShowKonfirmTarif");
                    titleAction("titleShowKonfirmTarif", "Konfirmasi Tabel Tarif");
                    var kode = getText("kode_import_tarif");
                    showTarifTable("showTarif", kode);
                },
            );

            submitForm(
                "frxx_tarifKonfim",
                "btnTarifKonfim_simpan",
                "POST",
                "{{ url('api/tehnik/soc/entry-soc/update-upload-tarif') }}",
                (resSukses) => {
                    clearForm("frxx_tarifKonfim");
                    clearSelect();
                    bsimpan('btnTarifKonfim_simpan', 'Simpan');
                    closeModal("modalShowKonfirmTarif");
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
                    clearSelect();
                    bsimpan('btnImportUw_simpan', 'Simpan');
                    closeModal("modalUw");
                    openModal("modalShowKonfirmUw");
                    titleAction("titleShowKonfirmUw", "Konfirmasi Tabel UW");
                    var kode = getText("kode_import_uw");
                    showUwTable("showUw", kode);
                },
            );

            submitForm(
                "frxx_uwKonfim",
                "btnUwKonfim_simpan",
                "POST",
                "{{ url('api/tehnik/soc/entry-soc/update-upload-uw') }}",
                (resSukses) => {
                    clearForm("frxx_uwKonfim");
                    clearSelect();
                    bsimpan('btnUwKonfim_simpan', 'Simpan');
                    closeModal("modalShowKonfirmUw");
                },
                (resError) => {
                    console.log(resError);
                },
            );
        });

        cekTombol(0);
        cekField();
        function cekTombol (tipe) {
            clear_f();
            cekField();

            if (tipe=='0') {
                titleAction('title_action', 'Buat SOC Baru');
                setTextReadOnly("msoc_mrkn_nama",false);
                setTextReadOnly("e_manfaat_pol",false);
                setTextReadOnly("e_nasabah",false);
                setTextReadOnly("msoc_mspaj_nomor",true);
                setTextReadOnly("msoc_mssp_nama",false);
                setTextReadOnly("msoc_jns_perusahaan",false);
            }

            if (tipe=='1') {
                titleAction('title_action', 'SOC Edit');
                setTextReadOnly("e_manfaat_pol",false);
                setTextReadOnly("msoc_mrkn_nama",false);
                setTextReadOnly("e_nasabah",false);
                setTextReadOnly("msoc_mspaj_nomor",false);
                setTextReadOnly("msoc_mssp_nama",false);
                setTextReadOnly("msoc_jns_perusahaan",false);

            }

            if (tipe=='2') {
                titleAction('title_action', 'SOC Diendos');
                setTextReadOnly("msoc_mrkn_nama",false);
                setTextReadOnly("e_nasabah",false);
                setTextReadOnly("e_manfaat_pol",false);
                setTextReadOnly("msoc_mspaj_nomor",false);
                setTextReadOnly("msoc_mssp_nama",false);
                setTextReadOnly("msoc_jns_perusahaan",false);
            }

            if (tipe=='3') {
                titleAction('title_action', 'SOC Dibatalkan');
                setTextReadOnly("msoc_mrkn_nama",false);
                setTextReadOnly("e_nasabah",false);
                setTextReadOnly("msoc_mspaj_nomor",false);
                setTextReadOnly("e_manfaat_pol",false);
                setTextReadOnly("msoc_mssp_nama",false);
                setTextReadOnly("msoc_jns_perusahaan",false);
            }
            setText("msoc_endos",tipe);
        }

        function cekField () {
            setText('msoc_endos','0');
			setText('msoc_mfee_persen','0');
			setText('msoc_mkom_persen','0');
			setText('msoc_overreding','0');
			setText('msoc_mmfe_persen','0');
			setText('msoc_mujh_persen','0');
			setText('msoc_mujhrf_kode','0');
			setText('msoc_mdr_kode','0');
			setText('msoc_mut_kode','0');
			setText('msoc_referal','0');
			setText('msoc_maintenance','0');
			setText('msoc_no_endors','-');
			// setCombo("msoc_tipe_uw","0");
			// setCombo("typerpt","web");
        }

        function setsegmen(rec) {
            setText('msoc_mssp_kode', rec.value);
            console.log(rec.value);
            reSelGrid('e_manfaat','{{ url("api/tehnik/soc/entry-soc/select-jamiasu") }}' + '?' + '&mssp=' + rec.value + '&mjns=' + getText("msoc_mjns_kode"));
        }

        function cekpolis() {
            vv={ res : ''};
            rms = '&pmgpolis='+getText('msoc_mrkn_kode')+'&perus='+getText('msoc_jns_perusahaan')+'&mekanisme2='+getText('msoc_mekanisme2')+'&mekanisme='+getText('msoc_mekanisme')+'&jns_bayar='+getText('msoc_jenis_bayar')+'&nasabah='+getText('msoc_mjns_kode')+'&mrkn_nama='+getText('msoc_mrkn_nama')+'&mft='+getText('msoc_mft_kode');

            url = '{{ url("api/tehnik/soc/entry-soc/select-get-soc") }}' + '?' + rms;
            $.getJSON(url,vv, function(data){
                if (data) {
                    $('#ff').form('load',data);
                    //setloadpolis();
                    $('#ffile').form('load',data);
                }
            });
        }

        function cekkomisi() {
            // var id = getSelect('msoc_mkom_persen');
            // if (id == 0) {
            //     alert(id);
            // }
            var xkompot=getText('msoc_mkomdisc_persen');
            var xkomtdkpot=getText('msoc_mkom_persen');

            if (xkomtdkpot == 0) {
                setTextReadOnly('msoc_mkomdisc_persen',false);
                setTextReadOnly('msoc_mkom_persen',false);
            }

            if (xkomtdkpot > 0) {
                setTextReadOnly('msoc_mkom_persen',false);
                setTextReadOnly('msoc_mkomdisc_persen',true);
                setText('msoc_mkomdisc_persen','0');
            }

            if (xkompot > 0) {
                setTextReadOnly('msoc_mkom_persen',true);
                setTextReadOnly('msoc_mkomdisc_persen',false);
                setText('msoc_mkom_persen','0');
                pesan('Apakah anda yakin komisi mengurangi kontribusi Tagih/Netto ?');
            }
        }

        function cekdiscrate () {
            setTextReadOnly("msoc_mdr_kode",true);
            if (getText("msoc_mfee_persen")==0) {
                pesan("Silakan Isi Discount Rate Jika anda yakin kontribusi dibayarkan Nett");
                setTextReadOnly("msoc_mfee_persen",true);
                setTextReadOnly("msoc_mdr_kode",false);
            } else {
                pesan("Apakah Anda Yakin kontribusi dibayarkan Gross?? ");
            }
        }

        function muncul1(uptambah,ujrah_referal,discrate,mmft_kode_jiwa) {
            setComboReadOnly("msoc_mmft_kode_jiwa",true);
            if (mmft_kode_jiwa=="1") {
                setComboReadOnly("msoc_mmft_kode_jiwa",false);
            }

            setComboReadOnly("msoc_mut_kode",true);
            if (uptambah=="1") {
                setComboReadOnly("msoc_mut_kode",false);
            }

            setComboReadOnly("msoc_mujhrf_kode",true);
            if (ujrah_referal=="1") {
                setComboReadOnly("msoc_mujhrf_kode",false);
            }

            setComboReadOnly("msoc_mdr_kode",false);
            if (discrate=="1") {
                setComboReadOnly("msoc_mdr_kode",true);
            }
        }

        function close_mTarif () {
            closeModal('modalTarif');
            clearForm('frxx_uploadTarif');
            clearSelect();
        }

        function close_mUw () {
            closeModal('modalUw');
            clearForm('frxx_uploadUw');
            clearSelect();
        }

        function close_lihatDoc () {
            closeModal('modalLihatDoc');
            $('#lihatFileDoc').attr("data","");
        }

        function showTarifTable (idTable, kode) {
            dtTable(
                idTable,
                false,
                "{{ url('api/tehnik/soc/entry-soc/lihat-tarif') }}" + "/" + kode,
                [
                    { data: "mstuj_usia", className: "text-center" },
                    { data: "mstuj_0", className: "text-center" },
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

        function showUwTable (idTable, kode) {
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

        function clear_f () {
            clearForm('frxx_soc');
            clearForm('frxx_uploadTarif');
            clearForm('frxx_uploadUw');
            clearSelect();
            bsimpan('btn_simpan', 'Simpan');
        }

        function close_mTarif () {
            closeModal('modalTarif');
            clearForm('frxx_uploadTarif');
            clearSelect();
        }

        function close_mUw () {
            closeModal('modalUw');
            clearForm('frxx_uploadUw');
            clearSelect();
        }

        function close_lihatDoc () {
            closeModal('modalLihatDoc');
            $('#lihatFileDoc').attr("data","");
        }

        function showTarifTable (idTable, kode) {
            dtTable(
                idTable,
                false,
                "{{ url('api/tehnik/soc/entry-soc/lihat-tarif') }}" + "/" + kode,
                [
                    { data: "mstuj_usia", className: "text-center" },
                    { data: "mstuj_0", className: "text-center" },
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

        function showUwTable (idTable, kode) {
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

        // Form SOC
        hidePesan('msoc_mrkn_kode');
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
    </script>
@endsection
