<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function rules(Request $request): array
    {
        return [
            'name' => ['required', 'string', 'max:20', Rule::unique('products')->ignore($request->route('product'))],
            'files.0' => 'file|max:8192|image|mimes:jpeg,png',
            'files.1' => 'file|max:8192|image|mimes:jpeg,png',
            'files.2' => 'file|max:8192|image|mimes:jpeg,png',
        ];
    }
}
