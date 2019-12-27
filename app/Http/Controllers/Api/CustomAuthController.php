<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UsersRepository;
use App\Repositories\RolesRepository;
use App\Services\ApiResponseCreator;
use App\Services\RolesChecker;
use App\Services\RolesKeeper;
use App\Services\Validation\RegisterUserValidator;
use App\Services\Validation\SignInUserValidator;
use App\Structures\UserResponse;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class CustomAuthController extends Controller
{
    /** @var UsersRepository */
    private $userRepository;

    /** @var RolesChecker */
    private $rolesChecker;

    /**@var RolesKeeper */
    private $rolesKeeper;

    /** @var array */
    private $allRoles = [];

    public function __construct(
        UsersRepository $userRepository,
        RolesChecker $rolesChecker,
        RolesKeeper $rolesKeeper,
        RolesRepository $roleRepository
    ) {
        $this->userRepository = $userRepository;
        $this->rolesChecker = $rolesChecker;
        $this->rolesKeeper = $rolesKeeper;
        $this->allRoles = $roleRepository->all()->toArray();
    }

    /**
     * @param RegisterUserValidator $registerUserValidator
     * @return JsonResponse
     */
    public function registerUser(RegisterUserValidator $registerUserValidator): JsonResponse
    {
        try {
            $requestData = $registerUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        $employeeRole = $this->rolesKeeper->getEmployeeRole();
        $requestData['password'] = Hash::make($requestData['password']);
        $requestData['role_id'] = $employeeRole->id;
        /** @var User $user */
        $user = $this->userRepository->create($requestData);
        $response = new UserResponse($user, $this->allRoles, true, false, '');

        return ApiResponseCreator::responseOk($response);
    }

    /**
     * @param SignInUserValidator $signInUserValidator
     * @return JsonResponse
     */
    public function signInUser(SignInUserValidator $signInUserValidator): JsonResponse
    {
        try {
            $userData = $signInUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError($e->errors(), Response::HTTP_BAD_REQUEST);
        }

        /** @var User $user */
        $user = $this->userRepository->findByEmail($userData['email']);

        if (!Hash::check($userData['password'], $user->password)) {
            return ApiResponseCreator::responseError('Incorrect password.', Response::HTTP_BAD_REQUEST);
        }

        $isAdmin = $this->rolesChecker->setUser($user)->isAdmin();
        $response = new UserResponse($user, $this->allRoles, !$isAdmin, $isAdmin, '');

        return ApiResponseCreator::responseOk($response);
    }
}
