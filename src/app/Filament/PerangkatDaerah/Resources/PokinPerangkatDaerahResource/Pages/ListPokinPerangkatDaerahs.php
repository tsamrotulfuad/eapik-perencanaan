<?php

namespace App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource\Pages;

use App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPokinPerangkatDaerahs extends ListRecords
{
    protected static string $resource = PokinPerangkatDaerahResource::class;
    
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
