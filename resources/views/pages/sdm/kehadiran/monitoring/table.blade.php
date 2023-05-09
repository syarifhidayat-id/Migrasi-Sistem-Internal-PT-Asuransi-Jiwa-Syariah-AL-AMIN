<table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="listAbsen">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
            <th class="min-w-80px">No.</th>
            <th>Nomor PK</th>
            <th class="min-w-400px">Pin</th>
            <th class="min-w-400px">Karyawan</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count($res); $i++)
            {{-- @foreach ($res as $ress) --}}
            <tr>
                <td class="text-center">{{ $i + 1 }}.</td>
                <td class="dt-body-center">{{ $res[$i]['ssen_sn'] }}</td>
                <td class="dt-body-center">{{ $res[$i]['ssen_pin'] }}</td>
                <td class="dt-body-center">{{ $res[$i]['skar_nama'] }}</td>
            </tr>
            {{-- @endforeach --}}
        @endfor
    </tbody>
</table>

<script>
    dtTables("listAbsen");
</script>
