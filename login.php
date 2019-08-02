<?php
require_once(__DIR__.'/core/dbconect.php');
require('functions/functions.php');
ini_set('display_errors',1);
session_start();

if(isset($_COKIE['name']) !=''){
  $_POST['name'] =$_COKIE['name'];
  $_POST['password'] = $_COKIE['password'];
  $_POST['save'] = 'on';
}

if(!empty($_POST)){
	if($_POST['name'] !='' && $_POST['password'] !=""){
		$login = $db->prepare('SELECT * FROM userinfo WHERE name=? AND password=?');
		$login->execute(array(
			$_POST['name'],
			sha1($_POST['password'])
		));
		$me = $login->fetch();

		if(isset($me)){
      $_SESSION['id'] = $me['id'];
      $_SESSION['time'] = time();
      $_SESSION['name'] = $me['name'];
			header('Location: index.php');exit();
		}else {
       $errors =  "blank";
		}
	}else {
    $errors = "none";
  }
}

if(isset($_POST['save']) === 'on'){
  setcookie('name',$_POST['name'],time()+60*60*24*14);
  setcookie('password',$_POST['password'],time()+60*60*24*14);
}


 ?>
<!-- <!DOCTYPE html> -->
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ログイン</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP&display=swap" rel="stylesheet"> 	<link rel="stylesheet" href="slick/slick.css">
<link rel="stylesheet" href="animate/animate.min.css">
<link href="css/main.css" rel="stylesheet">
<script src="js/main.js"></script>
</head>
  <body class="login">
    <header class="section0">
      <div class="section_title-box">
        <h1 class="section0_title">ログインページ</h1>
        <div class="section0_btn-box">
          <a href="front.php"><button type="button" class="btn bg-primary  text-light ">ホーム画面</button></a>
        </div>
        <form class="login_form" action="" method="post">
          <div class="form-group">
            <label for="exampleInputEmail1">アカウント名</label>
            <input type="text" class="form-control form-control-lg" name="name" id="exampleInputEmail1" placeholder="アカウント名" value="<?php if(isset($_SESSION['join']['name'])){ echo $_SESSION['join']['name'];} ?>">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">パスワード</label>
            <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="パスワード" value="<?php if(isset($_SESSION['join']['password'])){ echo $_SESSION['join']['name'];} ?>">
          </div>
          <button type="submit" class="btn btn-primary">ログイン</button>
        </form>
        <div class="attention">

        <p><?php if(isset($errors)){login($errors);} ?></p>
        </div>
      </div>
    </header>
  </body>
</html>
