<h3>Добро пожаловать в sam.gpp.kz!</h3>

<p>Здравствуйте <strong><b>{{$sname.' '.$fname.' '.$pname}}</b></strong>!</p>

<p>Вы зарегистрировались в системе sam.gpp.kz! Чтобы активировать учетную запись, пожалуйста, пройдите по ссылке:</p>
<strong><b><a href="http://sam.gpp.kz/confirmation/{{$email}}/{{$token}}">Подтверждения регистраций</a></b></strong>
<p>Cрок действия ссылки - <strong><b>3 дня</b></strong></p>
<hr/>
<small>Ваш логин: <strong><b>{{$email}}</b></strong></small><br/>
<small>Ваш пароль: <strong><b>{{$password}}</b></strong></small>
<hr/>
<small>
    Пожалуйста, подтвердите Ваш эл. адрес как можно скорее. Вы не сможете использовать свой аккаунт, пока не подтвердите эл. адрес.<br/>
    Если ссылка не открывается вставьте эту ссылку в адресную строку браузера:
    <a href="http://sam.gpp.kz/confirmation/{{$email}}/{{$token}}">
        http://sam.gpp.kz/confirmation/{{$email}}/{{$token}}
    </a>
</small>
<hr/>
<p>Если вы получили данное письмо по ошибке, просто игнорируйте его.</p>
<p>С уважением команда <strong><b>GxP Company!</b></strong></p>