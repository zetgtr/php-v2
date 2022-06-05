<?php
include './config.php';
$id = $_GET["id"];
$sql = "SELECT * FROM goods WHERE id=$id ";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
  $product = mysqli_fetch_assoc($res);
  $update = "UPDATE goods SET count = count+1 WHERE id='$id'";
  mysqli_query($connect, $update);
}
$main = "contents/contents_product.php";
$textHeader = $product["title"];
include "header.php";