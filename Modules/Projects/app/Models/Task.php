<?php

namespace Modules\Projects\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Task extends Model implements HasMedia
{
    use HasUuids, InteractsWithMedia, LogsActivity, SoftDeletes;

    protected $fillable = [
        'project_id',
        'milestone_id',
        'assigned_to',
        'created_by',
        'title',
        'description',
        'status',
        'priority',
        'start_date',
        'due_date',
        'estimated_hours',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'due_date' => 'date',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable()
            ->logOnlyDirty()
            ->setDescriptionForEvent(fn (string $eventName) => "Task {$eventName}");
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(Milestone::class);
    }

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function timeEntries(): HasMany
    {
        return $this->hasMany(TimeEntry::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class);
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class, 'label_task');
    }

    public function getTotalTimeAttribute(): int
    {
        return $this->timeEntries()->sum('duration_minutes') ?? 0;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('attachments');
    }
}
