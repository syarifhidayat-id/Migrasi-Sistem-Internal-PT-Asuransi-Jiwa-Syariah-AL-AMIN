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
                    <input class="form-control" type="text" id="a_pk" value="{{ $kode }}" />
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
                            <select class="form-select" id="tdna_penerima" data-control="select2" name="tdna_penerima"
                                data-placeholder="cari penerima dana" data-allow-clear="true">
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
                                    title="Transaksi baru" onclick="tombolAct(0)">Transaksi baru</button>
                            </div>
                            <div class="card-body py-5">
                                <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                                    <div class="table-responsive">
                                        <table class="table table-rounded table-striped border align-middle gy-5 gs-5"
                                            id="serverSide_kas">
                                            <thead>
                                                <tr
                                                    class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                                    <th class="min-w-150px">Keterangan</th>
                                                    <th class="min-w-150px">Debit/Kredit</th>
                                                    <th class="min-w-150px">Nilai</th>
                                                    <th class="min-w-150px">Akun</th>
                                                    <th class="min-w-150px">Nama Akun</th>
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
                                <input type="number" class="form-control" id="tdna_kode_vcr" name="tdna_kode_vcr"
                                    data-allow-clear="true" placeholder="input voucher" readonly />
                                <button type="button" class="btn btn-success" onclick="tombolVcr(0)">Input VCR</button>
                                <button type="button" class="btn btn-primary" id="btn_lihat_vcr"><i
                                        class="fa-sharp fa-solid fa-magnifying-glass"></i></button>
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
        setTextReadOnly('tkad_tipe_dk', true);
        setTextReadOnly('tkav_nomor', true);

        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // selectGrid(
            //     'msoc_mrkn_nama',
            //     'GET',
            //     '{{ url('api/keuangan/kas/kantor-alamin') }}',
            //     'mlok_pk',
            //     'mlok_nama',
            //     [
            // 		{field:'mlok_pk',title:'Kode',align:'left',width:180},
            // 		{field:'mlok_nama',title:'Nama',align:'left',width:280},
            // 	],
            //     function(i, row) {
            //         // hidePesan('msoc_mrkn_nama');
            //         // var kode = row.kode;
            //         // if (getText('msoc_nomor')=='') {
            //         //     setText('msoc_mrkn_kode', kode);
            //         //     bersih(2);
            //         //     bersih(1);
            //         // }
            //     }
            // );

            selectSide('tkad_jns_realisasi', true, '{{ url('api/keuangan/kas/e_realisasi') }}', function(d) {
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
                    // alert(res.params.data.id);
                    // var key = '{{ url('api/legal/pks/get_all_pks') }}' + '/' + res.params.data.id;
                    // $.get(key, function(a) {
                    //     $('#frxx_add').formToJson(a);
                    //     if (a.mpks_mrkn_kode !== "") {
                    //         var mrkn = "{{ url('api/legal/pks/get_edit_polis') }}" + "/" + a.mpks_mrkn_kode;
                    //         $.get(mrkn, function(b) {
                    //             selectEdit('mpks_mrkn_kode_test', b.mrkn_kode, b.mrkn_nama);

                    //         });
                    //     }
                    // });
                },
            );

            selectSide('e_akun', false, '{{ url('api/keuangan/kas/e_akun') }}', function(d) {
                    return {
                        text: d.asakn_kode + ' - ' + d.asakn_keterangan, // text nama
                        id: d.asakn_kode, // kode value
                        nama: d.asakn_keterangan,
                    }
                },
                function(res) {
                    // alert(res.params.data.nama);
                    setText('nama_akun', res.params.data.nama);
                },
            );

            // filterAll('input[type="search"]', 'serverSide_ojk'); //khusus type search inputan

            //     serverSide( //datatable serverside
            //         "serverSide_kas", //url api/route
            //         // "serverSide_kas", "{{ url('api/legal/laporan_berkala') }}", //url api/route
            //         function(a) { // di isi sesuai dengan data yang akan di filter ->
            //             // d.check_id = getText('check_id'),
            //             // d.mojk_pk = getText('check_id_mojk'),
            //             // d.search = $('input[type="search"]').val();
            //         },
            //         [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
            //             {
            //                 data: 'tkad_keterangan'
            //             },
            //             {
            //                 data: 'mojk_ket_jenis'
            //             },
            //             {
            //                 data: 'mojk_tahun'
            //             },
            //             {
            //                 data: 'mojk_ins_user'
            //             },
            //             {
            //                 data: 'ins_date'
            //             },
            //         ],
            //     );
            // });

            tombol('click', 'omodTam', function() {

            });


            tombol('click', 'btn_simpan', function() {
                closeModal('modal_rincian_transaksi');
                // var e_pk = $('#e_pk').val();
                var e_akun = $('#e_akun').val();
                var tkad_keterangan = $('#tkad_keterangan').val();
                var tkad_tipe_dk = $('#tkad_tipe_dk').val();
                var tkad_mta_pk = $('#tkad_mta_pk').val();
                var tkad_total = $('#tkad_total').val();
                var tkad_jns_realisasi = $('#tkad_jns_realisasi').val();
                var e_kasbon = $('#e_kasbon').val();
                var nama_akun = $('#nama_akun').val();
               

                if (tkad_tipe_dk == 'D') {
                    var tipe_dk = 'Debit';
                }
                if (e_pk != "") {
                    $('#serverSide_kas tbody').append('<tr class="child"><td>' + tkad_keterangan +
                        '</td><td>' + tipe_dk + '</td><td>' + tkad_total + '</td><td>' + e_akun +
                        '</td><td>' + nama_akun + '</td></tr>');
                }
            });


            $('body').on('change', '#jenis_dokumen', function() {
                var _this = $(this).val();
                console.log(_this);
            }).change();

            tombol('click', 'omodTam', function() {
                $('#modal').modal('show');
                setHide('btn_reset', false);
                bsimpan('btn_simpan', 'Simpan');
                $('#tMod').text('Tambah data');
                bsimpan('btn_simpan', 'Simpan');
                clearForm('frxx');
                clearSelect();

            });

            tombol('click', 'omodEdit', function() {
                $('#tMod').text('Edit Data');
                setHide('btn_reset', true);
                bsimpan('btn_simpan', 'Update');
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/ojk') }}" + "/" + kode + "/edit";
                $.get(url, function(res) {
                    // var key = "{{ url('api/legal/get_mojk_jenis') }}";
                    $('#modal').modal('show');
                    openModal('modal');
                    jsonForm('frxx', res);

                });
            });


            $('body').on('click', '#omodDelete', function() {
                var kode = $(this).attr('data-resouce'),
                    url = "{{ url('legal/ojk') }}" + "/" + kode;

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
                                    // reset();
                                    lodTable();

                                    console.log('Success', res);
                                },
                                error: function(err) {
                                    // reset();
                                    lodTable();

                                    console.log('Error', err);
                                }
                            });
                        })
                    }
                })
            });
        });


        // function grd_submit() {

        // }
        // function grd_submit() {
        //     submitForm(
        //         "frxx_tkad",
        //         "btn_simpan",
        //         "POST",
        //         (resSuccess) => {
        //             clearForm("frxx_tkad");
        //             clearSelect();
        //             lodTable('serverSide_kas');
        //             bsimpan("btn_simpan", 'Simpan');
        //             closeMod('#modal_rincian_transaksi');
        //         },
        //         (resError) => {
        //             console.log(resError);
        //         },
        //     );
        // }

        function tombolAct(tipe) {
            if (tipe == '0') {
                $('#tMod').text('Rincian Transaksi');
                openModal('modal_rincian_transaksi');
                // setHide('btn_reset');
            }
        }


        //Voucher kas
        function tombolVcr(tipe) {
            if (tipe == '0') {
                url = "{{ url('api/keuangan/kas/tkav_nomor') }}";
                $.get(url, function(res) {
                    var tdna_tgl_aju = getText('tdna_tgl_aju');
                    var tdna_dk = getText('tdna_dk');
                    // var tdna_dk = getText('tdna_dk');
                    // var tdna_dk = getText('tdna_dk');
                    // var tdna_dk = getText('tdna_dk');
                    $('#tMod_vcr').text('Input Voucher Kas');
                    openModal('modal_voucher');
                    setText('tkav_nomor', res);
                    setText('tkav_tanggal', tdna_tgl_aju);
                    setText('tkav_tipe_kas', tdna_dk);
                    
                });
            }
        }

        submitForm(
            "frxx_vcr",
            "btn_simpan",
            "POST",
            "{{ url('api/keuangan/kas/vcr') }}",
            (resSuccess) => {
                clearForm("frxx_vcr");
                clearSelect();
                // lodTable('serverSide_draft');
                bsimpan("btn_simpan", 'Simpan');
                closeModal('modal_voucher');
                clearForm('frxx_vcr');
            },
            (resError) => {
                console.log(resError);
            },
        );

        function closeMod() {
            closeModal('modal_rincian_transaksi');
            clearForm('frxx_tkad');
        }

        function closeModalVcr() {
            closeModal('modal_voucher');
            clearForm('frxx_vcr');
        }

        // function jenisFile(jenis1, jenis2) {
        //     var doc = $('#jenis_dokumen').val();
        //     var url = '{{ url('storage/legal/ojk') }}' + '/';
        //     if (doc == '1') {
        //         $('#view_pdf').attr('src', url + 'file1/' + jenis1);
        //         openModal('modalView');
        //     } else if (doc == '2') {
        //         $('#view_pdf').attr('src', url + 'file2/' + jenis2);
        //         openModal('modalView');
        //     } else {
        //         pesan('Silahkan pilih jenis file terlebih dahulu!');
        //     }
        // }
    </script>
@endsection
