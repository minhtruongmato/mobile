<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Auth;
use App\User;
class ClientApiController extends Controller
{
    public function postLogin(Request $request)
    {
        // echo $request->email;die;
		$email = $request->email;
		$password = $request->password;
		$level = 1;

    	if (Auth::attempt(['email' => $email, 'password' => $password, 'level' => $level])) {
            return response()->json(Auth::user(), 200);
        }
        
    }

    public function postRegister(Request $request)
    {
        if(User::where('email', $request->email)->count() > 0){
            return response()->json(['result' => true], 200);
        }else{
            if($user = User::create(request(['name', 'email', 'password', 'phone', 'address']))){
                auth()->login($user);
                return response()->json(['result' => 'success', 'data' => Auth::user()], 200);
            }else{
                return response()->json(['result' => false], 200);
            }
        }
    }
}
