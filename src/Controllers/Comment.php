<?php namespace Epic\Controllers;


use Epic\Lib;

class Comment extends Controller
{

    public function getComment()
    {
        if (empty($_SESSION['authorisation'])) {
            header(SITE_URL . "?action=login");
        }
        echo Lib\template('templates/tmp_head.php', [
            'title' => "Оставь свой комментарий! {$_SESSION['user']}",
        ]);

        echo Lib\template('templates/tmp_authorisation.php', [
            'authorisation' => $_SESSION['authorisation'],
            'user'          => $_SESSION['user'],
            'id'            => $_SESSION['id'],
            'alert'         => $_SESSION['wrong_user_alert'],
            'site_url'      => SITE_URL,
        ]);
        $data = Lib\GetNew($this->connection, $_GET['mess_id']);
        $comments = Lib\GetComments($this->connection, $data['id']);
        $users = Lib\GetUsersList($this->connection);
        echo Lib\template('templates/tmp_Comment.php', [
            'title'         => 'Оставить комментарий',
            'authorisation' => $_SESSION["authorisation"],
            'output'        => $data,
            'comments'      => $comments,
            'users'         => $users->fetchAll(),
            'token'         => Lib\get_token(),
        ]);

    }

    public function postComment()
    {
        if ($_SESSION['token'] == $_POST['token'])
        Lib\AddComment($this->connection, $_POST['note_id'], $_POST['body'], $_SESSION['id'], $_SESSION['user']);
        $this->getComment();
    }
}