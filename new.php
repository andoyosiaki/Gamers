<?php
session_start();
require(__DIR__.'/functions/functions.php');
ini_set('display_errors',1);


//テキストが空だったら'error'挿入
if(empty($_POST['text']) && $_POST === ''){
   $error = 'error';
}

//テキストの内容をセッションに保存
if(isset($_POST['text'])){
  $_SESSION['text'] = $_POST['text'];
  header('Location: input.php');exit();
}

//ログインしてなかったらregisterに飛ばす
if(!$_SESSION['id']){
  header('Location:register.php');exit();
}

 ?>

<?php require_once(__DIR__.'/head.php'); ?>

  <body class="new">
    <div class="insert_section">
      <p><?php echo $_SESSION['title']; ?></p>
      <p><?php echo $_SESSION['hardware']; ?></p>
      <a href="<?php echo $_SESSION['itemurl']; ?>">
      <?php $imginfo = getimagesize('data:application/octet-stream;base64,' . $_SESSION['image']);
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
          <?php if(isset($error) && $error === 'error'): ?>
            <p class="attention">テキストを入力してください</p>
          <?php endif; ?>
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
