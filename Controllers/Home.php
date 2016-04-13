<?php namespace Epic\Controllers;


use Epic\Lib;

class Home extends Controller
{
    public function getHome()
    {

        if (empty($_SESSION['authorisation']))
        {
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

        $MessPerPage = 5;
        $count = Lib\GetNewsCount(Lib\connection(), $_SESSION['id']);
        $pages = floor($count / $MessPerPage);

        if (!empty($_GET['page'])) {
            switch ($_GET['page']) {
                case 'PrevPage':
                    if (0 < $_SESSION['CurrentPage'])
                        $_SESSION['CurrentPage'] -= 1;
                    break;
                case 'NextPage':
                    if ($_SESSION['CurrentPage'] < $pages)
                        $_SESSION['CurrentPage'] += 1;
                    break;
            }
        }

        $i = $_SESSION['CurrentPage'] * $MessPerPage;
        $row = Lib\GetNews(Lib\connection(), $i, $MessPerPage);
        echo Lib\template('templates/Blog.php', [
            'authorisation' => $_SESSION["authorisation"],
            'data'          => $row,
            'site_url'      => 'http://192.168.100.220/',
            'pages'         => $pages + 1,
            'page'          => $_SESSION['CurrentPage'] + 1,
        ]);



    }
    
    public function postHome()
    {
        
    }
}