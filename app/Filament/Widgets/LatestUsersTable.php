<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestUsersTable extends TableWidget
{
    protected int|string|array $columnSpan = 'md';
    protected static ?string $heading = 'ℹ️ Latest Registered Users';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn(): Builder => User::query()->latest()->take(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\IconColumn::make('email_verified_at')
                    ->label('Verified')
                    ->boolean(fn(User $record) => filled($record->email_verified_at)),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y, h:i A')
                    ->sortable(),
            ])
            ->paginated([5, 10, 25]);
    }
}
