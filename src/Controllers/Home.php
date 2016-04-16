<?php namespace Epic\Controllers;


use Epic\Lib;

class Home extends Controller
{
    private $MessPerPage = 10;
    
    public function getHome()
    {

        if (empty($_SESSION['authorisation'])) {
            header("Location:http://192.168.100.220/?action=login");
        }

        echo Lib\template('templates/head.php', [
            'title' => "Это ваш личный блог! {$_SESSION['user']}",
        ]);

        echo Lib\template('templates/authorisation.php', [
            'authorisation' => $_SESSION["authorisation"],
            'user'          => $_SESSION["user"],
            'id'            => $_SESSION["id"],
            'alert'         => $_SESSION["wrong_user_alert"],
            'site_url'      => 'http://192.168.100.220/',
        ]);


        $count = Lib\GetNewsCount($this->connection, $_SESSION['id']);
        $this->MessPerPage = 10;
        $pages = ceil($count / $this->MessPerPage);
        empty($_GET['page']) ? $page = 1 : $page = (int)$_GET['page'];

        if ($page <= $pages) {
            $i = ($page - 1) * $this->MessPerPage;
            $data = Lib\GetNews($this->connection, $i, $this->MessPerPage);
        echo Lib\template('templates/Blog.php', [
            'authorisation' => $_SESSION["authorisation"],
            'data'          => $data,
            'pages'         => $pages,
            'page'          => $page,
        ]);
        }
    }

    public function postHome()
    {

    }
}