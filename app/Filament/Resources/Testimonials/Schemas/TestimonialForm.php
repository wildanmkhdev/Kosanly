<?php

namespace App\Filament\Resources\Testimonials\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TestimonialForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('boarding_house_id')
                    ->relationship('boardingHouse', 'name')
                    ->required()
                    ->numeric(),
                FileUpload::make('photo')
                    ->image()
                    ->columnSpan(2)
                    ->directory('testimonials')
                    ->required(),
                Textarea::make('content')
                    ->columnSpanFull()
                    ->required(),

                TextInput::make('name')
                    ->required(),
                TextInput::make('rating')
                    ->required()
                    ->minValue(1)
                    ->maxValue(5)
                    ->numeric(),
            ]);
    }
}
