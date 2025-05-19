<?php

namespace App\Filament\Resources\PokinKotaResource\Pages;

use App\Filament\Resources\PokinKotaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePokinKota extends CreateRecord
{
    protected static string $resource = PokinKotaResource::class;

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
