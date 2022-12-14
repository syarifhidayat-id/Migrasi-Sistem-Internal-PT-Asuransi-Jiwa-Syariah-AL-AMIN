<style>
    #canvas_container {
        width: 100%;
        height: 450px;
        overflow: auto;
    }

    #canvas_container {
        background: #333;
        text-align: center;
        border: solid 3px;
    }
</style>

<div class="modal fade" id="modalLihatDoc" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalLihatDoc_header">
                <h2 class="fw-bolder" id="titleLihatDoc"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="close_lihatDoc()"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group input-group-solid mb-5">
                            <button type="button" id="go_previous" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-chevron-left"></i> Previous</button>
                            <input type="text" class="form-control" name="current_page" id="current_page" value="1" />
                            <span class="input-group-text">/</span>
                            <input type="text" class="form-control" name="tot_page" id="tot_page" readonly />
                            <button type="button" id="go_next" class="btn btn-sm btn-light-primary">Next &nbsp;<i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group input-group-solid mb-5">
                            <span class="input-group-text">Zoom</span>
                            <button type="button" id="zoom_out" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-minus"></i></button>
                            <button type="button" id="zoom_in" class="btn btn-sm btn-light-primary"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div id="canvas_container">
                            <canvas id="viewPdfFile"></canvas>
                        </div>
                    </div>
                </div>
                {{-- <object id="lihatFileDoc" type="application/pdf" width="100%" height="500px"></object> --}}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="close_lihatDoc()"><i class="fa-solid fa-xmark"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
