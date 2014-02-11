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
		$this->parseParameter();
		$railway_id = $this->parameter['railway_id'];
		$interval = $this->getToday();
		extract($interval);

		//路線情報を取得
		$railwayInfo = $this->Railway->getById($railway_id);
		if(empty($railwayInfo)){throw new BadRequestException('Bad Parameter');}

		$company_id = $railwayInfo['Railway']['company_id'];
		$companyInfo = $this->Company->getById($company_id);

		$target = $companyInfo['Company']['target'];

		$res = $this->$target->find('all',array(
			'conditions'=>array(
				'railway_id'=>$railway_id,
				//'created' => array('$gte' => $start,'$lte'=>$last)
			),
			'order'=>array(
				'created' => -1
			)
		));
		if(empty($res)){throw new BadRequestException('Bad Parameter');}
		$results = array();
		unset($companyInfo['Company']['created']);
		unset($companyInfo['Company']['modified']);
		unset($railwayInfo['Railway']['created']);
		unset($railwayInfo['Railway']['modified']);
		foreach($res as $value) {
			$value[$target]['company'] = $companyInfo['Company'];
			$value[$target]['railway'] = $railwayInfo['Railway'];
			unset($value[$target]['modified']);
			unset($value[$target]['created']);
			unset($value[$target]['railway_id']);
			unset($value[$target]['@id']);
			unset($value[$target]['company_id']);
			$results[] = $value;
		}
		$this->response($results);
	}

	/**
	 * パラメータをパースする
	 */
	private function parseParameter(){
		$this->getParameter('GET');
		if(isset($this->parameter['odpt:trainInfoRailway'])){
			$this->parameter['railway_id'] = GenerateId::generate($this->parameter['odpt:trainInfoRailway']);
		}
		if(empty($this->parameter['railway_id'])){
			throw new BadRequestException('Bad Parameter');
		}
	}

	private function getToday(){
		$timezone = new DateTimeZone('Asia/Tokyo');

		$dt = new DateTime('now',$timezone);
		$start = new DateTime($dt->format('Y-m-d 0:0:0'),$timezone);
		$last = new DateTime($dt->format('Y-m-d 23:59:59'),$timezone);
		$start = $this->getMongoDate($start);
		$last = $this->getMongoDate($last);
		return array('start'=>$start,'last'=>$last);
	}

	/**
	 * 日付の条件指定
	 */
	private function getMongoDate($datetime){
		return new MongoDate($datetime->getTimestamp());
	}

}