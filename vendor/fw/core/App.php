<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 07.01.2019
 * Time: 1:29
 */

namespace fw\core;
use fw\core\Registry;
use fw\core\ErrorHandler;


class App
{
    public static $app;

    public function __construct()
    {
        session_start();
        self::$app = Registry::instance();
        new ErrorHandler();
    }
}