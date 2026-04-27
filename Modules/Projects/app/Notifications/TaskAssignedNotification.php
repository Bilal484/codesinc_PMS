<?php

namespace Modules\Projects\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Projects\Models\Task;

class TaskAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Task $task
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("Task Assigned: {$this->task->title}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("You have been assigned to a new task: **{$this->task->title}**")
            ->line("Project: {$this->task->project->name}")
            ->line("Priority: " . ucfirst($this->task->priority))
            ->action('View Task', url("/admin/tasks/{$this->task->id}/edit"))
            ->line('Thank you for using our project management system!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => "Task Assigned: {$this->task->title}",
            'body' => "You have been assigned to task '{$this->task->title}' in project '{$this->task->project->name}'.",
            'task_id' => $this->task->id,
            'project_id' => $this->task->project_id,
        ];
    }
}
