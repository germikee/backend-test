<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * HTTP validation rules.
     *
     * @var array
     */
    protected $rules = [
        'POST' => [
            'title'         => ['required', 'string'],
            'author_id'     => ['required', 'exists:authors,id'],
            'article'       => ['required', 'string'],
            'is_published'  => ['required', 'boolean'],
        ],
        'PATCH' => [
            'title'         => ['string'],
            'author_id'     => ['exists:id,authors'],
            'article'       => ['string'],
            'is_published'  => ['boolean'],
        ],
    ];

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return $this->rules[$this->method()];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'is_published.required' => 'The published field is required.',
            'is_published.boolean' => 'The published field must be true or false.',
        ];
    }
}
