<?php

namespace App\Filament\Resources\Food;

use App\Filament\Resources\Food\Pages\CreateFood;
use App\Filament\Resources\Food\Pages\EditFood;
use App\Filament\Resources\Food\Pages\ListFood;
use App\Filament\Resources\Food\Pages\ViewFood;
use App\Filament\Resources\Food\Schemas\FoodForm;
use App\Filament\Resources\Food\Schemas\FoodInfolist;
use App\Filament\Resources\Food\Tables\FoodTable;
use App\Models\Food;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class FoodResource extends Resource
{
    protected static ?string $model = Food::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Foods';

    public static function form(Schema $schema): Schema
    {
        return FoodForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return FoodInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return FoodTable::configure($table);
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
            'index' => ListFood::route('/'),
            'create' => CreateFood::route('/create'),
            'view' => ViewFood::route('/{record}'),
            'edit' => EditFood::route('/{record}/edit'),
        ];
    }
}
