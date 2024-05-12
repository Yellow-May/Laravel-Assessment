<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            "name" => "nullable|string|min:3|max:100",
            "price" => "nullable|numeric|min:1",
            "quantity" => "nullable|numeric|min:1",
            "description" => "nullable|string|min:10|max:255",
            "category_id" => "nullable|exists:categories,id",
            "image" => "nullable|image|max:2048"
        ];
    }
}
