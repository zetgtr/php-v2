<?php
session_start();
include "config.php";
include "function.php";
$function = true;
$auth = auth($pdo, session_id());
if($auth["admin"]==="true"){
    $main = "contents/contents_admin.php";
}else{
    $main = "contents/contents_noadmin.php";
}
$textHeader = 'Админка';
$adminButton = true;
include "header.php";