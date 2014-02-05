<?PHP
App::uses('RailMasterModel','Model');

/**
 * 各鉄道会社の路線情報を登録する
 */
class Railway extends RailMasterModel {
	var $useTable = "railway";

	/**
	 * パスワード登録
	 * @param stirng $railwayName 路線情報
	 * @param string $companyId 鉄道会社ID(TrainInfoCompany._id)
	 */
	public function setRailwayInfo($railwayName, $company_id){
		if(!is_string($railwayName) || !is_string($company_id)){return false;}
		//ID生成
		$_id = $this->genId($railwayName);

		$this->save(array(
			"_id"=>$_id,
			"company_id"=>$company_id,
			"odpt:trainInfoRailway" => $railwayName
		));
	}

}