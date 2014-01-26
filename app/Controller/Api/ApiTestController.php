<?PHP

app::uses('ApiController','Controller');

/**
 * APIデモ用コントローラ
 */
class ApiTestController extends ApiController {

	public function beforeFilter(){
		parent::beforeFilter();
	}

	/**
	 * サンプルAPI（適当な値）
	 */
	public function sample(){
		$data = array(
			"ID"=>1001,
			"Name"=>"テストユーザ",
			"Mail"=>"sample@railhazard.com"
		);
		$this->response($data);

	}

}