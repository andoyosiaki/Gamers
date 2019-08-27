<?php
session_start();
require_once __DIR__."/core/dbconect.php";

if($_SESSION['join']){
  $statement = $db->prepare('INSERT INTO userinfo SET name=?,password=?,icon=?,created=NOW()');
  $statement->execute(array(
    $_SESSION['join']['name'],
    sha1($_SESSION['join']['password']),
    $_SESSION['join']['icon']
  ));

  header('Location:login.php');exit();
}else {
  header('Location:front.php');exit();
}
