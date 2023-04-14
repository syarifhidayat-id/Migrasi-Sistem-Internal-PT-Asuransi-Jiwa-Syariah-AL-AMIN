<div>
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
        data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
        class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        @foreach ($slug as $slugs)
            @if (count($slugs['childs']) > 0)
            @else
                @php
                    // $curent = Request::route()->getName();
                    $curent = Request::getRequestUri();
                    $last = request()->segment(count(request()->segments()));
                    $str = str_replace('/', ' - ', $curent);
                    $muted = chop($str, '- ' . $last);
                    $title = str_replace('-', ' ', $last);
                @endphp
                @if ($title == 'dashboard')
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Dashboard</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-dark">Dashboard</li>
                    </ul>
                @else
                    <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1 slugs">{{ $title }}</h1>
                    <span class="h-20px border-gray-300 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted slugs">{{ $muted }}</li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-300 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-dark slugs">{{ $title }}</li>
                    </ul>
                @endif
            @endif
        @endforeach

    </div>
</div>
