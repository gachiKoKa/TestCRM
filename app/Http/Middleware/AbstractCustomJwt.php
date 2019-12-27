<?php

namespace App\Http\Middleware;

use App\Services\BearerTokenRetriever;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\JWTAuth;

class AbstractCustomJwt
{
    /** @var JWTAuth */
    protected $jwt;

    /** @var BearerTokenRetriever */
    protected $bearerTokenRetriever;

    public function __construct(JWTAuth $jwt, BearerTokenRetriever $bearerTokenRetriever)
    {
        $this->jwt = $jwt;
        $this->bearerTokenRetriever = $bearerTokenRetriever;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @return bool
     */
    protected function handleToken(Request $request): bool
    {
        $token = $this->bearerTokenRetriever->getToken($request);

        try {
            $this->jwt->setToken($token);
        } catch (JWTException | TokenInvalidException $exception) {
            return false;
        }

        return true;
    }
}
