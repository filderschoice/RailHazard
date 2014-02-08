<?PHP
/**
 * API用に利用するコントローラ
 */

class ApiController extends AppController {
	var $components = array('RequestHandler');
	protected $parameter = array();
	/**
	 * コントローラ起動時に実行
	 * @return [type] [description]
	 */
	public function beforeFilter(){
		parent::beforeFilter();
		$this->setResponseHeader();
	}

	/**
	 * リクエストパラメータ取得し,メンバに登録する。必須パラメータがない場合はエラー400を出力する
	 * @param string $method リクエストのメソッドタイプ
	 * @param array $needs 必須パラメータのキー情報(デフォルトは指定なし)
	 * @param array $ignores 無視するパラメータ,このパラメータがセットされていたらthrow requestを実行する
	 * @return array パラメータ
	 */
	protected function getParameter($method = "GET", $needs = array(), $ignores = array()){
		$parameter = array();
		if(!is_array($needs)){$needs = array();}
		if(!is_array($ignores)){$ignores = array();}

		switch($method){
		case "GET":
		$parameter = $this->request->query;
		break;
		case "POST":
		$parameter = $this->request->data;
		break;
		}
		for($i = 0; $i < count($needs); $i++){
			$key = $needs[$i];
			if(empty($parameter[$key])){
				throw new BadRequestException("Bad Parameter");
			}
		}
		for($i = 0; $i < count($ignores); $i++){
			$key = $ignores[$i];
			if(!empty($parameter[$key])){
				unset($parameter[$key]);
			}
		}
		$this->parameter = $parameter;
		return $parameter;
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