<?php

namespace App\Http\Controllers;

use App\Models\prodist;
use App\Models\cooperado;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function show() {
        //$prodists_total = prodist::where('statusreg','=','F');
        //$cota_comprada_total = prodist::where('statusreg','=','F')->sum('cota_comprada');
        //$cooperado = cooperado::find($idcooperado);
        //return view('dashboard.mostrar', compact('cota_comprada_total'));
        return view('dashboard.mostrar');
    }
}