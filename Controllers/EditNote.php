<?php

class EditNote extends Controller
{
    public function getEditNote()
    {

    }
    public function postEditNote()
    {

        if (!empty($_POST['btn_edit_note']) && !empty($_POST['note_id'])) {
            echo template('templates/head.php', [
                'title' => "Отредактировать новость",
            ]);

            echo template('templates/authorisation.php', [
                'authorisation' => $_SESSION['authorisation'],
                'user'          => $_SESSION['user'],
                'id'            => $_SESSION['id'],
                'alert'         => $_SESSION['wrong_user_alert'],
                'site_url'      => 'http://192.168.100.220/',

            ]);

            $data = GetNew(connection());
            echo template('templates/tmp_EditNote.php', [
                'authorisation' => $_SESSION['authorisation'],
                'title'         => $data['title'],
                'body'          => $data['body'],
                'note_id'       => $_POST['note_id'],
                'token'         => get_token(),
                'site_url'      => 'http://192.168.100.220/',
            ]);
        } else {

            header("Location:http://192.168.100.220/");
        }

        if (!empty($_POST['Edit']) && !empty($_POST['note_id']) && !empty($_POST['token']) && ($_SESSION['token'] == $_POST['token'])) {
            ApplyEditNew(connection());
        }

            if (!empty($_POST['Delete']) && !empty($_POST['note_id']) && $_SESSION['token'] == $_POST['token']) {
                DeleteNew(connection());
            }
        
    }
}