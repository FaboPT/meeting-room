<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'booked_for' => 'bail|required|email',
            'room_id' => 'bail|required|exists:rooms,id',
            'start_date' => 'bail|required|date|date_format:Y-m-d H:i',
            'end_date' => 'bail|required|date|date_format:Y-m-d H:i|after_or_equal:start_date',
        ];
    }
}
