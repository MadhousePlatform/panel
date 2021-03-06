<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|JsonResponse|RedirectResponse
     */
    public function handle(Request $request, Closure $next): Response|JsonResponse|RedirectResponse
    {
        $user = (new User)->whereId(auth()->id())->first();
        if ( $user->admin !== null) {
            return $next($request);
        }

        return redirect()->route('index');
    }
}
