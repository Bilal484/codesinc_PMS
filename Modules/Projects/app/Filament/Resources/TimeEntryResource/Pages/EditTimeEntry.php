<?php

namespace Modules\Projects\Filament\Resources\TimeEntryResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Projects\Filament\Resources\TimeEntryResource;

class EditTimeEntry extends EditRecord
{
    protected static string $resource = TimeEntryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
