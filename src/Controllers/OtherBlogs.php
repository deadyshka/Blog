<?php namespace Epic\Controllers;


use Epic\Lib;

class OtherBlogs extends Controller
{

    public function getOtherBlogs()
    {
        if (empty($_SESSION['authorisation'])) {
            header("Location:http://192.168.100.220/?action=login");
        }
        echo Lib\template('templates/tmp_head.php', [
            'title' => "Посмотрите блоги друзей! {$_SESSION['user']}",
        ]);

        echo Lib\template('templates/tmp_authorisation.php', [
            'authorisation' => $_SESSION["authorisation"],
            'user'          => $_SESSION["user"],
            'id'            => $_SESSION["id"],
            'alert'         => $_SESSION["wrong_user_alert"],
            'site_url'      => 'http://192.168.100.220/',
        ]);

        $data = Lib\GetUsersList($this->connection);

        echo Lib\template('templates/tmp_OtherBlogs.php', [
            'data' => $data,
        ]);

    }

    public function postOtherBlogs()
    {

    }
}