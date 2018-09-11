<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Auth;
class LoginController extends Controller
{
    public function showLogin()
    {
    	if (Auth::check()) {
    		return redirect()->intended(route('admin.dashboard'));
    	}
    	return view('auth.login');
    }

    public function postLogin(LoginRequest $request)
    {
    	   
    		$email = $request->email;
    		$password = $request->password;
    		$level = 2;

    	if (Auth::attempt(['email' => $email, 'password' => $password, 'level' => $level])) {
            return redirect()->intended('admin');
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

   	public function logout()
   	{
   		Auth::logout();
   		return redirect()->intended('admin/dang-nhap');
   	}
}
