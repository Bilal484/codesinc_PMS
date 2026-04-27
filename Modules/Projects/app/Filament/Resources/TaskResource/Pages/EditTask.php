<?php

namespace Modules\Projects\Filament\Resources\TaskResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Projects\Filament\Resources\TaskResource;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
