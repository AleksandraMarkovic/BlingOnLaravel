<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'productName' => ['required', 'regex:/^([A-Z][a-z]{1,50}\s?)+$/'],
            'productDescription' => 'required',
            'productColor' => 'required|not_in:0',
            'productType' => 'required|not_in:0',
            'brandName' => 'required',
            'productPrice' => 'required|numeric',
            'productSize' => 'required',
            'productImage' => 'required|image',
            'image1' => 'required|image',
            'image2' => 'required|image',
            'image3' => 'required|image',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute is required.',
            'productName.regex' => 'Each word must start with a capital letter, only letters allowed',
            'numeric' => 'The :attribute field must have a numeric value.',
            'image' => 'File must :attribute be an image.'
        ];
    }
}
