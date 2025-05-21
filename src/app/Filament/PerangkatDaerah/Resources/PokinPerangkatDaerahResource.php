<?php

namespace App\Filament\PerangkatDaerah\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\PokinKota;
use Filament\Tables\Table;
use App\Models\DataPokinKota;
use Filament\Resources\Resource;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\PokinPerangkatDaerah;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource\Pages;
use App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource\RelationManagers;

class PokinPerangkatDaerahResource extends Resource
{
    protected static ?string $model = PokinPerangkatDaerah::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = "Pohon Kinerja";
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
                    ->label('Nama Pohon Kinerja')
                    ->required(),
                TextInput::make('keterangan'),
                Select::make('misi')
                    ->options(PokinKota::query()
                        ->select([
                            DB::raw("CONCAT(misi, ' - ', keterangan) as misi_id"),
                            'id',
                        ])
                        ->pluck('misi_id', 'id'))
                    ->live()
                    ->native(false)
                    ->placeholder('Pilih Misi'),
                Select::make('kondisi_id')
                    ->label('Kondisi')
                    ->options(fn(Get $get): Collection => DataPokinKota::query()
                        ->where('misi', $get('misi'))
                        ->pluck('nama_kondisi', 'id'))
                    ->native(false)
                    ->placeholder('Pilih Kondisi')
                    ->searchable(),
                Select::make("tahun")
                    ->options([
                        "2025-2029" => "2025-2029",
                    ])
                    ->default("2025-2029")
                    ->native(false)
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('keterangan'),
                TextColumn::make('misi'),
                TextColumn::make('kondisi_id'),
                TextColumn::make('tahun'),
            ])
            ->filters([
                //
            ])
            ->emptyStateHeading("Tidak Ada Data")
            ->actions([
                Tables\Actions\Action::make('Tambah Data')
                    ->url(fn($record): string => PokinPerangkatDaerahResource::getUrl('data',  ['record' => $record->id]))
                    ->button()
                    ->outlined(),
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()
                ])
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
            'data' => Pages\DataPokinPerangkatDaerah::route('/pokin/data/{record}'),
        ];
    }
}
