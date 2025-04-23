<?php

namespace App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource\Pages;

use App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePohonKinerja extends CreateRecord
{
    protected static string $resource = PohonKinerjaResource::class;

    public function getHeading(): string
    {
        return 'Tambah Pohon Kinerja';
    }

    public function getBreadcrumb(): string
    {
        return 'Tambah Pohon Kinerja';
    }

    public function getTitle(): string
    {
        return 'Pohon Kinerja';
    }
}
