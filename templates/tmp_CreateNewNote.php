<?php require './head.php'; ?>
    <meta charset="utf-8">
    <title>Добавить новую запись</title>
    <br>
    <?php if($authorisation): ?>
        <table>
            <form method="post">
                Заголовок<br>
                <input type="text" name="title"><br>
                Тело<br>
                <textarea name="body" cols="100" rows="5"></textarea><br>
                <input type="submit" value="Запостить">
                <input type="hidden" name="token" value="<?= $token ?>">
            </form>
        </table>
    <?php else:  ?>
    <div style="text-align: left">
        <h1>Для добавления записи нужно авторизоватся</h1>
    </div>
    <?php endif; ?>

