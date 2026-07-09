<?php

namespace App\Filament\Resources\Food\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class FoodTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Food Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('calories')
                    ->label('Calories')
                    ->suffix(' kcal')
                    ->sortable(),

                TextColumn::make('protein')
                    ->label('Protein')
                    ->suffix(' g')
                    ->sortable(),

                TextColumn::make('carbohydrate')
                    ->label('Carbs')
                    ->suffix(' g')
                    ->sortable(),

                TextColumn::make('fat')
                    ->label('Fat')
                    ->suffix(' g')
                    ->sortable(),

                TextColumn::make('serving_size')
                    ->label('Serving')
                    ->sortable(),

                IconColumn::make('is_admin_approved')
                    ->label('Approved')
                    ->boolean(),

                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'Breakfast' => 'Breakfast',
                        'Lunch' => 'Lunch',
                        'Dinner' => 'Dinner',
                        'Snacks' => 'Snacks',
                        'Other' => 'Other',
                    ]),

                TernaryFilter::make('is_admin_approved')
                    ->label('Admin Approved'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
