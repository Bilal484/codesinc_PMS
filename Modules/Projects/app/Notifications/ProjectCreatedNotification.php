<?php

namespace Modules\Projects\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Modules\Projects\Models\Project;

class ProjectCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Project $project
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject("New Project Created: {$this->project->name}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("A new project **{$this->project->name}** has been created and you have been assigned as the owner.")
            ->line("Status: " . ucfirst($this->project->status))
            ->action('View Project', url("/admin/projects/{$this->project->id}/edit"))
            ->line('Thank you for using our project management system!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => "New Project: {$this->project->name}",
            'body' => "Project '{$this->project->name}' has been created.",
            'project_id' => $this->project->id,
        ];
    }
}
