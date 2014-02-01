# インストール

1. このリポジトリをクローンしてください。
2. サブモジュールを初期化してください（下参照）
3. Apacheの設定
	- apacheの補助設定を設置するディレクトリに，「settings/RailHazard.conf」をコピーする
	- コピーしたRailHazard.confを開き，パスを変更する（下参照）。
	- apacheを再起動する

```
サブモジュール初期化コマンド
$ git submodule update --init

```

```
※/path/to/RailHazardは，実際にアプリを設置するディレクトリのパスに変えてください。
<Directory /path/to/RailHazard/> <=ここを書き換える
...
</Directory>
```

# 構成

## Cakephp について

CakePHPについての詳しい説明は省略

## CAKEPHP の設定(2月1日 新規追加)

各種WebAPI等のコンシューマーキーやパスなどの漏洩を防ぐ為に，
CakePHPのコンフィグの管理方式を一部修正しています。

+ app/Config/Core/
+ app/Config/Bootstrap/
+ app/Config/Database/

それぞれのディレクトリにあった「development.php」ファイルを，
sample.phpという名前に変更しています。

自分の環境でアプリケーションを動かす際は，下記の通りファイルをコピーして
使ってください。

```
$cp app/Config/Core/sample.php app/Config/Core/development.php
$cp app/Config/Bootstrap/sample.php app/Config/Bootstrap/development.php
$cp app/Config/Database/sample.php app/Config/Database/development.php
※development.phpの「development」は，apacheに設定した環境変数の値になります。
```

## ベースクラスについて

ベースとなるクラスを，API用と，ページ用に分けています

* ページ用

BasicController.php


* API用

ApiController.php

ページ，APIの実装では，
それぞれのコントローラを継承して作成してください。

ページ，APIで共通して利用するような処理は，AppController.php
に実装してください

## レイアウトについて

Layoutファイル「View/Layouts/rail_hazard.ctp」を作成しています。

このレイアウトはデフォルトで利用できるようにBasicController.php内で
利用するように指定しています。

※ヘッダー部分しか実装していません。

Bootstrap, Javascriptはレイアウト内で読み込んでいるので，
そのまま利用できます。

## APIについて

ajaxで取得するデータは全てjsonで出力したいと思います。
そのため，ApiController内で「application/json」の
レスポンスヘッダーを付与するようにしています。

また，cakePHPでRESTfulなAPIを実装するには，
routerの設定をする必要があります。

詳しくはcakephp のHP

http://book.cakephp.org/2.0/ja/development/rest.html

を参照してください。
