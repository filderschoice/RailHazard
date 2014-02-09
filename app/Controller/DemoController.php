<?PHP

App::uses('BasicController','Controller');

class DemoController extends BasicController {
	public function beforeFilter(){
		parent::beforeFilter();
	}

	public function index(){
	}

	public function mock(){

	}

	public function mock2(){
	}

	public function traininfo(){

		// 画面表示用マクロ
		$this->set("page_header_name", "現在の運行情報（アラート型）");
		$this->set("tab_title_01","路線別運行情報");
		$this->set("tab_title_02","MYルート運行情報");
		$this->set("my_route_title","＜設定済みMYルート＞");
		$this->set("route_tag_01","路線別");
		$this->set("route_tag_02","Myルート");
		$this->set("pulldown_label_name_01","鉄道会社");
		$this->set("pulldown_label_name_02","路線");

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
}