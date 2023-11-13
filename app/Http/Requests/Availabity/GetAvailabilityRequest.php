<?php

namespace App\Http\Requests\Availabity;

use Illuminate\Foundation\Http\FormRequest;

class GetAvailabilityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date_booking' => 'bail|required|date|date_format:Y-m-d|after_or_equal:2025-01-01|before_or_equal:2025-01-07',
            'participants' => 'bail|required|integer|min:1',
        ];
    }
}
