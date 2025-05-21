<?php

use App\Database\Db;

if (!isset($_REQUEST['pwd']) || !isset($_REQUEST['name'])) {
    include_once __DIR__. '/forms/password_verify.php';
    die();
}

$db = new Db();
$users = $db->select('users', where: ['name' => $_REQUEST['name']]);

if (!empty($users)) {
    if (password_verify($_REQUEST['pwd'], $users[0]['password'])) {
        echo 'Password is correct';
    } else {
        echo 'Password is incorrect';
    }
} else {
    echo 'No user found for name : ' . $_REQUEST['name'];
}