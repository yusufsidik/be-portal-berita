<?php

namespace App\Filament\Resources\News\Tables;

use Filament\Actions\{BulkActionGroup, DeleteBulkAction, EditAction, ViewAction};
use Filament\Tables\Columns\{ToggleColumn, TextColumn, ImageColumn};
use Filament\Tables\Table;

class NewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author.name')
                    ->sortable(),
                TextColumn::make('category.title')
                    ->sortable(),
                TextColumn::make('title')
                    ->searchable(),
                ToggleColumn::make('is_featured'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
