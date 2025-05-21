<?php

use App\Controller\CharacterController;
use App\Controller\TypeController;

$router->get('/personnages', CharacterController::class .'@list');
$router->get('/personnage/{name}', CharacterController::class .'@show');
$router->post('/personnage/create', CharacterController::class .'@new');
$router->patch('/personnage/update/{name}', CharacterController::class .'@update');
$router->delete('/personnage/{name}', CharacterController::class .'@delete');

$router->get('/types', TypeController::class .'@list');
$router->get('/type/{id}', TypeController::class .'@show');
$router->post('/type/create', TypeController::class .'@new');
$router->patch('/type/update/{id}', TypeController::class .'@update');
$router->delete('/type/{id}', TypeController::class .'@delete');