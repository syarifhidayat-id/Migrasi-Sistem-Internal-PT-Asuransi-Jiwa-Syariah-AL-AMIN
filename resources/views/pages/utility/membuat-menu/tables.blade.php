<table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="lihatMenu">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
            <th class="min-w-50px">No.</th>
            <th class="min-w-50px">Icon</th>
            <th class="min-w-125px">Nama Menu</th>
            <th class="min-w-125px">Tipe</th>
            <th class="min-w-125px">Route</th>
            <th class="min-w-250px">Url</th>
            <th class="min-w-125px">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count($res); $i++)
            <tr>
                <td class="text-center">{{ $i + 1 }}.</td>
                <td>
                    <i class="{{ $res[$i]['wmn_icon'] }}"></i>
                </td>
                <td>{{ $res[$i]['wmn_descp'] }}</td>
                <td>{{ $res[$i]['wmn_tipe'] }}</td>
                <td>
                    @if (!@empty($res[$i]['wmn_url_n']) || !is_null($res[$i]['wmn_url_n']))
                        <div class="badge badge-light-success fw-bolder">{{ $res[$i]['wmn_url_n'] }}</div>
                    @else
                        <div class="badge badge-light-warning fw-bolder">-</div>
                    @endif
                </td>
                <td>
                    @if (!@empty($res[$i]['wmn_url_o_n']) || !is_null($res[$i]['wmn_url_o_n']))
                        <div class="badge badge-light fw-bolder">{{ $res[$i]['wmn_url_o_n'] }}</div>
                    @else
                        <div class="badge badge-light fw-bolder">-</div>
                    @endif
                </td>
                <td>
                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">Aksi
                        <span class="svg-icon svg-icon-5 m-0">
                            <i class="fa-sharp fa-solid fa-chevron-down"></i>
                        </span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="#" onclick="editMenu('{{ $res[$i]['wmn_kode'] }}')"
                                class="menu-link px-3">Edit</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" onclick="deleteMenu('{{ $res[$i]['wmn_kode'] }}')"
                                class="menu-link px-3">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
        @endfor
    </tbody>
</table>

<script>
    dtTables("lihatMenu");
</script>
