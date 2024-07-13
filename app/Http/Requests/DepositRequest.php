<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DepositRequest extends FormRequest
{
     public function rules(): array
    {
        return [
            'amount' => 'required',
            'date' => 'required',
            'status' => 'required',
            'return_date' => 'nullable',
            'updated_by' => 'nullable',
        ];
    }
}
