<!doctype html>
<html>
	<head>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no"/>
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta http-equiv="pragma" content="no-cache" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="expires" content="0" />
		<?PHP
		//ライブラリ読み込み
		echo $this->Html->css("/libs/bootstrap/css/bootstrap.min.css");
		echo $this->Html->script("/libs/jquery/jquery.min.js");
		echo $this->Html->script("/libs/bootstrap/js/bootstrap.min.js");
		?>
	</head>
	<body>
		<?PHP echo $content_for_layout;?>
	</body>
</html>