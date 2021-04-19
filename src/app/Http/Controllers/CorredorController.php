<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCorredorRequest;
use App\Models\Corredor;
use DateTime;
use Illuminate\Http\Request;

class CorredorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Corredor::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCorredorRequest $request)
    {
        $dataNascimento = date('Y-m-d', strtotime(str_replace('/', '-', $request->data_nascimento)));

        $corredor = Corredor::create([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'data_nascimento' => $dataNascimento,
            ]);

        return response()->json($corredor, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
