<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'gender' => ['sometimes', 'required', 'in:male,female,other'],
            'age' => ['sometimes', 'required', 'integer', 'min:10', 'max:100'],
            'height' => ['sometimes', 'required', 'numeric', 'min:100', 'max:250'], // cm
            'weight' => ['sometimes', 'required', 'numeric', 'min:30', 'max:300'],  // kg
            'activity_level' => ['sometimes', 'required', 'in:low,medium,high'],
            'goal' => ['sometimes', 'required', 'in:weight_loss,weight_gain,maintain,muscle_gain'],
            'medical_conditions' => ['nullable', 'array'],
        ];
    }
}
