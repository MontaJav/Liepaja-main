<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AdminMiddleware
{
    public function handle($request, Closure $next, $redirectToRoute = null) {
        if (! $request->user() || ($request->user() instanceof User && ! $request->user()->is_admin)) {
            return $request->expectsJson()
                ? abort(403, 'Pieeja liegta.')
                : Redirect::guest(URL::route($redirectToRoute ?: '/'));
        }

        return $next($request);
    }
}
