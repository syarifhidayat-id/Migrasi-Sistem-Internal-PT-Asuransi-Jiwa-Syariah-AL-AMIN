<table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="lihatEditSoc">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
            <th class="min-w-80px">No.</th>
            <th>No SOC</th>
            <th class="min-w-400px">Kode SOC</th>
            <th class="min-w-450px">Nama Pemegang Polis</th>
            <th class="min-w-250px">Jenis Nasabah</th>
            <th class="min-w-250px">Segmen Pasar</th>
            <th class="min-w-250px">Mekanisme 1 (Umum)</th>
            <th class="min-w-250px">Mekanisme 2 (Penutupan)</th>
            <th class="min-w-250px">Jenis Pekerjaan</th>
            <th class="min-w-150px">Manfaat Asuransi</th>
            <th class="min-w-150px">Pembayaran</th>
            <th class="min-w-150px">Jaminan</th>
            <th class="min-w-150px">Program Asuransi</th>
            <th class="min-w-100px">Cetak</th>
            <th class="min-w-150px">Tanggal Input</th>
            <th class="min-w-125px">Umur Input</th>
            <th class="min-w-125px">User Input</th>
            <th class="min-w-125px">Status Approval</th>
            <th class="min-w-150px">Kode Polis</th>
            <th class="min-w-125px">Approval Polis</th>
            <th class="min-w-125px">Status Polis</th>
            <th class="min-w-125px">Online Polis</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count($res); $i++)
            <tr>
                <td class="text-center">{{ $i + 1 }}.</td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="socKhusus('{{ $res[$i]['msli_nomor'] }}', 0)">{{ $res[$i]['msli_nomor'] }}</button>
                </td>
                <td class="dt-body-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="editSoc('{{ $res[$i]['msoc_kode'] }}', 0)">{{ $res[$i]['msoc_kode'] }}</button> |
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="showUW('{{ $res[$i]['msoc_mpuw_nomor'] }}')"><i class="fa-solid fa-eye"></i> Uw
                        Table</button>
                </td>
                <td>{{ $res[$i]['msli_mrkn_nama'] }}</td>
                <td>{{ $res[$i]['mjns_nama'] }}</td>
                <td>{{ $res[$i]['mssp_nama'] }}</td>
                <td>{{ $res[$i]['mkm_nama'] }}</td>
                <td>{{ $res[$i]['mkm_ket2'] }}</td>
                <td>{{ $res[$i]['mker_nama'] }}</td>
                <td class="text-center">{{ $res[$i]['mft_nama'] }}</td>
                <td>{{ $res[$i]['bayar'] }}</td>
                <td>{{ $res[$i]['mjm_nama'] }}</td>
                <td>{{ $res[$i]['mpras_nama'] }}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-light-primary btn-sm"
                        onclick="cetakSoc('{{ $res[$i]['msli_nomor'] }}', 0)">Pilih</button>
                </td>
                <td class="text-center">{{ $res[$i]['msoc_ins_date'] }}</td>
                <td class="text-center">{{ $res[$i]['umur'] }}</td>
                <td>{{ $res[$i]['msoc_ins_user'] }}</td>
                @php
                    $text = '';
                    if ($res[$i]['msoc_approve'] == 'sudah') {
                        $text = 'success';
                    } else {
                        $text = 'danger';
                    }
                @endphp
                <td class="text-center">
                    <div class="badge badge-light-{{ $text }} fw-bolder">{{ $res[$i]['mpol_approve'] }}
                </td>
                <td>{{ $res[$i]['mpol_kode'] }}</td>
                @php
                    $text = '';
                    if ($res[$i]['mpol_approve'] == 'sudah') {
                        $text = 'success';
                    } else {
                        $text = 'danger';
                    }
                @endphp
                <td class="text-center">
                    <div class="badge badge-light-{{ $text }} fw-bolder">{{ $res[$i]['mpol_approve'] }}
                </td>
                @php
                    $text = '';
                    if ($res[$i]['aktif'] == 'aktif') {
                        $text = 'success';
                    } elseif ($res[$i]['aktif'] == 'suspend') {
                        $text = 'warning';
                    } else {
                        $text = 'danger';
                    }
                @endphp
                <td class="text-center">
                    <div class="badge badge-light-{{ $text }} fw-bolder">{{ $res[$i]['aktif'] }}</div>
                </td>
                @php
                    $text = '';
                    if ($res[$i]['online'] == 'aktif') {
                        $text = 'success';
                    } else {
                        $text = 'danger';
                    }
                @endphp
                <td class="text-center">
                    <div class="badge badge-light-{{ $text }} fw-bolder">{{ $res[$i]['online'] }}</div>
                </td>
            </tr>
        @endfor
    </tbody>
</table>

<script>
    dtTables("lihatEditSoc");
</script>
