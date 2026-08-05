<?php

namespace App\Filament\Resources\AuditLogs\Schemas;

use App\Models\AuditLog;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class AuditLogInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Audit Details')
                ->schema([
                    TextEntry::make('id')->label('Log ID'),
                    TextEntry::make('event')
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
                        }),
                    TextEntry::make('subject_label')->label('Target Subject'),
                    TextEntry::make('user_name')->label('Causer / User'),
                    TextEntry::make('ip_address')->label('IP Address'),
                    TextEntry::make('tags')->badge()->color('secondary'),
                    TextEntry::make('url')->label('Request URL')->columnSpanFull(),
                    TextEntry::make('user_agent')->label('User Agent')->columnSpanFull(),
                    TextEntry::make('created_at')->label('Timestamp')->dateTime('d M Y, H:i:s'),
                ])
                ->columns(2),

            Section::make('Audit Payload & Diffs')
                ->schema([
                    TextEntry::make('old_values')
                        ->label('Old Values')
                        ->state(fn (AuditLog $record): string => json_encode($record->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?: 'None')
                        ->formatStateUsing(fn (string $state): string => $state)
                        ->fontFamily('mono')
                        ->columnSpan(1),

                    TextEntry::make('new_values')
                        ->label('New Values')
                        ->state(fn (AuditLog $record): string => json_encode($record->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?: 'None')
                        ->formatStateUsing(fn (string $state): string => $state)
                        ->fontFamily('mono')
                        ->columnSpan(1),
                ])
                ->columns(2),
        ]);
    }
}
