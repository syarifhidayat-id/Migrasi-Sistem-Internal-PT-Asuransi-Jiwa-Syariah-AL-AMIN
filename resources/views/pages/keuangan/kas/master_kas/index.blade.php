@extends('layouts.main-admin')

@section('title')
    Master KAS
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>Entry Dana KAS</h3>
            </div>
        </div>

        <form id="frxx_m_kas" name="frxx_m_kas" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body py-10">
                <div class="row">
                    <input class="form-control" type="text" data-allow-clear="false" id="a_pk" value="{{ $kode }}" />
                    <input class="form-control" id="tdna_user_ins" name="tdna_user_ins"
                                        value="{{ Auth::user()->email }}" readonly />
                    {{-- <input class="form-control" id="tdna_akun_d" name="tdna_akun_d"  readonly /> --}}
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Kantor Al Amin</label>
                            <select class="form-select" id="tdna_mlok_kode" name="tdna_mlok_kode"
                                data-placeholder="cari kantor alamin" data-allow-clear="true">
                                <option></option>
                            </select>
                            {{-- <input type="text" id="test" /> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Kategori Transaksi</label>
                            <select class="form-select" id="tdna_dk" data-control="select2" name="tdna_dk"
                                data-placeholder="cari Kategori transaksi" data-allow-clear="true">
                                <option></option>
                                <option value="K">Pengeluaran</option>
                                <option value="D">Penerimaan</option>
                            </select>
                            {{-- <input type="text" id="test" /> --}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Tgl. Pengajuan</label>
                            <input type="date" class="form-control" id="tdna_tgl_aju" name="tdna_tgl_aju"
                                data-allow-clear="true" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Diterima Dari/Penerima Dana</label>
                            <select class="form-select" id="tdna_penerima" name="tdna_penerima"
                                data-placeholder="cari penerima dana" data-control="select2" data-allow-clear="true">
                                <option></option>
                            </select>
                            {{-- <input type="text" id="test" /> --}}
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="required form-label">Keterangan</label>
                            <input type="text" class="form-control" id="tdna_ket" name="tdna_ket"
                                data-allow-clear="true" placeholder="input keterangan" />
                        </div>
                    </div>

                    <div class="card-body py-10">
                        <div class="card-toolbar shadow-xs">
                            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                                <button type="button" class="btn btn-light-primary btn-sm me-3 mt-5"
                                    data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top"
                                    title="Transaksi baru" id="tamDtl">Transaksi baru</button>

                                {{-- <button type="button" class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="fa-sharp fa-solid fa-filter"></i> Filter
                                    </button> --}}

                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-800px" data-kt-menu="true">
                                    <div class="px-7 py-5">
                                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                                    </div>
                                    <div class="separator border-gray-200"></div>

                                    <div class="px-7 py-5" data-kt-datatable-table-filter="form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-10">
                                                    <label class="form-label fs-6 fw-bold">Kode PK:</label>
                                                    <input class="form-control" name="kode_new" id="kode_new"
                                                        data-kt-datatable-table-filter="filter" data-allow-clear="true" type="text"
                                                        placeholder="Kode New" />
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
                            <div class="card-body py-5">
                                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                                    <div class="table-responsive">
                                        <table class="table table-rounded table-striped border align-middle gy-5 gs-5"
                                            id="serverSide_kas">
                                            <thead>
                                                <tr
                                                    class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                                    <th class="min-w-150px">No</th>
                                                    <th class="min-w-150px">Keterangan</th>
                                                    <th class="min-w-150px">Debit/Kredit</th>
                                                    <th class="min-w-150px">Nilai</th>
                                                    <th class="min-w-150px">Akun</th>
                                                    <th class="min-w-150px">Nama Akun</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Nominal Dana</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="number" class="form-control" id="tdna_total" name="tdna_total"
                                    data-allow-clear="true" placeholder="input nominal dana" value="0" />
                                {{-- <div class="input-group-append">
                                  <span class="input-group-text">.00</span>
                                </div> --}}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Nomor Voucher</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="tdna_kode_vcr" name="tdna_kode_vcr"
                                    data-allow-clear="true" placeholder="input voucher" readonly />
                                <button type="button" class="btn btn-success" id="mod_input_vcr">Input VCR</button>
                                <button type="button" class="btn btn-primary" id="btn_lihat_vcr"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                                        <span class="text-danger error-text tdna_kode_vcr_err"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-5">
                            <label class="required form-label">Otorisasi Admin</label>
                            <select class="form-select" data-control="select2" id="tdna_aprov_admin"
                                name="tdna_aprov_admin" data-allow-clear="true" data-placeholder="-pilih-">
                                <option></option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-5">
                            <label class="required form-label">Otorisasi Pinca</label>
                            <select class="form-select" data-control="select2" id="tdna_aprov_kacab"
                                name="tdna_aprov_kacab" data-allow-clear="true" data-placeholder="-pilih-">
                                <option></option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Persetujuan Kadiv/Wakadiv Pemasaran</label>
                            <select class="form-select" data-control="select2" id="tdna_aprov_kapms"
                                name="tdna_aprov_kapms" data-allow-clear="true" data-placeholder="-pilih-">
                                <option></option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Persetujuan Korwil Pemasaran</label>
                            <select class="form-select" data-control="select2" id="tdna_aprov_korwil"
                                name="tdna_aprov_korwil" data-allow-clear="true" data-placeholder="-pilih-">
                                <option></option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-5">
                            <label class="required form-label">Persetujuan Keuangan</label>
                            <select class="form-select" data-control="select2" id="tdna_aprov_ho" name="tdna_aprov_ho"
                                data-allow-clear="true" data-placeholder="-pilih-">
                                <option></option>
                                <option value="0">Tidak</option>
                                <option value="1">Iya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-5">
                            <label class="required form-label">Upload Dokumen</label>
                            <div class="input-group">

                                <input type="file" class="form-control" name="tdna_bukti" placeholder="pilih file"
                                    id="tdna_bukti" />
                                {{-- <span class="text-danger error-text mpojk_dokumen_err"></span> --}}
                                <button type="button" class="btn btn-success" id="preview_bukti"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                        class="fa-solid fa-floppy-disk"></i> Simpan</button>
                <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i class="fa-solid fa-trash"></i>
                    Hapus</button>
            </div>
        </form>

        @include('pages.keuangan.kas.master_kas.modal.create')
        @include('pages.keuangan.kas.master_kas.modal.create-voucher')
        @include('pages.keuangan.kas.master_kas.modal.view')
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        setHide('a_pk', true);
        setHide('tkad_atjh_pk', true);
        setHide('tkad_pk', true);
        setHide('nama_akun', true);
        setHide('tdna_user_ins', true);
        setHide('tkad_approvkeu1_user', true);
        setHide('tkav_nomor', true);
        setHide('tkav_tdna_pk', true);
        // setHide('tkav_akun', true);
        setTextReadOnly('tdna_kode_vcr', true);
        setTextReadOnly('tkad_tipe_dk', true);
        setTextReadOnly('tkav_nomor', true);
        setTextReadOnly('tkav_tipe_bayar', true);
        setTextReadOnly('tkav_ket', true);
        setText('kode_new', getText('a_pk'));
        selectOpTag('tkad_keterangan');


        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            selectSideTag('tkad_jns_realisasi', false, '{{ url('api/keuangan/kas/e_realisasi') }}', function(d) {
                    return {
                        text: d.mar_kode + ' - ' + d.mar_nama, // text nama
                        id: d.mar_kode, // kode value
                        // nama: d.mar_nama,
                    }
                },
                function(res) {
                    // setText('nama_akun', res.params.data.nama);
                    // console.log(res.params.data.id);

                },
            );
            selectSide('tdna_penerima', false, '{{ url('api/keuangan/kas/s_karyawan') }}', function(d) {
                    return {
                        text: d.skar_nip + ' - ' + d.skar_nama, // text nama
                        id: d.skar_nip, // kode value
                    }
                },
                function(res) {
                    //
                },
            );

            selectSide('tdna_mlok_kode', false, '{{ url('api/keuangan/kas/kantor-alamin') }}', function(d) {
                    return {
                        text: d.mlok_pk + ' - ' + d.mlok_nama, // text nama
                        id: d.mlok_pk, // kode value
                    }
                },
                function(res) {

                },
            );

            selectSide('tdna_penerima', false, '{{ url('api/keuangan/kas/tdna_penerima') }}', function(d) {
                return {
                    text: d.skar_pk + ' - ' + d.skar_nama,
                    id: d.skar_nama,
                }
            });

            selectSide('e_akun', false, '{{ url('api/keuangan/kas/e_akun') }}', function(d) {
                    return {
                        text: d.asakn_keterangan, // text nama
                        id: d.asakn_kode, // kode value
                        nama: d.asakn_keterangan,
                    }
                },
                function(res) {
                    // alert(res.params.data.nama);
                    setText('nama_akun', res.params.data.nama);
                },
            );

            filterInput('a_pk', 'serverSide_kas');
            serverSide(
                "serverSide_kas",
                "{{ url('api/keuangan/kas/api_tb_dtl') }}",
                function(d) {
                    d.kode_pk = getText('a_pk');
                },
                [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead

                    {
                        data: "DT_RowIndex",
                        className: "text-center"
                    },
                    {
                        data: 'tkad_keterangan'
                    },
                    {
                        data: 'tipe_dk'
                    },
                    {
                        data: 'tkad_total'
                    },
                    {
                        data: 'tkad_askn_kode'
                    },
                    {
                        data: 'tkad_keterangan'
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center',
                        render: function(data, type, row) {
                            return `
                                <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <i class="fa-sharp fa-solid fa-chevron-down"></i>
                                    </span>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <a href="#" id="mod_edit_dtl" class="menu-link px-3" data-resouce="` + row
                                .tkad_pk + `">Edit</a>
                                    </div>
                                    <div class="menu-item px-3">
                                        <a href="#" id="mod_delete_dtl" class="menu-link px-3" data-resouce="` + row
                                .tkad_pk + `">Delete</a>
                                    </div>
                                </div>
                            `;
                        },
                    },
                ]
            );



            submitForm(
                "frxx_vcr",
                "btn_simpan",
                "POST",
                "{{ url('api/keuangan/kas/vcr') }}",
                (resSuccess) => {
                    // lodTable('serverSide_draft');
                    var vcr_no = getText('tkav_nomor');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modal_voucher');
                    clearForm("frxx_vcr");
                    setText('tdna_kode_vcr', vcr_no);
                },
                (resError) => {
                    console.log(resError);
                },
            );

            submitForm(
                "frxx_tkad",
                "btn_simpan",
                "POST",
                "{{ url('api/keuangan/kas/dtl') }}",
                (resSuccess) => {
                    // filterInput('a_pk', 'serverSide_kas');
                    lodTable('serverSide_kas');
                    bsimpan("btn_simpan", 'Simpan');
                    closeModal('modal_rincian_transaksi');
                    clearForm("frxx_tkad");
                },
                (resError) => {
                    console.log(resError);
                },
            );

            submitForm(
                "frxx_m_kas",
                "btn_simpan",
                "POST",
                "{{url('api/keuangan/kas/master-kas')}}",
                (resSuccess) => {
                    bsimpan('btn_simpan', 'Simpan')
                    // clearForm("frxx_m_kas");
                    reload();
                    
                },
                (resError) => {
                    console.log(resError);
                },
            );

            tombol('click', 'mod_edit_dtl', function() {
                var kode = $('#mod_edit_dtl').attr('data-resouce');
                    // console.log(kode);
                    lodJson("GET", "{{ url('api/keuangan/kas/api_edit_dtl') }}" + "/" + kode + "/edit", function (data) {
                    titleAction('tMod', 'Edit Rincian Transaksi');
                    bsimpan('btn_simpan', 'Update');
                    openModal('modal_rincian_transaksi');
                    jsonForm('frxx_tkad', data);
                    lodJson("GET", "{{ url('api/keuangan/kas/edit_akun') }}" + "/" + data.tkad_askn_kode, function(res) {
                        selectEdit('e_akun', res.asakn_kode, res.asakn_keterangan);
                    });
                });
            });

            tombol('click', 'mod_delete_dtl', function() {
                var kode = $('#mod_delete_dtl').attr('data-resouce'),
                    url = "{{ url('api/keuangan/kas/dtl') }}" + "/" + kode;
                submitDelete(kode, url, function(resSuccess) {
                    lodTable("serverSide_kas");
                    // console.log(resSuccess);
                }, function(resError) {
                    // console.log(resError);
                });
            });

            tombol('click', 'tamDtl', function() {
                $('#tMod').text('Rincian Transaksi');
                openModal('modal_rincian_transaksi');
            });

            $('body').on('change', '#jenis_dokumen', function() {
                var _this = $(this).val();
                console.log(_this);
            }).change();


            tombol('click', 'mod_input_vcr', function() {
                url = "{{ url('api/keuangan/kas/tkav_nomor') }}";

                // console.log(e_pk);
                lodJson("GET", url, function(res) {
                    var pk = getText('a_pk');
                    var tdna_tgl_aju = getText('tdna_tgl_aju');
                    var tdna_dk = getText('tdna_dk');
                    var tdna_penerima = getText('tdna_penerima');
                    var tdna_ket = getText('tdna_ket');
                    $('#tMod_vcr').text('Input Voucher Kas');
                    openModal('modal_voucher');

                    var key = "{{ url('api/keuangan/kas/vcr/get_tkad_akun') }}" + "/" + pk;
                    // console.log(key);
                    $.get(key, function(data) {
                        setText('tkav_akun', data.tkad_askn_kode);
                    });
                    setText('tkav_nomor', res);
                    setText('tkav_tanggal', tdna_tgl_aju);
                    setText('tkav_tipe_kas', tdna_dk);
                    setText('tkav_penerima', tdna_penerima);
                    setText('tkav_tipe_bayar', '0');
                    setText('tkav_ket', tdna_ket);
                });
            });
        });

        function closeMod() {
            closeModal('modal_rincian_transaksi');
            clearForm('frxx_tkad');
        }

        function closeModalVcr() {
            closeModal('modal_voucher');
        }
    </script>
@endsection
