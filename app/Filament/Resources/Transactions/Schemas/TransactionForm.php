<?php

namespace App\Filament\Resources\Transactions\Schemas;

use App\Models\Product;
use App\Models\Transaction;
use Auth;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class TransactionForm
{
    public static function updateTotals(Get $get, Set $set)
    {
        $selectedProducts = collect($get('transactionDetails'))
            ->filter(fn($item) => !empty($item['product_id']) && !empty($item['quantity']));

        if ($selectedProducts->isEmpty()) {
            $set('total_price', 0);
            return;
        }

        $productIds = $selectedProducts->pluck('product_id')->toArray();
        $prices = Product::whereIn('id', $productIds)->pluck('price', 'id');

        $total = $selectedProducts->reduce(function ($total, $product) use ($prices) {
            return $total + ($prices[$product['product_id']] * $product['quantity']);
        }, 0);

        $set('total_price', $total);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components([

            /* =========================
               Section: Informasi Transaksi
            ========================= */
            Section::make('Informasi Transaksi')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            TextInput::make('code')
                                ->label('Kode Transaksi')
                                ->required()
                                ->readOnly(fn() => Auth::user()->role === 'store')
                                ->default(fn(): string => 'TRX-' . mt_rand(1000, 9999))
                                ->unique(Transaction::class, 'code'),

                            Select::make('user_id')
                                ->label('Toko')
                                ->relationship('user', 'name')
                                ->reactive()
                                ->required()
                                ->disabled(fn() => Auth::user()->role === 'store'),

                            TextInput::make('name')
                                ->label('Nama Pembeli')
                                ->required()
                                ->placeholder('Masukkan nama pembeli'),

                            TextInput::make('phone_number')
                                ->label('Nomor Telepon')
                                ->numeric()
                                ->nullable()
                                ->hint('Opsional')
                                ->placeholder('ex: 0882xxxxxx'),

                            TextInput::make('table_number')
                                ->label('Nomor Meja')
                                ->required()
                                ->numeric()
                                ->placeholder('Masukkan nomor meja'),
                        ]),
                ])
                ->columns(1),

            /* =========================
               Section: Detail Pembayaran
            ========================= */
            Section::make('Detail Pembayaran')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Select::make('payment_method')
                                ->label('Metode Pembayaran')
                                ->required()
                                ->options([
                                    'cash' => 'Cash',
                                    'midtrans' => 'Midtrans',
                                ]),

                            Select::make('status')
                                ->label('Status')
                                ->required()
                                ->default('pending')
                                ->options([
                                    'pending' => 'Pending',
                                    'success' => 'Success',
                                    'failed' => 'Failed',
                                ])
                                ->placeholder('pending / success / failed'),
                        ]),

           
                ])
                ->columns(1),

            /* =========================
               Section: Daftar Produk
            ========================= */
            Section::make('Daftar Produk')
                ->schema([
                    Repeater::make('transactionDetails')
                        ->label('Daftar Pesanan')
                        ->defaultItems(3)
                        ->relationship('transactionDetails')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    Select::make('product_id')
                                        ->label('Produk')
                                        ->relationship('product', 'name')
                                        ->options(function (callable $get) {
                                            $products = Auth::user()->role === 'admin' 
                                                ? Product::all() 
                                                : Product::where('user_id', Auth::user()->id)->get();

                                            return $products->mapWithKeys(fn($product) => [
                                                $product->id => "$product->name (Rp " . number_format($product->price) . ")"
                                            ]);
                                        })
                                        ->required(),

                                    TextInput::make('quantity')
                                        ->label('Jumlah')
                                        ->numeric()
                                        ->minValue(1)
                                        ->default(1)
                                        ->required(),
                                ]),
                            TextInput::make('note')
                                ->label('Catatan')
                                ->nullable()
                                ->columnSpanFull(),
                        ])
                        ->columnSpanFull()
                        ->grid(2)
                        ->live()
                        ->afterStateUpdated(function (Get $get, Set $set) {
                            self::updateTotals($get, $set);
                        })
                        ->reorderable(),
                ])
                ->columnSpanFull(),
                         TextInput::make('total_price')
                        ->label('Total Harga')
                        ->required()
                        ->readOnly()
                        ->prefix('Rp ')
                        ->reactive()
                        ->columnSpanFull(),
        ]);
    }
}