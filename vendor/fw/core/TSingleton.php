<?php
/**
 * Created by PhpStorm.
 * User: zavix
 * Date: 08.01.19
 * Time: 14:50
 */

namespace fw\core;


trait TSingleton
{
    protected static $instance;

    public static function instance()
    {
        if (self::$instance === null){
            self::$instance = new self;
        }

        return self::$instance;
    }
}