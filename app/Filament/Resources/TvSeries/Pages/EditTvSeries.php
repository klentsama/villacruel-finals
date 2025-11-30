<?php

namespace App\Filament\Resources\TvSeries\Pages;

use App\Filament\Resources\TvSeries\TvSeriesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTvSeries extends EditRecord
{
    protected static string $resource = TvSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
