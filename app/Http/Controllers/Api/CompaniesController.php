<?php

namespace App\Http\Controllers\Api;

use App\Company;
use App\Constants\CommonConstants;
use App\Http\Controllers\Controller;
use App\Repositories\CompaniesRepository;
use App\Repositories\UsersRepository;
use App\Services\ApiResponseCreator;
use App\Services\CompanyLogoHandler;
use App\Services\CompanyMailSender;
use App\Services\PaginationHelper;
use App\Services\Validation\StoreCompanyValidator;
use App\Services\Validation\UpdateCompanyValidator;
use App\Structures\PaginatedData;
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

        $companies = $this->companiesRepository
            ->getBuilder()
            ->paginate(CommonConstants::RECORDS_PER_PAGE)
        ;
        $companyItems = $companies->items();

        foreach ($companyItems as $companyItem) {
            $companyItem->setLogoUrl();
        }

        $paginatedData = new PaginatedData();
        $paginatedData->currentPage = $companies->currentPage();
        $paginatedData->lastPage = $companies->lastPage();
        $paginatedData->records = $companyItems;
        $paginationBlock = PaginationHelper::generatePaginationBlock($paginatedData);

        return ApiResponseCreator::responseOk([
            'companies' => $companyItems,
            'pagination' => $paginationBlock
        ]);
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
     * @param UsersRepository $usersRepository
     * @return JsonResponse
     */
    public function destroy(int $id, UsersRepository $usersRepository): JsonResponse
    {
        $usersRepository->getBuilder()->where('company_id', $id)->update(['company_id' => null]);
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
     * @param int $companyId
     * @param int $userId
     * @param CompanyMailSender $companyMailSender
     * @return JsonResponse
     */
    public function joinUserToCompany(
        int $companyId,
        int $userId,
        CompanyMailSender $companyMailSender
    ): JsonResponse {
        $response = $companyMailSender->sendNotificationToCompanyEmail($companyId, $userId);

        if (is_null($response->user) || $companyId > 0 && is_null($response->company)) {
            return ApiResponseCreator::responseError('Company or user not found.', Response::HTTP_NOT_FOUND);
        }

        return ApiResponseCreator::responseOk();
    }
}
