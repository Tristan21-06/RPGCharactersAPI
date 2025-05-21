<?php

use App\Controller\CharacterController;
use App\Controller\TypeController;

$router->get('/personnages', CharacterController::class .'@list');
$router->get('/personnage/{name}', CharacterController::class .'@show');
$router->post('/personnage', CharacterController::class .'@new');
$router->patch('/personnage/{name}', CharacterController::class .'@update');
$router->delete('/personnage/{name}', CharacterController::class .'@delete');

$router->get('/types', TypeController::class .'@list');
$router->get('/type/{id}', TypeController::class .'@show');
$router->post('/type', TypeController::class .'@new');
$router->patch('/type/{id}', TypeController::class .'@update');
$router->delete('/type/{id}', TypeController::class .'@delete');