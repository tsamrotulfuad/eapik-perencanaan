<?php

namespace App\Filament\Resources\PokinKotaResource\Pages;

use App\Filament\Resources\PokinKotaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPokinKota extends EditRecord
{
    protected static string $resource = PokinKotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
