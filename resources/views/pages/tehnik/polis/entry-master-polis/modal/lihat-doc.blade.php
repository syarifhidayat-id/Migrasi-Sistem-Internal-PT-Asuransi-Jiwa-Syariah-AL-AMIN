<div class="modal fade" id="modalLihatDoc" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalLihatDoc_header">
                <h2 class="fw-bolder" id="titleLihatDoc"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="close_lihatDoc()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <object id="viewPdfFile" data="" type="application/pdf" width="100%" height="450px"></object>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="close_lihatDoc()"><i class="fa-solid fa-xmark"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
