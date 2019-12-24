<?php

namespace App\Services;

use App\Repositories\UserRepository;
use App\Repositories\UserRoleRepository;
use App\UserRole;

class RolesKeeper
{
    /** @var int */
    public $userId;

    /** @var UserRoleRepository */
    private $userRoleRepository;

    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRoleRepository $userRoleRepository, UserRepository $userRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @return UserRole
     */
    public function getAdminRole(): UserRole
    {
        /** @var UserRole $adminRole */
        $adminRole = $this->userRoleRepository->getBuilder()->where('name', 'admin')->first();

        if (is_null($adminRole)) {
            $this->userRoleRepository->create([
                'name' => 'admin'
            ]);
        }

        return $adminRole;
    }

    /**
     * @return UserRole
     */
    public function getEmployeeRole(): UserRole
    {
        /** @var UserRole $employeeRole */
        $employeeRole = $this->userRoleRepository->getBuilder()->where('name', 'employee')->first();

        if (is_null($employeeRole)) {
            $this->userRoleRepository->create([
                'name' => 'employee'
            ]);
        }

        return $employeeRole;
    }
}
