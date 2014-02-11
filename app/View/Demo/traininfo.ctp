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
			<h2 class="page-header"><?php echo $page_header_name ?></h2>
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<ul class="nav nav-pills">
						<li class="active"><a href="#railway" data-toggle="tab">
						<b>
							<?php echo $route_tag_01 ?>
						</b></a></li>
					  	<li><a href="#my_route" data-toggle="tab"><b><?php echo $route_tag_02 ?></b></a></li>
					</ul>
					<div class="tab-content">
						<!-- タブ境界-->
						<div class="tab-pane active" id="railway">
							<!-- タブタイトル-->
							<h3><b><?php echo $tab_title_01?></b></h3>
							<!-- タブプルダウンメニュー-->
							<HR>
							<div class="form form-inline" style="margin-bottom:10px;">
								<div class="form-group">
									<label for="company-select">
										<?php echo $pulldown_label_name_01 ?>
									</label>
									<select class="form-control" name="company-select">
									<?php
										while(list($value, $text) = each($dropdown_list_value_company)){
											echo "<option ";
											if($selected_value_company == $value){
												echo " selected ";
											}
											echo 'value=', $value, '>', $text, '</option>';
										}
									?>
									</select>
				 				</div>
								<div class="form-group">
									<label for="train-select">
										<?php echo $pulldown_label_name_02 ?>
									</label>
									<select class="form-control" name="train-select">
									<?php
										while(list($value, $text) = each($dropdown_list_value_train)){
											echo "<option ";
											if($selected_value_train == $value){
												echo " selected ";
											}	
											echo 'value=', $value, '>', $text, '</option>';
										}
									?>
									</select>
								</div>
								<div class="form-group"><button class="btn btn-primary">運行情報を表示</button></div>
							</div>
							<HR>
							<!-- タブコンテンツー-->
							<h4>運行情報: 
								<?php
									while(list($value, $text) = each($my_route_list_value_company)){
											if($selected_my_route_company == $value){
												echo $text;
											}	
										} 
								?></h4>
							<div class="hazard">
								<script id="railway_info" type="text/x-jquery-tmpl">
									{{if railstatus == 0}}		// 正常時
										<div class="hazard-item">
									{{else railstatus == 1}}	// 異常時
										<div class="hazard-item hazard">
									{{else}}					// それ以外
										// 処理なし
									{{/if}}
									<h4 class="hazard-title">${railname}</h4>
									<h4 class="hazard-status">${railname}</h4>
									{{if railstatus == 0}}		// 正常時
										<span class="label label-default">ALERT!!</span>
									{{else railstatus == 1}}	// 異常時
										<span class="label label-danger">ALERT!!</span>
									{{else}}					// それ以外
										// 処理なし
									{{/if}}
									</h4>
									<div class="row">
										<div class="train-image">
											//
										</div>
										<div class="train-info">
											${info_message}
										</div>
									</div>
									<div class="row">
										<div class="pull-right" style="margin-top:10px;">
											<button class="btn btn-default" onclick="location.href='#'">More</button>
											<button class="btn btn-info" onclick="location.href='#'">Tweetを見る</button>
										</div>
									</div>
								</script>

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
							<HR>
						</div>
						<!-- タブ境界-->
						<div class="tab-pane" id="my_route">
							<!-- タブタイトル-->
							<h3><b><?php echo $tab_title_02?></b></h3>
							<!-- MYルート情報表示-->
							<HR>
							<div id="title_myroute">
								<?php 
									echo '<h4>', $my_route_title, "</h4>";
									echo "<ul>";
									while(list($value, $text) = each($my_route_list)){
										echo '<li>', $text, '</li>';
									}
									echo "</ul>";
								?>
							</div>
							<HR>
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
							<HR>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-xs-12" >
<!--
					<div class="alert alert-info">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<p>広告表示部分はaffixでスクロールしても追尾するようにする</p>
						<a href="http://getbootstrap.com/javascript/#affix">Link</a>
					</div>
-->
					<div>
						<a class="twitter-timeline" data-theme="dark" height="500" href="https://twitter.com/search?q=%23%E5%B0%8F%E7%94%B0%E6%80%A5%E5%B0%8F%E7%94%B0%E5%8E%9F%E7%B7%9A" data-widget-id="431417384507686912">#小田急小田原線 に関するツイート</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</div>
					<div class="jumbotron">
						広告
					</div>
				</div>
			</div>
		</div><!-- /.container -->