<?php
session_start();
ini_set('display_errors',1);
require_once(__DIR__.'/core/dbconect.php');


//セッションにテキストが保存されていたらdbに保存
if($_SESSION['text']){
  $statment = $db->prepare('INSERT INTO post SET title=?,hardware=?,texts=?,image=?,itemurl=?,member=?,member_id=?');
  $statment->execute(array($_SESSION['title'],$_SESSION['hardware'],$_SESSION['text'],$_SESSION['image'],$_SESSION['itemurl'],$_SESSION['name'],$_SESSION['id']));
  header('Location:front.php');exit();
  echo "ここ";
}else {
  header('Location:register.php');exit();
  echo "ここです";
}
