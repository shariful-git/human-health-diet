<?php

namespace App\Filament\Widgets;

use App\Models\DailyLog;
use App\Models\Food;
use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Registered Users', User::count())
                ->description('All time accounts')
                ->descriptionIcon('heroicon-m-users', IconPosition::Before)
                ->color('primary'),

            Stat::make('Active Users (Today)', DailyLog::where('date', Carbon::today()->toDateString())->count())
                ->description('Users who logged data today')
                ->descriptionIcon('heroicon-m-check-circle', IconPosition::Before)
                ->color('success'),

            Stat::make('Total Diet Plans', Plan::count())
                ->description('Default + Custom plans')
                ->descriptionIcon('heroicon-m-clipboard-document-list', IconPosition::Before)
                ->color('warning'),

            Stat::make('Food Items In Database', Food::count())
                ->description('Global nutrition items')
                ->descriptionIcon('heroicon-m-cake', IconPosition::Before)
                ->color('info'),
        ];
    }
}
