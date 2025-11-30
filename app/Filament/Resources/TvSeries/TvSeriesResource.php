<?php

namespace App\Filament\Resources\TvSeries;

use App\Filament\Resources\TvSeries\Pages\CreateTvSeries;
use App\Filament\Resources\TvSeries\Pages\EditTvSeries;
use App\Filament\Resources\TvSeries\Pages\ListTvSeries;
use App\Filament\Resources\TvSeries\Schemas\TvSeriesForm;
use App\Filament\Resources\TvSeries\Tables\TvSeriesTable;
use App\Models\TvSeries;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Notifications\Action;

class TvSeriesResource extends Resource
{
    protected static ?string $model = TvSeries::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-tv';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make()
            ->schema([
                TextInput::make('title')
                    ->required(),

                Textarea::make('description')
                    ->required()
                    ->maxLength(250),
                    
                DatePicker::make('release_date')
                    ->required(),

                
                    

                FileUpload::make('image')
                    ->image()
                    ->directory('tvseries-images'),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
                ImageColumn::make('image')->imageSize(150),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('description')->limit(25),

                TextColumn::make('release_date')
                    ->date()
                    ->sortable(),


                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
        ])
        ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(),
                ]),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTvSeries::route('/'),
            'create' => CreateTvSeries::route('/create'),
            'edit' => EditTvSeries::route('/{record}/edit'),
        ];
    }
}
