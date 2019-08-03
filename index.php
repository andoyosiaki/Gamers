<?php
session_start();
require_once(__DIR__.'/core/dbconect.php');
require(__DIR__.'/functions/functions.php');
ini_set('display_errors',1);


if(isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()){
  $_SESSION['time'] = time();

  $statment = $db->prepare('SELECT * FROM userinfo WHERE id=?');
  $statment->execute(array($_SESSION['id']));
  $member = $statment->fetch();
}else {
  header('Location:front.php');exit();
}

//データ抽出
if(!empty($_POST['text'])){
  $post = str_replace(array(" ", "　"), "", $_POST['text']); //空白があるとエラーが出るので除外
}

if(isset($post) && strlen($post) > 1 && mb_strlen($post) > 1){ //１文字だけを入力するとエラーが出るので除外
  if($post){
  $url = file_get_contents("https://app.rakuten.co.jp/services/api/BooksGame/Search/20170404?format=json&title=".$post."&booksGenreId=006&applicationId=".ACOUNT_ID."");
  $json = json_decode($url,true);
   $n = count($json['Items']); //存在する商品の数
  }
}elseif(!isset($post)){
  $nodata = 'firstcontact';
}
else {
  $nodata = 'nodata';
}

 ?>

  <?php require_once(__DIR__.'/head.php'); ?>

   <body>
    <header class="section0">
     <div class="section_title-box">
       <h1 class="section0_title">投稿画面</h1>
       <div class="section0_btn-box">
         <a href="front.php"><button type="button" class="btn bg-primary  text-light ">ホーム画面</button></a>
         <a href="mypage.php?page=<?php echo $_SESSION['id']; ?>"><button type="button" class="btn bg-dark  text-light">マイページ</button></a>
         <a href="logout.php"><button type="button" class="btn bg-success  text-light">ログアウト</button></a>
       </div>
       <form class="serch_form" action="" method="post">
         <div class="form-group">
          <label for="Input">ゲームのタイトル名を入力してください</label>
          <input type="text" class="form-control form-control-lg" id="Input" name="text" placeholder="例) GTA5">
        </div>
         <button type="submit" class="btn-danger">検索</button>
       </form>
     </div>
    </header>

    <div class="serch_section" >
      <?php if(isset($nodata) && $nodata === 'firstcontact'): ?><p class="attention"><?php echo "検索フォームにゲームのタイトルを入力してください...。"; ?></p>
      <?php elseif(isset($nodata) && $nodata === 'nodata'): ?><p class="attention"><?php echo "検索結果は０でした...。"; ?></p>
      <?php elseif($n===0): ?><p class="attention"><?php echo "検索結果は０でした...。"; ?></p>
      <?php else: ?>
        <?php for ($i=0; $i < $n; $i++): ?>  <!-- 検索アイテムの数だけ表示。 -->
          <div class="serch_wrap-box">
            <p><?php echo  $title = $json['Items'][$i]['Item']['title']; ?></p>
            <p><?php echo  $hardware = $json['Items'][$i]['Item']['hardware']; ?></p>
            <div class="img_box">
              <a href="<?php echo  $itemUrl = $json['Items'][$i]['Item']['itemUrl']; ?>"><?php echo image($json['Items'][$i]['Item']['largeImageUrl']); ?></a>
            </div>
            <div class="serch_form-box">
              <form class="btn_box" action="next.php" method="post">
                <input type="hidden" name="title" value="<?php echo $title; ?>">
                <input type="hidden" name="hardware" value="<?php echo $hardware; ?>">
                <input type="hidden" name="itemurl" value="<?php echo $itemUrl; ?>">
                <input type="hidden" name="image" value="<?php echo img($json['Items'][$i]['Item']['largeImageUrl']); ?>">
                <button type="submit" class="btn btn-danger" >これを紹介する</button>
              </form>
            </div>
          </div>
        <?php endfor; ?>
      <?php endif; ?>
    </div>

  </body>
</html>
