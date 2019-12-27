<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BearerTokenRetriever
{
    /**
     * @param Request $request
     * @return string
     */
    public function getToken(Request $request): string
    {
        $headerStart = 'Bearer ';
        $header = $request->header('Authorization', '');

        if (Str::startsWith($header, $headerStart)) {
            return Str::substr($header, Str::length($headerStart));

        }
        return '';
    }
}
