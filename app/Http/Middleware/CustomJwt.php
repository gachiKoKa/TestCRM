<?php

namespace App\Http\Middleware;

use App\Services\ApiResponseCreator;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomJwt extends AbstractCustomJwt
{
    /**
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->handleToken($request)) {
            return ApiResponseCreator::responseError('Invalid token.', Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }
}
