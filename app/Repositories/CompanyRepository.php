<?php

namespace App\Repositories;

use App\Company;

class CompanyRepository extends AbstractRepository
{

    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return Company::class;
    }
}
