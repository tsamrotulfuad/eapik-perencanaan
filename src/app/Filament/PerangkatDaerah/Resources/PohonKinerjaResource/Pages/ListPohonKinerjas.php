<?php

namespace App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource\Pages;

use App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPohonKinerjas extends ListRecords
{
    protected static string $resource = PohonKinerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Tambah data'),
        ];
    }

    public function getHeading(): string
    {
        return 'Data Pohon Kinerja';
    }

    public function getBreadcrumb(): string
    {
        return 'Data Pohon Kinerja';
    }

    public function getTitle(): string
    {
        return 'Pohon Kinerja';
    }
}
