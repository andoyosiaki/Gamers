<?php
session_start();

if(isset($_POST['text']) && $_POST['text'] ===''){ //テキスト内容がポストされてるけどそれが空だった場合
   $error = 'error';
}


if(isset($_POST['text']) && $_POST['text'] !==''){ //テキスト内容がポストされていて空じゃない場合
  $_SESSION['text'] = $_POST['text'];
  header('Location: input.php');exit();
}

//ログインしてなかったらregisterに飛ばす
if(!$_SESSION['id']){
  header('Location:register.php');exit();
}


 ?>
 <!-- <!DOCTYPE html> -->
 <html lang="ja">
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>インサート画面</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
 	<link rel="stylesheet" href="animate/animate.min.css">
 	<link href="css/main.css" rel="stylesheet">
   	<script src="js/main.js"></script>
 </head>
  <body class="new">
    <div class="insert_section">
      <p><?php echo $_SESSION['title']; ?></p>
      <p><?php echo $_SESSION['hardware']; ?></p>
      <a href="<?php echo $_SESSION['itemurl']; ?>">
      <?php    $imginfo = getimagesize('data:application/octet-stream;base64,' . $_SESSION['image']);
         echo $image = '<img src="data:' . $imginfo['mime'] . ';base64,'.$_SESSION['image'].'">'; ?></a>

      <form class="insert_form-box" action="" method="post">
        <input type="hidden" name="title" value="<?php echo $_SESSION['title']; ?>">
        <input type="hidden" name="hardware" value="<?php echo $_SESSION['hardware']; ?>">
        <input type="hidden" name="itemurl" value="<?php echo $_SESSION['itemurl']; ?>">
        <input type="hidden" name="image" value="<?php echo $_SESSION['image']; ?>">
        <div class="form-group">
          <label for="exampleFormControlTextarea1"></label>
          <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="text" placeholder="このゲームの感想/紹介/オススメポイント/などをお書き下さい。"></textarea>
        </div>
          <?php if(!empty($error)){ ?>
            <p class="attention">テキストを入力してください</p>
          <?php endif;} ?>
        <div class="insert_tbn-box">
          <button type="submit" class="btn btn-primary">登録する</button>
        </div>
      </form>
      <a href="index.php">
        <button type="submit" class="btn btn-warning">一覧へ戻る</button>
      </a>
    </div>
  </body>
</html>
