<?php

namespace App\Services\Validation;

class SignInUserValidator extends AbstractCustomValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'email' => 'required|string|email|exists:users,email|max:255',
            'password'=> 'required|string|min:8'
        ];
    }
}
