<?PHP
App::uses("HttpSocket","Network/Http");

class RailApiShell extends AppShell {
	var $consumer = CONSUMER_RAIL_API;
	var $trainInfoUrl = "https://api.odpt.org/api/v2/datapoints";
	var $uses = array("JREast", "Keio", "Keisei", "Tobu", "TokyoMetro", "Tokyu", "TX", "Yurikamome");
	public function _welcome() {}

	public function main(){
		$data = $this->getJREast();
		$this->save($data, $this->JREast);
		$data = $this->getTobu();
		$this->save($data, $this->Tobu);
		$data = $this->getTX();
		$this->save($data, $this->TX);
		$data = $this->getKeisei();
		$this->save($data, $this->Keisei);
		$data = $this->getKeio();
		$this->save($data, $this->Keio);
		$data = $this->getYurikamome();
		$this->save($data, $this->Yurikamome);
		$data = $this->getTokyoMetro();
		$this->save($data, $this->TokyoMetro);
		$data = $this->getTokyu();
		$this->save($data, $this->Tokyu);
	}

	private function save($data,$model){
		$result = array();
		foreach($data as $value){
			$id = $value["@id"];
			$value["_id"] = $id;
			$model->save($value);
		}
		return $this;
	}

	/**
	 * JR東日本の運行情報を取得する
	 * @return [type] [description]
	 */
	private function getJREast(){
		return  $this->getData("JR-East");
	}

	/**
	 * 東武鉄道の運行情報を取得する
	 */
	private function getTobu(){
		return  $this->getData("Tobu");
	}

	/**
	 * 筑波エクスプレス
	 */
	private function getTX(){
		return $this->getData("TX");
	}

	/**
	 * 京成電鉄
	 */
	private function getKeisei(){
		return $this->getData("Keisei");
	}

	/**
	 * 京王電鉄
	 */
	private function getKeio(){
		return $this->getData("Keio");
	}

	/**
	 * ゆりかもめ
	 */
	private function getYurikamome(){
		return $this->getData("Yurikamome");
	}

	/**
	 * 東京メトロ
	 */
	private function getTokyoMetro(){
		return $this->getData("TokyoMetro");
	}

	/**
	 * 東急電鉄
	 */
	private function getTokyu(){
		return $this->getData("Tokyu");
	}

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
			$this->log($e->getMessage(),"Shell_Error");
			return null;
		}
	}

}

