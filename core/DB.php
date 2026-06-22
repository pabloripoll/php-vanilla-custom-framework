<?php

namespace Core;

use Database\Client\Secondary;
use Database\Client\Peta;

/**
 * Define database connections
 */
class DB
{
    public static function secondary()
    {
        return new Secondary;
    }

    public static function peta()
    {
        return new Peta;
    }
}
