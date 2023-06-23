<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;

class SorteioController extends Controller
{
    public function index()
    {
        $imagensUteis = ['numbers/1.png', 'numbers/2.png', 'numbers/3.png', 'numbers/4.png', 'numbers/5.png'];
        // $pessoas = ['ANA CLAUDIA ALVES.png', 'ANA FLAVIA PROFETA.png', 'ARTHUR MARQUES CARDOSO.png', 'BRUNO CASTRO ARAUJO.png', 'BRUNO DE SOUZA FERREIRA.png', 'CARMELITA SOUSA.png', 'CINTIA CRISTINA.png', 'CLICIO ARAUJO.png', 'DANYELE LORRANY.png', 'ELIANDRA BISPO SZERVINKS.png', 'FRANDSON MAGI.png', 'GABRIELI SOUZA.png', 'GUSTAVO CARVALHO.png', 'HIZA LORRANY.png', 'JONATHAN FLAVIO.png', 'JOAO PAULO CAETANO.png', 'LARISSA SIQUEIRA.png', 'LEO TANISLAU.png', 'LUIZ MOREIRA.png', 'MAX EYTHO.png', 'PABLINE DARES.png', 'PEDRO AUGUSTO.png', 'PEDRO HENRIQUE.png', 'PRISCILA PEREIRA.png', 'RAFAEL ALVES.png', 'RAYSSA DOS SANTOS.png', 'RUAN HENRIQUE.png', 'SAMAIA FERREIRA.png', 'STEPHANNE PEREIRA.png', 'STEPHANY MOURA.png', 'VINICIOS FRANCISCO.png', 'VINICIUS CORDEIRO.png', 'VITOR DE PAULA.png', 'VITOR FERREIRA.png', 'WICTOR RICARDO.png', 'WILLIAN ANTONIO.png'];
        $pessoas = Colaborador::all();
        return view('sorteio.index', ['pessoas' => $pessoas, 'imagensUteis' => $imagensUteis]);
    }
}
