<?php

namespace App\Filament\Resources\BoardingHouses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BoardingHouseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Tabs')
                    ->tabs([
                        Tab::make('Informasi Umum')
                            ->schema([
                                FileUpload::make('thumbnail')
                                    ->image()
                                    ->directory('boarding_house')
                                    ->required(),
                                TextInput::make('name')
                                    ->required()
                                    ->debounce(500) // kasi waktu supaya slug otomatis generate dalam 500 s
                                    ->reactive() // untuk trigger input 
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        $set("slug", Str::slug($state));
                                    }), // untuk trigger input 
                                TextInput::make('slug')
                                    ->required(),
                                Select::make('city_id')
                                    ->relationship('city', 'name') //city itu dia ngambil nama function relasi di model trs name kolom ap yg kita ambil dari relasi tersbut misla name aj
                                    ->required(),
                                Select::make('category_id')
                                    ->relationship('category', 'name') //category itu dia ngambil nama function relasi di model trs name kolom ap yg kita ambil dari relasi tersbut misla name aj
                                    ->required(),
                                RichEditor::make('description')
                                    ->required(),
                                TextInput::make('price')
                                    ->numeric()
                                    ->prefix("IDR")
                                    ->required(),
                                Textarea::make('address')
                                    ->required(),
                            ]),
                        Tab::make('Tab 2')
                            ->schema([
                                // ...
                            ]),
                        Tab::make('Tab 3')
                            ->schema([
                                // ...
                            ]),
                    ])->columnSpan(2)
            ]);
    }
}
