<?php

use Artur\Twitter\Core\Database;

?>
<div class="container-xxl">
    <div class="row" style="background-color:#9980FA;">
        <div class="col-md-2">
            <h5 style="margin-top:10px;">Twitter</h5>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-1">
            <h5 style="margin-top:5px;"><?= $user->username ?><h5>
        </div>
        <div class="col-md-1"><a href="/logout" style="margin-top:1px;" class="btn btn-outline-dark">Выход</a></div>
    </div>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/tweet">
                        <center>
                            <h5 class="card-title">Здравствуй!</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">Добро пожаловать в Twitter! </h6>
                            <p class="card-text">Ты всегда можешь рассказать своим друзьям и знакомым немного о себе, поделись с ними новыми начинаниями или интересными историями нажми кнопку Tweet и расскажи немного о себе ;)</p>
                            <textarea name="text" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            <br><p><input name="button" type="submit" class="btn btn-primary" value="Tweet">

                            </p>

                        </center>
                    </form>
                </div>
            </div>
            <center>
                <div class="card" style="margin-top: 20px;">
                    <h5 class="card-header">Публицкации</h5>
                    <div class="card-body">
                        <h5 class="card-title">Тут люди рассказываю о себе!</h5>
                        
                        <?php foreach ($tweets as $tweet): ?>
                            
                            <p class="card-text"><?= "Пользователь:", $tweet->user->username . " " . "опубликовал(а)" . "-" . $tweet->tweet . $tweet->dateFormat() ?> </p>
                        
                        <?php endforeach ?>
                    </div>
                </div>
            </center>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
</form>