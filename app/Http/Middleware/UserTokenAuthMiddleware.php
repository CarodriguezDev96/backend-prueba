<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Facades\App\Models\{
    User
};

class UserTokenAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');
        $userId = $request->user_id;
        
        $user = User::validateTokenUser($token, $userId);
        if ($user) {
            return $next($request);
        }

        return response()->json(
            [
                "status" => false,
                "message" => "Unauthorized  user",
                "data" => []
            ],
            401
        );

    }
}
