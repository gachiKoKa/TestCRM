<?php

namespace App\Repositories;

use App\Company;
use App\Services\CompanyLogoHandler;
use Exception;
use Illuminate\Container\Container;

class CompaniesRepository extends AbstractRepository
{
    /** @var CompanyLogoHandler */
    private $companyLogoHandler;

    public function __construct(Container $container, CompanyLogoHandler $companyLogoHandler)
    {
        parent::__construct($container);
        $this->companyLogoHandler = $companyLogoHandler;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return Company::class;
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        /** @var Company $company */
        $company = $this->find($id);

        if (is_null($company)) {
            return false;
        }

        $logoWasDeleted = $this->companyLogoHandler->deleteLogo($company);

        try {
            $companyWasDeleted = $company->delete();
        } catch (Exception $e) {
            return false;
        }

        return $logoWasDeleted && $companyWasDeleted;
    }
}
