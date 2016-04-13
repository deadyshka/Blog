<?php

;

class CreateNewNote extends Controller
{
    public function getCreateNewNote()
    {


    }
    public function postCreateNewNote()
    {
        if (empty($_SESSION['authorisation']))
        {
            header("Location:http://192.168.100.220/?action=login");
        }
        echo template('templates/head.php', [
            'title' => "Оставить сообщение",
        ]);

        echo template('templates/authorisation.php', [
            'authorisation' => $_SESSION['authorisation'],
            'user'          => $_SESSION['user'],
            'id'            => $_SESSION['id'],
            'alert'         => $_SESSION['wrong_user_alert'],
            'site_url'      => 'http://192.168.100.220/',

        ]);
        
        CreateNewNote(connection());

        echo template('templates/tmp_CreateNewNote.php', [
            'authorisation' => $_SESSION['authorisation'],
            'token'         => get_token(),
        ]);
    }
}