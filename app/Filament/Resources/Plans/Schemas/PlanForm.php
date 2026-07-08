<?php

namespace App\Filament\Resources\Plans\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Plan Name')
                    ->placeholder('e.g., 30 Days Weight Loss Plan')
                    ->required(),

                Textarea::make('description')
                    ->label('Plan Description')
                    ->placeholder('Provide a brief description of the plan...')
                    ->rows(4),

                TextInput::make('duration_days')
                    ->label('Duration (Days)')
                    ->placeholder('e.g., 30')
                    ->numeric()
                    ->required(),

                Select::make('plan_type')
                    ->label('Plan Type')
                    ->options([
                        'default' => 'Default (Admin)',
                        'custom' => 'Custom (User)',
                    ])
                    ->required(),

                Checkbox::make('is_active')
                    ->label('Is Active')
                    ->default(true),
            ]);
    }
}
