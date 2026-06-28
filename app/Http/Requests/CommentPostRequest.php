<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class CommentPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'string', 'max:10000'],
            'email' => ['string', 'nullable'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'body.required' => 'Please submit a non-empty comment!',
            'body.max' => 'Your comment must not be longer than 10000 characters',
        ];
    }

    #[Override]
    protected function getRedirectUrl()
    {
        if ($this['_form_id'] === 'main') {
            return url()->previous().'#comments';
        }

        return url()->previous().'#reply-anchor-'.$this['_reply_id'];
    }
}
