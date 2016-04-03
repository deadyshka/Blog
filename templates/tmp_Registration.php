<meta charset="utf-8">
<div >
        <form method="post" style="text-align: center">
            Email:<br>
            <input type="text" name="email"><br>
            Пароль:<br>
            <input type="password" name="pass"><br><br>
            <input type="submit" value="Зарегистрироватся">
        </form>
        <?php if ($alert): ?>
            <div style="color: red; position: absolute; right: 0">
                Неверный пользователь или пароль
            </div>
            <?php $alert = false; endif; ?>
</div>
