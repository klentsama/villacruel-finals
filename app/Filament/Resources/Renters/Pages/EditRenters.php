<?php

namespace App\Filament\Resources\Renters\Pages;

use App\Filament\Resources\Renters\RentersResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRenters extends EditRecord
{
    protected static string $resource = RentersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
