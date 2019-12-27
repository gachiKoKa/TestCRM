<?php

namespace App\Structures;

use App\Company;
use App\User;

class MailSenderResponse
{
    /** @var User|null */
    public $user;

    /** @var Company|null */
    public $company;

    public function __construct(?User $user = null, ?Company $company = null)
    {
        $this->user = $user;
        $this->company = $company;
    }
}
