<?php

namespace App\Filament\Resources\Exercises\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ExerciseInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Exercise Name'),

                        TextEntry::make('difficulty')
                            ->label('Difficulty')
                            ->badge()
                            ->color(fn (string $state) => match ($state) {
                                'easy' => 'success',
                                'medium' => 'warning',
                                'hard' => 'danger',
                                default => 'gray',
                            }),

                        TextEntry::make('calories_burn_per_minute')
                            ->label('Calories Burned')
                            ->suffix(' kcal/min'),

                        TextEntry::make('instruction')
                            ->label('Instructions')
                            ->placeholder('No instructions provided.')
                            ->columnSpanFull(),

                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime(),

                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime(),
                    ]),
            ]);
    }
}