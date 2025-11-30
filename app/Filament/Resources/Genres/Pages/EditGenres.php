<?php

namespace App\Filament\Resources\Genres\Pages;

use App\Filament\Resources\Genres\GenresResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGenres extends EditRecord
{
    protected static string $resource = GenresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
