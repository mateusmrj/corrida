<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorredorProvaRequest;
use App\Models\CorredorProva;
use App\Models\Prova;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class CorredorProvaCrontroller extends Controller
{
    public $ranking;
    
    public function __construct()
    {
        $this->ranking = $ranking = (new CorredorProva)->ranking();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resultado = $this->classificacao($this->ranking, ['all' => []]);

        return response()->json($resultado, 201);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCorredorProvaRequest $request)
    {
        $corredorProva = CorredorProva::create([
                'id_corredor' => $request->corredor,
                'id_prova' => $request->prova,
                'hora_inicio' => $request->hora_inicio,
                'hora_fim' => $request->hora_fim
            ]);
        
        return response()->json($corredorProva, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $res = CorredorProva::where(['id_corredor' => $request->corredor,'id_prova' => $request->prova]);
        $resultado = $res->update(
            [
                'hora_inicio' => $request->hora_inicio,
                'hora_fim' => $request->hora_fim
            ]
        );

        return response()->json(["Atualizado"], 201);
    }

    public function resultadoPorIdade()
    {
        $resultado = $this->classificacao(
            $this->ranking, 
            [
                '24' => [],
                '34' => [],
                '44' => [],
                '54' => [],
                '55' => []
            ]
        );
        //fazer a conversão para o valor pedido
        foreach ([
            '24' => '18-25',
            '34' => '25-35',
            '44' => '35-45',
            '54' => '45-54',
            '55' => '55+'
        ] as $key => $value) {

            $resultado[$value] = $resultado[$key];
            unset($resultado[$key]);
        }

        return response()->json($resultado, 201);

    }

    private function classificacao(Collection $ratings, array $ranges)
    {
        $ratings->map(function ($rank) use (&$ranges) {

            $rank->idade = Carbon::parse($rank->data_nascimento)->age;
            foreach ($ranges as $chek => &$array) {
                if ($chek >= $rank->idade) {
                    $key = 'Prova_' . $rank->tipo_prova;

                    $array[$key][] = [
                        'id_prova'   => $rank->id_prova,
                        'tipo_pova'  => $rank->tipo_prova . ' Km',
                        'corredor'   => $rank->id_corredor,
                        'Idade'      => $rank->idade,
                        'nome'       => $rank->nome,
                        'posicao'    => isset($array[$key]) ? count($array[$key]) + 1 : 1
                    ];
                    break;
                }
            }
            return $rank;
        });

        return $ranges;
    }
}
