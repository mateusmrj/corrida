<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use DateTime;

class StoreCorredorRequest extends FormRequest
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
            'nome' => 'required',
            'cpf' => ['required','unique:corredores','regex:/[0-9]+/','size:11'],
            'data_nascimento' => [
                'required',
                function ($attribute, $value, $fail) {
                    $date = new DateTime(str_replace('/', '-',$value));
                    $interval = $date->diff(new DateTime( date('Y-m-d') ) );
                    $idade = $interval->format( '%Y' );

                    if ($idade < 18) {
                        $fail('Não é permitido o cadastro de corredores menores de idade');
                    }
                }
            ]
        ];
    }
}
