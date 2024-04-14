<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class AuthController extends Controller
{

    /**
     * Display a view login users.
     *
     * @return View
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Display a registration form.
     *
     * @return View
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     *  User login from application.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function authenticate(LoginRequest $request)
    {
        $input = $request->except('_token');
        if (Auth::attempt($input)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'email' => 'Your provided credentials do not match in our records.',
            ])->onlyInput('email');
        }
    }

    /**
     * Register user from application.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function process(RegisterRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        User::create($input);
        return redirect('/login');
    }

    /**
     * Log out the user from application.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
