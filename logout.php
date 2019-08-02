<?php

ini_set('display_errors',1);

session_start();

$_SESSION = array();
if(ini_get("session.use_cookies")){
  $params = session_get_cookie_params();
  setcookie(session_name(),'',time()-4200,$params["path"],$params["domain"],$params["secure"],$params["httponly"]);
}

session_destroy();

setcookie('name','',time()-3600);
setcookie('password','',time()-3600);
header('Location:front.php');
exit();


 ?>