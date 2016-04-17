<?php namespace Epic\Controllers;

use Epic\Lib;

class Login extends Controller
{

    public function getLogin()
    {
        echo Lib\template('templates/tmp_head.php', [
            'title' => "Войти",
        ]);

        echo Lib\template('templates/tmp_authorisation.php', [
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
            if (Lib\authorisation($this->connection, $_POST['email'], $_POST['pass'])) {
                header(SITE_URL);
            }
        }
        if (!empty($_POST['btn_logout'])) {
            Lib\logout();
        }
    }
}