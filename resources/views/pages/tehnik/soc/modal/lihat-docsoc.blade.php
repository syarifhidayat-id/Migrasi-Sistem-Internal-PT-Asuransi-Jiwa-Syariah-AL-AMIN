<div class="modal fade" id="modalLihatDoc" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalLihatDoc_header">
                <h2 class="fw-bolder" id="titleLihatDoc"></h2>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div>
            </div>

            <div class="modal-body">
                <div class="card-body py-2">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalLihatDoc_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalLihatDoc_header" data-kt-scroll-wrappers="#modalLihatDoc_scroll" data-kt-scroll-offset="300px">
                        <canvas id="pdfView"></canvas>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="close_mDoc()"><i class="fa-solid fa-xmark"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
