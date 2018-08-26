<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Main</title>
    <!-- Bootstrap -->
    <link href="/landing/css/bootstrap.css" rel="stylesheet">
    <link rel="icon" type="image/vnd.microsoft.icon" href="/landing/img/logo/favicon.ico">
    <link rel="stylesheet" href="/landing/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
</head>
<body>

@include('landing.layout.header')

<div class="content">
    <div class="container">
        <div class="button-block visible-xs">
            <a href="#" class="btn btn-login show_popup" onclick="display()" rel="panel"><i class="icon i-user"></i>Войти</a>
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
                        <a href="#">Забыли пароль?</a>
                    </label>
                </form>
                <a href="#" class="btn btn-auth">Войти</a>
                <a href="#" class="btn btn-reg">Зарегистрироваться</a>
            </div>
        </div>
        <!--<div id="fullpage">-->
        <!--<section>-->
        <div class="advantage-block" id="advan">
            <!--<i class="icon totop" id="toTop"></i>-->
            <div class="row main-top">
                <div class="link-item">
                    <a href="index.html">Главная > </a><a href="buy.html">Купить</a>
                </div>
                <div class="col-md-3 col-sm-3 block-line">
                    <div class="sub-line"></div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <h1 class="block-title">НАШИ ПРЕИМУЩЕСТВА</h1>
                </div>
                <div class="col-md-3 col-sm-3 block-line">
                    <div class="sub-line"></div>
                </div>
            </div>
            <div class="row advantage-box">
                <div class="col-md-4 col-sm-4 ad-block">
                    <div class="ad-item">
                        <img src="img/main/advan1.png" alt="">
                        <a href="#">Более 100 требований по GPP с примерами соответствия</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 ad-block">
                    <div class="ad-item">
                        <img src="img/main/advan2.png" alt="">
                        <a href="#">Доступ с любого устройства, в любом места и в любое время</a>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 ad-block">
                    <div class="ad-item">
                        <img src="img/main/advan3.png" alt="">
                        <a href="#">Обучающие ресурсы для подготовки к инспекции GPP</a>
                    </div>
                </div>
            </div>
        </div>
        <!--</section>-->
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