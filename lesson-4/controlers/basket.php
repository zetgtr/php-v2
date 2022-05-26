<?php
session_start();
$id = $_POST['id'];
if ($_SESSION['basket']) {
    for ($i=0;$i<count($_SESSION['basket']);$i++){
        if($_SESSION['basket'][$i]['id']===$id){
            $basket = true;
            ++$_SESSION['basket'][$i]['count'];
        }
    }
    if(!$basket){
        array_push($_SESSION['basket'], ["id"=>$id, 'count'=>1]);
    }
} else {
    $_SESSION['basket'] = [0 => ["id"=>$id, 'count'=>1]];
}
print_r($_SESSION['basket']);
//header("location: ../index.php");