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
        $id = $this->input('id');
        return [
            'name' => 'required',
            'slug' => 'required|unique:products,slug,'.$id,
            'main_image' => 'mimes:png,jpg,jpeg|max:2048',
            'images.*' => 'image|mimes:jpg,jpeg,png|max:2048', // Validate each file in 'images[]'
            'short_description' => 'required',
            'description' => 'required',
            'regular_price' => 'required',
            'sku' => 'required',
            'stock_status' => 'required',
            'featured' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
            'brand_id'  =>'required'
        ];
    }
}
