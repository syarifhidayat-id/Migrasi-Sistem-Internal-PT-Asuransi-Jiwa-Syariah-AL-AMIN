<div class="modal fade" id="modalLihatUw" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalLihatUw_header">
                <h2 class="fw-bolder" id="titleLihatUw"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalLihatUw')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <div class="mb-5" hidden>
                    <form id="frxmodalLihatUw" action="" method="POST">
                        <label for="">mpuw nomor</label>
                        <input type="text" class="form-control" name="mpuw_nomor" id="mpuw_nomor">
                    </form>
                </div>
                <div class="card-body py-2 scroll-y">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalLihatUw_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalLihatUw_header" data-kt-scroll-wrappers="#modalLihatUw_scroll" data-kt-scroll-offset="300px">
                        <div class="table-responsive">
                            <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="listTableUw">
                                <thead>
                                    <tr class="fw-bold text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                        <td>No.</td>
                                        <td>Tipe Peserta</td>
                                        <td>Keterangan</td>
                                        <td>Deskripsi</td>
                                        <td>Minimal Umur</td>
                                        <td>Maksimal Umur</td>
                                        <td>Minimal UP</td>
                                        <td>Maksimal UP</td>
                                        <td>x+n</td>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalLihatUw')"><i class="fa-solid fa-xmark"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
