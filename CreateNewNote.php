<?php
include 'lib.php';
?>
<html>
<head>
    <title>Добавить новую запись</title>
    <meta charset="utf-8">
    <?php include 'head.php'; ?>
    <br>
<?php
session_start();
autorisation();
$connection = db_plug();
if (!empty($_POST['title']) && !empty($_POST['body'])) {

    $sql = $connection->prepare(
        "INSERT INTO blog_data(`title`,`body`, `autor_id`) VALUES (:_title, :_body, 2);");
    if ($sql->execute([':_title' => $_POST['title'], ':_body' => $_POST['body']])) {
        header("Location:http://192.168.100.220/index.php");
    } else
        echo 'ошибка';

}
?>
<?php
if ($_SESSION["autorisation"]):
    ?>
    <table>
        <form method="post">
            Заголовок<br>
            <input type="text" name="title"><br>
            Тело<br>
            <textarea name="body" cols="100" rows="5"></textarea><br>
            <input type="submit" value="Запостить">
        </form>
    </table>
<?php else: ?>
    <div style="text-align: left">
        <h1>Для добавления записи нужно авторизоватся</h1>
    </div>
<?php endif; ?>

