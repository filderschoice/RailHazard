<?PHP

App::uses('ApiController', 'Controller');

class CompanyController extends ApiController {
	var $uses = array("Company");
	public function beforeFilter(){
		parent::beforeFilter();
	}
	/**
	 * 鉄道会社データを取得
	 */
	public function view(){
		$this->getParameter("GET",array(),array("target","modified","created"));
		$data = $this->Company->getData($this->parameter);
		$this->response($data);
		return $data;
	}

	protected final function getParameter($method = "GET", $needs = array(), $ignores = array()){
		$req = parent::getParameter($method, $needs, $ignores);
		$parameter = array();
		if(is_array($req) && count($req) > 0){
			foreach($req as $key=>$value ){
				switch($key){
				case "_id":
					$parameter[$key] = $value;
					break;
				case "odpt:trainInfoCompany": //odptで問い合わせが来た場合はIDに変換して問い合わせる
					$id = GenerateId::generate($value);
					$parameter["_id"] = $id;
					break;
				case "name":
					$parameter[$key] = $value;
					break;
				}
			}
		}
		$this->parameter = $parameter;
		return $parameter;
	}

}