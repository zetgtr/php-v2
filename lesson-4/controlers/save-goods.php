<?
include '../config.php';
include '../function.php';
$title = $_POST['title'];
$text = $_POST['text'];
$id = $_GET['id'];
editGoods($connect, $id, $title, $text);
?>
