<?php

namespace App\Filament\Resources\PokinKotaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\PokinKotaResource;
use Filament\Actions\Action;

class ListPokinKotas extends ListRecords
{
    protected static string $resource = PokinKotaResource::class;

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

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->label('Tambah data'),
            // Action::make('tampil')->label('Tampil')->outlined()
            //     ->url(fn (): string => PokinKotaResource::getUrl('tampil')),
        ];
    }
}
