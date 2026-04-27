<?php

namespace Modules\Projects\Filament\Resources\MilestoneResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Modules\Projects\Filament\Resources\MilestoneResource;

class ListMilestones extends ListRecords
{
    protected static string $resource = MilestoneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
