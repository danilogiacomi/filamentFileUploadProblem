<?php

namespace App\Filament\Resources\PollingOrderResource\Pages;

use App\Filament\Resources\PollingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPollingOrder extends EditRecord
{
    protected static string $resource = PollingOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
