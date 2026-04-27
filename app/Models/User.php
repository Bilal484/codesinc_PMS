<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, HasRoles, HasUuids, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return true;
    }

    public function projects(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\Modules\Projects\Models\Project::class, 'project_user')
            ->withPivot('role')
            ->withTimestamps();
    }

    public function ownedProjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\Modules\Projects\Models\Project::class, 'owner_id');
    }

    public function assignedTasks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\Modules\Projects\Models\Task::class, 'assigned_to');
    }

    public function timeEntries(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\Modules\Projects\Models\TimeEntry::class);
    }
}
