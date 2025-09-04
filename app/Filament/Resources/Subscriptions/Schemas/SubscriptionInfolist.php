<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SubscriptionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('user.name'),
                TextEntry::make('end_date')
                ->label('Tanggal Berakhir')
                    ->dateTime(),
                TextEntry::make('subscriptionPayment.status')
                    ->label('Status Pembayaran')
                    ->badge()
                    ->colors([
                        'success'=> 'success',
                        'pending' => 'warning',
                        'failed' => 'danger',
                    ]),
                    
                TextEntry::make('created_at')
                    ->label('Tanggal Mulai')
                    ->dateTime(),
           
            ]);
    }
}