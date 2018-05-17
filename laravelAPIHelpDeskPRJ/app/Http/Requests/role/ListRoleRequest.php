<?php

namespace App\Http\Requests\role;

use Illuminate\Foundation\Http\FormRequest;

class ListRoleRequest extends FormRequest
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
            "name"  =>  "nullable|max:255",
            "search.value" => "nullable|max:255"
        ];
    }
}
