<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;


    protected function getHeaderActions(): array
    {
        return [
            Action::make('Kembali')
                ->label('Kembali')
                ->color('secondary')
                ->icon('heroicon-o-arrow-left')
                ->url(ProductResource::getUrl('index')), 

            EditAction::make(), 
        ];
    }
}