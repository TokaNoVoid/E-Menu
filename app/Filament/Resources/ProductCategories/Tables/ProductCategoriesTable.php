<?php

namespace App\Filament\Resources\ProductCategories\Tables;

use Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductCategoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->poll('10s')
        ->heading('Kategori Produk')
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->label('Toko')
                    ->hidden(fn()=> Auth::user()->role === 'store'),
                ImageColumn::make('icon'),
                TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('user')
                ->relationship('user','name')
                ->label('Toko')
                ->hidden(fn()=> Auth::user()->role === 'store'),

            ])
            ->recordActions([
                DeleteAction::make(),
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}