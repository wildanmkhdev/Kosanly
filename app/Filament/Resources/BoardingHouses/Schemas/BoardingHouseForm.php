<?php

namespace App\Filament\Resources\BoardingHouses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
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
                                    ->visibility('public')
                                    ->disk('public')
                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/avif'])
                                    ->directory('boarding_house')
                                    // ->disk('public')
                                    // ->visibility('public')
                                    ->required(),
                                TextInput::make('name')
                                    ->required()
                                    ->debounce(100) // kasi waktu supaya slug otomatis generate dalam 500 s
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
                        Tab::make('Bonus Ngekos')
                            ->schema([
                                Repeater::make('bonuses')
                                    ->relationship('bonuses')
                                    ->schema([
                                        FileUpload::make('image')
                                            ->image()
                                            ->visibility('public')
                                            ->disk('public')
                                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/avif'])
                                            ->directory('bonuses')
                                            ->required(),
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('description')
                                            ->required(),
                                    ])
                                    ->columns(2)
                            ]),
                        Tab::make('Kamar')
                            ->schema([
                                Repeater::make('rooms')
                                    ->relationship('rooms')
                                    ->schema([
                                        TextInput::make('name')
                                            ->required(),
                                        TextInput::make('room_type')
                                            ->required(),
                                        TextInput::make('square_feet')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('capacity')
                                            ->numeric()
                                            ->required(),
                                        TextInput::make('price_per_month')
                                            ->numeric()
                                            ->prefix("IDR")
                                            ->required(),
                                        Toggle::make('is_available')
                                            ->default(true)
                                            ->required(),
                                        Repeater::make('images')
                                            ->relationship('images')
                                            ->schema([
                                                FileUpload::make('image')
                                                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/avif'])
                                                    ->image()

                                                    ->visibility('public')
                                                    ->disk('public')
                                                    ->directory('rooms')
                                                    ->required(),


                                            ])
                                    ])
                                    ->columns(2)
                            ]),
                    ])->columnSpan(2)
            ]);
    }
}
