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
		$this->loadModel('Company');
		$data = array(
			array("JR東日本", "JREast", "JR-East"),
			array("京王線", "Keio", "Keio"),
			array("京成線", "Keisei", "Keisei"),
			array("東武線", "Tobu", "Tobu"),
			array("東京メトロ", "TokyoMetro", "TokyoMetro"),
			array("東急線", "Tokyu", "Tokyu"),
			array("つくばエクスプレス", "TX", "TX"),
			array("ゆりかもめ", "Yurikamome", "Yurikamome"),
			array("京急線", "Keikyu", "Keikyu"),
			array("西武線", "Seibu", "Seibu")
		);

		foreach($data as $value){
			$this->Company->setTrainInfo($value[0],$value[1],$value[2]);
		}
		$this->out('Collection "Target" Created!!');
	}

}