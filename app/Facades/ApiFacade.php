<?php
namespace App\Facades;

use App\Services\RestApiService;
use Illuminate\Support\Facades\Facade;

class ApiFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return RestApiService::class;
    }
}