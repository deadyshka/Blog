<?php namespace Epic;

require '../vendor/autoload.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
define('SITE_URL', 'http://192.168.100.220/');

Lib\connection(['host' => 'localhost', 'dbname' => 'blog', 'user' => 'root', 'password' => 'vagrant', 'encoding' => 'utf8']);
$router = new Route();
$router->handle($_SERVER['REQUEST_URI'], [
    'Home'          => 'Epic\Controllers\Home',
    'login'         => 'Epic\Controllers\Login',
    'logout'        => 'Epic\Controllers\Logout',
    'registration'  => 'Epic\Controllers\Registration',
    'EditNote'      => 'Epic\Controllers\EditNote',
    'CreateNewNote' => 'Epic\Controllers\CreateNewNote',
    'OtherBlogs'    => 'Epic\Controllers\OtherBlogs',
]);










