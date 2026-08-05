<?php

namespace App\Http\Middleware;

use App\Models\AuditLog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Response;

class TrackPortalVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Safely check table existence before logging
        if (!Schema::hasTable('audit_logs')) {
            return $response;
        }

        // Only track GET requests
        if (!$request->isMethod('GET')) {
            return $response;
        }

        // Exclude livewire internal calls, static assets, and debounced polling
        $path = $request->path();
        if (
            $request->ajax() ||
            $request->prefetch() ||
            str_contains($path, 'livewire/') ||
            str_contains($path, '_debugbar') ||
            str_contains($path, 'up')
        ) {
            return $response;
        }

        $ipAddress = $request->ip();
        $fullUrl = substr($request->fullUrl(), 0, 1000);
        $user = Auth::user();
        $sessionId = session()->getId();

        // Throttle duplicate page visits from same session/IP on exact same URL within 5 minutes
        $recentVisitExists = AuditLog::where('event', 'page_visit')
            ->where('ip_address', $ipAddress)
            ->where('url', $fullUrl)
            ->where('created_at', '>=', now()->subMinutes(5))
            ->exists();

        if (!$recentVisitExists) {
            AuditLog::create([
                'event' => 'page_visit',
                'auditable_type' => null,
                'auditable_id' => null,
                'user_type' => $user ? get_class($user) : null,
                'user_id' => $user ? $user->getKey() : null,
                'old_values' => null,
                'new_values' => [
                    'path' => '/' . ltrim($path, '/'),
                    'route_name' => $request->route()?->getName(),
                    'session_id' => $sessionId,
                ],
                'url' => $fullUrl,
                'ip_address' => $ipAddress,
                'user_agent' => substr((string) $request->userAgent(), 0, 1000),
                'tags' => 'visit',
            ]);
        }

        return $response;
    }
}
