@extends('layouts.main-admin')

@section('title')
    Absensi Harian
@endsection

@section('content')
    <div class="card mb-5 mb-xxl-10">

        <div class="card-header">
            <div class="card-title">
                <h3>List Absensi Harian</h3>
            </div>
        </div>

        <form id="frxrpt" name="frxrpt" action="{{ url('sdm/kehadiran/monitoring-absen-harian/list') }}" method="get"
            onSubmit="return form_submit(this,0);">
            @csrf
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex justify-content-start" data-kt-datatable-table-toolbar="base">
                        <button type="button" class="btn btn-light-primary me-3 btn-sm"
                            onclick="openModal('modalFilter')"><i class="fa-sharp fa-solid fa-filter"></i> Filter
                            Pencarian</button>
                    </div>
                </div>

                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-datatable-table-toolbar="base">
                        <div id="kt_table_datatable_export" class="d-none"></div>

                        <button type="button" id="btn_export" data-title="DAFTAR SUMMARY OF COMMISION"
                            class="btn btn-light-primary me-3 btn-sm" data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end"><i class="fa-sharp fa-solid fa-arrow-up-from-bracket"></i>
                            Export</button>

                        <div id="kt_table_datatable_export_menu" title-kt-export="DAFTAR SUMMARY OF COMMISION"
                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                            data-kt-menu="true">
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

                        {{-- <button type="button" id="omodTam" class="btn btn-primary me-3 btn-sm"><i
                            class="fa-solid fa-square-plus"></i> Input Pic Tax</button>
                    <button type="button" id="omodEdit" class="btn btn-primary btn-sm"><i
                            class="fa-solid fa-pen-to-square"></i> Update Saldo Tax</button> --}}
                    </div>
                </div>
            </div>

            <div class="card-body py-10">
                <div class="fw-bold fs-6 text-gray-800 text-center mb-5">DAFTAR ABSENSI HARIAN</div>
                <div class="table-responsive" id="dtTable"></div>
            </div>
            {{-- @include('pages.tehnik.soc.lihat-soc.modal.filter') --}}
        </form>

        {{-- @include('pages.tehnik.soc.lihat-soc.modal.cetak') --}}
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            setLoad("#dtTable", "{{ url('sdm/kehadiran/monitoring-absen-harian/list') }}");

            // selectSide('e_pmgpolis', false, '{{ url('tehnik/soc/lihat-soc-khusus/lod_pmg_polis') }}', function(d) {
            //     return {
            //         id: d.kode,
            //         text: d.nama
            //     }
            // });

            // tombol ('change', 'approv_soc', function () {
            //     var kode = $(this).attr('data-kode');
            //     var val = $(this).val();
            //     validate(
            //         "Data dengan kode berikut " + kode + " akan di approve!",
            //         (result) => {
            //             if (result.isConfirmed) {
            //                 getPost("{{ url('api/tehnik/soc/lihat-soc-khusus/update-status-approval') }}" + "/" + kode + "/" + val, '', function(data) {
            //                     // console.log(data);
            //                     message(
            //                         'success',
            //                         'Data berhasil di approve dengan kode ' + kode + ' !',
            //                     );
            //                     setCheck(this, true);
            //                     lodTable('datalistSoc');
            //                 });
            //             } else {
            //                 setCheck(this, false);
            //             }
            //         }
            //     );
            // });
        });

        function form_submit(form, ids) {
            filter(form, ids, function(res) {
                setHtml("#dtTable", res);
                return false;
            }, function(errr) {
                pesan("error", "Data gagal dimasukkan. \n cek koneksi jaringan");
            });
            return false;
        }

        function aprovalsoc(kodepolis, tipe) {
            vv = {
                res: ''
            };
            rms = "kodepolis=" + kodepolis;
            url = '{{ url('api/tehnik/polis/approval-master-polis/get-kode-soc') }}' + '?' + rms;
            $.get(url, vv, function(data) {
                if (data) {
                    if (tipe = "0") {
                        titleAction('titleModal', 'From Cetak');
                        openModal('modalCetakSoc');
                        setText("mpap_mpol_kode", kodepolis);
                        setText("kodex_soc", data.msoc_kode);
                        jsonForm('cetakLihatSoc', data);
                    }
                }
            });
        }
    </script>
@endsection
