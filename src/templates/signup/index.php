<?php

?>

<form method="POST" action="/registration" >
    <div class="container text-center">
        <div class="row align-items-center">
            <legend>Регистрация</legend>
            <?php if (isset($errors)): ?>
                <?php foreach($errors as $row):?>
                    <p style = 'color:red'><?= $row ?></p>
                <?php endforeach?>
            <?php endif; ?>
            <div class="mb-3">
                <p><label>Введите логин:</label><br><input type="text" name="login"></p>
                <p><label>Введите email:</label><br><input type="text" name="email"></p>
                <p><label>Введите пароль:</label><br><input type="password" name="password"></p>
                <div class="form-text">Мы никогда никому не передадим ваши данные.</div></br>
                <p><input name="button" type="submit" class="btn btn-primary" value="Зарегистрироваться"></p>
                <a href="/auth">Назад</a>
            </div>
        </div>
    </div>
</form>