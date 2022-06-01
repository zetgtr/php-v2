<?php
session_start();
include "../config.php";
include "../function.php";
$_SESSION['basket'] = array_filter($_SESSION['basket'],  function ($k) {
    if ($k['id'] == $_POST['id']) {
        $_SESSION['basket'][0] = null;
    } else {
        return $k !== $_POST['id'];
    }
},);
if(!$_SESSION['basket']){?>
<h1 class="basket_false">Корзина пуста</h1>
<?}?>
