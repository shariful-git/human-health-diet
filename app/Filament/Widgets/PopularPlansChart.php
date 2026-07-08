<?php

namespace App\Filament\Widgets;

use App\Models\Plan;
use Filament\Widgets\ChartWidget;

class PopularPlansChart extends ChartWidget
{
    protected int | string | array $columnSpan = 'md';
    protected ?string $heading = 'Diet Plan Distribution';

    protected function getData(): array
    {
        $defaultPlansCount = Plan::where('plan_type', 'default')->count();
        $customPlansCount = Plan::where('plan_type', 'custom')->count();

        return [
            'datasets' => [
                [
                    'label' => 'Total Plans Created',
                    'data' => [$defaultPlansCount, $customPlansCount],
                    'backgroundColor' => ['#6366f1', '#f59e0b'],
                ],
            ],
            'labels' => ['Official Default Plans', 'User Custom Plans'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
