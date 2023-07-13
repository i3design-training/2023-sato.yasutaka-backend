<?php

declare(strict_types=1);

use Slim\App;
use Slim\Routing\RouteCollectorProxy as Group;

//CORSの設定
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Headers: Content-Type");

return function (App $app) {
    $app->get('/', \App\Action\HomeAction::class)->setName('home');
    $app->get('/hello/{name}', \App\Action\HelloAction::class)->setName('hello');
    $app->post('/send-email',  \App\Action\SendEmailAction::class);
    $app->group('/api', function (Group $group) {
        $group->get('/users', \App\Action\UserListAction::class)->setName('users');
        $group->get('/users/{id}', \App\Action\UserReadAction::class)->setName('user');
        $group->post('/users', \App\Action\UserCreateAction::class);
        $group->put('/users/{id}', \App\Action\UserUpdateAction::class);
        $group->delete('/users/{id}', \App\Action\UserDeleteAction::class);
        $group->post('/users/complete/verify', \App\Action\TokenCheckAction::class)->setName('tokencheck');
        $group->post('/users/login', \App\Action\LoginCheckAction::class)->setName('logincheck');
    });
};
