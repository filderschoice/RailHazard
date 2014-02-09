<?PHP
	$this->Html->css("demo.css",null,array("inline"=>false));
?>
<!-- Header -->
<?php 
	echo $this->element('InfoNavHeader'); 
?>
<!-- Body -->
<div class="container">
	<h2 class="page-header"><?php echo $page_header_name ?></h2>
	<div class="row">
		<div class="col-md-8 col-xs-12">
			<ul class="nav nav-pills">
				<li class="active"><a href="#new_info" data-toggle="tab">
			  		<b><?php echo $route_tag_01 ?></b></a>
				</li>
				<li><a href="#railway" data-toggle="tab">
					<b><?php echo $route_tag_02 ?>
					</b></a>
				</li>
			  	<li><a href="#my_route" data-toggle="tab">
			  		<b><?php echo $route_tag_03 ?></b></a>
			  	</li>
			</ul>
			<div class="tab-content">
				<!-- タブ境界-->
				<div class="tab-pane active" id="new_info">
					<!-- タブタイトル-->
					<h3><b><?php echo $tab_title_01?></b></h3>
					<HR>
						<B><?php echo "ここに運行情報の最新情報を表示する！！" ?></B>
					<HR>
				</div>
				<!-- タブ境界-->
				<div class="tab-pane" id="railway">
					<!-- タブタイトル-->
					<h3><b><?php echo $tab_title_02?></b></h3>
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
					<h3><b><?php echo $tab_title_03?></b></h3>
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
<!-- Twitter Widget -->
			<?php echo $this->element('TwitterWidgetView'); ?>
<!-- AdSense -->
			<?php echo $this->element('AdSense_01'); ?>
		</div>
	</div>
</div><!-- /.container -->