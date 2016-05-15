<?php

namespace RoketId\ImageMax;

use Illuminate\Support\Facades\Facade;

class ImageMaxFacade extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor()
    {
        return 'imagemax';
    }
}
