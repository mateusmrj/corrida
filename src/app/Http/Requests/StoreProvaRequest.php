<?php

namespace App\Http\Requests;

use App\Models\Prova;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProvaRequest extends FormRequest
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
        return [
            'data' => 'required',
            'tipo_prova' => ['required',Rule::IN(array_keys(Prova::DISTANCIAS))],
        ];
    }
}
