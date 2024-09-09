<?php

namespace Artur\Twitter\Controllers;

use Artur\Twitter\Core\Request;
use Artur\Twitter\Models\User;
use Artur\Twitter\View\View;
use Artur\Twitter\Helpers\Auth;

use Exception;
use Ramsey\Uuid\Uuid;

class AuthController {
    public function index() {
        View::render('auth.index');
    }

    public function authorization() {
        Request::isPostMethod();
        $email = Request::post('email');    
        $login = Request::post('login');
        $password = Request::post('password');
        
        $user = new User; //хранит экземпляр класса user
        $user->username = $login; //доступ к свойству username $login хранит имя пользователя 
        $user->password = $password; //доступ к свойству password $password хранит пароль
        

        if($user->canAuthorize()) {
            $uuid = Uuid::uuid4();        
            setcookie('UUID', $uuid->toString(), time() + 60*60*24, '/');               
            $user->updateUuid($uuid);        
            header('Location: /main');
        } else {
            View::render('auth.index');
        }
    }

    public function logout() {
        setcookie('UUID', '', time() - 3600, '/');
        header('Location: /auth');
    }
}
