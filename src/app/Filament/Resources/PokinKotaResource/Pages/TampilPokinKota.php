<?php

namespace App\Filament\Resources\PokinKotaResource\Pages;

use App\Filament\Resources\PokinKotaResource;
use Filament\Resources\Pages\Page;

class TampilPokinKota extends Page
{
    protected static string $resource = PokinKotaResource::class;

    protected static string $view = 'filament.resources.pokin-kota-resource.pages.tampil-pokin-kota';
}
