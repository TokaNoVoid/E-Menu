<?php

namespace App\Filament\Resources\Subscriptions\Schemas;

use Auth;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubscriptionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name')
                    ->hidden(fn()=> Auth::user()->role === 'store'),
                Toggle::make('is_active')
                    ->hidden(fn()=> Auth::user()->role === 'store')
                    ->required(),
                Repeater::make('subscriptionPayment')
                    ->relationship()
                    ->label('⠀')
                    ->itemLabel('Pembayaran')
                    ->schema([
                        FileUpload::make('proof')
                            ->label('Bukti Pembayaran')
                            ->image()
                            ->required()
                            ->imageEditor()
                            ->columnSpanFull(),
                        Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'success' => 'Success',
                                'failed' => 'Rejected',
                            ])
                            ->required()
                            ->default('pending')
                            ->columnSpanFull()
                            ->label('Payment Status')
                            ->hidden(fn()=> Auth::user()->role === 'store'),
                            
                    ])
                    ->columnSpanFull()
                    ->addable(false),
            ]);
    }
}