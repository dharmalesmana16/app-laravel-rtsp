<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceTokenAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $expected = (string) config('services.stream_token');

        if ($expected === '' || !hash_equals($expected, (string) $request->bearerToken())) {
            abort(401, 'Unauthorized service token.');
        }

        return $next($request);
    }
}
