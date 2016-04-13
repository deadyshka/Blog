<?php namespace Epic\Controllers;

use Epic\Lib;


class Registration extends Controller
{
    public function getRegistration()
    {
        
    }
    
    public function postRegistration()
    {
        echo Lib\template('templates/head.php', [
            'title' => "Регистрация",
        ]);

        if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
            Lib\Registration(Lib\connection());
        }
        echo Lib\template('templates/tmp_Registration.php', [
            'authorisation' => false,
            'alert'         => false,
        ]);
    }
}