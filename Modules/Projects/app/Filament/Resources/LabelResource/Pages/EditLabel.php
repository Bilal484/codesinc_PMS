<?php

namespace Modules\Projects\Filament\Resources\LabelResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Projects\Filament\Resources\LabelResource;

class EditLabel extends EditRecord
{
    protected static string $resource = LabelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
