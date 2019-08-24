<?php
session_start();
require_once __DIR__."/core/dbconect.php";
require __DIR__."/functions/functions.php";


if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
  $page = $_REQUEST['page'];
}else {
  $page = 1;
}

$count = 5 * ($page - 1);
$statment = $db->prepare('SELECT * FROM post INNER JOIN userinfo on userinfo.name=post.member order by post.post_id DESC LIMIT ?,5');
$statment->bindParam(1,$count,PDO::PARAM_INT);
$statment->execute();

?>
<?php require_once __DIR__."/head.php"; ?>
  <body>
    <header class="section0">
      <div class="section_title-box">
        <h1 class="section0_title">Gamers</h1>
        <div class="section0_btn-box">
          <?php if(!isset($_SESSION['id'])){ ?><a href="login.php"><button type="button" class="btn bg-danger  text-light">ログイン</button></a><?php } ?>
          <?php if(!isset($_SESSION['id'])){ ?><a href="register.php"><button type="button" class="btn bg-primary  text-light">会員登録</button></a><?php } ?>
          <?php if (isset($_SESSION['id'])){ ?><a href="index.php"><button type="button" class=" btn bg-warning text-dark">投稿画面</button></a><?php } ?>
          <?php if (isset($_SESSION['id'])){ ?><a href="mypage.php?page=<?php echo $_SESSION['id']; ?>"><button type="button" class="btn bg-dark  text-light">マイページ</button></a><?php } ?>
          <?php if (isset($_SESSION['id'])){ ?><a href="logout.php"><button type="button" class="btn bg-success  text-light">ログアウト</button></a><?php } ?>
        </div>
      </div>
    </header>
    <article class="section1">
      <?php while($items = $statment->fetch()): ?>
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
      <?php endwhile; ?>
    </article>
    <div class="paging_box">
        <?php if($page >= 2): ?>
            <a href="front.php?page=<?php echo ($page-1); ?>"><i class="fas fa-arrow-circle-left fa-4x"></i></a>
        <?php endif; ?>
        <?php $counts = $db->query('SELECT COUNT(*) as cnt FROM post');
          $count= $counts->fetch();
          $max_num = floor($count['cnt'] / 5) + 1;
          if($page < $max_num):?>
          <a href="front.php?page=<?php echo ($page+1); ?>"><i class="fas fa-arrow-circle-right fa-4x"></i></a>
        <?php endif; ?>
    </div>
    <footer style="text-align:center;">
     <!-- Rakuten Web Services Attribution Snippet FROM HERE -->
      <a href="https://webservice.rakuten.co.jp/" target="_blank">Supported by Rakuten Developers</a>
     <!-- Rakuten Web Services Attribution Snippet TO HERE -->
    </footer>
  </body>
</html>
