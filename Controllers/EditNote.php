<?php namespace Epic\Controllers;

use Epic\Lib;


class EditNote extends Controller
{
    public function getEditNote()
    {

    }
    public function postEditNote()
    {

        if (!empty($_POST['btn_edit_note']) && !empty($_POST['note_id'])) {
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

            $data = Lib\GetNew(Lib\connection());
            echo Lib\template('templates/tmp_EditNote.php', [
                'authorisation' => $_SESSION['authorisation'],
                'title'         => $data['title'],
                'body'          => $data['body'],
                'note_id'       => $_POST['note_id'],
                'token'         => Lib\get_token(),
                'site_url'      => 'http://192.168.100.220/',
            ]);
        } else {

            header("Location:http://192.168.100.220/");
        }

        if (!empty($_POST['Edit']) && !empty($_POST['note_id']) && !empty($_POST['token']) && ($_SESSION['token'] == $_POST['token'])) {
            Lib\ApplyEditNew(Lib\connection());
        }

            if (!empty($_POST['Delete']) && !empty($_POST['note_id']) && $_SESSION['token'] == $_POST['token']) {
                Lib\DeleteNew(Lib\connection());
            }
        
    }
}