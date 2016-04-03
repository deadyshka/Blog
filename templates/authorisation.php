<div style="position: absolute; top:0; right:0; background-color: white; z-index: 10; opacity: 0.85">
    <?php if (!$authorisation): ?>
        <form method="post">
            Email:<br>
            <input type="text" name="email"><br>
            Пароль:<br>
            <input type="password" name="pass"><br>
            <input type="submit" value="Авторизоваться">
        </form>
        <form method="post" action="../Registration.php">
            <input type="submit" name="reg" value="Зарегистрироваться">
        </form>
        <?php if ($alert): ?>
            <div style="color: red; position: absolute; right: 0">
                Неверный пользователь или пароль
            </div>
            <?php $alert = false; endif; ?>
    <?php else: ?>
        <div style="position: absolute; right: 50px; top: 0px; width: 400px; color: whitesmoke; text-shadow: black 0 0 2px">
            Авторизован как:
            <?= $user . " Ваш id  : " . $id; ?>
        </div>
        <div style="position: absolute; right: 0px; top: 0px; color: blue">
            <form method="post" style="display: inline-block">
                <input type="submit" name="btn_logout" value="Выйти">
            </form>
        </div>

    <?php endif; ?>
</div>
