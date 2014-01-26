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
