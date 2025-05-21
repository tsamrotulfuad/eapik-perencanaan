<?php

namespace App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource\Pages;

use App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePokinPerangkatDaerah extends CreateRecord
{
    protected static string $resource = PokinPerangkatDaerahResource::class;

    public function getHeading(): string
    {
        return 'Tambah Data Pohon Kinerja';
    }

    public function getBreadcrumb(): string
    {
        return 'Tambah';
    }

    public function getTitle(): string
    {
        return 'Pohon Kinerja';
    }
}
