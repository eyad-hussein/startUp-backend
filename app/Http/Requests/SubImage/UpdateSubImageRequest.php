<?php

namespace App\Http\Requests\SubImage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubImageRequest extends FormRequest
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
            'image_id' => 'sometimes|integer|exists:images,id',
            'url' => 'sometimes|string',
        ];
    }
}