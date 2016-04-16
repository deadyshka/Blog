<!DOCTYPE html>
<html lang="en">
<title>Добавить новую запись</title>
<br>
<?php if ($authorisation): ?>

    <form method="post" style="position: absolute; top: 100px; left: 20px">
        <label for="title" class="control-label">Заголовок</label>
        <input class="form-control" type="text" name="title" id="title"><br>
        <label for="body" class="control-label">Новость</label>
        <textarea class="form-control" name="body" id="body" cols="100" rows="5"></textarea><br>
        <input type="submit" value="Запостить">
        <input type="hidden" name="token" value="<?= $token ?>">
    </form>

<?php else: ?>
    <div style="text-align: left">
        <h1>Для добавления новости нужно авторизоватся</h1>
    </div>
<?php endif; ?>
</html>
