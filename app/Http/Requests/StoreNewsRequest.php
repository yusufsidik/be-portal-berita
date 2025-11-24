<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsRequest extends FormRequest
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
            'author_id' => ['required','integer','exists:authors,id'],
            'category_id' => ['required','integer','exists:categories,id'],
            'title' => ['required','string','max:255'],
            'slug' => ['required','string','unique:news,slug'],
            'thumbnail' => ['nullable','string'],
            'content' => ['required','string'],
            'is_featured' => ['required','boolean']
        ];
    }
}
