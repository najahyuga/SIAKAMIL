<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // view to page index
    public function dashboard() {
        return view('index');
    }

    // view to page dashboard admin index
    public function indexAdmin(){
        return view('admin.index');
    }
}
