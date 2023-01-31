<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProjectRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required',
                       Rule::unique('projects')->ignore($this->project), //devo forzare la regola unique a ignorare l'id del project che sto modificando in modo da non incorrere in un errore
                        'string',
                        'max:150'], 
            'description' => 'required|string|max:1500',
            'version' => 'required|numeric|between:0.01,99.99',
            'customer' => 'required|string|max:50',
            'cover_image' => 'nullable|image|max:4096',
            'type_id' => 'nullable|exists:types,id',
        ];
    }
}
