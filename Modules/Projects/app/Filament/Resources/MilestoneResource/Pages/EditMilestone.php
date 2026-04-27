<?php

namespace Modules\Projects\Filament\Resources\MilestoneResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Modules\Projects\Filament\Resources\MilestoneResource;

class EditMilestone extends EditRecord
{
    protected static string $resource = MilestoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
