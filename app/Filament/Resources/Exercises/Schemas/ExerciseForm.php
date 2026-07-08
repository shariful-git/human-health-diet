<?php

namespace App\Filament\Resources\Exercises\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ExerciseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Exercise Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('calories_burn_per_minute')
                            ->label('Calories Burned per Minute')
                            ->numeric()
                            ->minValue(0)
                            ->required(),

                        Select::make('difficulty')
                            ->label('Difficulty')
                            ->options([
                                'easy' => 'Easy',
                                'medium' => 'Medium',
                                'hard' => 'Hard',
                            ])
                            ->default('medium')
                            ->required(),
                    ]),

                Textarea::make('instruction')
                    ->label('Instructions')
                    ->rows(5)
                    ->placeholder('Describe how to perform the exercise...')
                    ->columnSpanFull(),
            ]);
    }
}
