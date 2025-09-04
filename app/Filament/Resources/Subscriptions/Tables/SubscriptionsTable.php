<?php

namespace App\Filament\Resources\Subscriptions\Tables;

use Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class SubscriptionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Toko')
                    ->hidden(fn()=> Auth::user()->role === 'store')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->label('Tanggal Mulai')
                    ->sortable(),
                TextColumn::make('end_date')
                    ->dateTime()
                    ->label('Tanggal Berakhir')
                    ->sortable(),
                ImageColumn::make('subscriptionPayment.proof')
                    ->label('Bukti Pembayaran'),
                TextColumn::make('subscriptionPayment.status')
                    ->label('Status Pembayaran'),
            ])
            ->filters([
                TrashedFilter::make(),
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