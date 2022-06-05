<?php

class C_User extends C_Base
{
    public function action_sign_in()
    {
        $this->title = 'Вход';
        $pdo = $this->pdo;
        $id = $this->sessionId;
        $login = trim(strip_tags($_POST['login']));
        $pass = trim(strip_tags($_POST['password']));
        $users = $pdo->query("SELECT * FROM `users`")->fetchAll();
        foreach ($users as $user) {
            if ($login == $user['login'] and md5($pass) == $user['pass']) {
                $pdo->query("UPDATE `users` SET `session` = '$id' WHERE `users`.`login` = '$login'")->fetch();
                header("location: /");
            } else {
                $login ? $message = "Не правильно ввели данные!" : $message = "";
                $this->content = $this->Template('v/v_auth.php', ['message'=>$message]);
            }
        }
    }
    public function action_sign_up()
    {
        $pdo = $this->pdo;
        $id = $this->sessionId;
        $login = trim(strip_tags($_POST['login']));
        $pass = trim(strip_tags($_POST['password']));
        $pass2 = trim(strip_tags($_POST['password2']));
        $users = $pdo->query("SELECT * FROM `users`")->fetchAll();
        $this->title = 'Регистрация';
        $this->content = $this->Template('v/v_auth.php');
        foreach ($users as $user) {
            if ($login == $user['login']) {
                $message = "Такой уже логин есть!";
                $this->content = $this->Template('v/v_auth.php', ['message'=>$message]);
            }
        }
        if ($pass === $pass2 && $login) {
            $pdo->query("INSERT INTO users (login, pass, session) VALUES ($login,md5($pass),$id)");
            header("location: /");
        } elseif($login) {
            $message = "Ваши пароли не совподают!";
            $this->content = $this->Template('v/v_auth.php', ['message'=>$message]);
        }
    }
}