<?php

namespace App\Filament\Resources\Renters;

use App\Filament\Resources\Renters\Pages\CreateRenters;
use App\Filament\Resources\Renters\Pages\EditRenters;
use App\Filament\Resources\Renters\Pages\ListRenters;
use App\Filament\Resources\Renters\Schemas\RentersForm;
use App\Filament\Resources\Renters\Tables\RentersTable;
use App\Models\Renters;
use BackedEnum;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Number;

class RentersResource extends Resource
{
    protected static ?string $model = Renters::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            Group::make()->schema([
                Section::make('Renter Information')->schema([
                    Select::make('user_id')
                        ->label('Renter')
                        ->relationship('user', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),

                    Select::make('status')
                        ->options([
                            'new' => 'New',
                            'rented' => 'Rented',
                            'returned' => 'Returned',
                            'overdue' => 'Overdue',
                        ])
                        ->default('new')
                        ->required(),

                    Select::make('payment_method')
                        ->options([
                            'credit_card' => 'Credit Card',
                            'paypal' => 'PayPal',
                            'bank_transfer' => 'Bank Transfer',
                            'cash' => 'Cash',
                            'stripe' => 'Stripe',
                        ])
                        ->required(),

                    Select::make('payment_status')
                        ->options([
                            'pending' => 'Pending',
                            'completed' => 'Completed',
                            'failed' => 'Failed',
                        ])
                        ->default('pending')
                        ->required(),

                    Select::make('currency')
                                    ->options([
                                        'INR' => 'INR',
                                        'USD' => 'USD',
                                        'EUR' => 'EUR',
                                        'GBP' => 'GBP',
                                    ])
                                    ->default('USD')
                                    ->required(),

                    Textarea::make('notes')
                            ->columnSpanFull()
                ])->columns(2),

                Section::make('Rent Items')->schema([
                    Repeater::make('item')
                    ->label('Rent a movie/tv')
                    ->relationship()
                    ->schema([
                        Select::make('movie_id')
                        ->label('Pick Item')
                        ->relationship('item', 'name')
                        ->searchable()
                        ->preload(),
                    ])
                
            ])->columnSpanFull(),
            
        ])
        ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            TextColumn::make('user.name')
                ->label('Customer')
                ->searchable()
                ->sortable(),

            TextColumn::make('grand_total')
                ->numeric()
                ->sortable()
                ->money('USD'),

            TextColumn::make('payment_method')
                ->searchable()
                ->sortable(), 
            
            TextColumn::make('payment_status')
                 ->searchable()
                 ->sortable(),

            TextColumn::make('currency')
                 ->searchable()
                 ->sortable(),

            SelectColumn::make('status')
                ->options([
                    'new' => 'New',
                    'rented' => 'Rented',
                    'returned' => 'Returned',
                    'overdue' => 'Overdue',
                ])
                ->searchable()
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
            ->actions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),       
                ])
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
            'index' => ListRenters::route('/'),
            'create' => CreateRenters::route('/create'),
            'edit' => EditRenters::route('/{record}/edit'),
        ];
    }
}
