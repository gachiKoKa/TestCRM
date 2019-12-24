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

    public function __construct(User $user, bool $isAdmin = false, bool $isEmployee = true)
    {
        $this->user = $user;
        $this->isAdmin = $isAdmin;
        $this->isEmployee = $isEmployee;
    }
}
