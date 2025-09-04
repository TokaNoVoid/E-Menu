<?php

namespace App\Filament\Resources\Transactions\Pages;

use App\Filament\Resources\Transactions\TransactionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditTransaction extends EditRecord
{
    public function mutateFormDataBeforeFillUsing(array $data): array
{
    if (isset($data['transactionDetails'])) {
        $data['transactionDetails'] = json_decode($data['transactionDetails'], true);
    }

    if(isset($data['note'])){
        $data['note'] = json_decode($data['note'], true);
    }

    return $data;
}

    protected static string $resource = TransactionResource::class;

    public  function getBreadcrumbs(): array
    {
        $transaction = static::getRecord();

        return [
            TransactionResource::getUrl('index') => 'Transaksi',
            $transaction->code ,
            'Edit',
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}