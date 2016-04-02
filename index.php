<?php
include 'lib.php';
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
$connection = db_plug();
autorisation();
$row = $connection->prepare("SELECT `title`, `body`, `created` FROM blog_data WHERE `autor_id`=:_id ORDER BY `id` DESC ");
$row->execute([':_id'=>$_SESSION["id"]]);
?>

<html>
<head>
    <title>Блог</title>
    <meta charset="utf-8">
    <?php include 'head.php'; ?>
    <br>
    <table align="center">
        <tr>
            <?php if ($_SESSION["autorisation"]): ?>
            <form method="post" action="CreateNewNote.php">
                <input type="submit" name="btn_create_new_note" value="Создать запись">
            </form>
            <td colspan="2" width="900" height="100" align="center">
                <?php

                while ($output = $row->fetch()):
                ?>
        <tr>
            <h1><?= htmlspecialchars($output['title']); ?></h1>
            <br>
            <?= htmlspecialchars($output['body']); ?>
            <br>
            <p style="text-align: right; font-size: 10px"><?= $output['created']; ?></p>
            <hr>
        </tr>
        <?php endwhile; endif; ?>
        </td>
        </tr>
    </table>


</html>


