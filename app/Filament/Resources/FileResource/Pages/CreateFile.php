<?php

namespace App\Filament\Resources\FileResource\Pages;

use App\Filament\Resources\FileResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFile extends CreateRecord
{
    protected static string $resource = FileResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
