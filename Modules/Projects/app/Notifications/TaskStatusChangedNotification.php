<?php

namespace Modules\Projects\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Projects\Models\Task;

class TaskStatusChangedNotification extends Notification implements ShouldQueue
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
            ->subject("Task Status Updated: {$this->task->title}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("The status of task **{$this->task->title}** has been updated to **" . ucfirst(str_replace('_', ' ', $this->task->status)) . "**.")
            ->line("Project: {$this->task->project->name}")
            ->action('View Task', url("/admin/tasks/{$this->task->id}/edit"))
            ->line('Thank you for using our project management system!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => "Task Status Updated: {$this->task->title}",
            'body' => "Task '{$this->task->title}' status changed to '" . ucfirst(str_replace('_', ' ', $this->task->status)) . "'.",
            'task_id' => $this->task->id,
            'project_id' => $this->task->project_id,
            'new_status' => $this->task->status,
        ];
    }
}
