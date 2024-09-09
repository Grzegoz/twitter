
<form method="POST" action="/authorization">
    <div class="container text-center">
        <div class="row align-items-center">
            <legend>Авторизация</legend>
            <div class="mb-3">
                <p><label>Введите логин:</label><br><input type="text" name="login"></p>
                
                <p><label>Введите пароль:</label><br><input type="password" name="password"></p>
                <p><input name="button" type="submit" class="btn btn-primary" value="Войти"></p>
                <p><div class="form-text">Нет аккаунта? Нажмите кнопку "Зарегистрироваться".</div>
                <a href="/signup">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</form>
