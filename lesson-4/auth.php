<?php
session_start();
$main = "contents/contents_auth.php";
if($_GET['sign']==='in'){
    $textHeader = 'Вход';
}elseif($_GET['sign']==='up'){
    $textHeader = 'Регистрация';
}elseif($_GET['exit']){
    include './config.php';
    include './function.php';
   	authOff($connect, session_id());
    header('location: index.php');
}
include "header.php";
?>