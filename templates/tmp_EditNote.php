<!DOCTYPE html>
<html lang="en">
<title>Отредактировать новость</title>
<br>
<?php if ($authorisation): ?>

        <form method="post" style="position: absolute; top: 100px; left: 20px">
            Заголовок<br>
            <input type="text" name="title" value="<?= $title ?>"><br>
            Тело<br>
            <textarea name="body" cols="100" rows="5"><?= $body ?></textarea><br>
            <input type="submit" name="Edit" value="Сохранить изменения">
            <input type="submit" name="Delete" value="Удалить новость">
            <input type="hidden" name="token" value="<?= $token ?>">
            <input type="hidden" name="note_id" value="<?= $note_id ?>">
        </form>

<?php else: ?>
    <div style="text-align: left">
        <h1>Для редактирования нужно авторизоватся</h1>
    </div>
<?php endif; ?>
</html>
