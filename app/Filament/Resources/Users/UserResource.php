<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;
use App\Models\User;
use BackedEnum;
use DateTime;
use Dom\Text;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Page;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Pest\Support\View;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?int $navigationSort = 5;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-user-group';

    public static function form(Schema $schema): Schema
    {
        return $schema->schema([
            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('email')
                ->label('Email Address')
                ->required()
                ->email()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            DateTimePicker::make('email_verified_at')
                ->label('Email Verified At')
                ->default(now()),

            TextInput::make('password')
                ->password()
                ->dehydrated(fn($state) => filled($state))
                ->required(fn(Page $livewire): bool => $livewire instanceof CreateUser)
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                    TextColumn::make('name')
                        ->searchable(),
                    TextColumn::make('email')
                        ->label('Email Address')
                        ->searchable(),
                        
                    TextColumn::make('email_verified_at')
                        ->label('Email Verified At')
                        ->dateTime('M d, Y H:i A')
                        ->sortable(),

                    TextColumn::make('created_at')
                        ->label('Created At')
                        ->dateTime('M d, Y H:i A')
                        ->sortable(),
            ])
            ->filters([

            ])
            ->actions([ 
                ActionGroup::make([ 
                    EditAction::make(),
                    ViewAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([ 
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }
}
