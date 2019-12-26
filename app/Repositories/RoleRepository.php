<?php

namespace App\Repositories;

use App\UserRole;

class RoleRepository extends AbstractRepository
{

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return UserRole::class;
    }
}
