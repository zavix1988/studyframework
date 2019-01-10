<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.01.2019
 * Time: 0:17
 */

namespace app\controllers\admin;


use fw\core\base\View;

class UserController extends AppController
{
    //public $layout = 'default';

    public function indexAction()
    {
        View::setMeta('Одменка::Главная', 'описание одменки', "Ключевики одменки");
        $test = 'Тестовая переменная';
        $data = ['test', 2];
        $this->set(compact(['test', 'data']));
    }

    public function testAction()
    {
    }
}