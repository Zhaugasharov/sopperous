<?php

if (isset($_POST['tel'])) { $tel = $_POST["tel"]; //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$tel = stripslashes($tel);
$tel = htmlspecialchars($tel);
//удаляем лишние пробелы
$tel = trim($tel); if ($tel == '') {unset($tel);}}

if (isset($_POST['name'])) {$name= $_POST["name"]; //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$name = stripslashes($name);
$name = htmlspecialchars($name);
//удаляем лишние пробелы
$name = trim($name); if ($name == '') {unset($name);}}

if (isset($_POST['action_text'])) {$answer= $_POST["action_text"]; //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
$answer = stripslashes($answer);
$answer = htmlspecialchars($answer);
//удаляем лишние пробелы
$answer = trim($answer); if ($answer == '') {unset($answer);}}

if (isset($_POST['quest'])) {$text= $_POST["quest"]; //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $text = stripslashes($text);
    $text = htmlspecialchars($text);
//удаляем лишние пробелы
    $text = trim($text); if ($text == '') {unset($text);}}


if (isset($_POST['info'])) {$info= $_POST["info"]; //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $info = stripslashes($info);
    $info = htmlspecialchars($info);
//удаляем лишние пробелы
    $info = trim($info); if ($info == '') {unset($info);}}

if (isset($_POST['email'])) {$email= $_POST["email"]; //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
//удаляем лишние пробелы
    $email = trim($email);
    if ($email == '') {
        unset($email);
    } else {
        if(!preg_match("|^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$|i", $email))
        {
            unset($email);
        }
    }
}


require 'phpmailer/PHPMailerAutoload.php';
$date=date("Y-m-d H:i:s");
if(!isset($name) || $name == 'Ваше имя') {$name = 'Не указано';}
if(!isset($info) || $info == '') {$info = 'Не указано';}


$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mailer@gxp.kz';                 // SMTP username
$mail->Password = 'Aa1234$';             // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
$mail->From = 'mailer@gxp.kz';
$mail->FromName = 'gxp.kz';
$mail->addAddress('one-page.kz@mail.ru', 'One-page');     // Add a recipient
$mail->addAddress('info@gxp.kz', 'gxp.kz');     // Add a recipient

    if (isset($tel)) {


        if(!isset($text) || $text == 'Ваш вопрос') {$text = 'Не указан';}
        if(!isset($email)) {$email = 'Не указан';}


        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->CharSet = "UTF-8";
        $mail->Subject = 'gxp.kz - Новая заявка на сайте от ' . $date . '';
        $mail->Body = 'Появилась новая заявка на сайте
                        <br>Контактные данные:
                        <br>Телефон: ' . $tel . '
                        <br>Имя: ' . $name . '
                        <br>Вопрос: ' . $text . '
                        <br><br>Информация: ' . $info . '
                        <br><a href="http://gxp.kz">Ссылка на сайт</a><br><br><br>
                           <blockquote style="margin: 10px; padding: 0 0 0 10px; border-left: 1px solid rgb(8, 87, 166);">Создание и поддержка сайтов
                           <a target="_blank" href="http://www.one-page.kz">http://www.one-page.kz</a>
                           <br>Контактные данные:
                           <br>+7 777 351 63 84
                           <br>+7 700 745 74 05
                           <br>one-page.kz@mail.ru
                           </blockquote>';
        $mail->AltBody = 'Появилась новая заявка на сайте /n  Контактные данные: /n  ' . $tel . '/n  Имя: /n  ' . $name . '/n Информация: /n ' . $info;

        if (!$mail->send()) {
            echo 'Ошибка отправки письма.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo $answer;
        }




    } else {
        echo 'Неправильно введены данные!';
    }


?>