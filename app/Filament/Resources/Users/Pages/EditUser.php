<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    public  function getBreadcrumbs(): array
    {
        $user = static::getRecord();

        return [
            UserResource::getUrl('index') => 'Users',
            $user->username ,
            'Edit',
        ];
    }

        public function getTitle(): string
    {
        return '';
    }
    protected function getRedirectUrl(): string
    {
        return UserResource::getUrl('index');    
    }


    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        return $data;
    }

    protected function getHeaderActions(): array
    {
        return [
                        Action::make('back')
                ->url(UserResource::getUrl())
                ->button()
                ->color('primary')
                ->icon('heroicon-o-arrow-left'),
            DeleteAction::make(),
        ];
    }
}