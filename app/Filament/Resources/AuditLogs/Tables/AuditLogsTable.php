<?php

namespace App\Filament\Resources\AuditLogs\Tables;

use App\Models\AuditLog;
use Filament\Actions;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class AuditLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('event')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'created' => 'success',
                        'updated' => 'warning',
                        'deleted' => 'danger',
                        'login' => 'info',
                        'logout' => 'gray',
                        'failed_login' => 'danger',
                        'password_reset' => 'warning',
                        default => 'gray',
                    })
                    ->sortable()
                    ->searchable(),

                TextColumn::make('subject_label')
                    ->label('Target Subject')
                    ->searchable(query: function ($query, string $search) {
                        return $query->where('auditable_type', 'like', "%{$search}%")
                            ->orWhere('auditable_id', 'like', "%{$search}%");
                    }),

                TextColumn::make('user_name')
                    ->label('Causer / User')
                    ->searchable(query: function ($query, string $search) {
                        return $query->where('user_type', 'like', "%{$search}%")
                            ->orWhere('user_id', 'like', "%{$search}%");
                    }),

                TextColumn::make('tags')
                    ->badge()
                    ->color('secondary')
                    ->sortable(),

                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable(),

                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->dateTime('d M Y, H:i:s')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('event')
                    ->options([
                        'created' => 'Created',
                        'updated' => 'Updated',
                        'deleted' => 'Deleted',
                        'login' => 'Login',
                        'logout' => 'Logout',
                        'failed_login' => 'Failed Login',
                        'password_reset' => 'Password Reset',
                    ]),

                SelectFilter::make('tags')
                    ->options([
                        'model' => 'Model Data',
                        'auth' => 'Authentication',
                        'security' => 'Security',
                    ]),
            ])
            ->recordActions([
                Actions\ViewAction::make(),
            ])
            ->toolbarActions([]);
    }
}
