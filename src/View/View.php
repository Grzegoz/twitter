<?php

namespace Artur\Twitter\View;

use Exception;

class View
{

    public static function render($viewFile, $data = [])
    {
        extract($data);
        $viewFile = strtolower($viewFile);
        $viewFile = explode('.', $viewFile);
        $view = __DIR__ . '/../templates/' . $viewFile[0] . '/' . $viewFile[1] . '.php';
        if(file_exists($view)) {
            ob_start();
            require_once $view;
            $content = ob_get_contents();
            ob_clean();

            require_once __DIR__ . '/../templates/layout.php';
        } else {
            throw new Exception(" \n Ошибка в пути к файлу");
        }
    }
}

//mb_strtolower, strtolower

// try catch в роутере, выдавать 404, если в контроллере что-то проиошло, выдавать 500 с текстом ошибки что тчо не так
