<?php
session_start();
require_once __DIR__."/core/dbconect.php";
require __DIR__."/functions/functions.php";

if(isset($_COKIE['name']) && $_COKIE['name'] !=''){
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

		if($me){
      $_SESSION['id'] = $me['id'];
      $_SESSION['time'] = time();
      $_SESSION['name'] = $me['name'];
			header('Location: index.php');exit();
		}else {
       $errors =  "nouser";
		}
	}else {
    $errors = "blank";
  }
}

if(isset($_POST['save']) === 'on'){
  setcookie('name',$_POST['name'],time()+60*60*24*14);
  setcookie('password',$_POST['password'],time()+60*60*24*14);
}

 ?>

<?php require_once __DIR__."/head.php"; ?>

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
            <input type="password" class="form-control form-control-lg" name="password" id="exampleInputPassword1" placeholder="パスワード" value="<?php if(isset($_SESSION['join']['password'])){ echo $_SESSION['join']['password'];} ?>">
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
