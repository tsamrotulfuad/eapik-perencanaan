<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PokinPerangkatDaerahResource\Pages;
use App\Filament\Resources\PokinPerangkatDaerahResource\RelationManagers;
use App\Models\PokinPerangkatDaerah;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PokinPerangkatDaerahResource extends Resource
{
    protected static ?string $model = PokinPerangkatDaerah::class;

    protected static ?string $navigationIcon = 'heroicon-s-squares-plus';
    protected static ?string $navigationLabel = "Perangkat Daerah";
    protected static ?string $breadcrumb = "Pohon Kinerja";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.keterangan')->label('Perangkat Daerah')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPokinPerangkatDaerahs::route('/'),
            'create' => Pages\CreatePokinPerangkatDaerah::route('/create'),
            'edit' => Pages\EditPokinPerangkatDaerah::route('/{record}/edit'),
        ];
    }
}
