<?php
$pdo =new PDO("mysql:host=localhost;dbname=blog;charset=utf8","root","vagrant");
$statement =$pdo->query("select *from blog_data");
?>


<html>
<head>
    <meta charset="utf-8">
    <title>Блог</title>
    <div>
        <form>
            Заголовок<br>
            <input type="text" name="title"><br>
            Тело<br>
            <input type="text" name="body" size="100"><br>
             <input type="button" size="20" value="Запостить">
        </form>
    </div>
    <div>
    <?php
        $row = $statement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($row as $item=>$value)
        {
            echo "<h1>.{$value['title']}</h1><br><div>{$value['body']}</div><hr>";
        }

        ?>
    </div>

</head>
</html>


