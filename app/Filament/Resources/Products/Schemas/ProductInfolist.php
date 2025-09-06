<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('image')
                    ->label('Foto Produk'),
                TextEntry::make('description')
                    ->label('Deskripsi')
                    ->extraAttributes(['class' => 'text-lg font-bold']),
                TextEntry::make('name')
                    ->label('Nama Produk')
                    ->extraAttributes(['class' => 'text-lg font-bold']),

                TextEntry::make('productCategory.name')
                    ->label('Kategori')
                    ->extraAttributes(['class' => 'text-sm font-medium  px-2 py-1 rounded']),

                TextEntry::make('user.name')
                    ->label('Toko')
                    ->extraAttributes(['class' => 'text-base']),

                TextEntry::make('price')
                    ->money('idr')
                    ->label('Harga')
                    ->extraAttributes(['class' => 'text-lg font-semibold text-green-500']),

                // Rating dengan bintang
                TextEntry::make('rating')
                    ->label('Rating')
                    ->formatStateUsing(function ($state) {
                        $fullStars = str_repeat('⭐', $state);
                        $emptyStars = str_repeat('✩', 5 - $state);
                        return $fullStars . $emptyStars . " ($state)";
                    })
                    ->extraAttributes(['class' => 'text-lg font-semibold']),
                
                TextEntry::make('created_at')
                    ->label('Dibuat')
                    ->dateTime()
                    ->extraAttributes(['class' => 'text-sm text-gray-500']),

                TextEntry::make('updated_at')
                    ->label('Diperbarui')
                    ->dateTime()
                    ->extraAttributes(['class' => 'text-sm text-gray-500']),
            ]);
    }
}