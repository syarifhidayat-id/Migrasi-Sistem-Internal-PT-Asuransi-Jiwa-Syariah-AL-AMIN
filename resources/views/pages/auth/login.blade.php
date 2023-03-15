@extends('layouts.app')

@section('content')
<div class="col-md-10 offset-md-1">
    <div class="ltf-block-logo d-block d-lg-none text-center text-lg-left">
        <img src="{{ asset('ww.css/css.login/images/logo-alm.png') }}" alt="logo">
    </div>
    <div class="my-5 text-center text-lg-left">
        <h3 class="font-weight-bold text-center">Sign In</h3>
        <p class="text-muted text-center">Sign in to PT. Asuransi Jiwa Syariah Al-Amin</p>
    </div>
    <form class="" action="{{ route('signin.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <div class="form-icon-wrapper">
                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" placeholder="Enter username" autofocus>
                <i class="form-icon-left mdi mdi-account"></i>
            </div>
            @error('email')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-group">
            <div class="form-icon-wrapper">
                <input type="password" class="form-control @error('password_n') is-invalid @enderror" name="password_n" id="password_n" placeholder="Enter password">
                <i class="form-icon-left mdi mdi-lock"></i>
                <a href="#" class="form-icon-right password-show-hide"
                title="Hide or show password">
                    <i class="mdi mdi-eye"></i>
                </a>
            </div>
            @error('password_n')
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="row ">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="text-center">
                        <a href="#" id="reload" title="Reload Captcha">
                            <img src="{!! captcha_src('flat') !!}" alt="gambar" class="captcha-gbr" id="captcha_image" style="border-radius: 10px;">
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-icon-wrapper">
                        <input type="text" class="form-control @error('ct_captcha') is-invalid @enderror" name="ct_captcha" id="ct_captcha" maxlength="4" placeholder="Enter captcha" autofocus>
                        <i class="form-icon-left mdi mdi-history"></i>
                    </div>
                    @error('ct_captcha')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary btn-block mb-4">Sign In</button>
        </div>
    </form>
    <div class="text-center mt-5">
        <a href="#">Untuk Aktivasi User Web Email alamin.co.id <i class="fa fa-long-arrow-right"></i></a>
    </div>
</div>
@endsection

@section('script')
    <script>
        $('body #reload').on('click', function(e) {
            $.get("{{ url('api/reload-captcha') }}", function (data) {
                $('#captcha_image').attr('src', data.captcha);
            });
            return false;
        });
    </script>
@endsection
