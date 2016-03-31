<?php
$connection = new \PDO("mysql:host=localhost;dbname=blog", 'root', 'vagrant', [
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
]);
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Блог</title>
    <div>
        <form method="post">
            Заголовок<br>
            <input type="text" name="title"><br>
            Тело<br>
            <textarea name="body" cols="100" rows="5"></textarea><br>
            <input type="submit" value="Запостить">
        </form>
    </div>

        <form method="post">
            Email:<br>
            <input type="text" name="email"><br>
            Пароль:<br>
            <input type="password" name="pass"><br>
            <input type="submit" value="Авторизоваться">
        </form>

    <div>

        <?php
        // Начало метода добавления в базу данных ---------------------------------------------------------------
        if (!empty($_POST['title']) && !empty($_POST['body'])) {

            $sql = $connection->prepare(
                "INSERT INTO blog_data(`title`,`body`, `autor_id`) VALUES (:_title, :_body, 2);");
            if ($sql->execute([':_title'=>$_POST['title'], ':_body'=>$_POST['body']]))
                echo "Записано в базу";
            else
                echo 'ошибка';
        }
        if (!empty($_POST['email']) && !empty($_POST['pass']))
        {
            $sql = $connection->prepare(" SELECT * FROM `users` WHERE `email`=:_email AND `password`=:_pass");
            $sql->execute([':_email'=>$_POST['email'], ':_pass'=>md5($_POST['pass'])]);

            if(!empty($sql->fetchAll()))
            {echo "Авторизован".PHP_EOL;}
            else
            {echo "Неправильный логин или пароль".PHP_EOL;}
        }
        $row = $connection->query("SELECT `title`, `body`, `created` FROM blog_data ORDER BY `id` DESC");
        // конец метода добавления в базу данных ----------------------------------------------------------------
        foreach ($row as $item => $value):
            ?>
            <h1>
                <?= htmlspecialchars($value['title']); ?>
            </h1>
            <br>
            <div>
                <?= htmlspecialchars($value['body']); ?>
            </div>
            <br>
            <div style="position: relative">
            <p style="font-size: 12; text-align: right"><?= $value['created']; ?></p>
            </div>
            <hr>
        <?php endforeach ?>
    </div>

</head>
</html>


