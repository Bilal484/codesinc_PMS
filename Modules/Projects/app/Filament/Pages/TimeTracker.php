<?php

namespace Modules\Projects\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Modules\Projects\Models\Task;
use Modules\Projects\Models\TimeEntry;

class TimeTracker extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-play';

    protected static ?string $navigationGroup = 'Project Management';

    protected static ?int $navigationSort = 4;

    protected static ?string $title = 'Time Tracker';

    protected static string $view = 'projects::filament.pages.time-tracker';

    public ?string $selectedTask = null;

    public ?string $notes = '';

    public function getRunningEntry(): ?TimeEntry
    {
        return TimeEntry::where('user_id', auth()->id())
            ->where('is_running', true)
            ->with('task.project')
            ->first();
    }

    public function startTimer(): void
    {
        if (! $this->selectedTask) {
            Notification::make()
                ->title('Please select a task first')
                ->warning()
                ->send();

            return;
        }

        $existing = TimeEntry::where('user_id', auth()->id())
            ->where('is_running', true)
            ->first();

        if ($existing) {
            $existing->stop();
        }

        TimeEntry::create([
            'task_id' => $this->selectedTask,
            'user_id' => auth()->id(),
            'started_at' => now(),
            'is_running' => true,
            'notes' => $this->notes,
        ]);

        $this->notes = '';

        Notification::make()
            ->title('Timer started')
            ->success()
            ->send();
    }

    public function stopTimer(): void
    {
        $entry = $this->getRunningEntry();

        if ($entry) {
            $entry->stop();

            Notification::make()
                ->title('Timer stopped')
                ->body("Logged {$entry->duration_minutes} minutes")
                ->success()
                ->send();
        }
    }

    public function getRecentEntries(): \Illuminate\Database\Eloquent\Collection
    {
        return TimeEntry::where('user_id', auth()->id())
            ->where('is_running', false)
            ->with('task.project')
            ->orderByDesc('stopped_at')
            ->limit(10)
            ->get();
    }

    public function getTasks(): \Illuminate\Database\Eloquent\Collection
    {
        return Task::whereNotIn('status', ['done', 'cancelled'])
            ->orderBy('title')
            ->get();
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\Select::make('selectedTask')
                ->label('Task')
                ->options(
                    Task::whereNotIn('status', ['done', 'cancelled'])
                        ->with('project')
                        ->get()
                        ->mapWithKeys(fn (Task $task) => [$task->id => "{$task->project?->name} - {$task->title}"])
                )
                ->searchable()
                ->required(),
            Forms\Components\Textarea::make('notes')
                ->label('Notes')
                ->rows(2),
        ];
    }
}
