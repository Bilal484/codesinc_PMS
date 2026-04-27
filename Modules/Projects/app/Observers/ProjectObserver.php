<?php

namespace Modules\Projects\Observers;

use Modules\Projects\Models\Project;
use Modules\Projects\Notifications\ProjectCreatedNotification;

class ProjectObserver
{
    public function created(Project $project): void
    {
        if ($project->owner) {
            $project->owner->notify(new ProjectCreatedNotification($project));
        }
    }
}
