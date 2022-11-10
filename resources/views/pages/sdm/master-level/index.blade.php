@extends('layouts.main-admin')

@section('title')
    Entry Level Jabatan
@endsection

@section('content')
<div class="card-header">
    <div class="card-toolbar justify-content-end">
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                <a type="button" target="newtab" href="{{ route('sdm.pegawai.lihat-level.index') }}" class="btn btn-success btn-sm" id="btn_tutup"><i
                    class="fa-solid fa-eye"></i> Lihat Level
                </a>
                {{-- <a type="button" href="master-direktorat/lihat-direktorat/" class="btn btn-success btn-sm" id="btn_tutup"><i
                    class="fa-solid fa-eye"></i> Lihat Direktorat
                </a> --}}
            </div>
        </div>
    </div>
</div>
<form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
    @csrf
    <div class="card mb-5 mb-xxl-10">
        <div class="px-7 py-5">
            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Kode Level :</label>
                        {{-- <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="slv_kode" id="slv_kode">
                            <option></option>
                            @foreach ($carilevel as $key=>$data)
                                <option value="{{ $data->slv_kode }}">{{ $data->slv_kode }}</option>
                            @endforeach
                        </select> --}}

                        <input type="text" class="form-control form-control-solid" name="slv_kode" id="slv_kode"/>
                    </div>
                </div>


                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Keterangan :</label>
                        <input type="text" class="form-control form-control-solid" name="slv_keterangan" id="slv_keterangan"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Tunjangan Jabatan :</label>
                        <input type="number" class="form-control form-control-solid" name="slv_tunjangan" id="slv_tunjangan"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Uang Penginapan :</label>
                        <input type="number" class="form-control form-control-solid" name="slv_tun_inap" id="slv_tun_inap"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Uang Makan :</label>
                        <input type="number" class="form-control form-control-solid" name="slv_tun_makan" id="slv_tun_makan"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Uang Saku :</label>
                        <input type="number" class="form-control form-control-solid" name="slv_tun_saku_wd" id="slv_tun_saku_wd"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Uang Saku (sabtu/minggu) :</label>
                        <input type="number" class="form-control form-control-solid" name="slv_tun_saku_we" id="slv_tun_saku_we"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Uang Saku Dinas Keluar Negeri :</label>
                        <input type="number" class="form-control form-control-solid" name="slv_tun_saku_lu" id="slv_tun_saku_lu"/>
                    </div>
                </div>

                <div class="col">
                    <div class="fv-row mb-7">
                        <label class="form-label fs-6 fw-bold">Angkutan Setempat :</label>
                        <input type="number" class="form-control form-control-solid" name="slv_tun_angkot" id="slv_tun_angkot"/>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="modal-footer justify-content-center">
        <button type="submit" class="btn btn-primary btn-sm" id="btn_simpan"><i
                class="fa-solid fa-floppy-disk"></i> Simpan</button>
        <button type="button" class="btn btn-warning btn-sm" id="btn_reset"><i
                class="fa-solid fa-trash"></i> Hapus</button>
        <button type="button" class="btn btn-danger btn-sm" id="btn_tutup"><i
                class="fa-solid fa-xmark"></i> Tutup</button>
    </div>
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


            $('#frxx').submit(function(e) {
                // $('#btn_simpan').click(function(e) {
                e.preventDefault();
                // var dataFrx = $('#frxx').serialize();
                var formData = new FormData(this); //jika ada input file atau dokumen
                bsimpan('btn_simpan', 'Please wait..');

                $.ajax({
                    url: "{{ route('sdm.pegawai.master-level.store') }}",

                    type: "POST",
                    data: formData,
                    cache: false, //jika ada input file atau dokumen
                    contentType: false, //jika ada input file atau dokumen
                    processData: false, //jika ada input file atau dokumen
                    // dataType: 'json',
                    success: function(res) {
                         window.location.reload();
                        if ($.isEmptyObject(res.error)) {
                            // console.log(res);
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
    </script>
@endsection
