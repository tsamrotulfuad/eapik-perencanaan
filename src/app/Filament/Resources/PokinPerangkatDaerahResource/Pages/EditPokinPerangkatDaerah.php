<?php

namespace App\Filament\Resources\PokinPerangkatDaerahResource\Pages;

use App\Filament\Resources\PokinPerangkatDaerahResource;
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
