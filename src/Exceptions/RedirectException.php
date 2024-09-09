<?php 

namespace Artur\Twitter\Exceptions;

use Exception;

class RedirectException extends Exception {
    protected $url;

    public function __construct($url) //конструктор это обычная функция которая вызвается при создании бъекта когда пишу new
    {
        $this->url = $url;
    }

    public function getUrl() {
        return $this->url;
    }
}