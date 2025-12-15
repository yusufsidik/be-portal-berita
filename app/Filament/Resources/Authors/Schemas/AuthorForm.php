<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\{TextInput, Textarea,FileUpload};

class AuthorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->placeholder('Required author ...')
                    ->required(),
                TextArea::make('bio')
                    ->placeholder('Optional ...')
                    ->columnSpanFull()
                    ->default(null),
                FileUpload::make('avatar')
                    ->disk('public')
                    ->image()
                    ->previewable()
                    ->maxSize(1024)
                    ->default(null)
            ]);
    }
}
