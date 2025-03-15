<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CinemaReportUpdateRequest extends FormRequest
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
          'date' => 'required|date',
            'movie_id' => 'required',
            'hall_id' => 'required',
            'showtime_id' => 'required',
            'total_seats' => 'required|numeric',
            'total_revenue' => 'required|numeric',
            'epc_id' => 'required',
        ];
    }
}
