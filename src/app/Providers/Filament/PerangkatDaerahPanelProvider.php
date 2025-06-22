<?php

namespace App\Providers\Filament;

use Filament\Pages;
use Filament\Panel;
use Filament\Widgets;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\MaxWidth;
use App\Filament\Pages\Auth\LoginCustom;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Filament\Http\Middleware\AuthenticateSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;

class PerangkatDaerahPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('perangkat_daerah')
            ->path('perangkat_daerah')
            ->login(LoginCustom::class)
            ->sidebarCollapsibleOnDesktop(true)
            ->maxContentWidth(MaxWidth::Full)
            ->colors([
                'primary' => Color::Blue,
            ])
            ->favicon(asset('logo/favicon.ico'))
            ->discoverResources(in: app_path('Filament/PerangkatDaerah/Resources'), for: 'App\\Filament\\PerangkatDaerah\\Resources')
            ->discoverPages(in: app_path('Filament/PerangkatDaerah/Pages'), for: 'App\\Filament\\PerangkatDaerah\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/PerangkatDaerah/Widgets'), for: 'App\\Filament\\PerangkatDaerah\\Widgets')
            // ->widgets([
            //     Widgets\AccountWidget::class,
            //     Widgets\FilamentInfoWidget::class,
            // ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->databaseNotifications();
    }
}
