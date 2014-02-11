<?PHP

App::uses('ApiController', 'Controller');

class RailwayController extends ApiController {
	var $uses = array('Company','Railway');

	public function index(){
		$companies = $this->getCompanies();
		$this->getParameter("GET",array("odpt:trainInfoCompany"),array("modified","created"));
		$railway = $this->getRailway($this->parameter);
		$railway = $this->mergeCompany($railway,$companies);
		$this->response($railway);
		return $railway;
	}

	/**
	 * IDをキーとして，鉄道会社情報を連想配列で取得(ハッシュテーブルとして利用)
	 * @return [type] [description]
	 */
	private function getCompanies(){
		$companies = $this->Company->getData(null);
		$result = array();
		foreach($companies as $key=>$value){
			$id = $value["Company"]["_id"];
			$result[$id] = $value["Company"];
		}
		return $result;
	}

	private function getRailway($parameter){
		return $this->Railway->find("all",array(
			"fields"=>array("odpt:trainInfoRailway","company_id"),
			"conditions"=>$parameter
		));
	}

	private function mergeCompany($railway,$companies){
		foreach($railway as $index=>$value){
			$id = $value["Railway"]["company_id"];
			unset($railway[$index]["Railway"]["company_id"]);
			$railway[$index]["Railway"]["company"] = $companies[$id];
		}
		return $railway;
	}

	protected final function getParameter($method = "GET", $needs = array(), $ignores = array()){
		$req = parent::getParameter($method,$needs,$ignores);
		$parameter = array();
		if(is_array($req) && count($req) > 0){
			foreach($req as $key=>$value ){
				switch($key){
				case "_id":
					$parameter[$key] = $value;
					break;
				case "odpt:trainInfoCompany": //odptで問い合わせが来た場合はIDに変換して問い合わせる
					$parameter["company_id"] = GenerateId::generate($value);
					break;
				case "odpt:trainInfoRailway":
					$parameter["_id"] = GenerateId::generate($value);
					break;
				}
			}
		}
		$this->parameter = $parameter;
		return $parameter;
	}

}