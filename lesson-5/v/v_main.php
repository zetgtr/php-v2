<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>
    <script src="./data/js/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script src="./data/js/script.js"></script>
    <title><?=$title ?></title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>

<body>
<header>
    <div class="conteiner header_box">
        <div></div>
        <div class="heder_auth">
            <?php
            if ($auth) { ?>
                <p>Вход выполнен как <?= $auth['login'] ?></p>
                <a href="index.php?act=auth&exit=true">Выйти</a>
            <? } else { ?>
                <a href="index.php?act=sign_in&c=sign">Войти</a>
                <a href="index.php?act=sign_up&c=sign">Зарегестрироватся</a>
            <? } ?>
        </div>
        <p><?= $title ?></p>
        <div></div>
        <div class="basket_box">
            <a href="/index.php?act=basket" class="link-basket">
                <div></div>
                <img src="data/img/basket.svg" alt="basket.svg">
            </a>
            <div></div>
            <div class="menu" onclick="myFunction()">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
                <?=$menu?>
            </div>
        </div>
    </div>
</header>
<?php
echo $content;
if(!$adminButton){
    echo $chat;
}
?>
<footer>
    <div class="conteiner footer_box">
        <p>Copyright &copy; 2022. Образовательная работа на Geekbrains | PHP V2 часть 5</p>
    </div>
</footer>
