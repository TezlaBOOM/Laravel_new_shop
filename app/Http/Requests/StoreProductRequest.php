<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' =>'required|max:500',
            'sku' =>'required|max:500',
            'description' =>'required|max:1500',
            'amount' =>'required|integer|min:0',
            'price' =>'required|numeric|between:0,999999.99',
            'image' =>'image|mimes:jpg,png',
            'category_id' =>'required|integer',
        ];
    }
    // public function messages()
    // {
    //     return[
    //         'name' =>'Jest wymagane pole :attribute!'
    //     ];
    // }
    // public function attributes()
    // {
    //     return[
    //         'name' =>'nazwa'
    //     ];
    // }
}
