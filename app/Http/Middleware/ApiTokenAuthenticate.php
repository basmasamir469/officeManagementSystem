<?php

namespace App\Http\Middleware;

use App\Models\Employee;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTokenAuthenticate
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (! $token) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $employee = Employee::where('api_token', $token)->first();

        if (! $employee) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        Auth::setUser($employee);
        $request->setUserResolver(fn () => $employee);

        return $next($request);
    }
}
