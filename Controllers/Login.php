<?php

class Login extends Controller
{

public function getLogin()
    {
        echo template('templates/head.php', [
            'title' => "Войти",
        ]);
        
        echo template('templates/authorisation.php', [
            'authorisation' => false,
            'user'          => null,
            'id'            => null,
            'alert'         => isset($_SESSION['wrong_user_alert']) ? $_SESSION['wrong_user_alert'] : false,
            'site_url'      => 'http://192.168.100.220/',
        ]);

    }

    public function postLogin()
    {
        echo template('templates/head.php', [
            'title' => "Войти",
        ]);
        if (!empty($_POST['email']) && !empty($_POST['pass'])) {
            if (authorisation(connection() ,$_POST['email'], $_POST['pass'])) {
                header("Location:http://192.168.100.220/");
            }
        }
        if (!empty($_POST['btn_logout'])){
            logout();
        }
    }
}