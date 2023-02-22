<div class="modal fade" id="modalAkun" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalAkun_header">
                <h2 class="fw-bolder" id="titleMod"></h2>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary"
                    onclick="closeModal('modalAkun')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <form id="frxx_akun" name="frxx_akun" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-5">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalAkun_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#modalAkun_header" data-kt-scroll-wrappers="#modalAkun_scroll"
                        data-kt-scroll-offset="300px">
                        <div class="row mb-2">
                            <div class="col-md-6">
                                    <label class="form-label fs-6 fw-bold">Pencarian</label>
                                    <input type="search" data-kt-datatable-table-filter="search" name="e_lovcari"
                                        id="e_lovcari" class="form-control form-control-solid" placeholder="pencarian" />
                            </div>
                            <div class="col-md-6 mb-5">
                                {{-- <label class="required form-label">Keterangan Dokumen</label> --}}
                                <input class="form-control" name="id_index" id="id_index" type="hidden"
                                    data-allow-clear="true" />
                            </div>
                            <div class="col-md-6 mb-5">
                                {{-- <label class="required form-label">Keterangan Dokumen</label> --}}
                                <input class="form-control" name="e_lovlain" id="e_lovlain" type="hidden"
                                    data-allow-clear="true" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-rounded table-striped border cell-border align-middle gy-5 gs-5"
                        id="serverSide_lov_polis">
                        <thead>
                            <tr
                                class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                <th class="min-w-50px">Kode</th>
                                <th class="min-w-200px">Nama</th>
                                <th class="min-w-100px">Keterangan</th>
                            </tr>
                        </thead>
                        {{-- <tbody></tbody> --}}
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalAkun')"> Tutup</button>
            </div>
        </div>
    </div>
</div>
