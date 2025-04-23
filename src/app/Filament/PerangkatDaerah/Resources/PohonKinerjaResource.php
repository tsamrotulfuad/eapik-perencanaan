<?php

namespace App\Filament\PerangkatDaerah\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\PohonKinerja;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource\Pages;
use App\Filament\PerangkatDaerah\Resources\PohonKinerjaResource\RelationManagers;

class PohonKinerjaResource extends Resource
{
    protected static ?string $model = PohonKinerja::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

    protected static ?string $navigationLabel = 'Pohon Kinerja';

    protected static ?string $breadcrumb = "Pohon Kinerja";

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')
                ->required(),
                Select::make('tahun')
                ->options([
                    '2025' => '2025',
                ])
                ->native(false)
                ->required(),
                FileUpload::make('file')
                ->directory('pokin')
                ->preserveFilenames()
                ->openable()
                ->uploadingMessage('Uploading File...')
                ->acceptedFileTypes(['application/pdf'])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->emptyStateHeading('Tidak ada data pohon kinerja')
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
            'index' => Pages\ListPohonKinerjas::route('/'),
            'create' => Pages\CreatePohonKinerja::route('/create'),
            'edit' => Pages\EditPohonKinerja::route('/{record}/edit'),
        ];
    }
}
