<?php

namespace App\Filament\Resources\PokinKotaResource\Pages;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use App\Filament\Resources\PokinKotaResource;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;

class DataPokinKota extends Page implements HasTable
{
    use InteractsWithTable, InteractsWithRecord;
    protected static string $resource = PokinKotaResource::class;
    protected static string $view = 'filament.resources.pokin-kota-resource.pages.data-pokin-kota';

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make("nama_kondisi")->label("Nama Pohon Kinerja")->required(),
            Repeater::make('indikator')
                ->simple(
                    TextInput::make('indikator')->required(),
                )
                ->addActionLabel('Tambah Indikator'),
            Select::make('parentId')
                ->label('ID Kondisi')
                ->options(function (): array {
                    return \App\Models\DataPokinKota::where('misi', $this->record->misi)->pluck('nama_kondisi', 'id')->all();
                })
                // ->options(\App\Models\DataPokinKota::where('misi', $this->record->misi)->pluck('nama_kondisi', 'id'))
                ->searchable()
                ->preload(true)
                ->live(true),                
            TextInput::make("misi")
                ->default($this->record->misi)
                ->readOnly(),
            Select::make("tahun")
                ->options([
                    "2025-2029" => "2025-2029",
                ])
                ->default("2025-2029")
                ->native(false)
                ->required(),
        ])
            ->columns(2)
            ->statePath('data');
    }

    public function create(): void
    {
        \App\Models\DataPokinKota::create($this->form->getState());
        $this->form->fill();
        Notification::make()
            ->title('Data berhasil disimpan')
            ->success()
            ->send();
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(\App\Models\DataPokinKota::query()->where('misi', $this->record->misi))
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('nama_kondisi')->searchable(),
                TextColumn::make('indikator'),
                TextColumn::make('parentId')
                    ->label('ID Kondisi')
                    ->default('Final Outcame'),
                TextColumn::make('misi'),
                TextColumn::make('tahun'),
            ])
            ->emptyStateHeading("Tidak Ada Data")
            ->filters([
                // ...
            ])
            ->actions([
                DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
