<?php

namespace App\Repositories;

use App\UserRole;

class UserRoleRepository extends AbstractRepository
{

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return UserRole::class;
    }
}
