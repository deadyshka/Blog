<?php namespace Epic\Controllers;


use Epic\Lib;

class Home extends Controller
{
    public function getHome()
    {
        if (empty($_SESSION['authorisation']))
        {
            header("Location:http://192.168.100.220/?action=login");
        }

        echo Lib\template('templates/head.php', [
            'title' => "Это ваш личный блог! {$_SESSION['user']}",
        ]);

        echo Lib\template('templates/authorisation.php', [
            'authorisation' => $_SESSION["authorisation"],
            'user'          => $_SESSION["user"],
            'id'            => $_SESSION["id"],
            'alert'         => $_SESSION["wrong_user_alert"],
            'site_url'      => 'http://192.168.100.220/',
        ]);

        $row = Lib\GetNews(Lib\connection());

        echo Lib\template('templates/Blog.php', [
            'authorisation' => $_SESSION["authorisation"],
            'data'          => $row,
            'site_url'      => 'http://192.168.100.220/',
        ]);

    }
    
    public function postHome()
    {
        
    }
}