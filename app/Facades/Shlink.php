<?php

namespace App\Facades;

use App\Services\ShlinkService;
use Illuminate\Support\Facades\Facade;

/**
 * @see ShlinkService
 */
class Shlink extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ShlinkService::class;
    }
}
