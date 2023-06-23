<?php

namespace App\Helpers;

class ColaboradorStatusHelper
{
    /**
     * Campos listas estaticas
     * Contem os valores possiveis
     */
    public static $status = [
        'E' => 'ELEGIVEL',
        'P' => 'PREMIADO',
    ];

    public static function get($valor)
    {
        return isset($valor) ? self::$status[$valor] : '';
    }
}
