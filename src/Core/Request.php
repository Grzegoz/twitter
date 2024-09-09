<?php

namespace Artur\Twitter\Core;

use Artur\Twitter\Models\User;

class Request
{
    
    public static function isPostMethod()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function post($key)
    {
        if(isset ($_POST[$key])) {         
            return trim($_POST[$key]);
        }
    }
}
