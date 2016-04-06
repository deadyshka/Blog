<!DOCTYPE html>
<html lang="en">
<div>
    <form method="post" style="text-align: center; position: absolute; top:100px">
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
        <input type="submit" class="btn btn-default col-xs-offset-5 " value="Зарегистрироватся " >
    </form>
    <?php if ($alert): ?>
        <div style="color: red; position: absolute; right: 0">
            Неверный пользователь или пароль
        </div>
        <?php $alert = false; endif; ?>
</div>
</html>
