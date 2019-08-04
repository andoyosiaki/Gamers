<?php
session_start();
require_once(__DIR__.'/core/dbconect.php');
require(__DIR__.'/functions/functions.php');
ini_set('display_errors',1);


if($_REQUEST['page']===$_SESSION['id']){
  $statment = $db->prepare('SELECT * FROM post INNER JOIN userinfo on userinfo.name = post.member WHERE post.member_id=? order by post.post_id desc');
  $statment->execute(array($_SESSION['id']));
}else {
  header('Location:front.php');
}

 ?>

<?php require_once(__DIR__.'/head.php'); ?>

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
</HTML>
