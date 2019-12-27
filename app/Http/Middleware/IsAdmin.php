<?php

namespace App\Http\Middleware;

use App\Services\ApiResponseCreator;
use App\Services\BearerTokenRetriever;
use App\Services\RolesChecker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class IsAdmin extends AbstractCustomJwt
{
    /** @var RolesChecker */
    private $rolesChecker;

    public function __construct(
        JWTAuth $jwt,
        BearerTokenRetriever $bearerTokenRetriever,
        RolesChecker $rolesChecker
    ) {
        parent::__construct($jwt, $bearerTokenRetriever);
        $this->rolesChecker = $rolesChecker;
    }

    /**
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $user = $this->jwt->setToken($this->bearerTokenRetriever->getToken($request))->parseToken()->toUser();
        } catch (JWTException $e) {
            return ApiResponseCreator::responseError('Invalid token.', Response::HTTP_UNAUTHORIZED);
        }

        if (!$this->rolesChecker->isAdmin($user->id)) {
            return ApiResponseCreator::responseError('Access denied.', Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
