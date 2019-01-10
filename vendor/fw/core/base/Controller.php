<?php

namespace fw\core\base;

/**
 * 
 */
abstract class Controller
{
    /**
     * Текущий маршрут и параметры
     * @var array
     */
    public $route = [];

    /**
     * текущий вид
     * @var string
     */
    public $view;

    /**
     * текущий шаблон
     * @var string
     */
    public $layout;

    public $data = [];


	public function __construct($route)
	{
		$this->route = $route;
		$this->view = $route['action'];
	}

	public function getView()
    {
        $vObj = new View($this->route, $this->layout, $this->view);
        $vObj->render($this->data);
    }

    /**
     * @param $data
     */
    public function set($data)
    {
        $this->data = $data;
    }

    public function isAjax()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        require APP . "/views/{$this->route['controller']}/{$view}.php";
    }
}