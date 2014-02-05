<?PHP
App::uses("HttpSocket","Network/Http");

/**
 * APIから運行情報を取得する.
 * ※運行情報とともにrailway情報もここで登録する
 */
class RailApiShell extends AppShell {
	var $consumer;
	var $trainInfoUrl = "https://api.odpt.org/api/v2/datapoints";
	var $uses = array(
		"Railway", "Company",
		"JREast", "Keio", "Keikyu",
		"Seibu", "Keisei", "Tobu",
		"TokyoMetro", "Tokyu", "TX", "Yurikamome");
	/**
	 * シェル初期化
	 * コンシューマキー設定
	 */
	public function initialize(){
		$this->consumer = Configure::read('APIConsumer.rail_api');
	}

	/**
	 * デフォルトで表示されるメッセージを封殺
	 */
	public function _welcome() {}

	/**
	 * メイン文
	 */
	public function main(){
		//trainInfo情報を取得する
		$trainInfoCompanies = $this->getCompanies();
		//print_r($trainInfoCompanies);

		//trainInfo分繰り返し
		foreach($trainInfoCompanies as $value ){
			$accessTarget = $value["odpt:trainInfoCompany"];
			//データ取得
			$data = $this->getData($accessTarget);
			//データがとれていたら下記の登録処理を行う
			if(is_array($data)) {
				foreach($data as $trainInfo) {
					$this->saveRailway($value,$trainInfo);
					$this->saveTrainInfo($value,$trainInfo);
				}
			}
			//break;
		}
	}

	/**
	 * accessTarget取得
	 */
	public function getCompanies(){
		$res = $this->Company->find("all",array(
			"fields"=>array("_id", "odpt:trainInfoCompany", "target", "name")
		));
		$result = array();
		foreach($res as $key=>$value) {
			$result[] = $value["Company"];
		}
		return $result;
	}

	/**
	 * 路線情報登録
	 * @param
	 */
	private function saveRailway($company, $data){
		$railway = @$data["odpt:trainInfoRailway"];
		if(!is_string($railway)){return false;}
		$this->Railway->setRailwayInfo($railway,$company["_id"]);
	}

	/**
	 * 運行情報登録
	 */
	private function saveTrainInfo($company, $data){
		$company_id = $company["_id"];
		$target = $company["target"];
		$railwayName = @$data["odpt:trainInfoRailway"];

		if(empty($railwayName)){
			$railway_id = -1;
		} else {
			$railway_id = GenerateId::generate($railwayName);
			$res = $this->Railway->find("first",array(
				"conditions"=>array("_id"=>$railway_id)
			));
			if(empty($res)){
				$railway_id = -1;
			}
		}
		$data["_id"] = $data["@id"];
		$data["company_id"] = $company_id;
		$data["railway_id"] = $railway_id;
		//保存
		$this->$target->save($data);
	}

	/**
	 * APIから運行情報を取得する
	 * @param  [type] $target [description]
	 * @param  array  $extend [description]
	 * @return [type]         [description]
	 */
	private function getData($target,$extend = array()){
		$defaultParam = array(
			"rdf:type"=>"odpt:TrainInfo",
			"acl:accessTarget"=>$target,
			"acl:consumerKey"=>$this->consumer
		);
		$param = array_merge($defaultParam,$extend);
		$socket = new HttpSocket();
		$res = $socket->get($this->trainInfoUrl,$param);
		if($res->code == 200){
			return json_decode($res->body,true);
		} else {
			$this->log($res->code . ": ".$res->reasonPhrase,"Shell_Error");
			return null;
		}
	}

}

