<?php

use Artur\Twitter\Core\Router;
use Artur\Twitter\Controllers\RegController;
use Artur\Twitter\Controllers\AuthController;
use Artur\Twitter\Controllers\MainController;
use Artur\Twitter\Middlewares\AuthMiddleware;

Router::add('auth', AuthController::class, 'index');
Router::add('authorization', AuthController::class, 'authorization');
Router::add('main', MainController::class, 'index', new AuthMiddleware);
Router::add('tweet', MainController::class, 'tweet', new AuthMiddleware);
Router::add('signup', RegController::class, 'index');
Router::add('registration', RegController::class, 'registration');
Router::add('logout', AuthController::class, 'logout');
Router::run();