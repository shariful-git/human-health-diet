<?php

namespace App\Filament\Resources\Plans\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Plan Information')
                    ->schema([

                        TextInput::make('name')
                            ->label('Plan Name')
                            ->required()
                            ->maxLength(255),

                        Textarea::make('description')
                            ->rows(4),

                        TextInput::make('duration_days')
                            ->label('Duration (Days)')
                            ->numeric()
                            ->required(),

                        Select::make('plan_type')
                            ->options([
                                'default' => 'Default',
                                'custom' => 'Custom',
                            ])
                            ->default('default')
                            ->required(),

                        Checkbox::make('is_active')
                            ->default(true),

                    ])
                    ->columns(2),

                Section::make('Plan Days')
                    ->schema([

                        Repeater::make('days')
                            ->relationship()
                            ->label('Plan Days')
                            ->schema([

                                TextInput::make('day_number')
                                    ->numeric()
                                    ->required(),

                                Repeater::make('planFoods')
                                    ->relationship()
                                    ->label('Foods')
                                    ->schema([

                                        Select::make('food_id')
                                            ->relationship('food', 'name')
                                            ->searchable()
                                            ->preload()
                                            ->required(),

                                        Select::make('meal_type')
                                            ->options([
                                                'breakfast' => 'Breakfast',
                                                'lunch' => 'Lunch',
                                                'dinner' => 'Dinner',
                                                'snacks' => 'Snacks',
                                            ])
                                            ->required(),

                                        TextInput::make('servings')
                                            ->numeric()
                                            ->default(1),

                                    ])
                                    ->columns(3)
                                    ->collapsible()
                                    ->cloneable()
                                    ->reorderable(),

                            ])
                            ->itemLabel(fn(array $state): ?string => isset($state['day_number']) ? 'Day ' . $state['day_number'] : null)
                            ->collapsible()
                            ->cloneable()
                            ->reorderable(),

                    ])

            ]);
    }
}
