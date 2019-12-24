<?php

namespace App\Services\Validation;

class SignInUserValidator extends AbstractCustomValidator
{

    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
            'email' => 'required|string|email|exists:users|max:255',
            'password'=> 'required|string|min:8'
        ];
    }
}
