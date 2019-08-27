<?php
session_start();
require_once __DIR__."/core/dbconect.php";

//セッションにテキストが保存されていたらdbに保存
if($_SESSION['text']){
  $statement = $db->prepare('INSERT INTO post SET title=?,hardware=?,texts=?,image=?,itemurl=?,member=?,member_id=?');
  $statement->execute(array($_SESSION['title'],$_SESSION['hardware'],$_SESSION['text'],$_SESSION['image'],$_SESSION['itemurl'],$_SESSION['name'],$_SESSION['id']));
  header('Location:front.php');exit();
}else {
  header('Location:register.php');exit();
}
