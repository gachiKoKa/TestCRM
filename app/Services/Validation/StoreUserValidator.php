<?php

namespace App\Services\Validation;

class StoreUserValidator extends AbstractCustomValidator
{
    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:255',
            'name' => 'required|string|max:255',
            'password'=> 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:user_roles,id',
            'company_id' => 'nullable|exists:companies,id'
        ];
    }
}
