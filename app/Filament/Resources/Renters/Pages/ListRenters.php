<?php

namespace App\Filament\Resources\Renters\Pages;

use App\Filament\Resources\Renters\RentersResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRenters extends ListRecords
{
    protected static string $resource = RentersResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
