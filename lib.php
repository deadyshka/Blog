<?php
//Подключение БД--------------------------------------------------------------------------------------------
function db_plug()
{

    $connection = new \PDO("mysql:host=localhost;dbname=blog", 'root', 'vagrant', [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
        \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
    ]);
    return $connection;
}

//Авторизация пользователя---------------------------------------------------------------------------------------------
function autorisation()
{
     //Логика
    $connection = db_plug();
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {
        $sql = $connection->prepare(" SELECT * FROM `users` WHERE `email`=:_email AND `password`=:_pass");
        $sql->execute([':_email' => $_POST['email'], ':_pass' => md5($_POST['pass'])]);

        if (!empty($data = $sql->fetchAll())) {
            $_SESSION["autorisation"] = true;
            $_SESSION["user"] = $data[0]['email'];
        } else {
            $_SESSION["wrong_user_alert"] = true;
        }
    }
    if (!empty($_POST['btn_logout']))
        $_SESSION["autorisation"] = false;
    //Верстка
    ?>
    <div style="position: fixed; top:0; right:0; background-color: white; z-index: 10; opacity: 0.85">
    <?php if (!$_SESSION["autorisation"]): ?>
    <form method="post">
        Email:<br>
        <input type="text" name="email"><br>
        Пароль:<br>
        <input type="password" name="pass"><br>
        <input type="submit" value="Авторизоваться">
    </form>
    <?php if ($_SESSION["wrong_user_alert"]): ?>
        <div style="color: red; position: absolute; right: 0">
            Неверный пользователь или пароль
        </div>
        <?php $_SESSION["wrong_user_alert"] = false; endif; ?>
<?php else: ?>
    <div style="position: absolute; right: 50px; top: 10px; width: 300px;">
        Авторизован как:
        <?= $_SESSION["user"]; ?>
    </div>
    <div style="position: absolute; right: 5px; top: 5px">
        <form method="post" style="display: inline-block">
            <input type="submit" name="btn_logout" value="Выйти">
        </form>
    </div>

<?php endif; ?>
    </div>
<?php
}
//-------------------------------------------------------------------------------------------------------------
?>