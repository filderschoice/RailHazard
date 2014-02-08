<?PHP
App::uses('RailMasterModel','Model');

/**
 * APIのアクセスポイント取得するモデル
 */
class Company extends RailMasterModel {
	var $useTable = "company";
	var $primaryKey = "_id";

	/**
	 * レスポンスデータ取得
	 */
	public function getData($conditions){
		return $this->find("all",array(
			"fields"=>array("_id","odpt:trainInfoCompany","name"),
			"conditions"=>$conditions
		));
	}

	/**
	 * odpt:TrainInfoマスターデータを登録する
	 */
	public function setTrainInfo($name, $target, $odptTarget){
		//ID生成
		$_id = $this->genId($odptTarget);
		$this->save(array(
			"_id"=>$_id,
			"odpt:trainInfoCompany"=>$odptTarget,
			"target"=>$target,
			"name"=>$name
		));
	}
}