<?php
session_start();
include '../config.php';
include '../function.php';
if($_SESSION['basket']){
    $user = getUser($connect, session_id())['id_user'];
    foreach($_SESSION['basket'] as $basket){
        bayBasket($connect, $user, $basket['id'], $basket['count']);
    }
}
$_SESSION['basket'] = [];
?>
<div class="basket_false">Корзина пуста</div>