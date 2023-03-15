<div class="modal fade" id="modalLihatTarif" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalLihatTarif_header">
                <h2 class="fw-bolder" id="titleLihatTarif"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="close_mLTarif()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <div class="card-body py-2 scroll-y">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="modalLihatTarif_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#modalLihatTarif_header" data-kt-scroll-wrappers="#modalLihatTarif_scroll" data-kt-scroll-offset="300px">
                        <div class="table-responsive">
                            <iframe id="tbTarif" src="" frameborder="0" width="100%" height="450px"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="close_mLTarif()"><i class="fa-solid fa-xmark"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
