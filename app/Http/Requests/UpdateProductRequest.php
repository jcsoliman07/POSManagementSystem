<?php

namespace App\Http\Requests;

use App\Models\Products;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {

        return true;

    }

    public function rules(): array
    {
        /** @var Products $product */
        $product = request()->route('product');
        $productId = $product instanceof Products ? $product->id : $product;

        return [
            'product'        => ['required', 'string', 'max:255', Rule::unique('products', 'name')->ignore($productId)],
            'price'          => ['required', 'numeric', 'min:0'],
            'category'       => ['required', 'exists:categories,id'],
            'description'    => ['required', 'string'],
            'image'          => ['nullable', File::types(['png', 'jpg', 'jpeg'])],
            'existing_image' => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'product.required' => 'The product name is required.',
            'product.unique'   => 'The product name is already in use.',
            'category.exists'  => 'The selected category is invalid.',
        ];
    }
}
