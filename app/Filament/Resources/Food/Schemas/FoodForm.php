<?php

namespace App\Filament\Resources\Food\Schemas;

use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class FoodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Food Name')
                            ->required()
                            ->maxLength(255),

                        Select::make('category')
                            ->label('Category')
                            ->options([
                                'grain' => 'Grain',
                                'vegetable' => 'Vegetable',
                                'fruit' => 'Fruit',
                                'meat' => 'Meat',
                                'fish' => 'Fish',
                                'egg' => 'Egg',
                                'dairy' => 'Dairy',
                                'legume' => 'Legume',
                                'nut' => 'Nut',
                                'oil' => 'Oil',
                                'beverage' => 'Beverage',
                                'snack' => 'Snack',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->required(),

                        TextInput::make('calories')
                            ->label('Calories (kcal)')
                            ->numeric()
                            ->required(),

                        TextInput::make('serving_size')
                            ->label('Serving Size')
                            ->default('100g')
                            ->required(),

                        TextInput::make('protein')
                            ->label('Protein (g)')
                            ->numeric()
                            ->default(0)
                            ->step(0.01)
                            ->required(),

                        TextInput::make('carbohydrate')
                            ->label('Carbohydrate (g)')
                            ->numeric()
                            ->default(0)
                            ->step(0.01)
                            ->required(),

                        TextInput::make('fat')
                            ->label('Fat (g)')
                            ->numeric()
                            ->default(0)
                            ->step(0.01)
                            ->required(),

                        TextInput::make('fiber')
                            ->label('Fiber (g)')
                            ->numeric()
                            ->default(0)
                            ->step(0.01)
                            ->required(),

                        TextInput::make('sugar')
                            ->label('Sugar (g)')
                            ->numeric()
                            ->default(0)
                            ->step(0.01)
                            ->required(),

                        Checkbox::make('is_admin_approved')
                            ->label('Admin Approved')
                            ->default(true),
                    ]),
            ]);
    }
}
