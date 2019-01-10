<?php
/**
 * Created by PhpStorm.
 * User: Алексей
 * Date: 02.01.2019
 * Time: 22:29
 */

require_once '../vendor/libs/rb.php';

$db = require_once '../config/config_db.php';

R::setup($db['dsn'], $db['user'], $db['pass'], $options);

//var_dump(R::testConnection());

//create

/*$cat = R::dispense('category');
$cat->title = 'Категория 3';
$id = R::store($cat);*/
/*var_dump($id);*/


//read

/*$cat = R::load('category', 2);
print_r($cat);
echo $cat['title'];*/


//update

/*$cat = R::load('category', 3);
echo $cat->title . '<br>';
$cat->title = 'Категория 3';
R::store($cat);
echo $cat->title;*/

/*$cat = R::dispense('category');
$cat->title = 'Категория 3>>>';
$cat->id = 3;
R::store($cat);*/


//delete

/*$cat = R::load('category', 3);
R::trash($cat);

R::wipe('category');*/

$cats = R::findAll('category', 'id > ?' [2]);
print_r($cats);