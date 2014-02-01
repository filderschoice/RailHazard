<?PHP
	$this->Html->css("demo.css",null,array("inline"=>false));
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
			<h3 class="page-header">現在の運行情報（アラート型）</h3>
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						レイアウトは適当。タイムラインではなく，常に最新の運行情報が表示される。
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
					<h4>マイルート運行情報</h4>
					<div class="hazard">
						<div class="hazard-item hazard-alert">
							<h4 class="hazard-title">山手線</h4>
							<h4 class="hazard-status">
								<span class="label label-danger">ALERT!!</span> <span style="color:#f00;font-weight:bold;">運行情報あり</span>
							</h4>
							<div class="row">
								<div class="train-image">
									<?PHP echo $this->Html->image("yamanote.gif");?>
								</div>
								<div class="train-info" >
									午前９時に発生した有楽町線人身事故の影響で，山手線は現在運転を見合わせております
								</div>
							</div>
							<div class="row">
								<div class="pull-right" style="margin-top:10px;">
									<button class="btn btn-default">More</button>
									<button class="btn btn-info">Tweetを見る</button>
								</div>
							</div>
						</div>
						<div class="hazard-item">
							<h4 class="hazard-title">東上線</h4>
							<h4 class="hazard-status">
								<span class="label label-default">ALERT!!</span> <span></span>
							</h4>
							<div class="row">
								<div class="train-image">
									<?PHP echo $this->Html->image("tojo.gif");?>
								</div>
								<div class="train-info">
									東上線は通常通り運転しています
								</div>
							</div>
							<div class="row">
								<div class="pull-right" style="margin-top:10px;">
									<button class="btn btn-default">More</button>
									<button class="btn btn-info">Tweetを見る</button>
								</div>
							</div>
						</div>
					</div>

					<h4>東京メトロ運行情報</h4>
					<div class="hazard">
						<div class="hazard-item hazard">
							<h4 class="hazard-title">副都心線</h4>
							<h4 class="hazard-status">
								<span class="label label-danger">ALERT!!</span>
							</h4>
							<div class="row">
								<div class="train-image">
									<?PHP echo $this->Html->image("yamanote.gif");?>
								</div>
								<div class="train-info" >
									副都心線は正常に運転しています
								</div>
							</div>
							<div class="row">
								<div class="pull-right" style="margin-top:10px;">
									<button class="btn btn-default">More</button>
									<button class="btn btn-info">Tweetを見る</button>
								</div>
							</div>
						</div>
						<div class="hazard-item">
							<h4 class="hazard-title">有楽町線</h4>
							<h4 class="hazard-status">
								<span class="label label-default">ALERT!!</span> <span></span>
							</h4>
							<div class="row">
								<div class="train-image">
									<?PHP echo $this->Html->image("tojo.gif");?>
								</div>
								<div class="train-info">
									有楽町線は正常通り運転しています
								</div>
							</div>
							<div class="row">
								<div class="pull-right" style="margin-top:10px;">
									<button class="btn btn-default">More</button>
									<button class="btn btn-info">Tweetを見る</button>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="col-md-4 col-xs-12" >
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>広告表示部分はaffixでスクロールしても追尾するようにする</p>
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
		</div><!-- /.container -->