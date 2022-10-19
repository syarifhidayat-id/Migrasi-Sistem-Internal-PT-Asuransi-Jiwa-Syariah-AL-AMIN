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
                <button type="button" class="btn btn-light-primary btn-sm" id="title_action">Buat SOC Baru</button>
            </div>
        </div>

        <div class="card-toolbar">
            <div class="d-flex align-items-center">
                <span class="fs-7 text-gray-700 fw-bolder pe-3">Quick Tools:</span>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary me-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Baru" id="btn_baru"><i class="fa-solid fa-file-circle-plus fs-2x"></i></button>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary me-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Endors" id="btn_endors"><i class="fa-solid fa-file-circle-question fs-2x"></i></button>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary me-3" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Edit" id="btn_edit"><i class="fa-solid fa-file-circle-check fs-2x"></i></button>
                <button type="button" class="btn btn-sm btn-icon btn-icon-muted btn-active-icon-primary" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Tambah Batal" id="btn_Batal"><i class="fa-solid fa-file-circle-minus fs-2x"></i></button>
            </div>

        </div>
    </div>

    <div class="card-body py-10">
        <form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nama Pemegang Polis</label>
                        <select class="form-select form-select-solid" name="msoc_mrkn_nama" id="msoc_mrkn_nama" data-placeholder="Pilih pemegang polis" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_mrkn_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nasabah Bank/Peserta</label>
                        <select class="form-select form-select-solid" name="msoc_mjns_kode" id="msoc_mjns_kode" data-placeholder="Pilih nasabah bank" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_mssp_kode" id="msoc_mssp_kode" placeholder="msoc_mssp_kode" hidden />
                        <input type="text" class="form-control form-control-solid" name="mpid_mssp_kode" id="mpid_mssp_kode" placeholder="mpid_mssp_kode" hidden />
                        <span class="text-danger error-text msoc_mjns_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Segmen Pasar</label>
                        <select class="form-select form-select-solid" name="msoc_mssp_nama" id="msoc_mssp_nama" data-placeholder="Pilih segmen pasar" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_mssp_kode" id="msoc_mssp_kode" placeholder="msoc_mssp_kode" hidden />
                        <input type="text" class="form-control form-control-solid" name="mpid_mssp_kode" id="mpid_mssp_kode" placeholder="mpid_mssp_kode" hidden />
                        <span class="text-danger error-text msoc_mssp_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Nomor SPAJ</label>
                        <select class="form-select form-select-solid" name="msoc_mspaj_nama" id="msoc_mspaj_nama" data-placeholder="Pilih segmen pasar" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_mspaj_nomor" id="msoc_mspaj_nomor" placeholder="msoc_mspaj_nomor" hidden />
                        <span class="text-danger error-text msoc_mspaj_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Mekanisme 1 (Umum)</label>
                        <select class="form-select form-select-solid" name="msoc_mekanisme" id="msoc_mekanisme" data-placeholder="Pilih mkanisme 1" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_mekanisme_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="form-label">Mekanisme 2 (Penutupan)</label>
                        <select class="form-select form-select-solid" name="msoc_mekanisme2" id="msoc_mekanisme2" data-placeholder="Pilih mekanisme 2" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_mekanisme2_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Manfaat Asuransi</label>
                        <select class="form-select form-select-solid" name="msoc_mft_kode" id="msoc_mft_kode" data-placeholder="Pilih manfaat asuransi" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_approve" id="msoc_approve" placeholder="msoc_approve" hidden />
                        <input type="text" class="form-control form-control-solid" name="edit_akses" id="edit_akses" placeholder="edit_akses" hidden />
                        <span class="text-danger error-text msoc_mft_kode_err"></span>
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
                        <select class="form-select form-select-solid" name="msoc_jns_perusahaan" id="msoc_jns_perusahaan" data-placeholder="Pilih jenis pekarjaan" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_jns_perusahaan_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Jaminan Asuransi</label>
                        <select class="form-select form-select-solid" name="msoc_mjm_kode" id="msoc_mjm_kode" data-placeholder="Pilih jaminan asuransi" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <input type="text" class="form-control form-control-solid" name="msoc_mspaj_nomor" id="msoc_mspaj_nomor" placeholder="msoc_mspaj_nomor" hidden />
                        <span class="text-danger error-text msoc_mjm_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Jenis Produk</label>
                        <input type="text" class="form-control form-control-solid" name="msoc_mpid_kode" id="msoc_mpid_kode" placeholder="jenis produk" />
                        <input type="text" class="form-control form-control-solid" name="msoc_mjns_mpid_kode" id="msoc_mjns_mpid_kode" placeholder="msoc_mjns_mpid_kode" hidden />
                        <span class="text-danger error-text msoc_mpid_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Program Asuransi</label>
                        <select class="form-select form-select-solid" name="msoc_mpras_kode" id="msoc_mpras_kode" data-placeholder="Pilih program asuransi" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_mpras_kode_err"></span>
                        <label class="required form-label">Urutan Nomor filter/penyaringan harus benar !</label>
                    </div>
                </div>
            </div>

            <div class="separator my-7"></div>

            <div class="row">
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Saluran Distribusi</label>
                        <select class="form-select form-select-solid" name="msoc_mslr_kode" id="msoc_mslr_kode" data-placeholder="Pilih saluran distribusi" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
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
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_mpojk_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Cabang Alamin</label>
                        <select class="form-select form-select-solid" name="msoc_mlok_kode" id="msoc_mlok_kode" data-placeholder="Pilih cabang alamin" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_mssp_nama_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Marketing</label>
                        <select class="form-select form-select-solid" name="msoc_mkar_kode_mkr" id="msoc_mkar_kode_mkr" data-placeholder="Pilih marketing" data-allow-clear="true">
                            <option></option>
                            {{-- @foreach ($type_menu as $type)
                                <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                            @endforeach --}}
                        </select>
                        <span class="text-danger error-text msoc_mkar_kode_mkr_err"></span>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-5">
                        <label class="required form-label">Pimpinan Cabang</label>
                        <input type="text" class="form-control form-control-solid" name="msoc_mkar_kode_pim" id="msoc_mkar_kode_pim" placeholder="Pimpinan cabang" />
                        <span class="text-danger error-text msoc_mkar_kode_pim_err"></span>
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" name="msoc_handlingfee" id="msoc_handlingfee" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" name="msoc_handlingfee2" id="msoc_handlingfee2" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_mujh_persen" id="msoc_mujh_persen" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" name="msoc_mmfe_persen" id="msoc_mmfe_persen" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_overreding" id="msoc_overreding" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_mkom_persen" id="msoc_mkom_persen" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_mkomdisc_persen" id="msoc_mkomdisc_persen" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_referal" id="msoc_referal" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_maintenance" id="msoc_maintenance" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_mfee_persen" id="msoc_mfee_persen" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                                <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_mdr_kode" id="msoc_mdr_kode" data-placeholder="Pilih">
                                    <option></option>
                                    {{-- @foreach ($type_menu as $type)
                                        <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                    @endforeach --}}
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
                        <input type="text" class="form-control form-control-solid" name="msoc_nomor" id="msoc_nomor" placeholder="No surat endors" />
                        <span class="text-danger error-text msoc_nomor_err"></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-5">
                        <label class="form-label">Kode SOC</label>
                        <input type="text" class="form-control form-control-solid" name="msoc_kode" id="msoc_kode" placeholder="No surat endors" />
                        <span class="text-danger error-text msoc_kode_err"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="mb-5">
                        <label class="form-label">Import Tarif</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-5">
                                    <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_jenis_tarif" id="msoc_jenis_tarif" data-placeholder="Pilih">
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
                                            <select class="form-select form-select-solid rounded-0 border-start border-end" name="msoc_mth_nomor" id="msoc_mth_nomor" data-placeholder="Pilih">
                                                <option></option>
                                                {{-- @foreach ($type_menu as $type)
                                                    <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                                @endforeach --}}
                                            </select>
                                            <span class="text-danger error-text msoc_mth_nomor_err"></span>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                        <button type="button" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
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
                                    <select class="form-select form-select-solid rounded-0 border-start border-end" data-control="select2" name="msoc_tipe_uw" id="msoc_tipe_uw" data-placeholder="Pilih">
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
                                            <select class="form-select form-select-solid rounded-0 border-start border-end" name="msoc_mpuw_nomor" id="msoc_mpuw_nomor" data-placeholder="Pilih">
                                                <option></option>
                                                {{-- @foreach ($type_menu as $type)
                                                    <option value="{{ $type->wmt_kode }}">{{ $type->wmt_nama }}</option>
                                                @endforeach --}}
                                            </select>
                                            <span class="text-danger error-text msoc_mpuw_nomor_err"></span>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-upload"></i> Upload</button>
                                        <button type="button" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
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
                                <div class="mb-5">
                                    <div class="input-group input-group-solid flex-nowrap">
                                        <div class="overflow-hidden flex-grow-1">
                                            <input type="file" class="form-control form-control-solid" name="msoc_dok" id="msoc_dok" placeholder="pilih file" />
                                            <span class="text-danger error-text msoc_dok_err"></span>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-eye"></i> Lihat</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="card-footer text-center">
        <button type="submit" class="btn btn-primary btn-sm me-3" id="btn_simpan"><i class="fa-solid fa-floppy-disk"></i> Simpan</button>
        <button type="button" class="btn btn-warning btn-sm me-3" id="btn_reset"><i class="fa-solid fa-trash"></i> Hapus</button>
        <button type="button" class="btn btn-danger btn-sm" id="btn_close2"><i class="fa-solid fa-xmark"></i> Tutup</button>
    </div>
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

        selectOpReq('msoc_mjns_kode');
        selectOpReq('msoc_mssp_nama');
        selectOpReq('msoc_mspaj_nama');
        selectOpReq('msoc_mekanisme');
        selectOpReq('msoc_mekanisme2');
        selectOpReq('msoc_mft_kode');
        selectOpReq('msoc_jenis_bayar');
        selectOpReq('msoc_jns_perusahaan');
        selectOpReq('msoc_mjm_kode');
        selectOpReq('msoc_mpras_kode');
        setTextReq('msoc_mpid_kode', true);
        selectOpReq('msoc_mslr_kode');
        selectOpReq('msoc_mpojk_kode');
        selectOpReq('msoc_mlok_kode');
        selectOpReq('msoc_mkar_kode_mkr');
        setTextReadOnly('msoc_mkar_kode_pim', true);

        selectOpReq('msoc_pajakfee');
        selectOpReq('msoc_handlingfee');
        selectOpReq('msoc_handlingfee2');
        setSelectReadOnly('msoc_mmfe_persen', true);

        setText('msoc_no_endors', '-');
        setTextReadOnly('msoc_nomor', true);
        setTextReadOnly('msoc_kode', true);

        selectOpReq('msoc_mth_nomor');
        selectOpReq('msoc_mpuw_nomor');

        $(function () {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            selectServerSideReq( //select server side with api/route
                'msoc_mrkn_nama', //kode select
                '{{ url("api/tehnik/soc/entry-soc/select-pmgpolis") }}', //url
                function(data) {
                    return {
                        results: $.map(data, function(d) {
                            return {
                                text: d.nama, // text nama
                                id: d.kode // kode value
                            }
                        })
                    };
                },
            );

            $('body').on('click', '#btn_baru', function() {
                $('#title_action').text('Buat SOC Baru');
                resetForm();
                bsimpan('btn_simpan', 'Simpan');
            });

            $('body').on('click', '#btn_endors', function() {
                $('#title_action').text('SOC Diendos');
                resetForm();
                bsimpan('btn_simpan', 'Simpan');
            });

            $('body').on('click', '#btn_edit', function() {
                $('#title_action').text('SOC Edit');
                resetForm();
                bsimpan('btn_simpan', 'Simpan');
            });

            $('body').on('click', '#btn_Batal', function() {
                $('#title_action').text('SOC Dibatalkan');
                resetForm();
                bsimpan('btn_simpan', 'Simpan');
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
                resetForm();
            });

            $('#btn_close').click(function() {
                closeModal('#modalMenu');
            });

            $('#btn_close2').click(function() {
                closeModal('#modalMenu');
            });
        });

        function bersih(tipe) {
            if (getText("e_bersih")=="1") {
                return ;
            }
            if (tipe==1) {
                setText("e_manfaat","");
                setText("e_pras","");
                setText("msoc_nomor","");
                setText("msoc_mpras_kode","");
                setText("msoc_mjm_kode","");
            }
            if (tipe==2) {
                setText("msoc_mrkn_nama","");
            }
        }

        function resetForm() {
            $('#frxx').trigger('reset');
        }
    </script>
@endsection
