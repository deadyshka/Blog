<?php
require 'Lib.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

//
$connection = connection(['host' => 'localhost', 'dbname' => 'blog', 'user' => 'root', 'password' => 'vagrant', 'encoding' => 'utf8']);
routes($_SERVER['REQUEST_URI'],[
    'Home' => 'Home',
    'login' => 'Login',
    'logout' => 'Logout',
    'registration' => 'Registration',
    'EditNote' => 'EditNote',
    'CreateNewNote' => 'CreateNewNote',
]);










