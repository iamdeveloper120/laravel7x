<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ResponseTrait;


class CheckRole
{
    use ResponseTrait;
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param array $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        $user = Auth::user();
        if($user and in_array($user->role, $roles)) {
            return $next($request);
        }
        $this->status = 401;
        $this->success = false;
        $this->message = "You're are not authorized to perform this operation";
        return $this->apiResponse();
    }
}
