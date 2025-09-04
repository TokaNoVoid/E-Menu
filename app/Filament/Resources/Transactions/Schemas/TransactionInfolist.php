<?php

namespace App\Filament\Resources\Transactions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use PhpParser\Node\Stmt\Label;

class TransactionInfolist
{

 
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name')
                    ->label('Toko'),
                TextEntry::make('code'),
                TextEntry::make('name')
                    ->label('Nama Pelanggan'),
                TextEntry::make('phone_number')
                    ->label('Nomor Telepon'),
                TextEntry::make('table_number')
                    ->label('Nomor Meja'),
                TextEntry::make('payment_method')
                    ->Label('Metode Pembayaran'),
                TextEntry::make('total_price')
                ->label('Total Harga')
                ->prefix('Rp ')
                ->money('idr')
                    ->numeric(),
                TextEntry::make('status')
                    ->label('Status'),
                TextEntry::make('created_at')
                ->label('Tanggal Transaksi')
                    ->dateTime(),
                TextEntry::make('updated_at')
                ->label('Tanggal Diperbarui')
                    ->dateTime(),
            ]);
    }
}