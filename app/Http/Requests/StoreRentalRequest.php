<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fleet_id' => 'required|string|max:255',
            'pickup_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after_or_equal:pickup_date',
            'pickup_time' => 'required',
            'return_time' => 'required',
            'pickup_location' => 'required|string|max:255',
            'return_location' => 'required|string|max:255',
            'note' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'payment_status' => 'required',
            'rental_amount' => 'required',
            'depo_amount' => 'nullable',
            'total_amount' => 'nullable',
            'depo_date' => 'nullable',
            'staff_id' => 'required',
        ];
    }
}
