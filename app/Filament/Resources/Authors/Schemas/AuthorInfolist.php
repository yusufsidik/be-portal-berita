<?php

namespace App\Filament\Resources\Authors\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class AuthorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name')->columnSpanFull(),
                TextEntry::make('bio')
                    ->columnSpanFull()
                    ->placeholder('-'),
                ImageEntry::make('avatar')
                    ->disk('public')
                    // ->imageWidth(200)
                    ->imageHeight(200)
                    ->columnSpanFull()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime('d F Y')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime('d F Y')
                    ->placeholder('-'),
            ]);
    }
}
