<?php

namespace App\Filament\Resources\TvSeries\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class TvSeriesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                    //
            ]);
    }
}
