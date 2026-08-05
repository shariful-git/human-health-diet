<?php

namespace App\Filament\Widgets;

use App\Models\AuditLog;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PortalVisitsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 2;

    protected function getStats(): array
    {
        $totalVisits = AuditLog::where('event', 'page_visit')->count();
        $uniqueVisitors = AuditLog::where('event', 'page_visit')->distinct('ip_address')->count('ip_address');
        $visitsToday = AuditLog::where('event', 'page_visit')->whereDate('created_at', Carbon::today())->count();
        $authenticatedVisitors = AuditLog::where('event', 'page_visit')->whereNotNull('user_id')->distinct('user_id')->count('user_id');

        return [
            Stat::make('Total Portal Visits', number_format($totalVisits))
                ->description('All recorded page views')
                ->descriptionIcon('heroicon-m-eye', IconPosition::Before)
                ->color('info'),

            Stat::make('Unique Visitors (IPs)', number_format($uniqueVisitors))
                ->description('Distinct IP addresses')
                ->descriptionIcon('heroicon-m-globe-alt', IconPosition::Before)
                ->color('primary'),

            Stat::make('Portal Visits Today', number_format($visitsToday))
                ->description('Visits recorded today')
                ->descriptionIcon('heroicon-m-chart-bar', IconPosition::Before)
                ->color('success'),

            Stat::make('Logged-in Visitor Accounts', number_format($authenticatedVisitors))
                ->description('Unique authenticated users')
                ->descriptionIcon('heroicon-m-user-group', IconPosition::Before)
                ->color('warning'),
        ];
    }
}
