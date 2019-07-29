<?php
namespace App\Http\Controllers\Auth;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guard = 'admin';

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.adminLogin');
    }

    public function guard()
    {
        return auth()->guard('admin');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nip' => 'required|string|max:199',
            'jabatan' => 'required|string|email|max:255',
            'password' => 'required|string|min:6|confirmed'
        ]);
        Admin::create([
            'nip' => $request->nip,
            'password' => bcrypt($request->password),
            'jabatan' => $request->nip
        ]);
        return redirect()->route('admin-login')->with('success','Registration Success');
    }
    public function login(Request $request)
    {
        if (auth()->guard('admin')->attempt(['nip' => $request->nip, 'password' => $request->password ] ])) {
            return redirect()->route('/admin');
        }
        return back()->withErrors(['email' => 'Email or password are wrong.']);
    }
}