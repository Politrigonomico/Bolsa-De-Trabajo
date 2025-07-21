<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postulante;
use App\Models\Empresa;

class IndexController extends Controller
{
    public function index()
    {
        

        $totalPostulantes = Postulante::count();
        $totalEmpresas = Empresa::count();


        return view('index', compact('totalPostulantes', 'totalEmpresas'));
    }
}
