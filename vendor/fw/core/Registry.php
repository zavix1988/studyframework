<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 07.01.2019
 * Time: 1:22
 */

namespace fw\core;


class Registry
{
    use TSingleton;

    public static $objects = [];

/*    protected static $instance;*/

    protected function __construct()
    {
        $config = require_once ROOT . '/config/config.php';

        foreach($config['components'] as $name =>$component )
        {
            self::$objects[$name] = new $component;
        }
    }

/*    public static function instance()
    {
        if (self::$instance === null){
            self::$instance = new self;
        }

        return self::$instance;
    }*/

    public function __get($name)
    {
        // TODO: Implement __get() method.
        if (is_object(self::$objects[$name])){
            return self::$objects[$name];
        }
    }


    public function __set($name, $object)
    {
        // TODO: Implement __set() method.
        if(!isset(self::$objects[$name])){
            self::$objects[$name] = new $object;
        }
    }

    public function getList()
    {
        echo '<pre>';
        var_dump(self::$objects);
        echo '</pre>';
    }
}
