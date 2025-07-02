<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

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
            'product'           => ['required', 'string', 'max:255', 'unique:products,name'], //maps 'name' in prodcuts table name
            'price'             => ['required', 'numeric', 'min:0'],
            'category'          => ['required', 'exists:categories,id'], //Connected to the category_id in db
            'description'       => ['required', 'string'],
            'image'             => ['required', 'file', File::types(['png', 'jpg', 'jpeg'])],
        ];
    }

    public function messages() :array
    {
        return[
            'product.required' => ['Please enter a product name.'],
            'price.required' => ['Please enter a price.'],
            'price.numeric' => ['Please enter a valid number'],
            'product.min' => ['Price cannot be negative'],
            'image.file' => ['Upload file must be a file.'],
            'image.mimes' => ['Only PNG, JPG, or JPEG images are allowed'],
        ];
    }
}
