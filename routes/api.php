<?php

use App\Controller\TypeController;

$router->get('/types', TypeController::class .'@list');
$router->get('/type/{id}', TypeController::class .'@show');
$router->post('/type', TypeController::class .'@new');
$router->patch('/type/{id}', TypeController::class .'@update');
$router->delete('/type/{id}', TypeController::class .'@delete');