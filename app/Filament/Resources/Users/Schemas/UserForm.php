<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('User Information')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),

                    TextInput::make('email')
                        ->email()
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),

                    TextInput::make('password')
                        ->password()
                        ->required(fn (string $operation) => $operation === 'create')
                        ->dehydrated(fn (?string $state) => filled($state))
                        ->dehydrateStateUsing(
                            fn (?string $state) => filled($state)
                                ? Hash::make($state)
                                : null
                        ),

                    Toggle::make('is_admin')
                        ->label('Give Admin Access')
                        ->default(false)
                        ->helperText('Allow this user to access the admin panel.'),
                ])
                ->columns(2),
        ]);
    }
}