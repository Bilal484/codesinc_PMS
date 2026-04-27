<?php

namespace Modules\Projects\Filament\Resources\TaskResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Projects\Filament\Resources\TaskResource;

class ListTasks extends ListRecords
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('kanban')
                ->label('Kanban Board')
                ->icon('heroicon-o-view-columns')
                ->url(TaskResource::getUrl('kanban'))
                ->color('info'),
        ];
    }
}
