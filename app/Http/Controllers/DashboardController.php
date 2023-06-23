<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Certificado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
    }

    public function index()
    {
        $colaboradores = [];
        return view('dashboard.index', [
            'colaboradores' => $colaboradores
        ]);
    }
}
