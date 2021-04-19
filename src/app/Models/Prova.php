<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prova extends Model
{
    use HasFactory;

    protected $table = 'provas';

    public $timestamps = false;

    const DISTANCIA_3    = 1;
    const DISTANCIA_5    = 2;
    const DISTANCIA_10   = 10;
    const DISTANCIA_21   = 21;
    const DISTANCIA_42   = 42;


    const DISTANCIAS     = [
        self::DISTANCIA_3    => '3',
        self::DISTANCIA_5    => '5',
        self::DISTANCIA_10   => '10',
        self::DISTANCIA_21   => '21',
        self::DISTANCIA_42   => '42',
    ];

    protected $fillable = [
        'tipo_prova',
        'data'
    ];
}
