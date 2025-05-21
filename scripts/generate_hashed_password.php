<?php

if (!isset($_REQUEST['pwd'])) {
    include_once __DIR__. '/forms/password_hash.php';
    die();
}

echo password_hash($_REQUEST['pwd'], PASSWORD_DEFAULT);