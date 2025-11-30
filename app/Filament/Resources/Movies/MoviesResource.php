<?php

namespace App\Filament\Resources\Movies;

use App\Filament\Resources\Movies\Pages\CreateMovies;
use App\Filament\Resources\Movies\Pages\EditMovies;
use App\Filament\Resources\Movies\Pages\ListMovies;
use App\Filament\Resources\Movies\Schemas\MoviesForm;
use App\Filament\Resources\Movies\Tables\MoviesTable;
use App\Models\Movies;
use BackedEnum;
use Dom\Text;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MoviesResource extends Resource
{
    protected static ?string $model = Movies::class;
    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-film';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->required()
                            ->maxLength(250),

                        DatePicker::make('release_date')
                            ->required(),

                         FileUpload::make('images')
                            ->image()
                            ->directory('movies-images'),
                    ]),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        
        ->columns([
            ImageColumn::make('images')->imageSize(150),
            TextColumn::make('title')->sortable()->searchable(),
            TextColumn::make('description')->limit(25),
            TextColumn::make('release_date')->sortable(),
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
            'index' => ListMovies::route('/'),
            'create' => CreateMovies::route('/create'),
            'edit' => EditMovies::route('/{record}/edit'),
        ];
    }
}
