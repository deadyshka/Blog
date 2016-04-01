<?php
include 'lib.php';
session_start();
$connection = db_plug();
// Ввод в базу данных новости ---------------------------------------------------------------

//-------------------------------------------------------------------------------------------
//Проверка авторизации пользователя ---------------------------------------------------------

//-------------------------------------------------------------------------------------------
//Logout-------------------------------------------------------------------------------------

//-------------------------------------------------------------------------------------------
$row = $connection->prepare("SELECT `title`, `body`, `created` FROM blog_data ORDER BY `id` DESC");
$row->execute();
?>

<html>
<head>
    <title>Блог</title>
    <meta charset="utf-8">
    <?php include 'head.php'; ?>
    <?php autorisation(); ?>

    <table align="center" >



    <tr>
        <?php if($_SESSION["autorisation"]): ?>
    <form method="post" action="CreateNewNote.php">
        <input type="submit" name="btn_create_new_note" value="Создать запись">
    </form>
        <td colspan="2" width="900" height="100" align="center">
        <?php
        endif;

        while($output=$row->fetch()):
        ?>
        <tr>
            <h1><?= htmlspecialchars($output['title']); ?></h1>
            <br>
            <?= htmlspecialchars($output['body']); ?>
            <br>
            <p style="text-align: right; font-size: 10px"><?= $output['created']; ?></p>
            <hr>
        </tr>

        <?php endwhile; ?>
        </td>

    </tr>
    </table>


</html>


