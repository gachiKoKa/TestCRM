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
     * @param $userId
     * @return bool
     */
    public function isAdmin($userId): bool
    {
        $user = $this->find($userId);

        if (is_null($user)) {
            return false;
        }

        $adminRole = $this->rolesKeeper->getAdminRole();

        return $user->id === $adminRole->id;
    }

    /**
     * @param $userId
     * @return bool
     */
    public function isEmployee($userId): bool
    {
        $user = $this->find($userId);

        if (is_null($user)) {
            return false;
        }

        $employeeRole = $this->rolesKeeper->getEmployeeRole();

        return $user->id === $employeeRole->id;
    }
}
