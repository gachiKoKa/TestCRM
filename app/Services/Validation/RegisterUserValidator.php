<?php

namespace App\Services\Validation;

class RegisterUserValidator extends AbstractCustomValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:255',
            'name' => 'required|string|max:255',
            'password'=> 'required|string|min:8|confirmed'
        ];
    }
}
