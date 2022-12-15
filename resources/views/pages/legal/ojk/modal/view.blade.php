<div class="modal fade" id="modalView" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalView_header">
                <h4 class="fw-bolder" id="tModView"></h4>

                {{-- <div class="btn btn-icon btn-sm btn-active-icon-primary" id="btn_close3">
                    <span class="svg-icon svg-icon-1">
                        <i class="fa-sharp fa-solid fa-xmark"></i>
                    </span>
                </div> --}}
            </div>
            <div class="modal-body" id="modal-body">
                <Object id="view_pdf" data="" type="application/pdf" width="100%" height="500"></Object>
            </div>

                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger btn-sm" onclick="closePdf()">Close</button>
                    {{-- <button type="button" class="btn btn-danger btn-sm" onclick="close_pojk()"><i
                            class="fa-solid fa-xmark" ></i> Tutup</button> --}}
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
