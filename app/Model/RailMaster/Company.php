<?PHP
App::uses('RailMasterModel','Model');

/**
 * APIのアクセスポイント取得するモデル
 */
class Company extends RailMasterModel {
	var $useTable = "company";


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