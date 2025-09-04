<?php

namespace App\Filament\Resources\ProductCategories\Schemas;

use Auth;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;

class ProductCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(2) // Menggunakan 2 kolom untuk layout
            ->components([
                \Filament\Schemas\Components\Section::make('Informasi Kategori')
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Kategori')
                            ->required()
                            ->columnSpanFull(), 

                        Select::make("user_id")
                            ->label('Toko')
                            ->required()
                            ->relationship('user','name')
                            ->hidden(fn() => Auth::user()->role === 'store')
                            ->columnSpanFull(),
                    ]),

                \Filament\Schemas\Components\Section::make('Icon')
                    ->columns(1)
                    ->schema([
                        FileUpload::make('icon')
                            ->label('Icon Kategori')
                            ->required()
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight(250)          // Preview lebih besar agar tidak buram
                            ->imageResizeMode('cover')         // Menjaga aspect ratio
                            ->imageResizeTargetWidth(400)      // Resize lebar maksimal
                            ->imageResizeTargetHeight(400)     // Resize tinggi maksimal
                            ->maxSize(2048)                    // Maks 2MB (2048 KB)
                            ->columnSpanFull(),


                    ]),
            ]);
    }
}