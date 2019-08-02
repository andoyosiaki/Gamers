<?php
session_start();
require_once(__DIR__.'/core/dbconect.php');
require(__DIR__.'/functions/functions.php');
ini_set('display_errors',1);

if($_REQUEST['page']===$_SESSION['id']){
  $statment = $db->prepare('SELECT * FROM users INNER JOIN userinfo on userinfo.name = users.member WHERE users.member_id=? order by users.post_id desc');
  $statment->execute(array($_SESSION['id']));
}else {
  header('Location:front.php');
}

 ?>
 <!-- <!DOCTYPE html> -->
 <html lang="ja">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>マイページ</title>
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
       <h1 class="section0_title">マイページ</h1>
       <div class="section0_btn-box">
         <?php if (isset($_SESSION['id'])) { ?><a href="front.php"><button type="button" class="btn bg-primary  text-light">投稿一覧</button></a><?php } ?>
         <?php if (isset($_SESSION['id'])) { ?><a href="index.php"><button type="button" class=" btn bg-warning text-dark">投稿画面</button></a><?php } ?>
         <?php if (isset($_SESSION['id'])) { ?><a href="logout.php"><button type="button" class="btn bg-success  text-light">ログアウト</button></a><?php } ?>
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
                <?php require(__DIR__.'/functions/image.php'); ?>
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
         <?php if($_REQUEST['page']===$_SESSION['id']): ?>
           <div class="change_btn-box">
             <div class="delete_btn">
               <a href="delete.php?id=<?php echo $items['post_id']; ?>">削除</a>
             </div>
             <div class="update_btn">
              <a href="update.php?page=<?php echo $items['post_id']; ?>">編集</a>
             </div>
           </div>
         <?php endif; ?>
       </div>
     <?php endwhile; ?>
   </article>
 </body>
