<?php

namespace App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource\Pages;

use App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPohonKinerja extends EditRecord
{
    protected static string $resource = PohonKinerjaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    public function getHeading(): string
    {
        return 'Ubah Pohon Kinerja';
    }

    public function getBreadcrumb(): string
    {
        return 'Ubah Pohon Kinerja';
    }

    public function getTitle(): string
    {
        return 'Pohon Kinerja';
    }
}
