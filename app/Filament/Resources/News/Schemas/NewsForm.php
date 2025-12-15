<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

use App\Models\{Author, Category};

use Filament\Schemas\Components\Utilities\Set;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('author_id')
                    ->options(Author::query()->pluck('name', 'id'))
                    ->loadingMessage('Loading authors...')
                    ->placeholder('Select author')
                    ->required(),
                Select::make('category_id')
                    ->options(Category::query()->pluck('title', 'id'))
                    ->placeholder('Select category')
                    ->loadingMessage('Loading category...'),
                TextInput::make('title')
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated(true)
                    ->required(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        ['bold', 'italic', 'underline', 'strike', 'subscript', 'superscript', 'link'],
                        ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                        ['blockquote', 'codeBlock', 'bulletList', 'orderedList'],
                        ['table'],
                    ]),
                Toggle::make('is_featured')
                    ->required(),
                FileUpload::make('thumbnail')
                    ->disk('public')
                    ->visibility('public')
                    ->acceptedFileTypes(['image/jpg','image/jpeg'])
                    ->image()
                    ->previewable()
                    ->maxSize(1024)
                    ->columnSpanFull()
                    ->default(null),
                
            ]);
    }
}
