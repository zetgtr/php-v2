<?php

//$server = "localhost";
//const LOGIN = "root";
//CONST PAS = "";
//CONST DB = "lesson-8";
$host = 'localhost';
$db   = 'lesson-8';
$user = 'root';
$pass = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $pass);