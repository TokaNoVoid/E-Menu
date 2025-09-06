<?php

use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class Register extends BaseRegister
{
   public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo')
                    ->label('Logo Toko')
                    ->image()
                    ->imageEditor()
                    ->required()
                    ->columnSpanFull(),
                $this->getNameFormComponent()
                    ->label('Nama Toko')
                    ->required(),
                TextInput::make('username')
                    ->required()
                    ->regex('/^\S+$/')
                    ->maxLength(255)
                    ->minLength(4),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent()
                    ->minLength(3),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}