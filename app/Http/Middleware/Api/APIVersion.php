<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\InvalidApiVersion;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class APIVersion
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $api_version): Response
    {
        if ($this->checkApiVersion($api_version)) return InvalidApiVersion::throw();

        return $next($request);
    }

    private function checkApiVersion($api_version)
    {
        return config('app.api_version') !== $api_version;
    }
}
