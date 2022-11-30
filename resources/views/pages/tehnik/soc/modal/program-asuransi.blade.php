<div class="modal fade" id="modalProg" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalProg_header">
                <h2 class="fw-bolder" id="titleModal"></h2>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalProg')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>

            <div class="modal-body">
                <div class="mb-5" hidden>
                    <form id="frxmodalProg" action="" method="POST">
                        <label for="">mpid</label>
                        <input type="text" class="form-control" name="mpid" id="mpid">
                        {{-- <label for="">mkm</label>
                        <input type="text" class="form-control" name="mkm" id="mkm"> --}}
                        <label for="">mkm2</label>
                        <input type="text" class="form-control" name="mkm2" id="mkm2">
                        <label for="">mft</label>
                        <input type="text" class="form-control" name="mft" id="mft">
                        <label for="">mrkn</label>
                        <input type="text" class="form-control" name="mrkn" id="mrkn">
                        <label for="">mssp</label>
                        <input type="text" class="form-control" name="mssp" id="mssp">
                        <label for="">mjm</label>
                        <input type="text" class="form-control" name="mjm" id="mjm">
                        <label for="">mjns</label>
                        <input type="text" class="form-control" name="mjns" id="mjns">
                        {{-- <label for="">byr</label>
                        <input type="text" class="form-control" name="byr" id="byr"> --}}
                        <label for="">perush</label>
                        <input type="text" class="form-control" name="perush" id="perush">
                    </form>
                </div>
                <div class="card-body py-2">
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="progAsur">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                    <th class="min-w-200px">Program Asuransi</th>
                                    <th>Nomor SOC</th>
                                    <th>Kode Program Asuransi</th>
                                    <th>Up Tambahan</th>
                                    <th>Ujrah Referal</th>
                                    <th>Discount Rate</th>
                                    <th>Tambahan Jiwa</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" onclick="closeModal('modalProg')"><i class="fa-solid fa-xmark"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
