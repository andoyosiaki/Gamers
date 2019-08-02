<?php
session_start();
ini_set('display_errors',1);

if($_POST['title']){
  $_SESSION['title'] = $_POST['title'];
  $_SESSION['hardware'] = $_POST['hardware'];
  $_SESSION['itemurl'] = $_POST['itemurl'];
  $_SESSION['image'] = $_POST['image'];
  header('Location:new.php');exit();
}else {
  header('Location:front.php');exit();
}
