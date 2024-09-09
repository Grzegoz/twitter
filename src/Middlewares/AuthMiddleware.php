<?php

namespace Artur\Twitter\Middlewares;

use Artur\Twitter\Core\Database;
use Artur\Twitter\Exceptions\RedirectException;
use Artur\Twitter\Helpers\Auth;
use Artur\Twitter\Models\User;

class AuthMiddleware implements IMiddleware
{
    public function middleware()
    {
        if (!isset($_COOKIE['UUID'])) {
            throw new RedirectException('/auth');
        }
        $uuid = $_COOKIE['UUID'];
        $user = User::findByUuid($uuid);
        if($user === null) {
            throw new RedirectException('/auth');
        }
        Auth::setUser($user);
    }
}




