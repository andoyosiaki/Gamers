<?php
//楽天デベロッパーid
define('ACOUNT_ID',1083140160780730237);

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

function special($text){
  $h_text  =  h($text);
  $br_text = mb_substr($h_text,0,300);
  return  $sb_text = nl2br($br_text);
}

function title($title){
  $titles = str_replace(array('.php','/games/'),'',$title);
  switch ($titles) {
    case 'front':
    echo  "Gamers";
      break;
    case 'index':
    echo "投稿画面";
      break;
    case 'login':
    echo   "ログイン画面";
      break;
    case 'register':
    echo  "会員登録画面";
      break;
    case 'new':
    echo  "インサート画面";
      break;
    case 'mypage':
    echo "マイページ画面";
      break;
    case 'update';
    echo "編集画面";
      break;
  }
}

// login.php
function login($errors){
  if($errors === 'nouser'){
  echo "登録されていません";
}elseif ($errors === 'blank') {
  echo "空欄があります";
  }
}

// register.php
function RegisterAcount($name){
  if($name === 'blanlk'){
    echo "アカウント名を入力してください。";
  }elseif ($name === 'length_name') {
    echo "アカウント名は10文字以下でおねがいします。";
  }elseif ($name === 'alph_chara') {
    echo "アカウント名は半角英数文字でおねがいします。";
  }elseif ($name === 'duplicate') {
    echo "このアカウント名はすでに使われています";
  }
}

// register.php
function Registerpassword($password){
  if($password === 'blanlk'){
    echo "エラー";
  }elseif ($password === 'length') {
    echo "パスワードは４文字以上でおねがいします。";
  }
}

// index.php
function image($souce){
  $img = file_get_contents($souce);
  $enc_img = base64_encode($img);
  $imginfo = getimagesize('data:application/octet-stream;base64,' . $enc_img);
  return  $images = '<img src="data:' . $imginfo['mime'] . ';base64,'.$enc_img.'">';
}

//index.php
function img($souces){
  $img = file_get_contents($souces);
  return  $enc_img = base64_encode($img);
}
