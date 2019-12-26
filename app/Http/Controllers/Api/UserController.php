<?php

namespace App\Http\Controllers\Api;

use App\constants\CommonConstants;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Services\ApiResponseCreator;
use App\Services\Validation\StoreUserValidator;
use App\Services\Validation\UpdateUserValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $users = $this->userRepository
            ->getBuilder()
            ->with(['role', 'company'])
            ->paginate(CommonConstants::RECORDS_PER_PAGE)
            ->items()
        ;

        return ApiResponseCreator::responseOk($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserValidator $storeEmployeeValidator
     * @return JsonResponse
     */
    public function store(StoreUserValidator $storeEmployeeValidator): JsonResponse
    {
        try {
            $newUserData = $storeEmployeeValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $newUser = $this->userRepository->create($newUserData);

        return ApiResponseCreator::responseOk($newUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserValidator $updateUserValidator
     * @param int $id
     * @return JsonResponse
     */
    public function update(int $id, UpdateUserValidator $updateUserValidator): JsonResponse
    {
        $updateUserValidator->id = $id;

        try {
            $updateUserData = $updateUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $updated = $this->userRepository->update($id, $updateUserData);

        if (!$updated) {
            return ApiResponseCreator::responseError('User was not updated', Response::HTTP_BAD_REQUEST);
        }

        return ApiResponseCreator::responseOk($updated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $deletedUser = $this->userRepository->delete($id);

        if (!$deletedUser) {
            return ApiResponseCreator::responseError('User was not deleted', Response::HTTP_BAD_REQUEST);
        }

        return ApiResponseCreator::responseOk();
    }

}
