<?php

namespace App\Filament\Resources\Products\Schemas;

use Auth;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) 
            ->components([
                Section::make('Informasi Produk')
                    ->columns(1) 
                    ->schema([
                        Select::make('user_id')
                            ->label('Toko')
                            ->required()
                            ->reactive()
                            ->relationship('user', 'name')
                            ->hidden(fn() => Auth::user()->role === 'store'),

                        Select::make('product_category_id')
                            ->label('Kategori')
                            ->required()
                            ->relationship('productCategory', 'name')
                            ->disabled(fn(Callable $get) => $get('user_id') == null)
                            ->hidden(fn() => Auth::user()->role === 'store')
                            ->options(function(Callable $get){
                                $userId = $get('user_id');
                                
                                if(!$userId){
                                    return [];
                                }
                                return \App\Models\ProductCategory::where('user_id', $userId)->pluck('name', 'id');

                            }),
                        Select::make('product_category_id')
                            ->label('Kategori')
                            ->required()
                            ->relationship('productCategory', 'name')
                            ->hidden(fn() => Auth::user()->role === 'admin')
                            ->options(function(Callable $get){
                                return \App\Models\ProductCategory::where('user_id', Auth::user()->id)->pluck('name', 'id');
                            }),

                        TextInput::make('name')
                            ->label('Nama Produk')
                            ->required(),

                        TextInput::make('price')
                            ->label('Harga Produk')
                            ->required()
                            ->numeric()
                            ->prefix('Rp'),

                        TextInput::make('rating')
                            ->label('Rating Produk')
                            ->required()
                            ->numeric()
                            ->minLength(1)
                            ->maxLength(5),

                        Toggle::make('is_popular')
                            ->label('Produk Populer?'),

                        Textarea::make('description')
                            ->label('Deskripsi Produk')
                            ->required(),
                    ]),

                Section::make('Foto Produk')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Produk')
                            ->image()
                            ->imagePreviewHeight(300)
                            ->imageResizeMode('cover')
                            ->required(),
                    ]),
                Repeater::make('productIngredients')
                    ->label('Bahan Baku')
                    ->defaultItems(1)
                    ->relationship('productIngredients')
                    ->grid(4)
                    ->schema([
                        TextInput::make('name')
                            ->label('Bahan Baku')
                            ->required()
                    ])->columnSpanFull()
            ])
            ;
    }
}