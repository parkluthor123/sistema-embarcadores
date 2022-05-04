<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //

    public function doLogin(Request $request)
    {
        $credentials = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if(Auth::guard('employees')->attempt($credentials))
        {
            return redirect()->route('admin.dashboard');
        }
        else{
            return redirect()->route('home');
        }
    }

    public function logout()
    {
        Auth::guard('employees')->logout();
        return redirect()->route('home');
    }
}
