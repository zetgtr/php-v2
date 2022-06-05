<?php
require_once "config.php";
$name = $_POST["reviews-name"];
$text = $_POST["reviews-text"];
if($name && $text){
    $sqlUpdate = "INSERT INTO reviews (name, text) VALUES ('$name', '$text')";
    mysqli_query($connect, $sqlUpdate);
}
$main = "contents/contents_reviews.php";
$textHeader = 'Отзывы';
include "header.php";