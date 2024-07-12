<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title' => ['string', 'required'],
            'body' => ['string', 'required'],
            'user_ids' => ['array', 'required',
            # Check if every Id supplied is an integer. Altenatively a rule can be created to perform the task
            function($attribute, $value, $fail){
                $integerId = collect($value)->every(fn ($element) => is_int($element));
                if(!$integerId){
                    $fail($attribute . ' Only integers allowed');
                }
            }
        ],
        ];
    }

    public function messages(){
        return [
            'title.string' => 'Title must be string',
            'body.required' => 'Please enter a valid value for the body field',

        ];
    }
}
