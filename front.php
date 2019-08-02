<?php
session_start();
require_once(__DIR__.'/core/dbconect.php');
require(__DIR__.'/functions/functions.php');
ini_set('display_errors',1);


if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
  $page = $_REQUEST['page'];
}else {
  $page = 1;
}

$count = 5*($page - 1);
$statment = $db->prepare('SELECT * FROM users INNER JOIN userinfo on userinfo.name=users.member order by users.post_id DESC LIMIT ?,5');
$statment->bindParam(1,$count,PDO::PARAM_INT);
$statment->execute();

 ?>
 <!-- <!DOCTYPE html> -->
 <html lang="ja">
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Gamers</title>
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
            <p class="item_hard <?php echo $add; ?>"><?php echo $items['hardware']; ?></p>
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
          <?php $counts = $db->query('SELECT COUNT(*) as cnt FROM users');
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
