<?php

namespace App\Http\Controllers\Api;

use App\Constants\CommonConstants;
use App\Http\Controllers\Controller;
use App\Repositories\RolesRepository;
use App\Repositories\UsersRepository;
use App\Services\ApiResponseCreator;
use App\Services\BearerTokenRetriever;
use App\Services\RolesChecker;
use App\Services\PaginationHelper;
use App\Services\Validation\StoreUserValidator;
use App\Services\Validation\UpdateUserValidator;
use App\Structures\UserResponse;
use App\User;
use App\Structures\PaginatedData;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class UsersController extends Controller
{
    /** @var UsersRepository */
    private $userRepository;

    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('isAdmin', ['except' => ['getByToken']]);
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

        $userData['password'] = Hash::make($userData['password']);
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

        if (array_key_exists('password', $userData)) {
            $userData['password'] = Hash::make($userData['password']);
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

    /**
     * @param Request $request
     * @param BearerTokenRetriever $bearerTokenRetriever
     * @param JWTAuth $JWTAuth
     * @param RolesChecker $rolesChecker
     * @param RolesRepository $rolesRepository
     * @return JsonResponse
     */
    public function getByToken(
        Request $request,
        BearerTokenRetriever $bearerTokenRetriever,
        JWTAuth $JWTAuth,
        RolesChecker $rolesChecker,
        RolesRepository $rolesRepository
    ): JsonResponse {
        $token = $bearerTokenRetriever->getToken($request);

        try {
            $user = $JWTAuth->setToken($token)->parseToken()->toUser();
        } catch (JWTException | TokenInvalidException $e) {
            return ApiResponseCreator::responseError($e->getMessage(), Response::HTTP_UNAUTHORIZED);
        }

        /** @var User|null $user */
        $user = $this->userRepository->findByEmail($user->email);

        if (is_null($user)) {
            return ApiResponseCreator::responseError('User was not found.', Response::HTTP_NOT_FOUND);
        }

        $isAdmin = $rolesChecker->setUser($user)->isAdmin();
        $response = new UserResponse($user, $rolesRepository->all()->toArray(), !$isAdmin, $isAdmin, $token);

        return ApiResponseCreator::responseOk($response);
    }
}
