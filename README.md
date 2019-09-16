はじめに

このアプリはPHPを独学で学習している私がアウトプットの１つとして作成したもので、セキュリティなどに問題があるかもしれません。  
もし実際にアプリを動作させるような場合はローカル環境で動作させてください。
あと、もし眼に余るようなトンデモナイ記述をしていたらそっと<a href="https://twitter.com/float_top">ツイッター</a>のDMにでも連絡いただければ幸いです。(；´Д`)


アプリ名
====
**<a href="https://games.kagomeee.com/">Gamers</a>**
<img src="https://user-images.githubusercontent.com/52596476/64943603-24337180-d8a7-11e9-95e5-10c40391f0fd.png" width="1000">

## 簡単な説明
ゲームの会員制口コミサイトです。  
初めてユーザー登録機能を搭載させました。セキュリティ面に不安があるのでユーザーにはメールアドレスは要求せず、任意の半角英数文字(アカウント名)と任意の半角英数文字(パスワード)を用いて会員登録してもらいます。  
商品検索には楽天APIを使っているので楽天で取り扱っているゲームのみ投稿可能となります。よってソーシャルゲームなどは投稿不可能となります。


## 機能
1. ユーザー登録機能
1. ログイン・ログアウト機能
1. 商品検索機能（楽天API）
1. コンテンツ投稿機能
1. コンテンツ編集機能
1. コンテンツ削除機能
1. マイページ機能
1. ユーザー投稿一覧表示機能


## 開発環境
使用言語・データーベース
* PHP
* HTML
* CSS（SCSS）
* MYSQL  

使用ツール・ライブラリ
* bootstrap4
* MAMP
* Font Awesome
* Atom Editor

## 利用方法

ダウンロード後に `functions/functions.php` の冒頭にある
`define('ACOUNT_ID',◯◯◯◯◯◯◯);`より楽天アプリIDを設定してAPIを動作可能にしてください。  
アプリIDの発行はこちらからどうぞ<a href='https://webservice.rakuten.co.jp/'>「楽天デベロッパーズ」</a>


## 作った感想と今後の課題

今回初めてユーザー登録を実装させました。できれば登録ユーザー自身にユーザーアイコンをアップロードしてもらってコンテンツの表示とともにアカウント名と一緒にユーザーアイコンを表示させたかったのですが、画像のサイズの変更処理などが分からず、苦肉の策としてサイズを統一した１０種類のアイコンをこちらで用意して、ユーザーが会員登録の際に１０種類の中から好きなアイコンを選択してもらう形式にしました。  
ユーザーがアップロードしたオリジナルのアイコン画像をcssを使って横縦幅を無理やり調整して縮小させる方法も考えたのですが、あまり良い処理の方法とは思えないので取りやめました。

また商品検索には楽天APIを使用しました。  
検索結果はjsonデータで送られてくるので、エンコードして存在する商品の分だけforで回して表示しています。  
楽天APIに関するネットの情報を見る限り私が書いたプログラムは推奨されない書き方のような気がするのですが、動いてしまっているのでそのまま稼働させてしまっています。  
当該プログラムはindex.phpの18〜35行目、forは64〜81行目で商品表示処理をしています。  

バリデーションも適切な関数を使用しないと意図しない表示がされてしまったりして,Qiitaのバリデーション早見表などを何度も確認しながら実装させました。  

今回のアプリ作成で1番躓いたポイントはjsonデータで送られてきた商品画像のurlから、画像データをBase64にエンコードして取得する所です。  
jsonデータを取り合うかつのも今回が初めてな上に、Base64とは？？って所から始めたので非常に大変でした。  
基礎的なログインシステムの構築やjsonデータの加工などはPHPの入門書に書かれているのですが、urlから画像データを取得する方法はさすがに解説しておらず、全てネットからの情報を得て実装させました。
作成当初からtwiiterにて完成後は公開する予定でしたので、本番環境に移行後にエラー表示が出ないよう何度もコードのチェックなども入念に行いました。
完成後は予定通りtwiiterにて公開したところ、ありがたい事に数名の方が実際に会員登録をしてコンテンツの投稿をしてくれました。
