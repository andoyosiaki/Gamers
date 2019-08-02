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
<!-- <!DOCTYPE html> -->
<html lang="ja">
<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>削除画面</title>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
 <link rel="stylesheet" href="animate/animate.min.css">
 <link href="css/main.css" rel="stylesheet">
   <script src="js/main.js"></script>
</head>
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
