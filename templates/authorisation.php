<!DOCTYPE html>
<html lang="en">
<div style="position: absolute; top:0; right:0; background-color: white; z-index: 10; opacity: 0.85">

    <?php if (!$authorisation): ?>

        <form class="form-horizontal" method="post" style="position: absolute; top: 55px; right: 50px; width: 300px">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Почта</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" name="pass" class="form-control" id="inputPassword3" placeholder="Password">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Авторизоватся</button>
                </div>

            </div>

        </form>
        <form action="Registration.php" class="form-horizontal" method="post" style="position: absolute; top: 153px; right:  0px; width: 200px">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" name="reg" value="Зарегистрироваться" class="btn btn-default">
            </div>

        </div>
        </form>
        <?php if ($alert): ?>
            <div style="color: red; position: absolute; right: 0">
                Неверный пользователь или пароль
            </div>
            <?php
            $alert = false; endif;
    else: ?>
        <div style="position: absolute; top: 50px; right: 50px; width: 300px">
<!--            style="position: absolute; right: 50px; top: 0px; width: 400px; color: whitesmoke; text-shadow: black 0 0 2px">-->
            Авторизован как:
            <?= $user . " Ваш id  : " . $id; ?>
        </div>
        <div style="position: absolute; right: 0; top: 50px; color: blue">
            <form method="post" >
                <input type="submit" name="btn_logout" class="btn btn-default btn-xs" value="Выйти"
                       style="font-size: 11px ">
            </form>
        </div>

    <?php endif; ?>
</div>
</html>
