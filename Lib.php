<?php

require 'Controllers/Home.php';
require 'Controllers/Login.php';
require 'Controllers/CreateNewNote.php';
require 'Controllers/EditNote.php';
require 'Controllers/Registration.php';
//Подключение БД--------------------------------------------------------------------------------------------
function connection(array $config = [])
{
    static $connection;
    if (empty($connection)) {
        $connection = new \PDO("mysql:host={$config['host']};dbname={$config['dbname']}", $config['user'], $config['password'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$config['encoding']}"
        ]);
    }
    return $connection;

}

//Авторизация пользователя---------------------------------------------------------------------------------------------
function authorisation(\PDO $connection = null, $email= null, $pass = null)
{

    if (!empty($email) && !empty($pass)) {
        $sql = $connection->prepare(" SELECT * FROM `users` WHERE `email`=:_email AND `password`=:_pass");
        $sql->execute([':_email' => $_POST['email'], ':_pass' => md5($_POST['pass'])]);
        
        if (!empty($data = $sql->fetchAll())) {
            $_SESSION['authorisation'] = true;
            $_SESSION['user'] = $data[0]['email'];
            $_SESSION['id'] = $data[0]['id'];
            return true;
        } 
        else {
            $_SESSION['wrong_user_alert'] = true;
            return false;
        }
    }
}

/**
 * @param $logout
 */
function logout()
{
    session_destroy();
    header("Location:http://192.168.100.220/");
    die();
}

//Генерация токена-----------------------------------------------------------------------------------------------------
function get_token()
{
    $token = uniqid();
    $_SESSION['token'] = $token;

    return $token;
}

//Проверка токена------------------------------------------------------------------------------------------------
function valid_token($token)
{
    return !empty($_SESSION['token']) && $token == $_SESSION['token'];
}

//Шаблон---------------------------------------------------------------------------------------------------------
function template($name, array $vars = [])
{
    if (!is_file($name)) {
       // throw new Exception("Could not load template file {$name}");
    }
    ob_start();
    extract($vars);
    require($name);
    $contents = ob_get_contents();
    ob_end_clean();

    return $contents;
}
//Route
function routes($uri, $routes)
{
    $request = parse_url($uri);
    $params = [];
    if (!empty($request['query'])) {
        parse_str($request['query'], $params);
    }
    $action = empty($params['action']) ? 'Home' : $params['action'];
    if (isset($routes[$action])) {
        $controller = new $routes[$action]();
        return $controller->handle($action, empty($_SERVER['REQUEST_METHOD']) ? 'get' : $_SERVER['REQUEST_METHOD'], $params);
    }

    return false;
}
//Get news
function GetNews(\PDO $connection)
{
    $row = $connection->prepare("SELECT * FROM blog_data WHERE `autor_id`=:_id ORDER BY `id` DESC ");
    $row->execute([':_id' => $_SESSION["id"]]);
    return $row;
}
//Create New Note
function CreateNewNote(\PDO $connection)
{
    if (!empty($_POST['title']) && !empty($_POST['body']) && valid_token($_POST['token'])) {
        $sql = $connection->prepare(
            "INSERT INTO blog_data(`title`,`body`, `autor_id`) VALUES (:_title, :_body, :_id);");
        if ($sql->execute([':_title' => $_POST['title'], ':_body' => $_POST['body'], ':_id' => $_SESSION['id']])) {
            header("Location:http://192.168.100.220/");
        } else
            echo 'ошибка';
    }
}
//GetNew
function GetNew(\PDO $connection)
{
    $sql = $connection->prepare(
        "SELECT `title`, `body` FROM blog_data WHERE `id`=:_id");
    if ($sql->execute([':_id' => $_POST['note_id']])) {
        return $sql->fetch();
    }
}
//EditApply
function ApplyEditNew(\PDO $connection)
{
    $sql = $connection->prepare(
        "UPDATE blog_data SET `title`=:_title, `body`=:_body, `updated`= NOW() WHERE `id`=:_id;");
    if ($sql->execute([':_title' => $_POST['title'],
                       ':_body'  => $_POST['body'],
                       ':_id'    => $_POST['note_id']])
    ) {
        header("Location:http://192.168.100.220/");
    }
}
//deleteNew
function DeleteNew (\PDO $connection)
{
    $sql = $connection->prepare(
        "UPDATE blog_data  SET `deleted`=TRUE WHERE `id`=:_id;");
    if ($sql->execute([':_id' => $_POST['note_id']])) {
        header("Location:http://192.168.100.220/");
    }
}
//registration
function Registration (\PDO $connection)
{
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