<?php 

namespace Artur\Twitter\Helpers;

use Artur\Twitter\Models\User;
use Exception;

class Auth {
    private static ?User $user = null;

    public static function setUser(User $user) {
        self::$user = $user;
    }

    public static function getUser() {
        if(self::$user === NULL) {
            throw new Exception('No authorized user');
        }
        
        return self::$user;
        
    }    
    //если пользов нет а кто то вызвал гет юзер а там нул то нужно бросать экспе
}







//1-oe будет хранить авторизованного пользователя 2-oe логическая ошибка в роутере 