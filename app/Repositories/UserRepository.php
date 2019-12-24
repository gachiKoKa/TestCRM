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
}
