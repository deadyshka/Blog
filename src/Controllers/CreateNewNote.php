<?php namespace Epic\Controllers;


use Epic\Lib;

class CreateNewNote extends Controller
{
    public function getCreateNewNote()
    {
        if (empty($_SESSION['authorisation'])) {
            header(SITE_URL . '?action=login');
        }
        echo Lib\template('templates/tmp_head.php', [
            'title' => "Оставить сообщение",
        ]);
        echo Lib\template('templates/tmp_authorisation.php', [
            'authorisation' => $_SESSION['authorisation'],
            'user'          => $_SESSION['user'],
            'id'            => $_SESSION['id'],
            'alert'         => $_SESSION['wrong_user_alert'],
            'site_url'      => SITE_URL,
        ]);
        echo Lib\template('templates/tmp_CreateNewNote.php', [
            'authorisation' => $_SESSION['authorisation'],
            'token'         => Lib\get_token(),
        ]);
    }

    public function postCreateNewNote()
    {
        Lib\CreateNewNote($this->connection);
        header('Location:' . SITE_URL);
    }
}