<?php namespace Epic\Controllers;

use Epic\Lib;


class Registration extends Controller
{
    public function getRegistration()
    {
        echo Lib\template('templates/head.php', [
            'title' => "Регистрация",
        ]);
        echo Lib\template('templates/tmp_Registration.php', [
            'authorisation' => false,
            'alert'         => false,
        ]);
    }
    
    public function postRegistration()
    {


        if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
            Lib\Registration(Lib\connection());
            header(SITE_URL);
        } else {
            $this->getRegistration();
        }
    }
}