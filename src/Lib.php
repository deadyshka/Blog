<?php namespace Epic\Lib;

/**
 * Подключение БД
 * @param array $config
 * @return \PDO
 */
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

/**
 * Авторизация
 * @param \PDO|null $connection
 * @param null $email
 * @param null $pass
 * @return bool
 */
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
 * Разлогинится
 * @param $logout
 */
function logout()
{
    session_destroy();
    header("Location:http://192.168.100.220/");
    die();
}

/**
 * Сгенерировать токен
 * @return mixed
 */
function get_token()
{
    $token = uniqid();
    $_SESSION['token'] = $token;

    return $token;
}

/**
 * Проверка токена
 * @param $token
 * @return bool
 */
function valid_token($token)
{
    return !empty($_SESSION['token']) && $token == $_SESSION['token'];
}

/**
 * Нарисовать шаблон
 * @param $name
 * @param array $vars
 * @return mixed
 */
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

/**
 * Получить все новости
 * @param \PDO $connection
 * @param $number
 * @param $count
 * @return bool|\PDOStatement
 */
function GetNews(\PDO $connection, $number, $count, $id)
{
    if ($number >= 0 && $count >= 0) {
    $row = $connection->prepare("SELECT * FROM blog_data WHERE `autor_id`=:_id AND `deleted`=FALSE ORDER BY `id` DESC LIMIT {$number},{$count}");
        $row->execute([':_id' => $id]);
    return $row;
    } else {
        return false;
    }
}

/**
 * Создать новость
 * @param \PDO $connection
 */
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

/**
 * Получить новость по id
 * @param \PDO $connection
 * @return mixed
 */
function GetNew(\PDO $connection, $id)
{
    $sql = $connection->prepare(
        "SELECT * FROM blog_data WHERE `id`=:_id");
    $sql->execute([
        ':_id' => $id,
    ]);

    return $sql->fetch();

}

/**
 * Применить изменения в записи
 * @param \PDO $connection
 */
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

/**
 * Удалить новость
 * @param \PDO $connection
 */
function DeleteNew (\PDO $connection)
{
    $sql = $connection->prepare(
        "UPDATE blog_data  SET `deleted`=TRUE WHERE `id`=:_id;");
    if ($sql->execute([':_id' => $_POST['note_id']])) {
        header("Location:http://192.168.100.220/");
    }
}

/**
 * Регистрация
 * @param \PDO $connection
 */
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

/**
 * Количество новостей пользователя
 * @param \PDO $connection
 * @param $id
 * @return int
 */
function GetNewsCount(\PDO $connection, $id)
{
    $sql = $connection->prepare('SELECT count(*) FROM blog_data WHERE `deleted`=false AND `autor_id`=:id');
    $sql->execute([':id' => $id]);
    $data = $sql->fetch();

    return (int)$data['count(*)'];
}

function GetUsersList(\PDO $connection)
{
    $sql = $connection->prepare('SELECT `email`, `id` FROM users WHERE `deleted`=false ORDER BY `id` DESC');
    $sql->execute();

    return $sql;
}

function GetUserById(\PDO $connection, $id)
{
    $sql = $connection->prepare('SELECT * FROM users WHERE `deleted`=false AND `id`=:id');
    $sql->execute([':id' => $id]);
    $data = $sql->fetch();

    return $data;
}

function AddComment(\PDO $connection, $note_id, $body, $autor_id, $autor_name)
{

    $sql = $connection->prepare(
        'INSERT INTO comments(`message_id`,`body`, `autor_id`, `autor_name`) 
                VALUES (:note_id, :body, :autor_id, :autor_name)');
    if ($sql->execute([':note_id' => $note_id, ':body' => $body, ':autor_id' => $autor_id, ':autor_name' => $autor_name])) {
        return;
    } else {
        echo 'ошибка';
    }
}

function GetComments(\PDO $connection, $id)
{
    $sql = $connection->prepare('SELECT * FROM comments WHERE `message_id`=:id');
    $sql->execute([':id' => $id]);

    return $sql;
}

function GetCommentsCount(\PDO $connection, $id)
{
    $sql = $connection->prepare('SELECT count(*) FROM comments WHERE `message_id`=:id');
    $sql->execute([':id' => $id]);
    $data = $sql->fetch();

    return (int)$data['count(*)'];
}