<?php

namespace App\Filament\Resources\PollingOrderResource\Pages;

use App\Filament\Resources\PollingOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPollingOrders extends ListRecords
{
    protected static string $resource = PollingOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
