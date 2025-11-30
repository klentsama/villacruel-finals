<?php

namespace App\Filament\Resources\Rents;

use App\Filament\Resources\Rents\Pages\CreateRent;
use App\Filament\Resources\Rents\Pages\EditRent;
use App\Filament\Resources\Rents\Pages\ListRents;
use App\Filament\Resources\Rents\Schemas\RentForm;
use App\Filament\Resources\Rents\Tables\RentsTable;
use App\Models\Rent;
use BackedEnum;
use DateTime;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInputDate;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;


class RentResource extends Resource
{
    protected static ?string $modelLabel = 'Rentables';

    protected static ?int $navigationSort = 4;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Group::make()->schema([
                Section::make('Item Details')->schema([

                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    

                    MarkdownEditor::make('description')
                            ->columnSpanFull()
                            ->fileAttachmentsDirectory('rentables')
                ])->columns(2),

            Section::make('Images')->schema([ 
                            FileUpload::make('images')
                            ->multiple()
                            ->directory('images')
                            ->maxFiles(5)
                    ])
            ])->columnSpan(2),

            Group::make()->schema([
                        Section::make('Price')->schema([
                            TextInput::make('price')
                                ->required()
                                ->numeric()
                                ->prefix('USD')
                    ]),

                    Section::make('Select Genre')->schema([
                        Select::make('genres')
                            ->multiple()
                            ->relationship('genres', 'name')
                            ->preload()
                            ->searchable(),

                         Select::make('type')
                                ->required()
                                ->options([
                                    'movie' => 'Movie',
                                    'tv_series' => 'TV Series',
                                ]),
    
                    ]),

            Section::make('Status')->schema([
                            Toggle::make('in_stock')
                                ->required()
                                ->default(true),

                            Toggle::make('is_popular')
                                ->required()
                                ->default(true),
                            
                            Toggle::make('is_active')
                                ->required()
                                ->default(true),
                            
                            Toggle::make('on_sale')
                                ->required(),
                        ]),
                    ])->columnSpan(1),
            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                ImageColumn::make('images')->imageSize(150),

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('genres.name')
                    ->sortable(),

                TextColumn::make('type')
                    ->sortable(),

                TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('description')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
                
                IconColumn::make('on_sale')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault:true),
                
                IconColumn::make('in_stock')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault:true),
                
                IconColumn::make('is_popular')
                    ->boolean()
                    ->toggleable(isToggledHiddenByDefault:true),


                TextColumn::make('status')
                    ->sortable(),
                    
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),
                
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault:true),

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
            'index' => ListRents::route('/'),
            'create' => CreateRent::route('/create'),
            'edit' => EditRent::route('/{record}/edit'),
        ];
    }
}
