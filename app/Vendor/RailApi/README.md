# Train API使い方

## インスタンス生成方法

```
$api = new TrainApi("コンシューマーキー");
```

## APIにアクセス

```
$api->accessAPI($endPoint, $parameter);
# $endPointは"/api/v2/datapoints" または "/api/v2/places" を指定
# $parameter は，リクエストパラメータの連想配列
```

## サンプル
```
$api = new TrainApi("Your CONSUMER KEY");
$data = $api->accessAPI("/api/v2/datapoints",array(
	"rdf:type"=>"odpt:TrainInfo",
	"acl:accessTarget"=>"Tobu"
));
```

## レスポンスヘッダー情報

レスポンスヘッダは，TrainApi::headerに連想配列の形式でセットされます。

```
Array
(
    [Code] => 200
    [Message] => OK
    [Server] => nginx/1.4.3
    [Date] => Mon, 20 Jan 2014 17:48:31 GMT
    [Content-Type] => application/json;charset=utf-8
    [Content-Length] => 4651
    [Connection] => keep-alive
    [X-Content-Type-Options] => nosniff
);
```

## リクエストが正常に行われなかった場合

HTTPリクエストが正しく行われなかった場合は，レスポンス，ヘッダ情報共にNULLになります。
