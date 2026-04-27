<?php

namespace Modules\Projects\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Milestone extends Model
{
    use HasUuids, LogsActivity, SoftDeletes;

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'due_date',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Milestone {$eventName}");
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function getProgressAttribute(): float
    {
        $total = $this->tasks()->count();
        if ($total === 0) {
            return 0;
        }
        $done = $this->tasks()->where('status', 'done')->count();

        return round(($done / $total) * 100, 1);
    }
}
