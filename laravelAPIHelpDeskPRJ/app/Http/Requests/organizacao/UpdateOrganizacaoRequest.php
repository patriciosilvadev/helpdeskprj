<?php

namespace App\Http\Requests\organizacao;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateOrganizacaoRequest extends FormRequest
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
            "nome" => "required|max:255",
            "razao_social" => "nullable|max:255",
            "documento" => ["nullable", "max:255", Rule::unique('organizacao', "documento")->where(function ($query) {
                return $query->where('id', "<>", $this->id);
            })],
            "codigo" => ["nullable", "max:50", Rule::unique('organizacao', "codigo")->where(function ($query) {
                return $query->where('id', "<>", $this->id);
            })],
            "status" => ["nullable", Rule::in(['1', '0'])]
        ];
    }
}
