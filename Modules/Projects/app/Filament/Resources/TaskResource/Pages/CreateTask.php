<?php

namespace Modules\Projects\Filament\Resources\TaskResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Projects\Filament\Resources\TaskResource;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }
}
