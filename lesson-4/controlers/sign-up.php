<?php
session_start();
include "../function.php";
include "../config.php";
$sessionId = session_id();
$login = trim(strip_tags($_POST["login"]));
$pas1 = trim(strip_tags($_POST["password1"]));
$pas2 = trim(strip_tags($_POST["password2"]));
$user = getAll($connect, 'users');
foreach ($user as $item) {
    if ($login == $item['login']) {
        exit("Такой уже логин есть!");
    }
}
if ($pas1 === $pas2) {
    newUser($connect, $login, md5($pas1), $sessionId);
    header("location: ../index.php");
} else {
    echo "Ваши пароли не совподают!";
}