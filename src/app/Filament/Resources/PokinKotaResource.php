<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\PokinKota;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PokinKotaResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PokinKotaResource\RelationManagers;

class PokinKotaResource extends Resource
{
    protected static ?string $model = PokinKota::class;
    protected static ?string $navigationIcon = "heroicon-c-folder-plus";
    protected static ?string $navigationLabel = "Pohon Kinerja";
    protected static ?string $breadcrumb = "Pohon Kinerja";

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make("nama")->label("Nama Pohon Kinerja")->required(),
            TextInput::make("keterangan")->required(),
            Select::make("misi")
                ->options([
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                ])
                ->native(false),
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
                TextColumn::make("nama"),
                TextColumn::make("keterangan"),
                TextColumn::make("misi")->sortable(),
                TextColumn::make("tahun"),
            ])
            ->emptyStateHeading("Tidak Ada Data")
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\Action::make('Tambah Data')
                    ->url(fn ($record): string => PokinKotaResource::getUrl('data',  ['record' => $record->misi]))
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
            "index" => Pages\ListPokinKotas::route("/"),
            "create" => Pages\CreatePokinKota::route("/create"),
            "edit" => Pages\EditPokinKota::route("/{record}/edit"),
            "tampil" => Pages\TampilPokinKota::route("/tampil/pokin/"),
            "data" => Pages\DataPokinKota::route("/pokin/data/{record}")
        ];
    }
}
