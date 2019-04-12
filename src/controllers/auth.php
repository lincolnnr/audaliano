<?php

use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/login', function () use ($app){
        $view = $app->service('view.renderer');
        $repository = $app->service('users.repository');
        $users = $repository->all();
        return $view->render('auth/login.html.twig',
            ['users' => $users]);
    },'auth.show_login_form')
    ->post('/login', function (ServerRequestInterface $request) use($app){
        $app->service('auth')->login();
//        $data = $request->getParsedBody();
//        $repository = $app->service('users.repository');
//        $repository->create($data);
//        return $app->route('users.list');
    }, 'auth.login');