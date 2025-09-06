<?php

namespace App\Filament\Resources\ProductCategories\Pages;

use App\Filament\Resources\ProductCategories\ProductCategoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

    protected static ?string $title = " ";



    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('Buat Kategori Produk'),
        ];
    }
}