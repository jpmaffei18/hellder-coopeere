<?php

namespace App\Http\Controllers;

use App\Models\prodist;
use App\Models\cooperado;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke(){
        return view('home');
    }
}
