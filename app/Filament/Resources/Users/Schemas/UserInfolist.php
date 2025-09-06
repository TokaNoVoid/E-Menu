<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ImageEntry::make('logo')
                    ->imageHeight(50)
                    ->imageWidth(50)
                    ->circular()
                    ->extraImgAttributes([
                        'alt' => 'User Logo',
                        'loading' => 'lazy',
                    ]),
                TextEntry::make('name')
                    ->label('Nama Toko')
                    ->badge()
                    ->color('primary'),
                TextEntry::make('username')
                    ->label('Username')
                    ->badge()
                    ->color('secondary'),
                TextEntry::make('email')
                    ->label('Email Address')
                    ->badge()
                    ->color('success'),
                TextEntry::make('role')
                    ->label('User Role')
                    ->badge()
                    ->color('warning'),
                TextEntry::make('created_at')
                    ->label('Account Created')
                    ->dateTime()
                    ->badge()
                    ->color('info'),
                TextEntry::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->badge()
                    ->color('danger'),
            ]);
    }
}