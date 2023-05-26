<?php

$router->add('',
    ['controller' => \App\Controllers\MainController::class, 'action' => 'index', 'method' => 'GET']);
$router->add('addmovie',
    ['controller' => \App\Controllers\MainController::class, 'action' => 'createForm', 'method' => 'GET']);
$router->add('updatemovie/{id:\d+}',
    ['controller' => \App\Controllers\MainController::class, 'action' => 'updateForm', 'method' => 'GET']);
$router->add('movies/{id:\d+}',
    ['controller' => \App\Controllers\MainController::class, 'action' => 'show', 'method' => 'GET']);


$router->add('create',
    ['controller' => \App\Controllers\MovieController::class, 'action' => 'create', 'method' => 'POST']);
$router->add('movie/delete/{id:\d+}',
    ['controller' => \App\Controllers\MovieController::class, 'action' => 'delete', 'method' => 'GET']);
$router->add('update/{id:\d+}',
    ['controller' => \App\Controllers\MovieController::class, 'action' => 'update', 'method' => 'POST']);