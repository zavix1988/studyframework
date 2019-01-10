<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 10.01.2019
 * Time: 0:24
 */

namespace app\controllers\admin;
use fw\core\base\Controller;


class AppController extends Controller
{
    public $layout = 'admin';

    public function __construct($route)
    {
        parent::__construct($route);
    }
}