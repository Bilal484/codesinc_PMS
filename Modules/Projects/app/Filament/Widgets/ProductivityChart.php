<?php

namespace Modules\Projects\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;
use Modules\Projects\Models\Task;

class ProductivityChart extends ChartWidget
{
    protected static ?string $heading = 'Tasks Completed (Last 30 Days)';

    protected static ?int $sort = 5;

    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        $days = collect(range(29, 0))->map(fn ($i) => Carbon::now()->subDays($i)->format('Y-m-d'));

        $completedByDay = Task::where('status', 'done')
            ->where('updated_at', '>=', now()->subDays(30))
            ->get()
            ->groupBy(fn ($task) => $task->updated_at->format('Y-m-d'))
            ->map->count();

        $data = $days->map(fn ($day) => $completedByDay->get($day, 0))->toArray();
        $labels = $days->map(fn ($day) => Carbon::parse($day)->format('M d'))->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Tasks Completed',
                    'data' => $data,
                    'borderColor' => '#10b981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                    'fill' => true,
                    'tension' => 0.3,
                ],
            ],
            'labels' => $labels,
        ];
    }
}
