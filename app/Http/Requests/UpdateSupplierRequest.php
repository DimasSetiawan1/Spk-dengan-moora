<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
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
        return [];
        // return [
        //     'name' => 'required|unique:suppliers',
        //     'kualitas' => 'required|char:1',
        //     'harga' => 'required|decimal:0,10',
        //     'pengiriman' => 'required|integer',
        //     'persediaan' => 'required|boolean',
        // ];
    }
}
