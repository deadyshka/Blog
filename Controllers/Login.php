<?php namespace Epic\Controllers;

use Epic\Lib;

class Login extends Controller
{

public function getLogin()
    {
        echo Lib\template('templates/head.php', [
            'title' => "Войти",
        ]);

        echo Lib\template('templates/authorisation.php', [
            'authorisation' => false,
            'user'          => null,
            'id'            => null,
            'alert'         => isset($_SESSION['wrong_user_alert']) ? $_SESSION['wrong_user_alert'] : false,
            'site_url'      => SITE_URL,
        ]);

    }

    public function postLogin()
    {

        if (!empty($_POST['email']) && !empty($_POST['pass'])) {
            if (Lib\authorisation(Lib\connection(), $_POST['email'], $_POST['pass'])) {
                header("Location:http://192.168.100.220/");
            }
        }
        if (!empty($_POST['btn_logout'])){
            Lib\logout();
        }
    }
}