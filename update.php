<?php
session_start();
require_once(__DIR__.'/core/dbconect.php');
require(__DIR__.'/functions/functions.php');
ini_set('display_errors',1);

$statment = $db->prepare('SELECT * FROM post INNER JOIN userinfo on userinfo.name = post.member WHERE post.post_id=?');
$statment->execute(array($_REQUEST['page']));
$items = $statment->fetch();

if($_SESSION['id'] === $items['id']){
  if(isset($_POST['text']) && $_POST['text'] != ''){
    $statment = $db->prepare('UPDATE post SET texts=? WHERE post_id=?');
    $statment->execute(array($_POST['text'],$_REQUEST['page']));
    $changed = "exist";
  }elseif(isset($_POST['text']) && $_POST['text'] === '') {
    $changed = 'blank';
  }
}else {
  header('Location:front.php');exit();
}

 ?>

<?php require_once(__DIR__.'/head.php'); ?>

  <body class="update">
    <article class="section1">
        <div class="sec1_wrap-box">
          <div class="sec1_item-box">
            <p class="item_hard"><?php echo $items['hardware']; ?></p>
            <h2 class="item_title"><?php echo $items['title']; ?></h2>
          </div>
          <div class="sec1_item_author-box">
            <div class="article_itemimg-box">
              <div class="sec1_itemimg-box">
                <?php $imginfo = getimagesize('data:application/octet-stream;base64,' . $items['image']);
                 echo $image = '<img src="data:' . $imginfo['mime'] . ';base64,'.$items['image'].'">'; ?>
              </div>
            </div>
            <div class="sec1_aut_int-box">
              <div class="sec1_author-box">
                  <div class="sec1_authorimg-box">
                      <p><img src="img/<?php echo $items['icon']; ?>.png" alt=""></p>
                  </div>
                <p class="sec1_member"><?php echo h($items['member']); ?>さん</p>
              </div>
              <div class="sec1_intro-box">
                <p><?php echo special($items['texts']); ?></p>
              </div>
            </div>
          </div>
          <div class="item_detail">
            <a href="<?php echo $items['itemurl']; ?>">
            <button type="button" class="btn btn-outline-primary bg-light">　詳　細　</button>
            </a>
          </div>
        </div>
    </article>

    <div class="insert_tbn-box text-center mb-5">
      <a href="mypage.php?page=<?php echo $_SESSION['id']; ?>"><button  class="btn  bg-warning text-light">マイページ</button></a>
    </div>
    <div class="insert_section">
        <form class="" action="update.php?page=<?php echo $items['post_id']; ?>" method="post">
        <textarea name="text" rows="8" cols="80" placeholder=""></textarea>
        <div class="insert_tbn-box">
          <button type="submit" class="btn  bg-danger text-light">送信</button>
        </div>
        <div class="attention">

          <p><?php if(isset($changed) && $changed === 'exist'){ echo '変更完了しました';} ?></p>
          <p><?php if(isset($changed) && $changed === 'blank') {echo '変更内容を入力してください';}?></p>
        </div>
        </form>
    </div>
  </body>
</html>
