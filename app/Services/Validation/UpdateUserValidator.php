<?php

namespace App\Services\Validation;

class UpdateUserValidator extends AbstractCustomValidator
{
    /** @var int */
    public $id = 0;

    /**
     * @inheritDoc
     */
    public function getRules(): array
    {
        return [
            'email' => 'string|email|unique:users,email,' . $this->id . '|max:255',
            'name' => 'string|max:255',
            'password'=> 'string|min:8|confirmed',
            'role_id' => 'exists:user_roles,id',
            'company_id' => 'nullable|exists:companies,id'
        ];
    }
}
