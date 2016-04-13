<?php

class Registration extends Controller
{
    public function getRegistration()
    {
        
    }
    
    public function postRegistration()
    {
        echo template('templates/head.php', [
            'title' => "Регистрация",
        ]);

        if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
            Registration(connection());
        }
        echo template('templates/tmp_Registration.php', [
            'authorisation' => false,
            'alert'         => false,
        ]);
    }
}