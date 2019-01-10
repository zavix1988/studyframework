<?php

namespace app\controllers;
use app\models\Main;
use fw\core\App;
use fw\core\base\View;



/**
 *
 */
class MainController extends AppController
{
    //public $layout = 'main';

    public function indexAction()
    {

        //App::$app->getList();


        $model = new Main();
        $books = App::$app->cache->get('books');
        /*        if (!$books){
                    $books = \R::findAll('books');
                    App::$app->cache->set('books', $books, 3600*24);
                }*/
        //trigger_error(E_USER_ERROR);

        $book = \R::findOne('books', 'id = 2');
        $menu = $this->menu;
        $title = 'PAGE TITLE';
/*        $this->setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $meta = $this->meta;*/
        View::setMeta('Главная страница', 'Описание страницы', 'Ключевые слова');
        $this->set(compact(['title', 'books', 'menu', 'meta']));
    }

    public function testAction()
    {
        if($this->isAjax()){
            $model = new Main();
/*            $data = ['answer' => 'Server answer', 'code' => 200];
            echo json_encode($data);*/
          $book = \R::findOne('books', "id = {$_POST['id']}");
            $this->loadView('_test', compact('book'));
            die;
        }
        echo 222;

        $this->layout = 'test';
    }
}