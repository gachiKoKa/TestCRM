<?php

namespace App\Structures;

use App\User;

class UserResponse
{
    /** @var User */
    public $user;

    /** @var array */
    public $roles;

    /** @var bool */
    public $isAdmin;

    /** @var bool */
    public $isEmployee;

    /** @var string */
    public $token;

    public function __construct(
        User $user,
        array $roles = [],
        bool $isEmployee = false,
        bool $isAdmin = false,
        string $token = ''
    ) {
        $this->user = $user;
        $this->roles = $roles;
        $this->isEmployee = $isEmployee;
        $this->isAdmin = $isAdmin;
        $this->token = $token;
    }
}
