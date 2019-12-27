<?php

namespace App\Services;

use App\Repositories\UsersRepository;
use App\User;
use App\UserRole;

class RolesChecker
{
    /** @var UsersRepository */
    private $userRepository;

    /** @var RolesKeeper */
    private $rolesKeeper;

    /** @var User|null */
    private $user = null;

    public function __construct(UsersRepository $userRepository, RolesKeeper $rolesKeeper)
    {
        $this->userRepository = $userRepository;
        $this->rolesKeeper = $rolesKeeper;
    }

    /**
     * @param int|null $userId
     * @return bool
     */
    public function isAdmin(?int $userId = null): bool
    {
        $adminRole = $this->rolesKeeper->getAdminRole();

        return $this->checkRole($adminRole, $userId);
    }

    /**
     * @param int|null $userId
     * @return bool
     */
    public function isEmployee(?int $userId = null): bool
    {
        $employeeRole = $this->rolesKeeper->getEmployeeRole();

        return $this->checkRole($employeeRole, $userId);
    }

    /**
     * @param User $user
     * @return RolesChecker
     */
    public function setUser(User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @param UserRole $role
     * @param int|null $userId
     * @return bool
     */
    private function checkRole(UserRole $role, ?int $userId = null)
    {
        /** @var User|null $user */
        $user = $this->user;

        if (!is_null($userId) && $userId > 0) {
            $user = $this->userRepository->find($userId);
        }

        if (is_null($user)) {
            return false;
        }

        return $user->id === $role->id;
    }
}
