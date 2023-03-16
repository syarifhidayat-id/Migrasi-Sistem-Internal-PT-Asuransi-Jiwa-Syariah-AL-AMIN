<div class="modal fade" id="modalTampil" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-950px">
        <div class="modal-content">
            <div class="modal-header" id="modalView_header">
                <h4 class="fw-bolder" id="tModView"></h4>
                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" onclick="closeModal('modalView')"><i class="fa-sharp fa-solid fa-xmark"></i></button>
            </div>
            <div class="modal-body" id="modal-body">
                {{-- <div class="card-body py-12"> --}}
                    <div class="table-responsive">
                        <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="datalistvcr">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                                    <th>No.</th>
                                    <th class="min-w-250px">Pemegang Polis</th>
                                    <th class="min-w-250px">ID</th>
                                    <th>Kode Polis</th>
                                    <th>Peserta</th>
                                    <th>Uang Pertanggungan</th>
                                    <th>Kotribusi Tagih</th>
                                    <th>Komisi Bruto</th>
                                    <th>Tax Komisi</th>
                                    <th>Komisi Netto</th>
                                    <th>Overriding Bruto</th>
                                    <th>Tax Overriding</th>
                                    <th>Overriding Netto</th>
                                    <th class="min-w-100px">Approval</th>
                                    <th>Keterangan</th>
                                    <th>Cab. Alamin</th>
                                    <th>Approv Kabag</th>
                                    <th>Approv Kadiv</th>
                                    <th>Approv Direktur</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                {{-- </div> --}}
            </div>
           
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-light btn-sm" onclick="closeModal('modalView')">Close</button>
                    {{-- <button type="button" class="btn btn-danger btn-sm" onclick="close_pojk()"><i
                            class="fa-solid fa-xmark" ></i> Tutup</button> --}}
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
