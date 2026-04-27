<?php

namespace Modules\Projects\Filament\Resources\TaskResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\Page;
use Illuminate\Contracts\View\View;
use Modules\Projects\Filament\Resources\TaskResource;
use Modules\Projects\Models\Task;

class KanbanTasks extends Page
{
    protected static string $resource = TaskResource::class;

    protected static string $view = 'projects::filament.pages.kanban-tasks';

    protected static ?string $title = 'Kanban Board';

    public array $statuses = [
        'backlog' => 'Backlog',
        'todo' => 'To Do',
        'in_progress' => 'In Progress',
        'in_review' => 'In Review',
        'done' => 'Done',
    ];

    public ?string $projectFilter = null;

    public function getTasksByStatus(string $status): \Illuminate\Database\Eloquent\Collection
    {
        $query = Task::where('status', $status)
            ->with(['assignee', 'project', 'labels'])
            ->orderBy('sort_order');

        if ($this->projectFilter) {
            $query->where('project_id', $this->projectFilter);
        }

        return $query->get();
    }

    public function updateTaskStatus(string $taskId, string $newStatus, int $newOrder): void
    {
        $task = Task::findOrFail($taskId);
        $task->update([
            'status' => $newStatus,
            'sort_order' => $newOrder,
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('list')
                ->label('List View')
                ->icon('heroicon-o-list-bullet')
                ->url(TaskResource::getUrl('index'))
                ->color('gray'),
            Actions\Action::make('create')
                ->label('New Task')
                ->icon('heroicon-o-plus')
                ->url(TaskResource::getUrl('create')),
        ];
    }
}
