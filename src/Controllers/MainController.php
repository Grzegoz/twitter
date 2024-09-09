<?php

namespace Artur\Twitter\Controllers;

use Artur\Twitter\Helpers\Auth;
use Artur\Twitter\Core\Request;
use Artur\Twitter\Models\Post;
use Artur\Twitter\View\View;

class MainController
{

    public static function index()
    {
        $tweets = Post::allTweet();

        View::render('main.index', [
        
            'user' => Auth::getUser(),
            'tweets' => $tweets,
        ]);
    }

    public function tweet()
    {
        if (!Request::isPostMethod()) {
            return;
        }
        $tweet = Request::post('text');
       
        $post = new Post;
        $post->tweet = $tweet;

        $post->save();
        
        header("Location: /main");
    }
}




















//как сделать хештег ? хэштег это ссылка которая подсвечивает отсльные хэштэги с названиями 
//Реализация:
//1- когда пользователь пишет знак # извлекать слово и добавлять в бд
//2- сделать просто подсветку хештегов 3-поиск по хештегам делаю запрос в мою бд для получение всех твитов содержащий это тег 
//
//
//
//
//класс это шаблон а объекты это реализация шаблона
//Для обращения к свойствам и методам объекта внутри его класса применяется ключевое слово this
