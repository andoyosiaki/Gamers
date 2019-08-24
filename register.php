<?php
session_start();
require_once __DIR__."/core/dbconect.php";
require __DIR__."/functions/functions.php";

if(!empty($_POST)){
  if($_POST['name'] === ''){
    $error['name']='blank';
  }
  if(strlen($_POST['name']) > 10){
    $error['name']='length_name';
  }
  if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['name'])){
    $error['name']='alph_chara';
  }
  if($_POST['password'] === ''){
    $error['password']='blank';
  }
  if(strlen($_POST['password']) < 4){
    $error['password']='length';
  }

  if(empty($error)){
    $statment = $db->prepare('SELECT COUNT(*) AS cnt FROM userinfo WHERE name=?');
    $statment->execute(array($_POST['name']));
    $member = $statment->fetch();
    if($member['cnt'] > 0){
      $error['name'] = 'duplicate';
    }
  }

  if(is_null($error)){
  $_SESSION['join'] = $_POST;
   header('Location:thanks.php');exit();
  }
}

 ?>
<?php require_once __DIR__."/head.php"; ?>
  <body class="register">
    <header class="section0">
      <div class="section_title-box">
        <h1 class="section0_title">会員登録</h1>
        <div class="section0_btn-box">
        <a href="front.php"><button type="button" class="btn bg-primary  text-light ">ホーム画面</button></a>
      </div>
      </div>
      <div class="login_section">
        <form class="login_form-box" action="" method="post">
          <div class="login_inpt-box">
            <label for="exampleInputEmail1">1:アカウント名は10文字以下の半角英数文字でお願いします。</label>
            <input type="text" class="form-control form-control-lg" name="name" placeholder="アカウント名">
            <div class="attention">
              <p><?php if(isset($error['name'])){ echo RegisterAcount($error['name']);} ?></p>
            </div>
            <label for="exampleInputEmail1">2:パスワード入力</label>
            <input type="password" class="form-control form-control-lg" name="password" placeholder="パスワード">
            <div class="attention">
              <p><?php if(isset($error['password'])){ echo Registerpassword($error['password']);} ?></p>
            </div>
          </div>
          <label for="exampleInputEmail1">3:アイコンを選択してください</label>
          <div class="icon_box">
            <div class="icon_men">
              <img src="img/1.png" alt="">
              <input class="icon_bt" type="radio" name="icon" value="1" checked="checked">
            </div>
            <div class="icon_men">
              <img src="img/2.png" alt="">
              <input class="icon_bt" type="radio" name="icon" value="2">
            </div>
            <div class="icon_men">
              <img src="img/3.png" alt="">
              <input class="icon_bt" type="radio" name="icon" value="3">
            </div>
            <div class="icon_men">
              <img src="img/4.png" alt="">
              <input class="icon_bt" type="radio" name="icon" value="4">
            </div>
            <div class="icon_men">
              <img src="img/5.png" alt="">
              <input class="icon_bt" type="radio" name="icon" value="5">
            </div>
          </div>
          <div class="icon_box">
            <div class="icon_men">
              <img src="img/6.png" alt="">
              <input class="icon_bt" type="radio" name="icon" value="6">
            </div>
              <div class="icon_men">
                <img src="img/7.png" alt="">
                <input class="icon_bt" type="radio" name="icon" value="7">
              </div>
             <div class="icon_men">
                <img src="img/8.png" alt="">
                <input class="icon_bt" type="radio" name="icon" value="8">
             </div>
             <div class="icon_men">
                <img src="img/9.png" alt="">
                <input class="icon_bt" type="radio" name="icon" value="9">
             </div>
             <div class="icon_men">
                <img src="img/10.png" alt="">
                <input class="icon_bt" type="radio" name="icon" value="10">
             </div>
          </div>
          <div class="login_btn-box">
            <button type="submit" class="btn btn-danger">登録する</button>
          </div>
        </form>
      </div>
    </header>
  </body>
</html>
