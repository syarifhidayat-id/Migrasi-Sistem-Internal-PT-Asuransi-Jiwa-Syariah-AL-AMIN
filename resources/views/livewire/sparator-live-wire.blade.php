<div>
    <span class="h-20px border-gray-300 border-start mx-4"></span>
    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    @foreach ($menulist as $menu)
        @if (count($menu['childs']) > 0)
            <li class="breadcrumb-item text-muted">
                <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-300 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">{{ $menu['wmn_descp'] }}</li>
            @foreach ($menu['childs'] as $child)
                @if (count($child['childs']) > 0)
                @else
                @endif
            @endforeach
        @else
            <li class="breadcrumb-item text-muted">
                <a href="{{ route($menu['wmn_url_n']) }}" class="text-muted text-hover-primary">{{ $menu['wmn_descp'] }}</a>
            </li>
        @endif
    @endforeach
    </ul>
</div>
