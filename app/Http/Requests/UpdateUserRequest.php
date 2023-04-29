<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'address.city' =>'required|max:255',
            'address.zip_code' =>'required|max:6',
            'address.street' =>'required|max:255',
            'address.street_no' =>'required|max:5',
            'address.home_no' =>'required|max:5',


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
