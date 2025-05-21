<?php

namespace App\Filament\Widgets;

use App\Models\PohonKinerja;
use App\Models\PokinKota;
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
        
        $pokin_kota = PokinKota::get()->count();

        return [
            Stat::make('Perangkat Daerah', $user),
            Stat::make('Pohon Kinerja Kota', $pokin_kota)
        ];
    }
}
