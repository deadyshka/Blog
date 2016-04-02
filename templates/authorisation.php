<div style="position: fixed; top:0; right:0; background-color: white; z-index: 10; opacity: 0.85">
    <?php if (!$authorisation): ?>
        <form method="post">
            Email:<br>
            <input type="text" name="email"><br>
            Пароль:<br>
            <input type="password" name="pass"><br>
            <input type="submit" value="Авторизоваться">
        </form>
        <?php if ($alert): ?>
            <div style="color: red; position: absolute; right: 0">
                Неверный пользователь или пароль
            </div>
            <?php $alert = false; endif; ?>
    <?php else: ?>
        <div style="position: absolute; right: 50px; top: 10px; width: 300px;">
            Авторизован как:
            <?= $user . " <br> id: " . $id; ?>
        </div>
        <div style="position: absolute; right: 5px; top: 5px">
            <form method="post" style="display: inline-block">
                <input type="submit" name="btn_logout" value="Выйти">
            </form>
        </div>

    <?php endif; ?>
</div>
