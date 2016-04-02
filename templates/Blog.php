<html>
    <meta charset="utf-8">
    <title>Блог</title>
    <?php require 'head.php'; ?>
    <br>
    <table align="center">
        <tr>
            <?php if ($_SESSION["authorisation"]): ?>
            <form method="post" action="CreateNewNote.php">
                <input type="submit" name="btn_create_new_note" value="Создать запись">
            </form>
            <td colspan="2" width="900" height="100" align="center">
                <?php

                while ($output = $data->fetch()):
                ?>
            </td>

        <tr>
            <h1><?= htmlspecialchars($output['title']); ?></h1>
            <br>
            <?= htmlspecialchars($output['body']); ?>
            <br>
            <p style="text-align: right; font-size: 10px"><?= $output['created']; ?></p>
            <hr>
        </tr>
        <?php endwhile; endif; ?>

        </tr>
    </table>


</html>
