<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SnackShopReportStoreRequest extends FormRequest
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
            'snack_shop_id' => 'required',
            'user_id' => 'required',
            'opening_balance' => 'required|numeric',
            'sales' => 'required|numeric',
            'save_amount' => 'required|numeric',
            'total_expenses' => 'required|numeric',
            'transfer_amount' => 'required|numeric',
            'closing_balance' => 'required|numeric',
            'surplus_deficits' => 'required|numeric',
            'total_surplus_deficits' => 'nullable|numeric',
            'description' => 'nullable',
        ];
    }
}
