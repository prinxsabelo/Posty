<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        // dd(auth()->user()->posts);
        // dd(auth()->user());
    
        return view('dashboard');
    }
}
