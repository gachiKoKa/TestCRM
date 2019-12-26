<?php

namespace App\Services\Validation;

class StoreUserValidator extends AbstractCustomValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'email' => 'required|string|email|unique:users|max:255',
            'name' => 'required|string|max:255',
            'password'=> 'required|string|min:8|confirmed',
            'company_id' => 'nullable|int|exists:companies,id',
            'role_id' => 'required|int|exists:user_roles,id'
        ];
    }
}
