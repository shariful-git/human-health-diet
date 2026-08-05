<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable
{
    /**
     * Flag to temporarily bypass auditing if needed.
     */
    public static bool $isAuditingDisabled = false;

    /**
     * Boot trait and register model event listeners.
     */
    public static function bootAuditable(): void
    {
        static::created(function (Model $model) {
            if (static::$isAuditingDisabled) {
                return;
            }
            $model->recordAudit('created', null, $model->getAuditNewValues('created'));
        });

        static::updated(function (Model $model) {
            if (static::$isAuditingDisabled) {
                return;
            }

            [$oldValues, $newValues] = $model->getAuditUpdatedValues();
            if (!empty($oldValues) || !empty($newValues)) {
                $model->recordAudit('updated', $oldValues, $newValues);
            }
        });

        static::deleted(function (Model $model) {
            if (static::$isAuditingDisabled) {
                return;
            }
            $model->recordAudit('deleted', $model->getAuditOldValues('deleted'), null);
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function (Model $model) {
                if (static::$isAuditingDisabled) {
                    return;
                }
                $model->recordAudit('restored', null, $model->getAuditNewValues('restored'));
            });
        }
    }

    /**
     * Polymorphic relationship to AuditLog.
     */
    public function auditLogs(): MorphMany
    {
        return $this->morphMany(AuditLog::class, 'auditable')->latest();
    }

    /**
     * Record an audit log entry for this model.
     */
    public function recordAudit(string $event, ?array $oldValues = null, ?array $newValues = null, ?string $tags = 'model'): ?AuditLog
    {
        $user = Auth::user();

        $ipAddress = Request::ip();
        $userAgent = Request::userAgent();
        $url = App::runningInConsole() ? 'CLI: ' . implode(' ', $_SERVER['argv'] ?? []) : Request::fullUrl();

        return AuditLog::create([
            'event' => $event,
            'auditable_type' => get_class($this),
            'auditable_id' => $this->getKey(),
            'user_type' => $user ? get_class($user) : null,
            'user_id' => $user ? $user->getKey() : null,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'url' => substr($url, 0, 1000),
            'ip_address' => $ipAddress,
            'user_agent' => substr((string) $userAgent, 0, 1000),
            'tags' => $tags,
        ]);
    }

    /**
     * Get attributes to exclude from audit logging.
     */
    public function getAuditExcludedAttributes(): array
    {
        $defaultExcluded = [
            'password',
            'remember_token',
            'two_factor_secret',
            'two_factor_recovery_codes',
            'api_token',
            'created_at',
            'updated_at',
            'deleted_at',
        ];

        $modelExcluded = property_exists($this, 'auditExclude') ? (array) $this->auditExclude : [];

        return array_unique(array_merge($defaultExcluded, $modelExcluded));
    }

    /**
     * Filter and sanitize model attributes for audit log.
     */
    protected function sanitizeAuditAttributes(array $attributes): array
    {
        $excluded = $this->getAuditExcludedAttributes();
        return Arr::except($attributes, $excluded);
    }

    /**
     * Get sanitized old values for deleted or updated event.
     */
    protected function getAuditOldValues(string $event): array
    {
        return $this->sanitizeAuditAttributes($this->getAttributes());
    }

    /**
     * Get sanitized new values for created or updated event.
     */
    protected function getAuditNewValues(string $event): array
    {
        return $this->sanitizeAuditAttributes($this->getAttributes());
    }

    /**
     * Calculate old and new values specifically for 'updated' event.
     */
    protected function getAuditUpdatedValues(): array
    {
        $dirty = $this->getDirty();
        $changes = $this->sanitizeAuditAttributes($dirty);

        $oldValues = [];
        $newValues = [];

        foreach ($changes as $key => $newValue) {
            $oldValue = $this->getOriginal($key);

            // Ignore if values match logically
            if ($oldValue === $newValue) {
                continue;
            }

            $oldValues[$key] = $oldValue;
            $newValues[$key] = $newValue;
        }

        return [$oldValues, $newValues];
    }

    /**
     * Execute callback without recording audit logs.
     */
    public static function withoutAuditing(callable $callback)
    {
        static::$isAuditingDisabled = true;
        try {
            return $callback();
        } finally {
            static::$isAuditingDisabled = false;
        }
    }
}
