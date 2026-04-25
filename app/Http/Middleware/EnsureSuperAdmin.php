<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureSuperAdmin
{
    public function handle(Request $request, Closure $next)
    {
        $adminId = session('_admin_id');
        $user    = $adminId
            ? \App\Models\User::find($adminId)
            : $request->user();

        if (! $user || ! $user->is_superadmin) {
            abort(403);
        }

        return $next($request);
    }
}
