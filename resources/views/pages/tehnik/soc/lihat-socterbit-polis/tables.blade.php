<table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="lihatSocTPolis">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
            <th class="min-w-80px">No.</th>
            <th class="min-w-250px">Pemegang Polis</th>
            <th class="min-w-150px">Nomor Soc</th>
            <th class="min-w-150px">Kode Soc</th>
            <th class="min-w-150px">Jaminan</th>
            <th class="min-w-250px">Jaminan Asuransi</th>
            <th class="min-w-250px">Program Asuransi</th>
            <th class="min-w-250px">Nasabah</th>
            <th class="min-w-250px">Jenis Produk</th>
            <th class="min-w-150px">Status Approval</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $key=>$datas)
        <tr>
            <td class="text-center">{{ ++$key }}.</td>
            <td>
                <div class="badge badge-light-success fw-bolder">{{ $datas['msoc_mrkn_nama'] }}</div>
            </td>
            <td>{{ $datas['msoc_nomor'] }}</td>
            <td>{{ $datas['msoc_kode'] }}</td>
            <td class="text-center">{{ $datas['msoc_mft_nama'] }}</td>
            <td>{{ $datas['msoc_mjm_nama'] }}</td>
            <td>{{ $datas['msoc_mpras_nama'] }}</td>
            <td>{{ $datas['msoc_mjns_keterangan'] }}</td>
            <td>{{ $datas['msoc_mpid_nama'] }}</td>
            <td class="text-center">{{ $datas['approv'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    dtTables("lihatSocTPolis");
</script>