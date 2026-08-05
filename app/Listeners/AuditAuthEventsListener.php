<?php

namespace App\Listeners;

use App\Models\AuditLog;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;

class AuditAuthEventsListener
{
    /**
     * Handle authentication events.
     */
    public function handle(object $event): void
    {
        $eventName = null;
        $user = null;
        $details = [];

        if ($event instanceof Login) {
            $eventName = 'login';
            $user = $event->user;
            $details = [
                'guard' => $event->guard,
                'email' => $user->email ?? null,
            ];
        } elseif ($event instanceof Logout) {
            $eventName = 'logout';
            $user = $event->user;
            $details = [
                'guard' => $event->guard,
                'email' => $user->email ?? null,
            ];
        } elseif ($event instanceof Failed) {
            $eventName = 'failed_login';
            $user = $event->user;
            $details = [
                'guard' => $event->guard,
                'attempted_email' => $event->credentials['email'] ?? null,
            ];
        } elseif ($event instanceof PasswordReset) {
            $eventName = 'password_reset';
            $user = $event->user;
            $details = [
                'email' => $user->email ?? null,
            ];
        }

        if (!$eventName) {
            return;
        }

        $ipAddress = Request::ip();
        $userAgent = Request::userAgent();
        $url = App::runningInConsole() ? 'CLI' : Request::fullUrl();

        AuditLog::create([
            'event' => $eventName,
            'auditable_type' => $user ? get_class($user) : null,
            'auditable_id' => $user ? $user->getKey() : null,
            'user_type' => $user ? get_class($user) : null,
            'user_id' => $user ? $user->getKey() : null,
            'old_values' => null,
            'new_values' => $details,
            'url' => substr($url, 0, 1000),
            'ip_address' => $ipAddress,
            'user_agent' => substr((string) $userAgent, 0, 1000),
            'tags' => 'auth',
        ]);
    }
}
