<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Портал GPP</title>
    <meta name="description" content="Портал GPP"/>
    <meta name="keywords" content="Портал GPP"/>
    <!-- Bootstrap -->
    <link href="/landing/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/landing/img/logo/favicon.ico">
    <link rel="stylesheet" href="/landing/css/style.css">
    <link href="/landing/https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>

@include('landing.layout.header')

<div class="content">
    <div class="container">
        <div class="button-block visible-xs">
            <a href="/landing/#" class="btn btn-login show_popup" onclick="display()" rel="panel"><i class="icon i-user"></i>Войти</a>
        </div>
        <div class="popup-bg"></div>
        <div class="auth-box">
            <div class="auth popup" id="panel">
                <form action="#">
                    <label for="#log" class="auth-label"><input type="text" placeholder="Ваш логин или Email" id="log">
                        <i class="icon i-user1"></i></label>
                    <label for="#pass" class="auth-label"><input type="text" placeholder="Ваш пароль" id="pass"> <i
                                class="icon i-pass"></i></label>
                    <label for="check" class="check-label1">
                        <input type="checkbox" id="check" class="hid-form">
                        <span class="checkmark "></span>
                        <span>Запомнить меня</span>
                        <a href="/landing/#">Забыли пароль?</a>
                    </label>
                </form>
                <a href="/landing/#" class="btn btn-auth">Войти</a>
                <a href="/landing/#" class="btn btn-reg">Зарегистрироваться</a>
            </div>
        </div>
        <div class="row buy-top">
            <div class="col-md-2 col-sm-2 buy-side">
                <div class="link-item">
                    <a href="/landing/index.html">Главная > </a><a href="/landing/buy.html">Купить</a>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 buy-content">
                <p>подписаться (купить) на наши ресурсы легко, быстро и безопасно</p>
                <h1 class="block-title">Выберите удобный для Вас период подписки и получите полный доступ на все
                    материалы GPP.KZ</h1>
                <ul class="buy-list">
                    <li><span>365 дней</span></li>
                    <li><span>67500 </span></li>
                    <li><span>1 год</span></li>
                    <li><span>Скидка 30%</span></li>
                </ul>
            </div>
        </div>
        <div class="row buy-bottom">
            <p>Выберите способ оплаты</p>
            <div class="col-md-2 col-sm-2 buy-block">
                <div class="buy-item">
                    <a href="/landing/#" class="btn btn-buy">
                        <img src="/landing/img/icon/buy1.PNG" alt="">
                    </a>
                    <a href="/landing/#">Оплата через QIWI Терминал</a>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 buy-block">
                <div class="buy-item">
                    <a href="/landing/#" class="btn btn-buy">
                        <img src="/landing/img/icon/buy2.PNG" alt="">
                    </a>
                    <a href="/landing/#">Оплата через QIWI Кошелек</a>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 buy-block">
                <div class="buy-item">
                    <a href="/landing/#" class="btn btn-buy">
                        <img src="/landing/img/icon/buy3.PNG" alt="">
                    </a>
                    <a href="/landing/#">Личный кабинет Kaspi.kz</a>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 buy-block">
                <div class="buy-item">
                    <a href="/landing/#" class="btn btn-buy">
                        <img src="/landing/img/icon/buy4.PNG" alt="">
                    </a>
                    <a href="/landing/#">Оплата через Касса24 Терминал</a>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 buy-block">
                <div class="buy-item">
                    <a href="/landing/#" class="btn btn-buy">
                        <img src="/landing/img/icon/buy5.PNG" alt="">
                    </a>
                    <a href="/landing/#">Online оплата</a>
                </div>
            </div>
            <div class="col-md-2 col-sm-2 buy-block">
                <div class="buy-item">
                    <a href="/landing/#" class="btn btn-buy">
                        <img src="/landing/img/icon/buy6.PNG" alt="">
                    </a>
                    <a href="/landing/#">Выставить счет на оплату </a>
                    <a href="/landing/#">Ваш лицевой счет</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="footer ad-footer">
    <div class="container-fluid bg-menu">
        <div class="container footer-block">
            <p>Информационный ресурс GGP.kz © 2017. Все права защищены</p>
            <p>Использование материалов возможно только с соблюдением Правил пользования сайтом</p>
            <p>Разработка и дизайн bg.pro, 2018</p>
        </div>
    </div>
</div>
<script src="/landing/js/bootstrap.min.js"></script>
<script src="/landing/js/jquery.min.js"></script>
<script src="/landing/js/libs.min.js"></script>
<script src="/landing/js/common.js"></script>
</body>
</html>