<?php

namespace App\Filament\Resources\Movies\Pages;

use App\Filament\Resources\Movies\MoviesResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMovies extends CreateRecord
{
    protected static string $resource = MoviesResource::class;
}
