<?PHP
/**
 * RailHazard用マイグレーション用のシェル
 */
class RailHazardShell extends AppShell {
	/**
	 * メイン文
	 * @return [type] [description]
	 */
	public function main(){
		$this->createAccessPoint();
	}

	/**
	 * 公共交通データのアクセスポイントのリスト作成
	 */
	public function createAccessPoint(){
		$this->loadModel('RailTarget');
		$data = array(
			array("JREast", "JR東日本"),
			array("Keio", "京王線"),
			array("Keisei", "京成線"),
			array("Tobu", "東武線"),
			array("TokyoMetro", "東京メトロ"),
			array("Tokyu", "東急線"),
			array("TX", "つくばエクスプレス"),
			array("Yurikamome","ゆりかもめ"),
			array("Keikyu","京急線"),
			array("Seibu","西武線")
		);
		$i = 10001;
		foreach($data as $value){
			$this->RailTarget->save(array(
				"_id"=>$i,
				"target"=>$value[0],
				"name"=>$value[1]
			));
			$i++;
		}
		$this->out('Collection "Target" Created!!');
	}

}