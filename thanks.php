<?php
require_once(__DIR__.'/core/dbconect.php');
session_start();
ini_set('display_errors',1);

if($_SESSION['join']){
  $statment = $db->prepare('INSERT INTO userinfo SET name=?,password=?,icon=?,created=NOW()');
  $statment->execute(array(
    $_SESSION['join']['name'],
    sha1($_SESSION['join']['password']),
    $_SESSION['join']['icon']
  ));

header('Location:login.php');exit();
}else {
header('Location:front.php');exit();
}
