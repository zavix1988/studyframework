<?php
/**
 * Created by PhpStorm.
 * User: zavix
 * Date: 10.01.19
 * Time: 13:54
 */

namespace app\controllers;


use app\models\User;
use fw\core\base\View;

class UserController extends AppController
{
    public function signupAction()
    {
        if (!empty($_POST)){
            $data = $_POST;
            $user = new User();
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUnique()){
                $user->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }

            $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);

            if ($user->save('user')){
                $_SESSION['success'] = 'Вы успешно зарегистрированы';
            }else{
                $_SESSION['error'] = 'Ошибка, попробуйте позже';
            }
            redirect();

        }

        View::setMeta('Регистрация');
    }

    public function loginAction()
    {
        if(!empty($_POST)){
            $user = new User();
            if($user->login()){
                $_SESSION['success'] = 'Вы успешно залогинились';
            }else{
                $_SESSION['error'] = 'Логин или пароль введены неверно';
            }
            redirect('/');
        }
        View::setMeta('Вход');
    }

    public function logoutAction()
    {
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
            redirect('/user/login');
        }
    }
}