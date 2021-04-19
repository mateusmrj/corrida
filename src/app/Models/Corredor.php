<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Corredor extends Model
{
    use HasFactory;

    protected $table = 'corredores';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento'
    ];
}
