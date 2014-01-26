<?PHP
/**
 * API用に利用するコントローラ
 */

class ApiController extends AppController {
	var $components = array('RequestHandler');
	/**
	 * コントローラ起動時に実行
	 * @return [type] [description]
	 */
	public function beforeFilter(){
		parent::beforeFilter();
		$this->setResponseHeader();
	}

	/**
	 * json形式でデータを出力する
	 * @param  array $results 出力するデータ配列
	 * @return bool          trueを返す
	 */
	protected function response($results){
		$this->set("info",$results);
		$this->set("_serialize","info");
		return true;
	}

	/**
	 * レスポンスヘッダーをjsonにする
	 */
	private function setResponseHeader(){
		$this->RequestHandler->setContent('json', 'application/json; charset=UTF-8' );
	}

}