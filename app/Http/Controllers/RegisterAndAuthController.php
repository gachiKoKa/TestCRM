<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Services\ApiResponseCreator;
use App\Services\Validation\StoreUserValidator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class RegisterAndAuthController extends Controller
{
    /**@var StoreUserValidator */
    private $storeUserValidator;

    /** @var UserRepository */
    private $userRepository;

    public function __construct(StoreUserValidator $storeUserValidator, UserRepository $userRepository)
    {
        $this->storeUserValidator = $storeUserValidator;
        $this->userRepository = $userRepository;
    }

    /**
     * @return JsonResponse
     */
    public function registerUser(): JsonResponse
    {
        try {
            $newUserData = $this->storeUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError('Registration issue', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $newUser['admin'] = false;
        $newUser['employee'] = true;
        $newUser = $this->userRepository->create($newUserData);

        return ApiResponseCreator::responseOk($newUser);
    }

    /**
     * @return JsonResponse
     */
    public function getAbc(): JsonResponse
    {
        return ApiResponseCreator::responseOk(['a' => '1']);
    }
}
