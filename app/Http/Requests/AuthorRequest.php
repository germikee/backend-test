<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
{
    /**
     * HTTP validation rules.
     *
     * @var array
     */
    protected $rules = [
        'POST' => [
            'first_name' => ['required', 'string'],
            'last_name'  => ['required', 'string'],
        ],
        'PATCH' => [
            'first_name' => ['string'],
            'last_name'  => ['string'],
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
}
