<?php
session_start();
include './config.php';
if(!$function){
    include './function.php';
}
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <script src="js/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script> 
    <script src="/js/script.js"></script>
    <title><?= $textHeader ?></title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
    <header>
        <div class="conteiner header_box">
            <div></div>
            <div class="heder_auth">
                <?php
                $auth = auth($pdo, session_id());
                if (count($auth) > 0) { ?>
                <p>Вход выполнен как <?= $auth['login'] ?></p>
                <a href="auth.php?exit=true">Выйти</a>
                <? } else { ?>
                <a href="auth.php?sign=in">Войти</a>
                <a href="auth.php?sign=up">Зарегестрироватся</a>
                <? } ?>
            </div>
            <p><?= $textHeader ?></p>
            <div></div>
            <div class="basket_box">
                <a href="./basket.php" class="link-basket">
                    <div></div>
                    <img src="img/basket.svg" alt="basket.svg">
                </a>
                <div></div>
                <div class="menu" onclick="myFunction()">
                    <div class="bar1"></div>
                    <div class="bar2"></div>
                    <div class="bar3"></div>
                    <? include "./components/menu.php" ?>
                </div>
            </div>
        </div>
    </header>
    <?php 
        include $main;
        if(!$adminButton){
            include "./components/reviews-item.php";
        }
    ?>
    <footer>
        <div class="conteiner footer_box">
            <p>Copyright &copy; 2022. Образовательная работа на Geekbrains | PHP V2 часть 4</p>
        </div>
    </footer>