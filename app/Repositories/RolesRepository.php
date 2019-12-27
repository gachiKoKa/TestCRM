<?php

namespace App\Repositories;

use App\UserRole;

class RolesRepository extends AbstractRepository
{
    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return UserRole::class;
    }
}
