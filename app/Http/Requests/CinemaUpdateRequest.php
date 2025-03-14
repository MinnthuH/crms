<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CinemaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            'name' => 'required|string|max:255',
            'hall_ids' => 'required|array',  // Array of selected halls
            'showtime_ids' => 'required|array', // Array of selected showtimes
            'ticketprice' => 'required|array', // Array of selected ticket prices
        ];
    }
}
