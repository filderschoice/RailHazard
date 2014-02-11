<?php

App::uses('BasicController','Controller');

class InfoController extends BasicController{

	// マクロ定義
	$ALERT_NOTDENGER = 0;
	$ALERT_DENGER = 1;
	
	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index(){
			// 画面表示用マクロ
		$this->set("page_header_name", "現在の運行情報（アラート型）");
		$this->set("route_tag_01","最新情報");
		$this->set("route_tag_02","路線別");
		$this->set("route_tag_03","Myルート");

		$this->set("tab_title_01","最新運行情報");
		$this->set("tab_title_02","路線別運行情報");
		$this->set("tab_title_03","MYルート運行情報");

		$this->set("pulldown_label_name_01","鉄道会社");
		$this->set("pulldown_label_name_02","路線");

		$this->set("my_route_title","＜設定済みMYルート＞");

		// ドロップダウンリスト１定数
		$this->set("dropdown_list_value_company", 
				array(
					"-",
					"全て表示",
					"JR東日本",
					"東京メトロ",
					"東武線",
					"東横線"
				));
		$this->set("selected_value_company", 0);

		// ドロップダウンリスト２定数
		$this->set("dropdown_list_value_train", 
				array(
					"-",
					"有楽町線",
					"副都心線",
					"半蔵門線",
					"銀座線"
				));
		$this->set("selected_value_train", 0);

		// ドロップダウンリスト３定数
		$this->set("my_route_list", 
				array(
					"小田急鉄道：小田急小田原線",
					"JR東日本：南武線"
				));

		// MYルートリスト１定数
		$this->set("my_route_list_value_company", 
				array(
					"-",
					"JR東日本",
					"京王電鉄",
					"京成電鉄",
					"首都圏新都市鉄道",
					"東急鉄道",
					"東京地下鉄",
					"東武鉄道",
					"ゆりかもめ",
					"JR東日本"
				));
		$this->set("selected_my_route_company", 1);

		// MYルートリスト２定数
		$this->set("my_route_list_value_train", 
				array(
					"-",
					"JR東日本",
					"京王電鉄",
					"京成電鉄",
					"首都圏新都市鉄道",
					"東急鉄道",
					"東京地下鉄",
					"東武鉄道",
					"ゆりかもめ",
					"JR東日本"
				));
		$this->set("selected_my_route_train", 2);

		$rail_company_list = array(
			"京王電鉄",
			"京王電鉄",
			"京王電鉄",
			"京王電鉄",
			"京成電鉄",
			"京成電鉄",
			"首都圏新都市鉄道",
			"首都圏新都市鉄道",
			"首都圏新都市鉄道",
			"首都圏新都市鉄道",
			"首都圏新都市鉄道",
			"首都圏新都市鉄道",
			"東京地下鉄",
			"東京地下鉄",
			"東京地下鉄",
			"東京地下鉄",
			"東京地下鉄",
			"東京地下鉄",
			"東京地下鉄",
			"東京地下鉄",
			"東京地下鉄",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道",
			"東武鉄道"
		);
	}

	public function dropdown_list($list_class, $list_name, $list_value, $selected_value){
		echo '<select class=', $list_class, 'name=', $list_name, '>';
		while(list($value, $text) = each($list_value)){
			echo "<option ";
			if($selected_value == $value){
				echo " selected ";
			}
			echo 'value=', $value, '>', $text, '</option>';
		}
		echo "</select>";
	}

	public function railway_info($railname, ){
		<?php
			// 運行情報表示マクロ
			echo "<div class=\"hazard-item hazard\">";
			// 路線名
			echo '<h4 class=\"hazard-title\">', $railname, '</h4>';
			// 路線運行状態
			echo '<h4 class=\"hazard-status\">';
				switch($railstatus){
				case $ALERT_DENGER:		// 異常時
					'<span class=\"label label-danger\">', '</h4>';
					break;
				case $ALERT_NOTDENGER:	// 正常時
				defalut:				// その他
					'<span class=\"label label-default\">', '</h4>';
					break;
				}
			echo 'ALERT!</span>';
			echo '</h4>';
			// 路線状況詳細１
			echo '<div class=\"row\">';
			echo '<div class=\"train-image\">';
				echo $this-Html->image("tojo.gif");
			echo '</div>';
			echo '<div class=\"train-info\">';
				echo $railname, 
			echo '</div>';
		?>
	}
}

?>