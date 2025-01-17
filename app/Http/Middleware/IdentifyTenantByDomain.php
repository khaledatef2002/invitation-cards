<?php

namespace App\Http\Middleware;

use App\Models\Tenant;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IdentifyTenantByDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $domain = $request->getHost(); // Get the full domain from the request
        $tenant = Tenant::where('domain', $domain)->first();

        if (!$tenant) {
            abort(404, 'Tenant not found.');
        }

        // Store tenant in the application container
        app()->instance('tenant', $tenant);

        return $next($request);
    }
}
