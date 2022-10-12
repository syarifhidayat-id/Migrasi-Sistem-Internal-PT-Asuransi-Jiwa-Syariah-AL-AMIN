<div class="table-responsive">
    <table class="table table-rounded table-striped border align-middle gy-5 gs-5" id="kt_table_datatable">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 border-bottom border-gray-200 text-center align-middle">
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No HP</th>
                <th class="min-w-125px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user as $key=>$data)
            <tr>
                <td class="text-center">{{ ++$key }}.</td>
                <td>{{ $data->name }}</td>
                <td>
                    <div class="badge badge-light-success fw-bolder">{{ $data->email_user }}</div>
                </td>
                <td>
                    <div class="badge badge-light fw-bolder">{{ $data->no_hp }}</div>
                </td>
                <td class="text-end">
                    <a href="#" class="btn btn-light btn-active-light-primary btn-sm" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Aksi
                        <span class="svg-icon svg-icon-5 m-0">
                            <i class="fa-sharp fa-solid fa-chevron-down"></i>
                        </span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="#" id="omodEdit" class="menu-link px-3" data-resouce="{{ $data->id }}">Edit</a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="#" id="omodDelete" class="menu-link px-3" data-resouce="{{ $data->id }}">Delete</a>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td rowspan="5">Data tidak ada!</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
