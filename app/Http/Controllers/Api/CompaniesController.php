<?php

namespace App\Http\Controllers\Api;

use App\constants\CommonConstants;
use App\Http\Controllers\Controller;
use App\Repositories\CompanyRepository;
use App\Repositories\UserRepository;
use App\Services\ApiResponseCreator;
use App\Services\CompanyLogoHandler;
use App\Services\Validation\StoreCompanyValidator;
use App\Services\Validation\UpdateCompanyValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class CompaniesController extends Controller
{
    /** @var CompanyRepository */
    private $companyRepository;

    /** @var CompanyLogoHandler */
    private $companyLogoHandler;

    public function __construct(CompanyRepository $companyRepository, CompanyLogoHandler $companyLogoHandler)
    {
        $this->companyRepository = $companyRepository;
        $this->companyLogoHandler = $companyLogoHandler;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $companies = $this->companyRepository->getBuilder()->paginate(CommonConstants::RECORDS_PER_PAGE)->items();

        foreach ($companies as $company) {
            if (is_null($company->logo)) {
                $company->logo = '';
                continue;
            }

            $company->logo = $this->companyLogoHandler->getCompanyLogoUrl($company->logo);
        }

        return ApiResponseCreator::responseOk($companies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyValidator $storeCompanyValidator
     * @return JsonResponse
     */
    public function store(StoreCompanyValidator $storeCompanyValidator): JsonResponse
    {
        try {
            $newCompanyData = $storeCompanyValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $uploadFileName = $this->companyLogoHandler->uploadLogo();
        $newCompanyData['logo'] = $uploadFileName;
        $newCompany = $this->companyRepository->create($newCompanyData);
        $newCompany->logo = $this->companyLogoHandler->getCompanyLogoUrl($newCompany->logo);

        return ApiResponseCreator::responseOk($newCompany);
    }

    /**
     * Update the specified resource in storage.
     *
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
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $company = $this->companyRepository->find($id);
        $uploadFileName = $this->companyLogoHandler->uploadLogo();

        if ($uploadFileName != '') {
            $updateCompanyData['logo'] = $uploadFileName;
        }

        $updated = $this->companyRepository->update($id, $updateCompanyData);

        if (!$updated) {
            return ApiResponseCreator::responseError('Company was not updated.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $company->refresh();
        $company->logo = $this->companyLogoHandler->getCompanyLogoUrl($company->logo);

        return ApiResponseCreator::responseOk($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
       $deletedCompanyLogo = $this->companyLogoHandler->deleteCompanyLogoFromDirectory($id);
       $deletedCompany = $this->companyRepository->delete($id);

        if (!$deletedCompany || !$deletedCompanyLogo) {
            return ApiResponseCreator::responseError('Company was not deleted properly', Response::HTTP_BAD_REQUEST);
        }

        return ApiResponseCreator::responseOk();
    }

    /**
     * @return JsonResponse
     */
    public function getAllCompanies(): JsonResponse
    {
        $companies = $this->companyRepository->getBuilder()->select(['id', 'name'])->get()->toArray();

        return ApiResponseCreator::responseOk($companies);
    }

    /**
     * @param UserRepository $userRepository
     * @param int $companyId
     * @param int $userId
     * @return JsonResponse
     */
    public function joinUserToCompany(UserRepository $userRepository, int $companyId, int $userId): JsonResponse
    {
        $company = $this->companyRepository->find($companyId);

        if (is_null($company)) {
            return ApiResponseCreator::responseError('Company not found', Response::HTTP_NOT_FOUND);
        }

        $user = $userRepository->find($userId);

        if (is_null($user)) {
            return ApiResponseCreator::responseError('User not found', Response::HTTP_NOT_FOUND);
        }

        $user->company_id = $company->id;
        $user->save();

        return ApiResponseCreator::responseOk();
    }
}
