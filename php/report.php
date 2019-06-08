<?php
session_start();
$frommail = $_SESSION['login'];
$aboutrole = $_SESSION['role'];
$temamail = $_POST['tema'];
$aboutmail = $_POST['description'];
date_default_timezone_set('Etc/UTC');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$mail = new PHPMailer(true);
$mail->CharSet = 'UTF-8';

try {
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host       = 'smtp.yandex.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'Lara.v.m@yandex.ru';
    $mail->Password   = 'Dima496booksik';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom('Lara.v.m@yandex.ru', $frommail.' => '.$aboutrole);
    $mail->addAddress('provsehinas@gmail.com', 'Report');
    $mail->addReplyTo('provsehinas@gmail.com', 'Information');

    $mail->isHTML(true); 
    $mail->Subject = $temamail;
    $mail->Body    = $aboutmail;

    $mail->send();
    
    echo 'Сообщение отправлено, вы вернетсь назад автоматически.';
    header("refresh: 3; url=http://localhost/vkr/index.php");
} catch (Exception $e) {
    echo "Свяжитесь с администратором по телефону: {$mail->ErrorInfo}";
}