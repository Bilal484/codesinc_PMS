<?php

namespace Modules\Projects\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Modules\Projects\Models\Task;

class TasksByStatusChart extends ChartWidget
{
    protected static ?string $heading = 'Tasks by Status';

    protected static ?int $sort = 3;

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $statuses = ['backlog', 'todo', 'in_progress', 'in_review', 'done', 'cancelled'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[] = Task::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Tasks',
                    'data' => $counts,
                    'backgroundColor' => [
                        '#9ca3af',
                        '#6366f1',
                        '#3b82f6',
                        '#f59e0b',
                        '#10b981',
                        '#ef4444',
                    ],
                ],
            ],
            'labels' => ['Backlog', 'To Do', 'In Progress', 'In Review', 'Done', 'Cancelled'],
        ];
    }
}
