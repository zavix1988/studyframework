<?php
/**
 * Created by PhpStorm.
 * User: zavix
 * Date: 10.01.19
 * Time: 14:25
 */

namespace app\models;


use fw\core\base\Model;

class User extends Model
{
    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
    ];

    public $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['email'],
            ['name'],
        ],
        'email' =>[
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ],
    ];

    public function checkUnique()
    {
        $user = \R::findOne('user', 'login = ? OR email = ? LIMIT 1', [$this->attributes['login'], $this->attributes['email']]);
        if ($user){
            if($user->login == $this->attributes['login']){
                $this->errors['unique'][] = 'Этот логин уже занят';
            }
            if($user->email == $this->attributes['email']){
                $this->errors['unique'][] = 'Этот email уже занят';
            }
            return false;
        }
        return true;
    }

    public function login()
    {
        $login = !empty(rtrim($_POST['login'])) ? rtrim($_POST['login']) : null;
        $password = !empty(rtrim($_POST['password'])) ? rtrim($_POST['password']) : null;
        if($login && $password){
            $user = \R::findOne('user', 'login = ? LIMIT 1', [$login]);
            //$user = \R::findOne('user', 'login ')
            if ($user){
                if (password_verify($password, $user->password)){
                    foreach ($user as $key => $value){
                        if ($key != 'password')$_SESSION['user'][$key] = $value;
                    }
                    return true;
                }
            }
        }
        return false;
    }

}