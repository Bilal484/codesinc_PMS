<?php

namespace Modules\Projects\Observers;

use Modules\Projects\Models\Task;
use Modules\Projects\Notifications\TaskAssignedNotification;
use Modules\Projects\Notifications\TaskStatusChangedNotification;

class TaskObserver
{
    public function created(Task $task): void
    {
        if ($task->assigned_to && $task->assignee) {
            $task->assignee->notify(new TaskAssignedNotification($task));
        }
    }

    public function updated(Task $task): void
    {
        if ($task->isDirty('assigned_to') && $task->assigned_to && $task->assignee) {
            $task->assignee->notify(new TaskAssignedNotification($task));
        }

        if ($task->isDirty('status') && $task->assigned_to && $task->assignee) {
            $task->assignee->notify(new TaskStatusChangedNotification($task));
        }
    }
}
