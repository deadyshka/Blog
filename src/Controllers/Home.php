<?php namespace Epic\Controllers;


use Epic\Lib;

class Home extends Controller
{
    private $MessPerPage = 10;

    public function getHome()
    {
        $title = null;
        if (empty($_SESSION['authorisation'])) {
            header("Location:http://192.168.100.220/?action=login");
        }

        if (empty($_GET)) {
            $_SESSION['blog_id'] = $_SESSION['id'];
        }
        if (!empty($_GET['user_id'])) {
            $_SESSION['blog_id'] = $_GET['user_id'];
        }

        $UserData = Lib\GetUserById($this->connection, $_SESSION['blog_id']);

        $UserData['id'] == $_SESSION["id"] ? $title = 'Привет!' : $title = 'Это блог: ';
        echo Lib\template('templates/tmp_head.php', [
            'title' => "{$title} {$UserData['email']}",
        ]);

        echo Lib\template('templates/tmp_authorisation.php', [
            'authorisation' => $_SESSION["authorisation"],
            'user'          => $_SESSION["user"],
            'id'            => $_SESSION["id"],
            'alert'         => $_SESSION["wrong_user_alert"],
            'site_url'      => 'http://192.168.100.220/',
        ]);


        $count = Lib\GetNewsCount($this->connection, $_SESSION['blog_id']);
        $pages = ceil($count / $this->MessPerPage);
        empty($_GET['page']) ? $page = 1 : $page = (int)$_GET['page'];

        if ($page <= $pages) {
            $i = ($page - 1) * $this->MessPerPage;
            $data = Lib\GetNews($this->connection, $i, $this->MessPerPage, $_SESSION['blog_id']);
            echo Lib\template('templates/tmp_Blog.php', [
                'authorisation' => $_SESSION["authorisation"],
                'data'          => $data,
                'pages'         => $pages,
                'page'          => $page,
                'connection'    => $this->connection,
            ]);
        }
    }

    public function postHome()
    {

    }
}