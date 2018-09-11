<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Http\Requests\ClientRegisterRequest;
use App\Http\Requests\ClientLoginRequest;
use Auth;

class ClientController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function store(ClientRegisterRequest $request)
    {
        
        $user = User::create(request(['name', 'email', 'password', 'phone', 'address']));
        
        auth()->login($user);
        
        return redirect()->to('/');
    }

    public function showLogin($value='')
    {
        if (Auth::check()) {
            return redirect()->intended('/');
        }
        return view('login');
    }

    public function postLogin(ClientLoginRequest $request)
    {
        $email = $request->email;
            $password = $request->password;
            $level = 1;

        if (Auth::attempt(['email' => $email, 'password' => $password, 'level' => $level])) {
            return redirect()->intended('/');
        }
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended(route('client.showLogin'));
    }
}
