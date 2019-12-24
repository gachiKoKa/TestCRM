<?php

namespace App\Repositories;

use App\Services\RolesKeeper;
use App\User;
use Illuminate\Container\Container;

class UserRepository extends AbstractRepository
{
    /** @var RolesKeeper */
    private $rolesKeeper;

    public function __construct(Container $container, RolesKeeper $rolesKeeper)
    {
        parent::__construct($container);
        $this->rolesKeeper = $rolesKeeper;
    }

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
