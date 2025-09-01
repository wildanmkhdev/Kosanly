<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CostumerInformationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'room_id' => 'required|integer|exists:rooms,id',

            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'duration' => 'required',
            'start_date' => 'required'
        ];
    }
}
