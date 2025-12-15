<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Schema;

class NewsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('author.name')->label('Author'),
                TextEntry::make('category.title')->label('Category'),
                TextEntry::make('title'),
                ImageEntry::make('thumbnail')
                    ->placeholder('-')
                    ->imageWidth(800)
                    ->imageHeight(600)
                    ->extraImgAttributes([
                        'style' => 'object-fit: fill'
                    ])
                    ->disk('public')
                    ->columnSpanFull(),
                TextEntry::make('content')
                    ->columnSpanFull(),
                IconEntry::make('is_featured')
                    ->boolean()
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->dateTime('d F Y , H:i:s')
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime('d F Y , H:i:s')
                    ->placeholder('-'),
            ]);
    }
}
