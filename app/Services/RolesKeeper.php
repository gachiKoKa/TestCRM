<?php

namespace App\Services;

use App\Repositories\UserRoleRepository;
use App\UserRole;

class RolesKeeper
{
    /** @var UserRoleRepository */
    private $userRoleRepository;

    public function __construct(UserRoleRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
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
