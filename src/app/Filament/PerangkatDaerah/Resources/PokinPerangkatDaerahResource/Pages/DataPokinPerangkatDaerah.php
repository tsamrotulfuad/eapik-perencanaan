<?php

namespace App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource\Pages;

use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use App\Filament\PerangkatDaerah\Resources\PokinPerangkatDaerahResource;

class DataPokinPerangkatDaerah extends Page implements HasTable
{
    use InteractsWithTable, InteractsWithRecord;
    protected static string $resource = PokinPerangkatDaerahResource::class;
    protected static string $view = 'filament.perangkat-daerah.resources.pokin-perangkat-daerah-resource.pages.data-pokin-perangkat-daerah';

    public ?array $data = [];

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        $misi = $this->record->misi;

        return $form->schema([
            TextInput::make("nama_kondisi")->label("Nama Kondisi")
                ->required()
                ->placeholder('Masukkan Nama Kondisi'),
            Repeater::make('indikator')
                ->simple(
                    TextInput::make('indikator')->required(),
                )
                ->addActionLabel('Tambah Indikator'),
            Select::make('parentId')
                ->label('ID Kondisi')
                ->options(function (): array {
                    return \App\Models\DataPokinPerangkatDaerah::where('misi', $this->record->misi)->pluck('nama_kondisi', 'id')->all();
                })
                // ->options(\App\Models\DataPokinKota::where('misi', $this->record->misi)->pluck('nama_kondisi', 'id'))
                ->searchable()
                ->preload(true)
                ->live(true),
            TextInput::make("misi")
                ->default($misi)
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
        \App\Models\DataPokinPerangkatDaerah::create($this->form->getState());
        $this->form->fill();
        Notification::make()
            ->title('Data berhasil disimpan')
            ->success()
            ->send();
    }

    public function table(Table $table): Table
    {
        $misi = $this->record->misi;
        return $table
            ->query(\App\Models\DataPokinPerangkatDaerah::query()->where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('id')
                    ->label('ID'),
                TextColumn::make('nama_kondisi')->searchable(),
                TextColumn::make('indikator')->searchable(),
                TextColumn::make('parentId')
                    ->label('ParentID Kondisi')
                    ->default('Final Outcame'),
                TextColumn::make('misi'),
                TextColumn::make('tahun'),
            ])
            ->emptyStateHeading("Tidak Ada Data")
            ->filters([
                // ...
            ])
            ->actions([
                EditAction::make()
                    ->record($this->record)
                    ->form([
                        TextInput::make("nama_kondisi")->label("Nama Kondisi")
                            ->required(),
                        Repeater::make('indikator')
                            ->simple(
                                TextInput::make('indikator')->required(),
                            )
                            ->addActionLabel('Tambah Indikator'),
                        Select::make('parentId')
                            ->default($this->record->parentId)
                            ->label('ID Kondisi')
                            ->options(function (): array {
                                return \App\Models\DataPokinPerangkatDaerah::where('misi', $this->record->misi)->pluck('nama_kondisi', 'id')->all();
                            })
                            // ->options(\App\Models\DataPokinKota::where('misi', $this->record->misi)->pluck('nama_kondisi', 'id'))
                            ->searchable()
                            ->preload(true)
                            ->live(true),
                        TextInput::make("misi")
                            ->default($misi)
                            ->readOnly(),
                        Select::make("tahun")
                            ->options([
                                "2025-2029" => "2025-2029",
                            ])
                            ->default("2025-2029")
                            ->native(false)
                            ->required(),
                    ])
                    ->modalHeading('Edit data'),
                DeleteAction::make()->requiresConfirmation(),
            ])
            ->bulkActions([
                // ...
            ]);
    }
}
