<?php

namespace App\Http\Middleware\Api;

use App\Models\NotebookRecord;
use App\Services\TokenService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsActionAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $record = NotebookRecord::findOrFail(request('id'));
        TokenService::ensureIsActionAuthorized($record);

        return $next($request);
    }
}
