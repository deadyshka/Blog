<?php namespace Epic;

require 'Lib.php';
require 'Controllers/Controller.php';
require 'Controllers/Home.php';
require 'Controllers/Login.php';
require 'Controllers/CreateNewNote.php';
require 'Controllers/EditNote.php';
require 'Controllers/Registration.php';

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);


Lib\connection(['host' => 'localhost', 'dbname' => 'blog', 'user' => 'root', 'password' => 'vagrant', 'encoding' => 'utf8']);
Lib\routes($_SERVER['REQUEST_URI'], [
    'Home'          => 'Epic\Controllers\Home',
    'login'         => 'Epic\Controllers\Login',
    'logout'        => 'Epic\Controllers\Logout',
    'registration'  => 'Epic\Controllers\Registration',
    'EditNote'      => 'Epic\Controllers\EditNote',
    'CreateNewNote' => 'Epic\Controllers\CreateNewNote',
]);










