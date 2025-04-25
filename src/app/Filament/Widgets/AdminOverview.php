<?php

namespace App\Filament\Widgets;

use App\Models\PohonKinerja;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class AdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $user = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'panel_user');
            })->count();

        return [
            Stat::make('Perangkat Daerah', $user),
            Stat::make('Pohon Kinerja', PohonKinerja::query()->count()),
        ];
    }
}
