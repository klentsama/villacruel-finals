<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MoviesResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMovies extends EditRecord
{
    protected static string $resource = MoviesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
