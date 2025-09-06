<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\ProductCategory;
use Auth;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
        ->heading("Produk")
        ->poll('10s')
            ->columns([
                TextColumn::make('user.name')
                    ->label('Toko')
                    ->sortable()
                    ->hidden(fn()=> Auth::user()->role === 'store'),
                TextColumn::make('productCategory.name')
                    ->label('Kategori')
                    ->sortable(),
                ImageColumn::make('image')
                    ->label('Foto Produk')
                    ->alignCenter(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        $fullStars = str_repeat('⭐', $state);   
                        $emptyStars = str_repeat('✩', 5 - $state);  
                        return $fullStars . $emptyStars . " ($state)";
                    }),
                ToggleColumn::make("is_popular")
                ->label("Populer")
            ])
            ->filters([
                SelectFilter::make('user')
                    ->relationship('user','name')
                    ->label('Toko')
                    ->hidden(fn()=> Auth::user()->role === 'store'),
                SelectFilter::make('product_category_id')
                    // ->relationship('productCategory','name')
                    ->options(function(){
                        if(Auth::user()->role ===' admin'){
                            return ProductCategory::all()->pluck('name','id');
                        }
                        
                        return ProductCategory::where('user_id', Auth::user()->id)->pluck('name','id');
                    })
                    ->label('Kategori')
            ])
            ->recordActions([
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