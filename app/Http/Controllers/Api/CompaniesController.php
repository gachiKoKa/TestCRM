<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Constants\CommonConstants;
use App\Http\Controllers\Controller;
use App\Repositories\CompaniesRepository;
use App\Repositories\UsersRepository;
use App\Services\ApiResponseCreator;
use App\Services\CompanyLogoHandler;
use App\Services\Validation\StoreCompanyValidator;
use App\Services\Validation\UpdateCompanyValidator;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CompaniesController extends Controller
{
    /** @var CompaniesRepository */
    private $companiesRepository;

    /** @var CompanyLogoHandler */
    private $companyLogoHandler;

    public function __construct(CompaniesRepository $companiesRepository, CompanyLogoHandler $companyLogoHandler)
    {
        $this->companiesRepository = $companiesRepository;
        $this->companyLogoHandler = $companyLogoHandler;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        /** @var Company[] $companies */
        $companies = $this->companiesRepository
            ->getBuilder()
            ->paginate(CommonConstants::RECORDS_PER_PAGE)
            ->items()
        ;

        foreach ($companies as $company) {
            $company->setLogoUrl();
        }

        return ApiResponseCreator::responseOk($companies);
    }

    /**
     * @return JsonResponse
     */
    public function getAllCompanies(): JsonResponse
    {
        $companies = $this->companiesRepository->getBuilder()->select(['id', 'name'])->get()->toArray();

        return ApiResponseCreator::responseOk($companies);
    }

    /**
     * @param StoreCompanyValidator $storeCompanyValidator
     * @return JsonResponse
     */
    public function store(StoreCompanyValidator $storeCompanyValidator): JsonResponse
    {
        try {
            $requestData = $storeCompanyValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        /** @var Company $company */
        $company = $this->companiesRepository->create($requestData);

        if (!$this->companyLogoHandler->uploadLogo($company)) {
            return ApiResponseCreator::responseError(
                'Company logo was not updated.',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return ApiResponseCreator::responseOk();
    }

    /**
     * @param int $id
     * @param UpdateCompanyValidator $updateCompanyValidator
     * @return JsonResponse
     */
    public function update(int $id, UpdateCompanyValidator $updateCompanyValidator): JsonResponse
    {
        $updateCompanyValidator->id = $id;

        try {
            $updateCompanyData = $updateCompanyValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        /** @var Company $company */
        $company = $this->companiesRepository->find($id);
        $companyWasUpdated = $this->companiesRepository->update($id, $updateCompanyData);
        $companyLogoWasUpdated = $this->companyLogoHandler->uploadLogo($company);

        if (!$companyWasUpdated || !$companyLogoWasUpdated) {
            return ApiResponseCreator::responseError(
                'Company was not updated properly.',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return ApiResponseCreator::responseOk();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->companiesRepository->delete($id);

        if (!$deleted) {
            return ApiResponseCreator::responseError(
                'Company was not deleted properly.',
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        return ApiResponseCreator::responseOk();
    }

    /**
     * @param UsersRepository $usersRepository
     * @param int $companyId
     * @param int $userId
     * @return JsonResponse
     */
    public function joinUserToCompany(int $companyId, int $userId, UsersRepository $usersRepository): JsonResponse
    {
        /** @var Company|null $company */
        $company = $this->companiesRepository->find($companyId);

        if (is_null($company)) {
            return ApiResponseCreator::responseError('Company not found', Response::HTTP_NOT_FOUND);
        }

        /** @var User|null $user */
        $user = $usersRepository->find($userId);

        if (is_null($user)) {
            return ApiResponseCreator::responseError('User not found', Response::HTTP_NOT_FOUND);
        }

        $user->company_id = $company->id;
        $user->save();

        return ApiResponseCreator::responseOk();
    }
}
