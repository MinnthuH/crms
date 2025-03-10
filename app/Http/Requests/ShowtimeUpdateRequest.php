<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowtimeUpdateRequest extends FormRequest
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
            'showtime' => ['required', 'date_format:H:i', 'unique:show_times,showtime'], // Ensures correct time format and uniqueness

        ];
    }
}
