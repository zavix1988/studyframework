<?php
/**
 * Created by PhpStorm.
 * User: zavix
 * Date: 09.01.19
 * Time: 16:46
 */

namespace fw\widgets\menu;


use fw\libs\Cache;

class Menu
{

    protected $data;

    protected $tree;

    protected $menuHtml;

    protected $tpl;

    protected $container = 'ul';

    protected $class = 'menu';

    protected $table = 'categories';

    //protected $template = 'menu';

    protected $cache = 3600;
    protected $cacheKey = 'fw-menu';


    public function __construct($options = [])
    {
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    protected function getOptions($options)
    {
        foreach($options as $key => $option){
            if (property_exists($this, $key)){
                $this->$key = $option;
            }
        }
    }

    protected function output()
    {
        echo "<{$this->container} class='{$this->class}'>";
            echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    protected function run()
    {
        $cache = new Cache();
        $this->menuHtml = $cache->get($this->cacheKey);
        if(!$this->menuHtml){
            $this->data = \R::getAssoc("SELECT * FROM {$this->table}");
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
        }
        $this->output();
    }

    protected function getTree()
    {
        $tree = [];
        $data = $this->data;

        foreach ($data as $id=>&$node) {
            if (!$node['parent']){
                $tree[$id] = &$node;
            }else{
                $data[$node['parent']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach($tree as $id => $category){
            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }
}