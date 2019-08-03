<?php
session_start();
require_once(__DIR__.'/core/dbconect.php');
ini_set('display_errors',1);


$id = $_REQUEST['id'];
if(!empty($id)){
  $statment = $db->prepare('SELECT * FROM users WHERE post_id=?');
  $statment->execute(array($id));
  $member = $statment->fetch();
}else {
  header('Locationfront.php');
}

if(!empty($_SESSION['id']) && $_SESSION['id'] === $member['member_id']){
  if($id === $member['post_id']){
    $del = $db->prepare('DELETE FROM users WHERE post_id=?');
    $del->execute(array($id));
  }
  $delete = '投稿が削除されました';
}else {
  header('Location:front.php');exit();
}

?>

<?php require_once(__DIR__.'/head.php'); ?>

  <body class="delete">
    <header class="section0">
      <div class="section_title-box">
        <h1 class="section0_title text-dark">削除完了</h1>
        <div class="section0_btn-box">
          <a href="front.php"><button type="button" class="btn bg-primary  text-light ">ホーム画面</button></a>
          <a href="mypage.php?page=<?php echo $_SESSION['id']; ?>"><button type="button" class="btn bg-dark  text-light">マイページ</button></a>
          <a href="logout.php"><button type="button" class="btn bg-success  text-light">ログアウト</button></a>
        </div>
        <div class="attention">
          <p><?php echo $delete; ?></p>
        </div>
      </div>
    </header>
  </body>
</html>
