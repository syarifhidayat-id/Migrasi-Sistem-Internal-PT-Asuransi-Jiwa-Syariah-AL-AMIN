@extends('layouts.main-admin') 
@section('title') Entry Master Pegawai 
@endsection @section('content')

<div class="card-header">
	<div class="card-toolbar justify-content-end">
		<div class="card-toolbar">
			<div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base"> <a type="button" target="newtab" href="{{ route('sdm.pegawai.lihat-keahlian.index') }}" class="btn btn-success btn-sm" id="btn_tutup"><i
                    class="fa-solid fa-eye"></i> Lihat Pegawai
                </a> {{-- <a type="button" href="master-direktorat/lihat-direktorat/" class="btn btn-success btn-sm" id="btn_tutup"><i
                    class="fa-solid fa-eye"></i> Lihat Direktorat
                </a> --}} </div>
		</div>
	</div>
</div>

<form id="frxx" name="frxx" method="post" enctype="multipart/form-data">
    @csrf
    
    <div class="card mb-5 mb-xxl-10">
		<div class="px-7 py-5">

            <div class="accordion " id="kt_accordion_1">
                {{-- AWAL DATA DIRI --}}
                <div class="accordion-item">
					<h2 class="accordion-header" id="kt_accordion_1_header_1">
                            <button class="accordion-button fs-4 fw-semibold text-white" style="background-color: #0350BF;" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_1" aria-expanded="true" aria-controls="kt_accordion_1_body_1">
                                I. FORM DATA DIRI
                            </button>
                        </h2>
					<div id="kt_accordion_1_body_1" class="accordion-collapse collapse show" aria-labelledby="kt_accordion_1_header_1" data-bs-parent="#kt_accordion_1">
						<div class="accordion-body">
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">ID System :</label>
										<input type="text" class="form-control bg-warning" name="skar_pk" id="skar_pk" readonly/> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nama :</label>
										<input type="text" class="form-control form-control-solid" name="skar_nama" id="skar_nama" /> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor Induk Pegawai :</label>
										<input type="number" class="form-control form-control-solid" name="skar_nip" id="skar_nip" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold text-white">Nomor Induk Pegawai lama :</label>
										<input type="number" class="form-control form-control-solid" name="skar_nip_lama" id="skar_nip_lama" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7 ">
										<label class="form-label fs-6 fw-bold">Ibu Kandung :</label>
										<input type="text" class="form-control form-control-solid" name="skar_ibu_kandung" id="skar_ibu_kandung" /> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-4">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Tempat Lahir :</label>
										<input type="text" class="form-control form-control-solid" name="skar_tmp_lahir" id="skar_tmp_lahir" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Tanggal Lahir :</label>
										<input class="form-control form-control-solid" placeholder="pilih tanggal" id="kt_datepicker_1" name="skar_tanggal_lahir" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7 ">
										<label class="form-label fs-6 fw-bold">Jenis Kelamin :</label>
										<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="skar_kelamin" id="skar_kelamin">
											<option value=''>--- pilih ---</option>
											<option value="0">LAKI-LAKI</option>
											<option value="1">WANITA</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="fv-row mb-7 ">
										<label class="form-label fs-6 fw-bold">Status Nikah :</label>
										<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="skar_status_kawin" id="skar_status_kawin">
											<option value=''>--- pilih ---</option>
											<option value="0">LAJANG</option>
											<option value="1">MENIKAH</option>
											<option value="2">JANDA</option>
											<option value="3">DUDA</option>
											<option value="4">-</option>
										</select>
									</div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Email :</label>
										<input type="text" class="form-control form-control-solid" name="skar_facebook" id="skar_facebook" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor KTP :</label>
										<input type="number" class="form-control form-control-solid" name="skar_no_identitas" id="skar_no_identitas" /> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor HP :</label>
										<input type="number" class="form-control form-control-solid" name="skar_no_kontak" id="skar_no_kontak" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor WA :</label>
										<input type="number" class="form-control form-control-solid" name="skar_no_wa" id="skar_no_wa" /> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor NPWP :</label>
										<input type="text" class="form-control form-control-solid" name="skar_npwp" id="skar_npwp" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor Rekening :</label>
										<input type="text" class="form-control form-control-solid" name="skar_rek_nomor" id="skar_rek_nomor" /> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-3">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Pendidikan :</label>
										<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="skar_spen_kode" id="skar_spen_kode">
											<option value=''>--- pilih ---</option>
											<option value="0">-</option>
											<option value="1">SD/MI</option>
											<option value="2">SMP/MTS</option>
											<option value="3">SMA/MAN</option>
											<option value="4">SMK</option>
											<option value="5">D1</option>
											<option value="6">D3</option>
											<option value="7">S1</option>
											<option value="8">S2</option>
											<option value="9">S3</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Kewarganegaraan :</label>
										<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="skar_warganegara" id="skar_warganegara">
											<option value=''>--- pilih ---</option>
											<option value="0">WARGA NEGARA INDONESIA</option>
											<option value="1">WARGA NEGARA ASING</option>
										</select>
									</div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Sekolah/Universitas :</label>
										<input type="text" class="form-control form-control-solid" name="skar_lembaga_pendidikan" id="skar_lembaga_pendidikan" /> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor BPJS Tenaga Kerja :</label>
										<input type="number" class="form-control form-control-solid" name="skar_bpjs_kerja" id="skar_bpjs_kerja" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Nomor BPJS Tenaga Kesehatan :</label>
										<input type="number" class="form-control form-control-solid" name="skar_bpjs_sehat" id="skar_bpjs_sehat" /> </div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-1">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Alamat KTP :</label>
										<textarea class="form-control form-control-solid" aria-label="With textarea" name="skar_alamat1" id="skar_alamat1"></textarea>
									</div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-1">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Alamat Domisili :</label>
										<textarea class="form-control form-control-solid" aria-label="With textarea" name="skar_alamat2" id="skar_alamat2"></textarea>
									</div>
								</div>
							</div>
							<div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2 bg-warning" style="border-radius: 0.5em">
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Email Login :</label>
										<input type="text" class="form-control form-control-solid" name="skar_email_login" id="skar_email_login" /> </div>
								</div>
								<div class="col ">
									<div class="fv-row mb-7"> {{-- <i class="fonticon-bicycle fs-1" data-bs-toggle="tooltip" title="<em>Tooltip</em> <u>with</u> <b>HTML</b>"></i> --}}
										<label class="form-label fs-6 fw-bold"> Nomor HP Login : </label>
										<input type="text" class="form-control form-control-solid" name="skar_hp_login" id="skar_hp_login" /> </div>
								</div>
								<div class="col">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold">Pertanyaan Pilihan Rahasia Anda :</label>
										<select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="--- pilih ---" data-allow-clear="true" data-kt-datatable-table-filter="nama-route" data-hide-search="false" name="skar_stc_pk_1" id="skar_stc_pk_1">
											<option value=''>--- pilih ---</option>
											<option value='0'>?</option>
											<option value='1'>Apa warna favorit anda ?</option>
											<option value='2'>Siapa guru Sekolah Dasar yang anda kenal ?</option>
											<option value='3'>Siapa Nama Hewan Peliharaan Anda ?</option>
											<option value='4'>Siapa persiden yang paling bagus menurut anda ?</option>
											<option value='5'>Apa hoby anda ?</option>
											<option value='6'>Siapa nama ibu kandung anda ?</option>
											<option value='8'>Siapa anak pertama anda ?</option>
											<option value='9'>Berapa ukuran sepatu anda ?</option>
											<option value='10'>Apa makanan favorit anda ?</option>
											<option value='11'>Sekolah SMA anda ?</option>
											<option value='12'>Apa cita-cita anda saat kecil ?</option>
											<option value='13'>Dimana tempat paling berkesan menurut anda ?</option>
											<option value='14'>Siapa kekasih anda pertama kali ?</option>
											<option value='15'>Dimana tempat berkerja pertama kali ?</option>
											<option value='16'>Siapa Bapak kandung anda ?</option>
											<option value='17'>Kapan anda bertemu dengan kekasih anda ?</option>
											<option value='18'>Berapa jumlah saudara/i anda ?</option>
											<option value='19'>Berapa teman paling dekat dengan anda ?</option>
											<option value='20'>Berapa hasil 2 + 2 x 1 x 1 + 2 + 1 ?</option>
											<option value='21'>Berapa tinggi badan anda ?</option>
											<option value='22'>Umur berapa anda merasa sudah baligh ?</option>
											<option value='23'>Umur berapa anda bisa nyetir mobil ?</option>
											<option value='24'>Pelajaran Apa yang anda sukai di SMP ?</option>
											<option value='25'>Umur berapa anda bisa ngaji ?</option>
											<option value='26'>Umur berapa anda bisa baca tulis ?</option>
											<option value='27'>Siapa tokoh superhero favorit mu ?</option>
											<option value='28'>Siapa tokoh orang terkenal favorit mu ?</option>
											<option value='29'>Model Rambut apa yang anda sukai ?</option>
											<option value='30'>Siapa orang paling dekat selain pasangan anda ?</option>
											<option value='31'>Apa Tim Olahraga Favorit Anda ?</option>
										</select>
									</div>
								</div>
								<div class="col ">
									<div class="fv-row mb-7">
										<label class="form-label fs-6 fw-bold"> Jawaban Anda : </label>
										<input type="text" class="form-control form-control-solid" name="skar_stc_jwb_1" id="skar_stc_jwb_1" /> </div>
								</div>
							</div>
						</div>
					</div>
				</div>
                {{-- AKHIR DATA DIRI --}}

                {{-- AWAL PENDIDIKAN --}}
                <div class="accordion-item">
					<h2 class="accordion-header" id="kt_accordion_1_header_2">
                        <button style="background-color: #0350BF;" class="accordion-button fs-4 fw-semibold collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2" aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                        II. FORM PENDIDIKAN
                        </button>
                    </h2>
					<div id="kt_accordion_1_body_2" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
						<div class="accordion-body">

                            {{-- <form action=""> --}}
                                <div id="inputs">
                                    <div class="container row">
                                        <div hidden>
                                            <div class="count">1</div>
                                        </div>
                                        <div class=" row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                            <div class="col">
                                                <div class="fv-row mb-7"> <span>No.</span>
                                                    <input type="number" class="form-control form-control-solid" name="skap_no" id="skap_no" placeholder="1." /> </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row mb-7"> <span>Pendidikan</span>
                                                    <select class="form-select form-select-solid fw-bolder" name="skap_pend" id="skap_pend">
                                                        <option selected value='0'>SD</option>
                                                        <option value='1'>SMP</option>
                                                        <option value='2'>SMU/SMK</option>
                                                        <option value='3'>DIPLOMA</option>
                                                        <option value='4'>S-1</option>
                                                        <option value='5'>S-2</option>
                                                        <option value='6'>DOCTOR</option>
                                                        <option value='7'>KURSUS</option>
                                                        <option value='8'>LAINNYA</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row mb-7"> <span>Periode.</span>
                                                    <input type="text" class="form-control form-control-solid" name="skap_no" id="skap_no" placeholder="1999 - 2003 " /> </div>
                                            </div>
                                            <div class="col">
                                                <div class="fv-row mb-7"> <span>Keterangan.</span>
                                                    <textarea class="form-control form-control-solid" aria-label="With textarea" name="skap_pend_nama" id="skap_pend_nama" placeholder="keterangan"></textarea>
                                                </div>
                                            </div>

                                            <hr>
                                        </div>
                                    </div>
                                </div>

                            {{-- </form> --}}
						
                            <a class="btn btn-primary btn-sm" onclick="addDidik()"><i class="fa-solid fa-floppy-disk"></i> Tambah Data</a>
						
						</div>
					</div>
				</div>
                {{-- AKHIR PENDIDIKAN --}}

                <!--AWAL KEAHLIAN-->
				<div class="accordion-item">
					<h2 class="accordion-header" id="kt_accordion_1_header_3">
                            <button class="accordion-button fs-4 fw-semibold collapsed text-white" type="button" data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_3" aria-expanded="false" style="background-color: #0350BF;" aria-controls="kt_accordion_1_body_3">
                            III. KEAHLIAN
                            </button>
                        </h2>
					<div id="kt_accordion_1_body_3" class="accordion-collapse collapse" aria-labelledby="kt_accordion_1_header_3" data-bs-parent="#kt_accordion_1">
						<div class="accordion-body"> ... 

                            
                        </div>
					</div>
				</div>
				<!--AKHIR KEAHLIAN-->

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
			url: "{{ route('sdm.pegawai.master-keahlian.store') }}",
			type: "POST",
			data: formData,
			cache: false, //jika ada input file atau dokumen
			contentType: false, //jika ada input file atau dokumen
			processData: false, //jika ada input file atau dokumen
			// dataType: 'json',
			success: function(res) {
				window.location.reload();
				if($.isEmptyObject(res.error)) {
					// console.log(res);
					Swal.fire('Berhasil!', res.success, 'success').then((res) => {
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
$("#kt_datepicker_1").flatpickr();

 function addDidik(){
    let lastRow = $('.row:last').html();
	var matchedString = lastRow.match(/<div class="count">([0-9]*)<\/div>/);
	if(matchedString.length) {
		let nextNumber = matchedString[1] * 1;
		nextNumber++
		var newRow = lastRow.replace(matchedString[0], '<div class="count">' + nextNumber + '</div>');
	}
	$('#inputs').append('<div class="container row">' + newRow + '</div>');
	return false;

 }

</script> @endsection
