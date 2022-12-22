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
                    <div class="col-md-5">
                        <div class="mb-5">
                            <label class="required form-label">Kantor Al Amin</label>
                            <select class="form-select" id="e_cabalamin"
                                    name="e_cabalamin" data-placeholder="cari kantor alamin" data-allow-clear="true">
                                    <option></option>
                            </select>
                            {{-- <input type="text" id="test" /> --}}
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-5">
                            <label class="required form-label">Kategori Transaksi</label>
                            <select class="form-select" id="kantor_alamin"
                                    name="cari_pk" data-placeholder="cari kantor alamin" data-allow-clear="true">
                                    <option></option>
                            </select>
                            {{-- <input type="text" id="test" /> --}}
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- @include('pages.legal.ojk.modal.create')
        @include('pages.legal.ojk.modal.view') --}}
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // selectGrid(
            //     'msoc_mrkn_nama',
            //     'GET',
            //     '{{ url("api/keuangan/kas/kantor-alamin") }}',
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

            selectSide('kantor_alamin', false, '{{ url("api/keuangan/kas/kantor-alamin") }}', function(d) { return {
                text: d.mlok_pk + ' - ' + d.mlok_nama, // text nama
                id: d.mlok_pk, // kode value
            }},
            function(res) {
                alert(res.params.data.id);
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

            // selectSide('check_id_upload', false, '{{ url('api/legal/ojk/selectId') }}', function(d) { return {
            //     id: d.mojk_pk,
            //     text: d.mojk_pk
            // }}, function(res) {
            //     // setText('msoc_mssp_kode', res.params.data.id);
            //     // setText('msoc_mssp_nama', res.params.data.text);
            // });

            // filterAll('input[type="search"]', 'serverSide_ojk'); //khusus type search inputan

            // serverSide( //datatable serverside
            // "serverSide_ojk",
            //     "{{ url('api/legal/ojk') }}", //url api/route
            //     function(d) { // di isi sesuai dengan data yang akan di filter ->
            //         d.check_id = getText('check_id'),
            //         d.mojk_pk = getText('check_id_upload'),
            //         d.search = $('input[type="search"]').val()
            //     },
            //     [ //fillable body table name, sesuaikan dengan field yang terdapat pada tr thead
            //         {
            //             data: "DT_RowIndex",
            //             className: "text-center"
            //         },
            //         {
            //             // data: 'mojk_pk'
            //             data: null,
            //             orderable: false,
            //             className: 'text-center',
            //             render: function(data, type, row) {
            //                 return `
        //             <button type="button" id="omodEdit" data-resouce="` + row.mojk_pk + `" class="btn btn-light-success" target="blank"> `+ row.mojk_pk +` </button>`
            //             }
            //         },
            //         {
            //             data: 'mojk_judul'
            //         },
            //         {
            //             data: 'jenis_mojk'
            //         },
            //         {
            //             data: 'mojk_ket_jenis'
            //         },
            //         {
            //             data: 'mojk_tahun'
            //         },
            //         {
            //             data: 'mojk_ins_user'
            //         },
            //         {
            //             data: 'mojk_ins_date'
            //         },
            //         {
            //             data: 'select',
            //             orderable: false,
            //             className: 'text-center',
            //             render: function (data, type, row) {
            //                 return `
        //                 <select class="form-select" id="jenis_dokumen" data-pk="`+row.mojk_pk+`"
        //                     name="mojk_jenis" data-placeholder="Pilih jenis dokumen" data-allow-clear="true">
        //                     <option selected>Pilih</option>
        //                     <option value="1">Tanda Terima</option>
        //                     <option value="2">Dokumen</option>
        //                 </select>`
            //             }
            //         },
            //         {
            //             data: null,
            //             orderable: false,
            //             className: 'text-center',
            //             render: function(data, type, row) {
            //                 return `<button type="button" onclick="jenisFile('`+row.mojk_file1+`', '`+row.mojk_file2+`')" class="btn btn-light-success"> Lihat</button>`;
            //             }

            //         },
            //     ],
        // );

        tombol('click', 'omodTam', function() {

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

        $('#frxx').submit(function(e) {
            // $('#btn_simpan').click(function(e) {
            e.preventDefault();
            // var dataFrx = $('#frxx').serialize();
            var formData = new FormData(this); //jika ada input file atau dokumen
            bsimpan('btn_simpan', 'Please wait..');

            $.ajax({
                url: "{{ route('legal.ojk.store') }}",
                type: "POST",
                data: formData,
                cache: false, //jika ada input file atau dokumen
                contentType: false, //jika ada input file atau dokumen
                processData: false, //jika ada input file atau dokumen
                // dataType: 'json',
                success: function(res) {
                    // window.location.reload();
                    if ($.isEmptyObject(res.error)) {
                        console.log(res);
                        Swal.fire(
                            'Berhasil!',
                            res.success,
                            'success'
                        ).then((res) => {
                            lodTable('serverSide_ojk');
                            // reset();
                            // $('#frxx').trigger("reset");
                            $('#modal').modal('hide');
                            bsimpan('btn_simpan', 'Simpan');
                            // x();
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
        }); $('#btn_close3').click(function() {
            $('#modalView').modal('hide');
            // lodTable();
            x();
        }); $('#btn_close4').click(function() {
            // var kode = $(this).attr('data-resouce'),
            // var loc2 = $(location).attr('origin') + '/storage/legal/pojk/' + kode;
            $('#modalView').modal('hide');
            x();

        });

        $('#btn_closeCreate').click(function() {
            $('#modal').modal('hide');
            x();
        }); $('#btn_tutup').click(function() {
            $('#modal').modal('hide');
            x();
        });

        });

        function jenisFile(jenis1, jenis2) {
            var doc = $('#jenis_dokumen').val();
            var url = '{{ url('storage/legal/ojk') }}' + '/';
            if (doc == '1') {
                $('#view_pdf').attr('src', url + 'file1/' + jenis1);
                openModal('modalView');
            } else if (doc == '2') {
                $('#view_pdf').attr('src', url + 'file2/' + jenis2);
                openModal('modalView');
            } else {
                pesan('Silahkan pilih jenis file terlebih dahulu!');
            }
        }
    </script>
@endsection
