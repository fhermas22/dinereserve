<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreTableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only administrators can create tables
        return Auth::check() && Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'unique:tables,name'],
            'capacity' => ['required', 'integer', 'min:1', 'max:20'],
            'location' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'is_available' => ['boolean'],
        ];
    }

    /**
    * Get the error messages for the defined validation rules.
    *
    * @return array<string, string>
    */
    public function messages(): array
    {
        return [
            'name.unique' => "Une table avec ce nom existe déjà.",
            'capacity.min' => "La capacité doit être d'au moins :min personne.",
            'capacity.max' => "La capacité ne peut pas dépasser :max personnes.",
        ];
    }
}
