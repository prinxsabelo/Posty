<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {   
        $this->validate($request,[ 
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if(!Auth::attempt($request->only('email','password'), $request->remember)){
            return back()->with('status','Invalid login details..');
        }
        return Redirect::route('dashboard');
    }
}
