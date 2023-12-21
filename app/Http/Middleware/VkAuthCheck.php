<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VkAuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->post()['secret'] !== config('services.vk.token')) {
            return new Response('Permission denied', 403);
        }
        return $next($request);
    }
}
