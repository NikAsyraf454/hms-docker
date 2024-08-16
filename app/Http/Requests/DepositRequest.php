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
            'depo_amount' => 'required',
            'depo_date' => 'required',
            'depo_status' => 'required',
            'return_date' => 'nullable',
            'updated_by' => 'nullable',
        ];
    }
}
