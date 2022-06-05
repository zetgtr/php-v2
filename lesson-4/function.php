<?php
function getAll($link, $table)
{
    $query = "SELECT * FROM {$table}";
    $result = mysqli_query($link, $query);

    if (!$result)
        die(mysqli_error($link));

    $n = mysqli_num_rows($result);
    $res = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $res[] = $row;
    }
    return $res;
}

function newUser($link, $login, $pass, $sessionId)
{
    $t = "INSERT INTO users (login, pass, session) VALUES ('%s','%s','%s')";
    
    $query = sprintf($t, mysqli_real_escape_string($link, $login), mysqli_real_escape_string($link, $pass), mysqli_real_escape_string($link, $sessionId));

    $result = mysqli_query($link, $query);

    if (!$result) {
        die(mysqli_error($link));
    }

    return true;
}

function newId($link, $sessionId, $login)
{

    $query = "UPDATE `users` SET `session` = '$sessionId' WHERE `users`.`login` = '$login'";

    mysqli_query($link, $query);
}

function auth($pdo, $sessionId)
{
        $result = $pdo->query("SELECT * FROM `users` WHERE `users`.`session` = '$sessionId'");
        return $result->fetch();
}

function authOff($link, $sessionId)
{
    $query = "UPDATE `users` SET `session` = 0 WHERE `users`.`session` = '$sessionId'";

    mysqli_query($link, $query);
}

function getCart($link, $id)
{

    $query = "SELECT * FROM `goods` WHERE `goods`.`id` = $id";

    $result = mysqli_query($link, $query);

    if (!$result)
        die(mysqli_error($link));

    $n = mysqli_num_rows($result);
    $res = array();

    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $res = $row;
    }
    return $res;
}

function editAdmin($link, $id)
{
    $query = "SELECT * FROM `users` WHERE `users`.`id_user` = '$id'";
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $n = mysqli_num_rows($result);
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        $row;
    }
    if($row["admin"]==="true"){
        $sql = "UPDATE `users` SET `admin` = 'false' WHERE `users`.`id_user` = $id";
        mysqli_query($link, $sql);
    }elseif($row["admin"]==="false"){
        $sql = "UPDATE `users` SET `admin` = 'true' WHERE `users`.`id_user` = $id";
        mysqli_query($link, $sql);
    };
}

function modalPhoto($link, $id){
    $query = "SELECT * FROM `goods` WHERE `goods`.`id` = '$id'";
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $n = mysqli_num_rows($result);
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

function editPhoto($link, $id, $num, $photo){
    $query = "UPDATE `goods` SET `$num`='$photo' WHERE `goods`.`id` = '$id'";
    mysqli_query($link, $query);
}


function editGoods($link, $id, $title, $text){
    $query = "UPDATE `goods` SET `title`='$title', `text`='$text' WHERE `goods`.`id` = '$id'";
    mysqli_query($link, $query);
}

function addGoods($link){
    $query = "INSERT INTO `goods` (id) VALUES (NULL);";
    mysqli_query($link, $query);
    $query = "SELECT MAX(id) FROM `goods`";
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $n = mysqli_num_rows($result);
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}

function removeGoods($link, $id){
    $query = "DELETE FROM `goods` WHERE `goods`.`id` = $id";
    mysqli_query($link, $query);
}

function bayBasket($link, $user, $goods, $count){

    $t = "INSERT INTO `purchases` (user, goods, count) VALUES (%s,%s,%s)";
    
    $query = sprintf($t, mysqli_real_escape_string($link, $user), mysqli_real_escape_string($link, $goods), mysqli_real_escape_string($link, $count));

    $result = mysqli_query($link, $query);
    
    if (!$result) {
        die(mysqli_error($link));
    }

    return true;
}

function getUser($link, $sessionId){
    $query = "SELECT * FROM `users` WHERE `users`.`session` = '$sessionId'";
    $result = mysqli_query($link, $query);
    if (!$result)
        die(mysqli_error($link));
    $n = mysqli_num_rows($result);
    for ($i = 0; $i < $n; $i++) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
}