<?php
session_start();
require 'lib.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);


$connection = db_plug();
$action = empty($_GET['action']) ? 'home' : $_GET['action'];


switch ($action) {

    case 'home':

        if (isset($_SESSION['authorisation']) && $_SESSION['authorisation']) {
            echo template('templates/head.php', [
                'title' => "Это ваш личный блог! {$_SESSION['user']}",
            ]);

            echo template('templates/authorisation.php', [
                'authorisation' => $_SESSION["authorisation"],
                'user'          => $_SESSION["user"],
                'id'            => $_SESSION["id"],
                'alert'         => $_SESSION["wrong_user_alert"],
                'site_url'      => 'http://192.168.100.220/',
            ]);

            $row = $connection->prepare("SELECT * FROM blog_data WHERE `autor_id`=:_id ORDER BY `id` DESC ");
            $row->execute([':_id' => $_SESSION["id"]]);

            echo template('templates/Blog.php', [
                'authorisation' => $_SESSION["authorisation"],
                'data'          => $row,
                'site_url'      => 'http://192.168.100.220/',
            ]);

        } else {
            header("Location:http://192.168.100.220/?action=login");
        }

        break;

    case 'CreateNewNote':
        if (isset($_SESSION['authorisation']) && $_SESSION['authorisation']) {
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

            if (!empty($_POST['title']) && !empty($_POST['body']) && valid_token($_POST['token'])) {
                $sql = $connection->prepare(
                    "INSERT INTO blog_data(`title`,`body`, `autor_id`) VALUES (:_title, :_body, :_id);");
                if ($sql->execute([':_title' => $_POST['title'], ':_body' => $_POST['body'], ':_id' => $_SESSION['id']])) {
                    header("Location:http://192.168.100.220/");
                } else
                    echo 'ошибка';

            }

            echo template('templates/tmp_CreateNewNote.php', [
                'authorisation' => $_SESSION['authorisation'],
                'token'         => get_token(),
            ]);
        } else {
            header("Location:http://192.168.100.220/");
        }
        break;

    case 'login':

        echo template('templates/head.php', [
            'title' => "Войти",
        ]);

        echo template('templates/authorisation.php', [
            'authorisation' => false,
            'user'          => null,
            'id'            => null,
            'alert'         => isset($_SESSION['wrong_user_alert']) ? $_SESSION['wrong_user_alert'] : false,
            'site_url'      => 'http://192.168.100.220/',
        ]);
        if (!empty($_POST['email']) && !empty($_POST['pass'])) {
            if (authorisation($_POST['email'], $_POST['pass'])) {
                header("Location:http://192.168.100.220/");
            }
        }
        break;

    case 'logout':

        logout();
        break;

    case 'registration':

        echo template('templates/head.php', [
            'title' => "Регистрация",
        ]);

        if (!empty($_POST["email"]) && !empty($_POST["pass"])) {
            $sql = $connection->prepare(" SELECT * FROM `users` WHERE `email`=:_email");
            $sql->execute([':_email' => $_POST['email']]);
            if (empty($data = $sql->fetchAll())) {
                $sql = $connection->prepare(" INSERT INTO `users`(`email`,`password`) VALUES (:_email, :_pass)");
                $sql->execute([':_email' => $_POST['email'], ':_pass' => md5($_POST['pass'])]);
                $_SESSION["reg_success"];
                header("Location:http://192.168.100.220/");
            } else {
                echo "Такой email уже зарегистрирован";
            }
        }
        echo template('templates/tmp_Registration.php', [
            'authorisation' => false,
            'alert'         => false,
        ]);
        break;

    case 'EditNote':
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
            $sql = $connection->prepare(
                "SELECT `title`, `body` FROM blog_data WHERE `id`=:_id");
            if ($sql->execute([':_id' => $_POST['note_id']])) {
                $data = $sql->fetch();
                echo template('templates/tmp_EditNote.php', [
                    'authorisation' => $_SESSION['authorisation'],
                    'title'         => $data['title'],
                    'body'          => $data['body'],
                    'note_id'       => $_POST['note_id'],
                    'token'         => get_token(),
                    'site_url'      => 'http://192.168.100.220/',
                ]);
            } else
                echo 'ошибка';
        } else {
            header("Location:http://192.168.100.220/");
        }
        break;

    case 'EditApply':
        if (!empty($_POST['Edit']) && !empty($_POST['note_id']) && !empty($_POST['token']) && ($_SESSION['token'] == $_POST['token'])) {
                var_dump($_POST['note_id']);
                $sql = $connection->prepare(
                    "UPDATE blog_data SET `title`=:_title, `body`=:_body, `updated`= NOW() WHERE `id`=:_id;");
                if ($sql->execute([':_title' => $_POST['title'],
                                   ':_body'  => $_POST['body'],
                                   ':_id'    => $_POST['note_id']])
                ) {
                    header("Location:http://192.168.100.220/");
                }


            if (!empty($_POST['Delete']) && !empty($_POST['note_id']) && $_SESSION['token'] == $_POST['token']) {
                $sql = $connection->prepare(
                    "UPDATE blog_data  SET `deleted`=TRUE WHERE `id`=:_id;");
                if ($sql->execute([':_id' => $_POST['note_id']])) {
                    header("Location:http://192.168.100.220/");
                }
            }
        } else {
            header("Location:http://192.168.100.220/");
        }
        break;
}










