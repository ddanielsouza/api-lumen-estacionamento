<?php

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'users'], function () use ($router){
        $router->get('me', 'UserController@me');
        $router->post('register', 'UserController@register');
        $router->post('login', 'UserController@login');
    });

    $router->group(['prefix' => 'checkins'], function () use ($router){
        $router->post('register', 'CheckinController@register');
        $router->patch('/{idCheckin}', 'CheckinController@update');
        $router->get('/ativos', 'CheckinController@getCheckinsAtivos');
    });

    $router->group(['prefix' => 'configuracoes-estacionamentos'], function () use ($router){
        $router->post('register', 'ConfiguracaoEstacionamentoController@register');
        $router->patch('/{idConfiguracao}', 'ConfiguracaoEstacionamentoController@update');
        $router->get('/', 'ConfiguracaoEstacionamentoController@getAll');
    });
});