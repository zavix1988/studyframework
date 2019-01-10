<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 28.12.2018
 * Time: 6:52
 */

namespace fw\core\base;


/**
 * Class View
 * @package fw\core\base
 */
class View
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

    public $scripts = [];

    public static $meta = [
        'title' => '',
        'desc' => '',
        'keywords' => ''
    ];

    public function __construct($route, $layout = '', $view='')
    {
        $this->route = $route;
        if ($layout === false){
            $this->layout = false;
        } else {
            $this->layout = $layout ?: LAYOUT;
        }
        $this->view = $view;
    }


    /**
     *
     */
    public function render($data)
    {
        if(is_array($data))extract($data);
        $this->route['prefix'] = str_replace('\\', '/', $this->route['prefix']);
        $fileView = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";
        ob_start();
        if (is_file($fileView)){
            require $fileView;
        } else {
            //echo "<p>Не найден вид <b>$fileView</b></p>";
            throw new \Exception("<p>Не найден вид <b>{$fileView}</b></p>", 404);
        }
        $content = ob_get_clean();

        if (false !== $this->layout){
            $fileLayout = APP . "/views/layouts/{$this->layout}.php";
            if(is_file($fileLayout)){
                $content = $this->getScript($content);
                if (!empty($this->scripts)){
                    $scripts = $this->scripts[0];
                }
                require $fileLayout;
            } else {
                echo "<p>Не найден шаблон <b>$fileLayout</b></p>";
            }
        }

    }

    protected function getScript($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if(!empty($this->scripts)){
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public static function getMeta()
    {
        echo '<title>' . self::$meta['title']. '</title>
        <meta name="description" content="'. self::$meta['desc']. '">
        <meta name="keywords" content="' . self::$meta['keywords'] . '">';
    }

    public static function setMeta($title = '', $desc = '', $keywords = '')
    {
        self::$meta['title'] = $title;
        self::$meta['desc'] = $desc;
        self::$meta['keywords'] = $keywords;
    }
}