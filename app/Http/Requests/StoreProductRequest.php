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
            'name' => 'required|string|max:20|unique:products',
            /**
             * 画像ファイルのバリデーションでドット記法を書くとrequiredが効かない。
             * 一方、「files.0」のように配列番号を書くとrequiredが効く。
             */
            //'files.*' => 'required|file|max:8192|image|mimes:jpeg,png',
            'files.0' => 'required|file|max:8192|image|mimes:jpeg,png',
            'files.1' => 'required|file|max:8192|image|mimes:jpeg,png',
            'files.2' => 'required|file|max:8192|image|mimes:jpeg,png',
        ];
    }
}
