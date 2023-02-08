<div class="modal fade" id="modal-view-pdf" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalView_header">
                <h4 class="fw-bolder" id="tMod_vcr_test"></h4>
                <input type="text" class="form-control" name="tMod_vcr_view" id="tMod_vcr_view">
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modal-view-pdf')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" id="modal-body">
                <embed id="view_pdf_show" src="" type="application/pdf" width="100%" height="500">
                    
            </div>

            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modal-view-pdf')">Close</button>
            </div>
        </div>
    </div>
</div>
