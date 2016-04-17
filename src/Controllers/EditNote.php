<?php namespace Epic\Controllers;

use Epic\Lib;


class EditNote extends Controller
{
    public function getEditNote($data, $id)
    {
        if (empty($_SESSION['authorisation'])) {
            header(SITE_URL . "?action=login");
        }
        echo Lib\template('templates/tmp_head.php', [
            'title' => "Отредактировать новость",
        ]);

        echo Lib\template('templates/tmp_authorisation.php', [
            'authorisation' => $_SESSION['authorisation'],
            'user'          => $_SESSION['user'],
            'id'            => $_SESSION['id'],
            'alert'         => $_SESSION['wrong_user_alert'],
            'site_url'      => SITE_URL,

        ]);


        echo Lib\template('templates/tmp_EditNote.php', [
            'authorisation' => $_SESSION['authorisation'],
            'title'         => $data['title'],
            'body'          => $data['body'],
            'note_id'       => $id,
            'token'         => Lib\get_token(),
            'site_url'      => SITE_URL,
        ]);


    }

    public function postEditNote()
    {
        if (!empty($_POST['Edit']) && !empty($_POST['note_id'])
            && !empty($_POST['token']) && ($_SESSION['token'] == $_POST['token'])
        ) {
            Lib\ApplyEditNew($this->connection);
            header('Location:' . SITE_URL);
            var_dump('che');
        }

        if (!empty($_POST['Delete']) && !empty($_POST['note_id']) && $_SESSION['token'] == $_POST['token']) {
            Lib\DeleteNew($this->connection);
            header('Location:' . SITE_URL);
        }

        if (!empty($_POST['btn_edit_note']) && !empty($_POST['note_id'])) {
            $data = Lib\GetNew($this->connection, $_POST['note_id']);
            $this->getEditNote($data, $_POST['note_id']);

        } else {
            header('Location:' . SITE_URL);
        }



    }
}