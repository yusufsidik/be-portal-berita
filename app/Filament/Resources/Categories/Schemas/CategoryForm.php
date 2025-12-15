<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->placeholder('press Tab after fill the title to complete fill the slug')
                    ->required(),
                TextInput::make('slug')
                    ->placeholder('this slug automatically filled atfer fill the title')
                    ->disabled()
                    ->dehydrated(true)
                    ->required()
            ]);
    }
}
