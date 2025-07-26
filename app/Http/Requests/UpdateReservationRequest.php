<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Carbon;

class UpdateReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $reservation = $this->{'route'}('reservation');

        return Auth::check() && (
            Auth::user()->isAdmin() ||
            Auth::id() === $reservation->user_id
        );
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $today = Carbon::today()->toDateString();
        $now = Carbon::now()->format('H:i');
        return [
            'table_id' => ['required', 'exists:tables,id'],
            'reservation_date' => ['required', 'date', 'after_or_equal:' . $today],
            'reservation_time' => [
                'required',
                'date_format:H:i',
                Rule::when($this->{'reservation_date'} === $today, ['after:' . $now]),
            ],
            'party_size' => ['required', 'integer', 'min:1', 'max:10'],
            'special_requests' => ['nullable', 'string', 'max:500'],
            'customer_name' => ['required', 'string', 'max:255'],
            'customer_email' => ['required', 'email', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:20'],
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
            'table_id.required' => 'Veuillez sélectionner une table.',
            'table_id.exists' => 'La table sélectionnée n\'existe pas.',
            'reservation_date.required' => 'La date de réservation est obligatoire.',
            'reservation_date.after_or_equal' => 'La date de réservation doit être aujourd\'hui ou dans le futur.',
            'reservation_time.required' => 'L\'heure de réservation est obligatoire.',
            'reservation_time.after' => 'L\'heure de réservation doit être après l\'heure actuelle pour aujourd\'hui.',
            'party_size.required' => 'Le nombre de personnes est obligatoire.',
            'party_size.min' => 'Le nombre de personnes doit être d\'au moins :min.',
            'party_size.max' => 'Le nombre de personnes ne peut pas dépasser:max.',
            'customer_name.required' => 'Votre nom est obligatoire.',
            'customer_email.required' => 'Votre email est obligatoire.',
            'customer_email.email' => 'Veuillez entrer une adresse email valide.',
        ];
    }
}
