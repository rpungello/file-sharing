<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsApproved
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->admin === false && empty($request->user()->approved_at)) {
            abort(403, 'Your account is pending approval by an administrator.');
        }

        return $next($request);
    }
}
