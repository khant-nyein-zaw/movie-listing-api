<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rules\File;

class MovieFormRequest extends FormRequest
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
        switch ($this->method()) {
            case 'PUT': {
                    return [];
                }
            case 'POST': {
                    return [
                        'title' => ['required', 'max:255', 'unique:movies,title,' . $this->route('movie')],
                        'summary' => ['required'],
                        'cover_image' => [File::image()],
                        'author' => ['required', 'max:255'],
                        'genres' => ['required', 'array'],
                        'tags' => ['required', 'array'],
                        'imdb_rating' => ['required'],
                        // 'pdf_download_link' => ['required']
                    ];
                }
            default:
                break;
        }
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
