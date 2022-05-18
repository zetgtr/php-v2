<?php
include "../config.php";
include "../function.php";
if($_POST["id"]){
   editAdmin($connect, $_POST["id"]);
}