<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('logo')
                    ->required()
                    ->image()
                    ->imageResizeTargetWidth(800)
                    ->imageResizeTargetHeight(800)
                    ->imageResizeUpscale(true)
                    ->imageEditor()
                    ->helperText('Unggah logo pengguna. Format: JPG, PNG.')
                    ->placeholder('Pilih file logo...')
                    ->validationMessages([
                        'required' => 'Logo wajib diunggah.',
                        'image' => 'File harus berupa gambar.',
                    ]),

                TextInput::make('name')
                    ->required()
                    ->helperText('Nama lengkap pengguna.')
                    ->placeholder('Contoh: John Doe')
                    ->validationMessages([
                        'required' => 'Nama lengkap wajib diisi.',
                    ]),

                TextInput::make('username')
                    ->required()
                    ->unique(User::class, 'username')
                    ->regex('/^\S+$/')
                    ->minLength(5)
                    ->helperText('Username tanpa spasi.')
                    ->placeholder('Contoh: johndoe123')
                    ->validationMessages([
                        'required' => 'Username wajib diisi.',
                        'unique' => 'Username sudah digunakan.',
                        'regex' => 'Username tidak boleh mengandung spasi.',
                        'min' => 'Username harus terdiri dari minimal 5 karakter.',
                    ]),

                TextInput::make('email')
                    ->label('Alamat Email')
                    ->email()
                    ->unique(User::class, 'email')
                    ->required()
                    ->helperText('Alamat email aktif untuk komunikasi.')
                    ->placeholder('Contoh: john@example.com')
                    ->validationMessages([
                        'required' => 'Alamat email wajib diisi.',
                        'email' => 'Format email tidak valid.',
                        'unique' => 'Alamat email sudah terdaftar.',
                    ]),

                TextInput::make('password')
                    ->password()
                    ->required(fn ($context) => $context === 'create')
                    ->helperText(fn ($context) => $context === 'edit' ? 'Kosongkan jika tidak ingin mengubah password.' : 'Password wajib diisi saat membuat pengguna baru.')
                    ->placeholder('Masukkan password baru')
                    ->validationMessages([
                        'required' => 'Password wajib diisi.',
                    ]),

                Select::make('role')
                    ->required()
                    ->options([
                        'store' => 'Store',
                        'admin' => 'Admin',
                    ])
                    ->default('store')
                    ->placeholder('Pilih role pengguna')
                    ->validationMessages([
                        'required' => 'Role pengguna wajib dipilih.',
                    ]),
            ]);
    }
}