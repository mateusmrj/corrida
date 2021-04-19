<?php

namespace App\Http\Requests;

use App\Models\CorredorProva;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class StoreCorredorProvaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prova_id = $this->prova;

        Validator::extend('corredor_por_data', function ($attribute, $value) use ($prova_id) {
            
            $query = CorredorProva::join('provas', 'corredor_provas.id_prova', '=', 'provas.id')
            ->where('id_corredor', $value)
            ->where('provas.data', function($query) use ($prova_id) {
                $query->select('data')->from('provas')->where('id', $prova_id);
            });

            return !$query->count();
        });
        return [
            'corredor' => 'required|exists:corredores,id|corredor_por_data',
            'prova' => 'required|exists:provas,id',
            'hora_inicio' => 'nullable|date_format:H:i:s',
            'hora_fim' => 'nullable|date_format:H:i:s',
        ];
    }

    public function messages()
    {
        return [
            'corredor.corredor_por_data' => 'Não é possivél cadastrar o corredor em mais de uma prova no dia',
        ];
    }
}
