<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class AuditLog extends Model
{
    use HasFactory;

    protected $table = 'audit_logs';

    protected $fillable = [
        'event',
        'auditable_type',
        'auditable_id',
        'user_type',
        'user_id',
        'old_values',
        'new_values',
        'url',
        'ip_address',
        'user_agent',
        'tags',
    ];

    protected function casts(): array
    {
        return [
            'old_values' => 'array',
            'new_values' => 'array',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Polymorphic relationship to audited model.
     */
    public function auditable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Polymorphic relationship to causer (User or System).
     */
    public function user(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get a user-friendly label for the causer.
     */
    public function getUserNameAttribute(): string
    {
        if ($this->user) {
            return $this->user->name ?? $this->user->email ?? class_basename($this->user_type) . ' #' . $this->user_id;
        }

        return 'System / Guest';
    }

    /**
     * Get human readable subject description.
     */
    public function getSubjectLabelAttribute(): string
    {
        if (!$this->auditable_type) {
            return 'N/A';
        }

        $className = class_basename($this->auditable_type);

        if ($this->auditable && isset($this->auditable->name)) {
            return "{$className}: {$this->auditable->name}";
        }

        if ($this->auditable && isset($this->auditable->title)) {
            return "{$className}: {$this->auditable->title}";
        }

        return "{$className} #{$this->auditable_id}";
    }

    /**
     * Get calculate field diffs between old and new values.
     */
    public function getDiffAttribute(): array
    {
        $old = $this->old_values ?? [];
        $new = $this->new_values ?? [];

        $diff = [];
        $keys = array_unique(array_merge(array_keys($old), array_keys($new)));

        foreach ($keys as $key) {
            $oldVal = $old[$key] ?? null;
            $newVal = $new[$key] ?? null;

            if ($oldVal !== $newVal) {
                $diff[$key] = [
                    'old' => $oldVal,
                    'new' => $newVal,
                ];
            }
        }

        return $diff;
    }
}
