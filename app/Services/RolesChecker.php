<?php

namespace App\Services;

use App\Repositories\UserRepository;

class RolesChecker
{
    /** @var UserRepository */
    private $userRepository;

    /** @var RolesKeeper */
    private $rolesKeeper;

    public function __construct(UserRepository $userRepository, RolesKeeper $rolesKeeper)
    {
        $this->userRepository = $userRepository;
        $this->rolesKeeper = $rolesKeeper;
    }

    /**
     * @param $userId
     * @return bool
     */
    public function isAdmin(int $userId): bool
    {
        $user = $this->userRepository->find($userId);

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
    public function isEmployee(int $userId): bool
    {
        $user = $this->userRepository->find($userId);

        if (is_null($user)) {
            return false;
        }

        $employeeRole = $this->rolesKeeper->getEmployeeRole();

        return $user->id === $employeeRole->id;
    }
}
