<?php

namespace App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource\Pages;

use App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource;
use App\Models\User;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePohonKinerja extends CreateRecord
{
    protected static string $resource = PohonKinerjaResource::class;

    public function getHeading(): string
    {
        return 'Tambah Pohon Kinerja';
    }

    public function getBreadcrumb(): string
    {
        return 'Tambah Pohon Kinerja';
    }

    public function getTitle(): string
    {
        return 'Pohon Kinerja';
    }

    protected function getRedirectUrl(): string
    {
        $name = Auth::user()->name;
        $admin = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'super_admin');
        })->get();

        Notification::make()
            ->success()
            ->title('Pokin telah dibuat oleh '. $name)
            ->sendToDatabase($admin);

        return $this->getResource()::getUrl('index');
    }
}
