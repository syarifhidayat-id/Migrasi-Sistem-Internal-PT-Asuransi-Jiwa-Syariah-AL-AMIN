<table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="lihatPolis">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
            <th class="min-w-50px" rowspan="2">No.</th>
            <th class="min-w-125px" rowspan="2">Cabang</th>
            <th class="min-w-300px" rowspan="2">Nama Pemegang Polis</th>
            <th class="min-w-300px" rowspan="2">Nama Nasabah/Peserta</th>
            <th class="min-w-150px" rowspan="2">Segmen Pasar</th>
            <th class="min-w-200px" rowspan="2">Mekanisme 1 (Umum)</th>
            <th class="min-w-200px" rowspan="2">Mekanisme 2 (Penutupan)</th>
            <th class="min-w-200px" rowspan="2">Pekerjaan</th>
            <th class="min-w-150px" rowspan="2">Manfaat Asuransi</th>
            <th class="min-w-150px" rowspan="2">Pembayaran</th>
            <th class="min-w-150px" rowspan="2">Jaminan</th>
            <th class="min-w-150px" rowspan="2">Program Asuransi</th>
            <th class="min-w-300px" rowspan="2">Produk Induk</th>
            <th class="min-w-300px" rowspan="2">Produk Induk Ojk</th>
            <th class="min-w-150px" rowspan="2">Tanggal Akhir Ojk</th>
            <th class="min-w-200px" rowspan="2">Kode Polis</th>
            <th class="min-w-200px" rowspan="2">Kode Soc</th>
            <th class="min-w-150px" rowspan="2">Cetak</th>
            <th class="min-w-450px" colspan="4">Lihat</th>
            <th class="min-w-150px" rowspan="2">Online File</th>
            <th class="min-w-150px" rowspan="2">Date Input</th>
            <th class="min-w-150px" rowspan="2">User Input</th>
            <th class="min-w-150px" rowspan="2">Status Approval</th>
            <th class="min-w-150px" rowspan="2">Umur Input</th>
        </tr>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
            <td>Tarif</td>
            <td>Table</td>
            <td>Reas</td>
            <td>File</td>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count($res); $i++)
            <tr class="odd">
                <td class="dt-body-center">{{ $i + 1 }}.</td>
                <td>{{ $res[$i]['cabang'] }}</td>
                <td>{{ $res[$i]['mpol_mrkn_nama'] }}</td>
                <td>{{ $res[$i]['mjns_nama'] }}</td>
                <td>{{ $res[$i]['mssp_nama'] }}</td>
                <td>{{ $res[$i]['mkm_nama'] }}</td>
                <td>{{ $res[$i]['mkm_ket2'] }}</td>
                <td>{{ $res[$i]['mker_nama'] }}</td>
                <td>{{ $res[$i]['mft_nama'] }}</td>
                <td>{{ $res[$i]['bayar'] }}</td>
                <td>{{ $res[$i]['mjm_nama'] }}</td>
                <td>{{ $res[$i]['mpras_nama'] }}</td>
                <td>{{ $res[$i]['mpid_nama'] }}</td>
                <td>{{ $res[$i]['mpid_nama_ojk'] }}</td>
                <td>{{ $res[$i]['mpol_tgl_ahir_polis'] }}</td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="aprovPst('{{ $res[$i]['mpol_kode'] }}', 0)">{{ $res[$i]['mpol_kode'] }}</button>
                </td>
                <td>{{ $res[$i]['mpol_msoc_kode'] }}</td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="aprovalpolis('{{ $res[$i]['mpli_nomor'] }}', 0)">Pilih</button>
                </td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="lihat('{{ $res[$i]['mpol_kode'] }}', '', 0)">Tarif</button>
                </td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="lihat('{{ $res[$i]['mpol_kode'] }}', '', 1)">Uw Baris</button> | <button
                        type="button" class="btn btn-light-primary btn-sm"
                        onclick="lihat('{{ $res[$i]['mpol_kode'] }}', '', 4)">Uw Table</button>
                </td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="lihat('{{ $res[$i]['mpol_kode'] }}', '', 2)">Reas</button>
                </td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="lihat('{{ $res[$i]['mpol_kode'] }}', '', 5)">File</button>
                </td>
                @if ($res[$i]['mpol_convert_img'] == 1)
                    <td class="dt-body-center">
                        <button type="button" class="btn btn-light-primary btn-sm"
                            onclick="lihat('{{ $res[$i]['mpol_kode'] }}', 5)">Lihat</button>
                    </td>
                @elseif (empty($res[$i]['sfile']) && $res[$i]['mpol_convert_img'] == 0)
                    <td class="dt-body-center">???</td>
                @else
                    <td class="dt-body-center">
                        <button type="button" class="btn btn-light-primary btn-sm"
                            onclick="lihat('{{ $res[$i]['mpol_kode'] }}', 3)">Proses</button>
                    </td>
                @endif
                <td class="dt-body-center">{{ $res[$i]['mpol_ins_date'] }}</td>
                <td class="dt-body-center">{{ $res[$i]['mpol_ins_user'] }}</td>
                <td class="dt-body-center">{{ $res[$i]['msoc_approve'] }}</td>
                <td class="dt-body-center">{{ $res[$i]['umur'] }}</td>
            </tr>
        @endfor
    </tbody>
</table>

<script>
    dtTables("lihatPolis");
</script>
