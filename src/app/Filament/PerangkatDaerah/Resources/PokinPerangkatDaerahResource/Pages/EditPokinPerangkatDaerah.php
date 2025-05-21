<?php

namespace App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource\Pages;

use App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPokinPerangkatDaerah extends EditRecord
{
    protected static string $resource = PokinPerangkatDaerahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
