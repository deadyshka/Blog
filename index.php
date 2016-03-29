<html>
<head>
    <meta charset="utf-8">
    <title>Блог</title>
    <div>
        <form method="post">
            Заголовок<br>
            <input type="text" name="title"><br>
            Тело<br>
            <textarea name="body" cols="100" rows="5">text test</textarea><br>
             <input type="submit" value="Запостить">
        </form>
        <?php
        global $title;
        global $body;
        if (isset($_POST['title']))
        {$title=$_POST['title'];}
        if (isset($_POST['body']))
        {$body=$_POST['body'];}
        ?>
    </div>
    <div>

    <?php
    $connection = new PDO("mysql:host=localhost;dbname=blog", 'root', 'vagrant', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]);
        $statement =$connection->query("select *from blog_data");
        if (isset($title)&&isset($body)) {
            $sql = "INSERT INTO blog_data(`title`,`body`, `autor_id`) VALUES ('$title', '{$body}', 2)";
            if ($connection->query($sql))
                echo "Записано в базу";
            else
                echo 'ошибка';
        }
        $row = $connection->query("SELECT `title`, `body` FROM blog_data ORDER BY `id` DESC");

        foreach ($row as $item=>$value)
        {
            echo "<h1>.{$value['title']}</h1><br><div>{$value['body']}</div><hr>";
        }

    ?>
    </div>

</head>
</html>


