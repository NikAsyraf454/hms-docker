<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payment_date' => 'required',
            'payment_method' => 'required',
            'payment_status' => 'required',
            'rental_amount' => 'nullable',
            'proof' => 'nullable',
        ];
    }
}
