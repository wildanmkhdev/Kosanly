<?php

namespace App\Filament\Resources\Cities\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use illuminate\Support\Str;

class CityForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->required()
                    ->visibility('public')
                    ->disk('public')
                    ->columnSpan(2)
                    ->directory('cities'),
                TextInput::make('name')
                    ->required()
                    ->debounce(500) //supoaya tidak lgsg berubah kasi delay 500
                    ->reactive() // dia bakal trigger aktif
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', Str::slug($state)); // terus di isini akan membuat slug otomatis ketika name di isi
                    }),
                TextInput::make('slug')
                    ->required(),
            ]);
    }
}
