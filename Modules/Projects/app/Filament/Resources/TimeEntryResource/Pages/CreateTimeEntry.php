<?php

namespace Modules\Projects\Filament\Resources\TimeEntryResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Modules\Projects\Filament\Resources\TimeEntryResource;

class CreateTimeEntry extends CreateRecord
{
    protected static string $resource = TimeEntryResource::class;
}
