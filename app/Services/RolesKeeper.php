<?php

namespace App\Services;

use App\Constants\CommonConstants;
use App\Repositories\RolesRepository;
use App\UserRole;

class RolesKeeper
{
    /** @var RolesRepository */
    private $userRoleRepository;

    public function __construct(RolesRepository $userRoleRepository)
    {
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * @return UserRole
     */
    public function getAdminRole(): UserRole
    {
        return $this->getRole(CommonConstants::ADMIN_ROLE);
    }

    /**
     * @return UserRole
     */
    public function getEmployeeRole(): UserRole
    {
        return $this->getRole(CommonConstants::EMPLOYEE_ROLE);
    }

    /**
     * @param string $roleName
     * @return UserRole
     */
    private function getRole(string $roleName): UserRole
    {
        /** @var UserRole $role */
        $role = $this->userRoleRepository->getBuilder()->where('name', $roleName)->first();

        if (is_null($role)) {
            $role = $this->userRoleRepository->create([
                'name' => $roleName
            ]);
        }

        return $role;
    }
}
