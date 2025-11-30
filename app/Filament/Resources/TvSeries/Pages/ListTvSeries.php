<?php

namespace App\Filament\Resources\TvSeries\Pages;

use App\Filament\Resources\TvSeries\TvSeriesResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTvSeries extends ListRecords
{
    protected static string $resource = TvSeriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
