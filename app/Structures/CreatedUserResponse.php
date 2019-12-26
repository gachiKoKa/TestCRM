<?php

namespace App\Structures;


use App\User;

class CreatedUserResponse
{
    /** @var User */
    public $user;

    /** @var bool */
    public $isAdmin;

    /** @var bool */
    public $isEmployee;

    /** @var array */
    public $roles;

    public function __construct(User $user, bool $isAdmin = false, bool $isEmployee = true, array $roles = [])
    {
        $this->user = $user;
        $this->isAdmin = $isAdmin;
        $this->isEmployee = $isEmployee;
        $this->roles = $roles;
    }
}
