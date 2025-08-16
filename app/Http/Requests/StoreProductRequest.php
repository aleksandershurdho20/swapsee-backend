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
            'name'          => 'required|string|max:255',
            'slug'          => 'required|string|max:255|unique:products,slug',
            'description'   => 'required|string|max:1000',
            'category_id'   => 'required|exists:categories,id',
            'department_id' => 'required|exists:departments,id',
            'price'         => 'required|numeric|min:0',
            'status'        => 'required|string|in:draft,published',
            'quantity'      => 'nullable|integer|min:0',
        ];
    }
}
