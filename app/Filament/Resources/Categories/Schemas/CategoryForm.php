<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->image()
                    ->columnSpan(2)
                    ->visibility('public')
                    ->disk('public')
                    ->image()
                    ->directory('categories')

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
            ]);
    }
}
