<?php

namespace Modules\Projects\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Modules\Projects\Models\Task;

class OverdueTasksTable extends BaseWidget
{
    protected static ?string $heading = 'Overdue Tasks';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Task::query()
                    ->where('due_date', '<', now())
                    ->whereNotIn('status', ['done', 'cancelled'])
                    ->orderBy('due_date')
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('project.name')
                    ->label('Project'),
                Tables\Columns\TextColumn::make('assignee.name')
                    ->label('Assignee'),
                Tables\Columns\BadgeColumn::make('priority')
                    ->colors([
                        'gray' => 'low',
                        'info' => 'medium',
                        'warning' => 'high',
                        'danger' => 'critical',
                    ]),
                Tables\Columns\TextColumn::make('due_date')
                    ->date()
                    ->color('danger'),
                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'gray' => 'backlog',
                        'info' => 'todo',
                        'primary' => 'in_progress',
                        'warning' => 'in_review',
                    ]),
            ]);
    }
}
