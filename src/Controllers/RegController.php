<?php

namespace Artur\Twitter\Controllers;

use Artur\Twitter\Core\Database;
use Artur\Twitter\Models\User;
use Artur\Twitter\View\View;
use Artur\Twitter\Core\Request;


use Exception;

class RegController {
    public function index() {
        View::render('signup.index');
    }

    public function registration() {
        if(!Request::isPostMethod()) {
            return;
        }

        $email = Request::post('email');
        $login = Request::post('login');
        $password = Request::post('password');

        $user = new User;
        $user->username = $login;
        $user->email = $email;
        $user->password = $password;

        if(!$user->validate()) {
            View::render('signup.index', ['errors' => $user->getErrors()]);
            return;
        }

        $user->save();
        header("Location: /auth");
    }
}


















// $user = new User;
//             $user->username = $login;
//             $user->email = $email;
//             $user->password = $password;
//             $user->save();