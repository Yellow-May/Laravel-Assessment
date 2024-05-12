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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required|string|min:3|max:100",
            "price" => "required|numeric|min:1",
            "quantity" => "required|numeric|min:1",
            "description" => "required|string|min:10|max:255",
            "category_id" => "required|exists:categories,id",
            "image" => "required|image|max:2048"
        ];
    }
}
