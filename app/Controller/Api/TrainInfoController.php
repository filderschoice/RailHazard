<?PHP

App::uses('ApiController','Controller');

class TrainInfoController extends ApiController {
	var $uses = array(
		"Company", "Railway",
		"JREast", "Keio", "Keikyu",
		"Seibu", "Keisei", "Tobu",
		"TokyoMetro", "Tokyu", "TX", "Yurikamome"
	);

	/**
	 * ユーザデータ取得
	 * @return [type] [description]
	 */
	public function index(){
		$connect = $this->request->query["target"];
		if(!in_array($connect,$this->uses)){
			throw new NotFoundException();
		}
		$data = $this->$connect->find("all");
		$this->response($data);
	}

}