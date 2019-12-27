<?php

namespace App\Http\Controllers\Api;

use App\Constants\CommonConstants;
use App\Http\Controllers\Controller;
use App\Repositories\UsersRepository;
use App\Services\ApiResponseCreator;
use App\Services\PaginationHelper;
use App\Services\Validation\StoreUserValidator;
use App\Services\Validation\UpdateUserValidator;
use App\Structures\PaginatedData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller
{
    /** @var UsersRepository */
    private $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository
            ->getBuilder()
            ->with(['role', 'company'])
            ->paginate(CommonConstants::RECORDS_PER_PAGE)
        ;

        $usersItems = $users->items();

        $paginatedData = new PaginatedData();
        $paginatedData->currentPage = $users->currentPage();
        $paginatedData->lastPage = $users->lastPage();
        $paginatedData->records = $usersItems;
        $paginationBlock = PaginationHelper::generatePaginationBlock($paginatedData);

        return ApiResponseCreator::responseOk([
            'users' => $usersItems,
            'pagination' => $paginationBlock
        ]);
    }

    /**
     * @param StoreUserValidator $storeUserValidator
     * @return JsonResponse
     */
    public function store(StoreUserValidator $storeUserValidator): JsonResponse
    {
        try {
            $userData = $storeUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        $this->userRepository->create($userData);

        return ApiResponseCreator::responseOk();
    }

    /**
     * @param UpdateUserValidator $updateUserValidator
     * @param int $id
     * @return JsonResponse
     */
    public function update(int $id, UpdateUserValidator $updateUserValidator): JsonResponse
    {
        $updateUserValidator->id = $id;

        try {
            $userData = $updateUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        $updated = $this->userRepository->update($id, $userData);

        if (!$updated) {
            return ApiResponseCreator::responseError('User was not updated.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        return ApiResponseCreator::responseOk();
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deletedUser = $this->userRepository->delete($id);

        if (!$deletedUser) {
            return ApiResponseCreator::responseError('User was not deleted.', Response::HTTP_BAD_REQUEST);
        }

        return ApiResponseCreator::responseOk();
    }
}
