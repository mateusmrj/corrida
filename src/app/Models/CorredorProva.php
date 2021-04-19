<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CorredorProva extends Model
{
    use HasFactory;

    protected $primaryKey = ['id_corredor', 'id_prova'];

    public $incrementing = false;

    protected $table = 'corredor_provas';

    public $timestamps = false;

    protected $fillable = [
        'id_corredor',
        'id_prova',
        'hora_inicio',
        'hora_fim',
    ];

    public function ranking()
    {
        return $this->select('corredor_provas.id_prova', DB::raw('TIMEDIFF(hora_fim, hora_inicio) as duracao'), 'provas.tipo_prova', 'corredor_provas.id_corredor', 'corredores.data_nascimento', 'corredores.nome')
                ->join('corredores','corredores.id', '=', 'corredor_provas.id_corredor')
                ->join('provas','provas.id', '=', 'corredor_provas.id_prova')
                ->orderBy('provas.tipo_prova')
                ->orderBy('duracao')
                ->get();
    }
}
