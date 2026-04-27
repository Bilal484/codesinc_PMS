<?php

namespace Modules\Projects\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Modules\Projects\Models\Project;
use Modules\Projects\Models\Task;
use Modules\Projects\Models\TimeEntry;

class ProjectStatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalProjects = Project::count();
        $activeProjects = Project::where('status', 'in_progress')->count();
        $totalTasks = Task::count();
        $completedTasks = Task::where('status', 'done')->count();
        $overdueTasks = Task::where('due_date', '<', now())
            ->whereNotIn('status', ['done', 'cancelled'])
            ->count();
        $totalHours = round(TimeEntry::sum('duration_minutes') / 60, 1);

        return [
            Stat::make('Total Projects', $totalProjects)
                ->description("{$activeProjects} active")
                ->descriptionIcon('heroicon-o-briefcase')
                ->color('primary'),
            Stat::make('Total Tasks', $totalTasks)
                ->description("{$completedTasks} completed")
                ->descriptionIcon('heroicon-o-clipboard-document-check')
                ->color('success'),
            Stat::make('Overdue Tasks', $overdueTasks)
                ->description('Need attention')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($overdueTasks > 0 ? 'danger' : 'success'),
            Stat::make('Hours Logged', $totalHours)
                ->description('Total hours tracked')
                ->descriptionIcon('heroicon-o-clock')
                ->color('info'),
        ];
    }
}
