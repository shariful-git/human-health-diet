<?php

namespace App\Filament\Resources\Food\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class FoodInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Owner')
                            ->badge(),

                        TextEntry::make('name')
                            ->label('Food Name'),

                        TextEntry::make('category')
                            ->badge()
                            ->label('Category'),

                        TextEntry::make('calories')
                            ->label('Calories')
                            ->suffix(' kcal'),

                        TextEntry::make('serving_size')
                            ->label('Serving Size'),

                        TextEntry::make('protein')
                            ->label('Protein')
                            ->suffix(' g'),

                        TextEntry::make('carbohydrate')
                            ->label('Carbohydrate')
                            ->suffix(' g'),

                        TextEntry::make('fat')
                            ->label('Fat')
                            ->suffix(' g'),

                        TextEntry::make('fiber')
                            ->label('Fiber')
                            ->suffix(' g'),

                        TextEntry::make('sugar')
                            ->label('Sugar')
                            ->suffix(' g'),

                        IconEntry::make('is_admin_approved')
                            ->label('Admin Approved')
                            ->boolean(),

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
