<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 06.01.2019
 * Time: 12:29
 */

namespace fw\libs;


/**
 * Class Cache
 * @package fw\libs
 */
class Cache
{
    public function __construct()
    {

    }

    function set($key, $data, $time = 3600)
    {
        $content['data'] = $data;
        $content['end_time'] = time() + $time;
        if(file_put_contents(CACHE.'/'.md5($key).'.txt', serialize($content))){
            return true;
        }
        return false;
    }

    public function get($key)
    {
        $file = CACHE.'/'.md5($key).'.txt';
        if (file_exists($file)){
            $content = unserialize(file_get_contents($file));
            if(time() <= $content['end_time']){
                return $content['data'];
            }
            unlink($file);
        }
        return false;
    }

    public function  delete($key){
        $file = CACHE.'/'.md5($key).'.txt';
        if (file_exists($file)){
            unlink($file);
        }
    }
}