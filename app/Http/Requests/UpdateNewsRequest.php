<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNewsRequest extends FormRequest
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
        // ambil id dari route model binding
        $newsId = $this->route('news')->id;

        return [
            'author_id'     => ['required','integer','exists:authors,id'],
            'category_id'   => ['required','integer','exists:categories,id'],
            'title'         => ['required','string','max:255'],
            'slug'          => [
                'required',
                'string',
                Rule::unique('news','slug')->ignore($newsId)
            ],
            'thumbnail'     => ['nullable','string'],
            'content'       => ['required','string'],
            'is_featured'   => ['required','boolean']
        ];
    }
}
