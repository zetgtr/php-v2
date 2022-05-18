<?
session_start();
include "../config.php";
include "../function.php";
$login = trim(strip_tags($_POST['login']));
$pass = trim(strip_tags($_POST['password1']));
$user = getAll($connect, 'users');
foreach ($user as $item) {
    if ($login == $item['login'] and md5($pass) == $item['pass']) {
        $message = "Вы вошли!";
        $_SESSION['id'] = session_id();
        newId($connect, session_id(), $login);
        echo $message;
        header("location: ../index.php");
    } else {
        $message = "Не правильно ввели данные!";
        echo $message;
    }
}