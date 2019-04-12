<?php

use Psr\Http\Message\ServerRequestInterface;

$app
    ->get('/empresas', function () use ($app){
        $view = $app->service('view.renderer');
        $repository = $app->service('empresas.repository');
        $empresas = $repository->all();
        return $view->render('empresas/list.html.twig',
            ['empresas' => $empresas]);
    },'empresas.list')
    ->get('/empresas/new', function () use ($app){
        $view = $app->service('view.renderer');
        return $view->render('empresas/create.html.twig');
    },'empresas.new')
    ->post('/empresas/store', function (ServerRequestInterface $request) use($app){
        $data = $request->getParsedBody();
        $repository = $app->service('empresas.repository');
        $repository->create($data);
        return $app->route('empresas.list');
    }, 'empresas.store')
    ->get('/empresas/{id}/edit', function (ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $repository = $app->service('empresas.repository');
        $id = $request->getAttribute('id');
        $empresa = $repository->find($id);
        return $view->render('empresas/edit.html.twig',
            ['empresa' => $empresa]);
    },'empresas.edit')
    ->post('/empresas/{id}/update', function (ServerRequestInterface $request) use ($app){
        $repository = $app->service('empresas.repository');
        $id = $request->getAttribute('id');
        $data = $request->getParsedBody();
        $repository->update($id,$data);
        return $app->route('empresas.list');
    },'empresas.update')
    ->get('/empresas/{id}/show', function (ServerRequestInterface $request) use ($app){
        $view = $app->service('view.renderer');
        $repository = $app->service('empresas.repository');
        $id = $request->getAttribute('id');
        $empresa = $repository->find($id);
        return $view->render('empresas/show.html.twig',
            ['empresa' => $empresa]);
    },'empresas.show')
    ->get('/empresas/{id}/delete', function (ServerRequestInterface $request) use ($app){
        $repository = $app->service('empresas.repository');
        $id = $request->getAttribute('id');
        $repository->delete($id);
        return $app->route('empresas.list');
    },'empresas.delete');