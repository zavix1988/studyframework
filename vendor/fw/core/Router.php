<?php

namespace fw\core;

class Router{

	protected static $routes = [];
	protected static $route = [];

	public static function add($regExp, $route = [])
	{
		self::$routes[$regExp] = $route;
	}

	public static function getRoutes()
	{
		return self::$routes;
	}

	public static function getRoute()
	{
		return self::$route;
	}

	public static function matchRoute($url)
	{
		foreach (self::$routes as $pattern => $route) {
			if(preg_match("#$pattern#i", $url, $matches)){

				foreach($matches as $key => $value){
					if (is_string($key)) {
						$route[$key] = $value;
					}
				}
				if (!isset($route['action'])) {
					$route['action'] = 'index';
				}
				//prefix for admin controllers
                if (!isset($route['prefix']))$route['prefix'] = '';
				else $route['prefix'] .= '\\';
				$route['controller'] = self::upperCamelCase($route['controller']);
				self::$route = $route;
				return true;
			}
		}
		return false;
	}

	public static function dispatch($url)
	{
		$url = self::removeQueryString($url);
		if(self::matchRoute($url)){
			$controller = 'app\controllers\\' . self::$route['prefix'] . self::upperCamelCase(self::$route['controller'] . 'Controller');
			self::upperCamelCase($controller);
			if (class_exists($controller)) {
				$cObj = new $controller(self::$route);
				$action = self::lowerCamelCase(self::$route['action']).'Action';
				if (method_exists($cObj, $action)) {
					$cObj->$action();
					$cObj->getView();
				} else {
				    throw new \Exception("метод <b>$controller::$action</b> не найден", 404);
				}
			} else {
			    throw new \Exception("Контроллер <b>$controller</b> не найден", 404);
				//echo "Контроллер <b>$controller</b> не найден";
			}
		} else {
/*			http_response_code(404);
			include '404.html';*/
            throw new \Exception("Страница не найдена", 404);
		}
	}

	protected static function upperCamelCase($name)
	{
		return $name = str_replace(" ", "", ucwords(str_replace("-", " ", $name)));
	}

	protected static function lowerCamelCase($name)
	{
		return lcfirst(self::upperCamelCase($name));
	}

	protected static function removeQueryString($url)
	{
		if ($url) {
			$params = explode('&', $url, 2);
			if (false == strpos($params[0], '=')) {
				return rtrim($params[0], '/');
			} else {
				return '';
			}
		}
		return $url;
	}
}