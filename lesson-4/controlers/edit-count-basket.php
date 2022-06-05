<?php
session_start();
for($i=0;$i<count($_SESSION['basket']);$i++){
    if($_SESSION['basket'][$i]['id']===$_POST['id']){
        $_SESSION['basket'][$i]['count'] = $_POST['count'];
        echo "Цена: ".$_POST["price"]*$_POST['count']." руб.";
    }
}