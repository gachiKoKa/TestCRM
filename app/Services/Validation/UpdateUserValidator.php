<?php

namespace App\Services\Validation;

class UpdateUserValidator extends AbstractCustomValidator
{
    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'id' => 'required|int|exists:users,id',
            'email' => 'string|email|unique:users,email,' . $this->id . '|max:255',
            'name' => 'string|max:255',
            'password'=> 'string|min:8|confirmed',
            'role_id' => 'exists:user_roles,id',
            'company_id' => 'nullable|exists:companies,id'
        ];
    }
}
