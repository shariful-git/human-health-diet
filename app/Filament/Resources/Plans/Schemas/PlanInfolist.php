<?php

namespace App\Filament\Resources\Plans\Schemas;

use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class PlanInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([

                        TextEntry::make('name')
                            ->label('Plan Name')
                            ->weight('bold'),

                        TextEntry::make('plan_type')
                            ->label('Plan Type')
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'default' => 'success',
                                'custom' => 'warning',
                                default => 'gray',
                            }),

                        TextEntry::make('duration_days')
                            ->label('Duration')
                            ->formatStateUsing(fn ($state) => "{$state} Days")
                            ->badge(),

                        TextEntry::make('is_active')
                            ->label('Status')
                            ->badge()
                            ->formatStateUsing(fn ($state) => $state ? 'Active' : 'Inactive')
                            ->color(fn ($state) => $state ? 'success' : 'danger'),

                        TextEntry::make('days_count')
                            ->label('Total Days')
                            ->counts('days')
                            ->badge(),

                        TextEntry::make('description')
                            ->label('Description')
                            ->markdown()
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('Created')
                            ->since(),

                        TextEntry::make('updated_at')
                            ->label('Last Updated')
                            ->since(),
                    ]),

                RepeatableEntry::make('days')
                    ->label('Daily Meal Plan')
                    ->schema([

                        TextEntry::make('day_number')
                            ->label('Day')
                            ->badge(),

                        RepeatableEntry::make('planFoods')
                            ->label('Meals')
                            ->schema([

                                TextEntry::make('meal_type')
                                    ->label('Meal')
                                    ->badge(),

                                TextEntry::make('food.name')
                                    ->label('Food'),

                                TextEntry::make('servings')
                                    ->label('Servings'),

                            ])
                            ->columns(3),

                    ])
                    ->contained(),
            ]);
    }
}
