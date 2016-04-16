<?php namespace Epic\Controllers;

use Epic\Lib;


class EditNote extends Controller
{
    public function getEditNote($data, $id)
    {
        if (empty($_SESSION['authorisation'])) {
            header("Location:http://192.168.100.220/?action=login");
        }
        echo Lib\template('templates/head.php', [
            'title' => "Отредактировать новость",
        ]);

        echo Lib\template('templates/authorisation.php', [
            'authorisation' => $_SESSION['authorisation'],
            'user'          => $_SESSION['user'],
            'id'            => $_SESSION['id'],
            'alert'         => $_SESSION['wrong_user_alert'],
            'site_url'      => 'http://192.168.100.220/',

        ]);


        echo Lib\template('templates/tmp_EditNote.php', [
            'authorisation' => $_SESSION['authorisation'],
            'title'         => $data['title'],
            'body'          => $data['body'],
            'note_id'       => $_POST['note_id'],
            'token'         => Lib\get_token(),
            'site_url'      => 'http://192.168.100.220/',
        ]);


    }

    public function postEditNote()
    {
        if (!empty($_POST['btn_edit_note']) && !empty($_POST['note_id'])) {
            $data = Lib\GetNew($this->connection, $_SESSION['id']);
            $this->getEditNote($data, $_POST['note_id']);
        } else {

            header(SITE_URL);
        }

        if (!empty($_POST['Edit']) && !empty($_POST['note_id']) && !empty($_POST['token']) && ($_SESSION['token'] == $_POST['token'])) {
            Lib\ApplyEditNew($this->connection);
        }

        if (!empty($_POST['Delete']) && !empty($_POST['note_id']) && $_SESSION['token'] == $_POST['token']) {
            Lib\DeleteNew($this->connection);
        }

    }
}