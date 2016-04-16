<?php namespace Epic\Controllers;


use Epic\Lib;

class OtherBlogs extends Controller
{
    public function getOtherBlogs()
    {
        if (empty($_SESSION['authorisation'])) {
            header("Location:http://192.168.100.220/?action=login");
        }
        echo Lib\template('templates/head.php', [
            'title' => "Посмотрите блоги друзей! {$_SESSION['user']}",
        ]);

        echo Lib\template('templates/authorisation.php', [
            'authorisation' => $_SESSION["authorisation"],
            'user'          => $_SESSION["user"],
            'id'            => $_SESSION["id"],
            'alert'         => $_SESSION["wrong_user_alert"],
            'site_url'      => 'http://192.168.100.220/',
        ]);

    }

    public function posOtherBlogs()
    {

    }
}