<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Filament\Traits\DynamicAction;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;
    protected function getRedirectUrl(): string
    {
        return ProductResource::getUrl('index');    
    }
    public  function getBreadcrumbs(): array
    {
        $product = static::getRecord();

        return [
            ProductResource::getUrl('index') => 'Produk',
            $product->name ,
            'Edit',
        ];
    }
    public function getTitle(): string
    {
        return 'Buat Produk';
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Kembali')
                ->color('secondary')
                ->icon('heroicon-o-arrow-left')
                ->url(ProductResource::getUrl('index')),
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
    
}