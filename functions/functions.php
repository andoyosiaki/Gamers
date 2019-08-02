<?php

function h($s){
  return htmlspecialchars($s,ENT_QUOTES,'UTF-8');
}

function special($text){
  $h_text  =  h($text);
  $br_text = mb_substr($h_text,0,300);
  return  $sb_text = nl2br($br_text);
}

// login.php
function login($errors){
  if($errors === 'blank'){
  echo "登録されていません";
  }elseif ($errors === 'none') {
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
