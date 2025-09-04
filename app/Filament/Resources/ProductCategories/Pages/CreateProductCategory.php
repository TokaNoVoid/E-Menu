<?php

namespace App\Filament\Resources\ProductCategories\Pages;

use App\Filament\Resources\ProductCategories\ProductCategoryResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProductCategory extends CreateRecord
{
    public function getTitle(): string
    {
        return 'Buat Kategori Produk';
    }
    protected static string $resource = ProductCategoryResource::class;
}