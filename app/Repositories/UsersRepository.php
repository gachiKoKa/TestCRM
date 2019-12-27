<?php

namespace App\Repositories;

use App\User;

class UsersRepository extends AbstractRepository
{
    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return User::class;
    }

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        /** @var User $user */
        $user = $this->getBuilder()->where('email', $email)->first();

        return $user;
    }
}
