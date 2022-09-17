<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'address' => 'required|max:255',
            'first_name' => 'required|max:40',
            'last_name' => 'required|max:40',
            'email' => 'required|max:255',
            'mobile' => 'required|max:25',
            'product' => 'required|integer|exists:products,id'
        ];
    }
}
