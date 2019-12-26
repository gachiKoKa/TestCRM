<?php

namespace App\Http\Controllers\Api;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Services\ApiResponseCreator;
use App\Services\RolesChecker;
use App\Services\RolesKeeper;
use App\Services\Validation\RegisterUserValidator;
use App\Services\Validation\SignInUserValidator;
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

    /** @var UserRepository */
    private $userRepository;

    /** @var RolesChecker */
    private $rolesChecker;

    /**@var RolesKeeper */
    private $rolesKeeper;

    /** @var SignInUserValidator */
    private $signInUserValidator;

    /** @var array */
    private $allRoles = [];

    public function __construct(
        SignInUserValidator $signInUserValidator,
        UserRepository $userRepository,
        RolesChecker $rolesChecker,
        RolesKeeper $rolesKeeper,
        RoleRepository $roleRepository
    ) {
        $this->signInUserValidator = $signInUserValidator;
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
            $newUserData = $registerUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError('Registration issue', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $employeeRole = $this->rolesKeeper->getEmployeeRole();
        $newUserData['password'] = Hash::make($newUserData['password']);
        $newUserData['role_id'] = $employeeRole->id;
        /** @var User $newUser */
        $newUser = $this->userRepository->create($newUserData);

        return ApiResponseCreator::responseOk(new CreatedUserResponse($newUser, false, true, $this->allRoles));
    }

    /**
     * @return JsonResponse
     */
    public function signInUser(): JsonResponse
    {
        try {
            $userData = $this->signInUserValidator->validate();
        } catch (ValidationException $e) {
            return ApiResponseCreator::responseError('Invalid credentials', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        /** @var User $user */
        $user = $this->userRepository->findByEmail($userData['email']);

        if (!Hash::check($userData['password'], $user->password)) {
            return ApiResponseCreator::responseError('Incorrect password', Response::HTTP_BAD_REQUEST);
        }

        $isAdminUser = $this->rolesChecker->isAdmin($user->id);

        return ApiResponseCreator::responseOk(
            new CreatedUserResponse($user, $isAdminUser, !$isAdminUser, $this->allRoles)
        )
            ;
    }
}
