<?php

require_once __DIR__ . '/../vendor/autoload.php';

if (isset($_GET['pwdQuery'])) {
    include_once __DIR__ . '/../scripts/generate_hashed_password.php';
    die;
}else if (isset($_GET['pwdVerify'])) {
    include_once __DIR__ . '/../scripts/verify_hashed_password.php';
    die;
}

use App\Core\Router;

$router = new Router();

require_once __DIR__ . '/../routes/api.php';

header('Content-Type: application/json');
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);