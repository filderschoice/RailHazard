<?PHP
	$this->Html->css("demo.css",null,array("inline"=>false));
	function insertItem($context){
		$image = $context->Html->image("yamanote.gif");
		return <<<HTML
<li>
	<div class="row">
		<div class="col-md-2 col-xs-2 train-image">
			{$image}
		</div>
		<div class="col-md-10 col-xs-10 train-info">
			<h3 class="train-name">山手線</h3>
			<div class="train-info-text">
				本日午前９時に発生した人身事故により，現在山手線は運転を見合わせています。
			</div>
			<div>
				<button class="btn btn-info">Twitterの反応を見る</button>
			</div>
		</div>
	</div>
</li>
HTML;
	}
?>
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">Rail Hazard</a>
				</div>
				<div class="collapse navbar-collapse">
					<ul class="nav navbar-nav">
						<li class="active"><a href="#">運行情報</a></li>
						<li><a href="#">マイルート</a></li>
						<li><a href="#">ランキング</a></li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>

		<div class="container">
			<h3 class="page-header">現在の運行情報（タイムライン型）</h3>
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						レイアウトは適当。タイムラインの情報は１分間に１回更新する
					</div>
					<div>
						<div class="form form-inline" style="margin-bottom:10px;">
							<div class="form-group">
								<label for="company-select">鉄道会社</label>
								<select class="form-control" name="company-select">
									<option>全て表示</option>
									<option>JR東日本(山手線)</option>
									<option>東京メトロ</option>
									<option>東武線</option>
									<option>東横線</option>
								</select>
							</div>
							<div class="form-group">
								<label for="train-select">路線</label>
								<select class="form-control" name="train-select">
									<option>有楽町線</option>
									<option>副都心線</option>
									<option>半蔵門線</option>
									<option>銀座線</option>
								</select>
							</div>
							<div class="form-group"><button class="btn btn-primary">運行情報を表示</button></div>
						</div>
					</div>
					<ul class="timeline">
						<?PHP for($i = 0;$i < 50; $i++){
							echo insertItem($this);
						}?>
					</ul>
				</div>
				<div class="col-md-4 col-xs-12" >
					<div data-spy="affix" data-offset-top="10" data-offset-bottom="5">
						<div class="alert alert-info">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<p>広告表示部分はaffixでスクロールしても追尾するようにする。モバイルの場合はページ下部に廻る</p>
							<a href="http://getbootstrap.com/javascript/#affix">Link</a>
						</div>
						<div class="jumbotron">
							TwitterタイムラインWidget
						</div>
						<div class="jumbotron">
							広告
						</div>
					</div>
				</div>
			</div>
		</div><!-- /.container -->