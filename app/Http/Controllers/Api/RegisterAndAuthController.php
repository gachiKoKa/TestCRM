<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use App\Services\ApiResponseCreator;
use App\Services\RolesChecker;
use App\Services\RolesKeeper;
use App\Services\Validation\StoreUserValidator;
use App\Structures\CreatedUserResponse;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class RegisterAndAuthController extends Controller
{
    /**@var StoreUserValidator */
    private $storeUserValidator;

    /** @var UserRepository */
    private $userRepository;

    /** @var RolesChecker */
    private $rolesChecker;

    /**@var RolesKeeper */
    private $rolesKeeper;

    public function __construct(
        StoreUserValidator $storeUserValidator,
        UserRepository $userRepository,
        RolesChecker $rolesChecker,
        RolesKeeper $rolesKeeper
    ) {
        $this->storeUserValidator = $storeUserValidator;
        $this->userRepository = $userRepository;
        $this->rolesChecker = $rolesChecker;
        $this->rolesKeeper = $rolesKeeper;
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

        $employeeRole = $this->rolesKeeper->getEmployeeRole();
        $newUserData['password'] = Hash::make($newUserData['password']);
        $newUserData['role_id'] = $employeeRole->id;
        /** @var User $newUser */
        $newUser = $this->userRepository->create($newUserData);

        return ApiResponseCreator::responseOk(new CreatedUserResponse($newUser));
    }

}
