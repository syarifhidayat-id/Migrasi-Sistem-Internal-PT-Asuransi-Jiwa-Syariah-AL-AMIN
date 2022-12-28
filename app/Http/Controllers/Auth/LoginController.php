<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->redirectTo = route('login');
    //     $this->middleware('guest')->except('logout');
    // }

    public function index()
    {
        return view('pages.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function store(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password_n' => 'required',
            'captcha' => 'required|captcha',
        ],
        [
            'email.required'=>'Username harus terisi!',
            'password_n.required'=>'Password harus terisi!',
            'captcha.required'=>'Captcha harus terisi!',
            'captcha.captcha'=>'Jawaban kamu salah!',
        ]);

        if ($validasi->fails()) {
            return redirect()->back()->withErrors($validasi)->withInput($request->all());
        } else {
            $validasi = $request->except(
                '_token',
                'captcha'
            );
            if (Auth::attempt($validasi)) {
                // return redirect()->intended(RouteServiceProvider::HOME);
                return redirect()->intended('dashboard');
            } else {
                return back()->withErrors([
                    'email' => 'Username anda salah, silahkan cek kembali!',
                    'password_n' => 'Password anda salah, silahkan cek kembali!',
                    'captcha' => 'Jawaban kamu salah!',
                ])->onlyInput(
                    'email',
                    'password_n',
                    'captcha',
                );
            }
        }
    }

    public function reloadCaptha()
    {
        return response()->json([
            'captcha' => captcha_img('flat')
        ]);
    }

    public function dashboard()
    {
        if (Auth::check())
        {
            return view('pages.dashboard');
        }

        return redirect()->route('signin');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // $data = $request->all();
        // $data = $request->except('_token',);
        // $data['log_end'] = date('Y-m-d H:i:s');
        // $data['active'] = 0;

        // DB::table('web_conf.user_token')->update($data);

        return redirect('/');
    }
}
