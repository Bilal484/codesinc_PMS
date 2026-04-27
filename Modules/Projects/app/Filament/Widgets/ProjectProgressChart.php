<?php

namespace Modules\Projects\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Modules\Projects\Models\Project;

class ProjectProgressChart extends ChartWidget
{
    protected static ?string $heading = 'Projects by Status';

    protected static ?int $sort = 2;

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getData(): array
    {
        $statuses = ['planning', 'in_progress', 'on_hold', 'completed', 'cancelled'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[] = Project::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'data' => $counts,
                    'backgroundColor' => [
                        '#9ca3af',
                        '#3b82f6',
                        '#f59e0b',
                        '#10b981',
                        '#ef4444',
                    ],
                ],
            ],
            'labels' => ['Planning', 'In Progress', 'On Hold', 'Completed', 'Cancelled'],
        ];
    }
}
