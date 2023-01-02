@extends('layouts.app')

@section('content')
<form class="form w-100" novalidate="novalidate" id="kt_sign_in_form" method="POST" action="{{ route('signin.store') }}">
    @csrf

    <div class="text-center mb-10">
        <h1 class="text-dark mb-3">{{ __('Sign In to Al-Amin') }}</h1>
        {{-- <div class="text-gray-400 fw-bold fs-4">New Here?
        <a href="#" class="link-primary fw-bolder">{{ __('Create an Account') }}</a></div> --}}
    </div>

    <div class="fv-row mb-10">
        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Username') }}</label>
        <input class="form-control form-control-lg form-control-solid @error('email') is-invalid @enderror" type="text" name="email" value="{{ old('email') }}" placeholder="Masukkan username" required autocomplete="email" autofocus />

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="fv-row mb-10">
        <div class="d-flex flex-stack mb-2">
            <label class="form-label fw-bolder text-dark fs-6 mb-0">{{ __('Password') }}</label>
            @if (Route::has('password_n.request'))
                {{-- <a href="{{ route('password.request') }}" class="link-primary fs-6 fw-bolder">{{ __('Forgot Password ?') }}</a> --}}
            @endif
        </div>
        <input class="form-control form-control-lg form-control-solid @error('password_n') is-invalid @enderror" type="password" name="password_n" placeholder="Masukkan password" required autocomplete="password_n" />

        @error('password_n')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="fv-row mb-20">
        <label class="form-label fs-6 fw-bolder text-dark">{{ __('Captcha') }}</label>
        <div class="input-group mb-5">
            <input class="form-control form-control-solid form-control-lg @error('captcha') is-invalid @enderror" type="text" name="captcha" id="captcha" maxlength="4" placeholder="Masukkan captcha" required autocomplete="captcha" autofocus />
            <a id="reload" title="Reload Captcha"><span>{!! captcha_img('flat') !!}</span></a>

            @error('captcha')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="text-center">
        <button type="submit" id="kt_sign_in_submit" class="btn btn-lg btn-primary w-100 mb-5">
            <span class="indicator-label">{{ __('Login') }}</span>
            <span class="indicator-progress">{{ __('Please wait...') }}
            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
</form>
@endsection

@section('script')
    <script>
        tombol('click', 'reload', function() {
            lodJson("GET", "{{ url('api/reload-captcha') }}", function (data) {
                setHtml("#reload span", data.captcha);
            });
        });
    </script>
@endsection
