<?PHP

/**
 * 公共交通実証実験API呼び出しクラス
 */
class TrainApi {
	private $consumer = null;
	private $baseURL = "https://api.odpt.org/";
	private $curl = null;
	public $body = null;
	public $header = null;

	/**
	 * コンストラクタ
	 * @param string $consumer コンシューマーキー
	 */
	public function __construct($consumer){
		$this->consumer = $consumer;
		$this->createCurlObj();
	}

	/**
	 * リクエストメソッド
	 * @param string $api アクセスするAPI
	 * @param array $params パラメータ(連想配列で指定)
	 */
	public function accessAPI($api,$params = array()){
		$params["acl:consumerKey"] = $this->consumer;
		$getParameter = $this->parseParam($params);
		return $this->request($api,$getParameter);
	}

	/**
	 * HTTPリクエスト
	 * @param string $api アクセスするAPI
	 * @param string $getParameter GETパラメータとして追加する文字列
	 */
	private function request($api,$getParameter){
		$url = $this->baseURL.$api."?".$getParameter;
		curl_setopt($this->curl,CURLOPT_HTTPGET,true);
		curl_setopt($this->curl,CURLOPT_URL,$url);
		$response = curl_exec($this->curl);
		if(!empty($response)){
			list($header,$body) = explode("\r\n\r\n",$response, 2);
			$this->header = $this->parseHeader($header);
			$this->body = $body;
		} else {
			$this->header = null;
			$this->body = null;
		}
		return $this->body;
	}

	/**
	 * ヘッダーパース
	 */
	private function parseHeader($header){
		$headerInfo = explode("\r\n",$header);
		$this->header = array();
		foreach($headerInfo as $info){
			if(preg_match("/HTTP\/1\.1/",$info)){
				list($http,$code,$message) = explode(" ",$info,3);
				$this->header["Code"] = $code;
				$this->header["Message"] = $message;
			} else {
				list($key,$value) = explode(": ",$info,2);
				$this->header[$key] = $value;
			}
		}
		return $this->header;
	}

	/**
	 * curlのオブジェクト作成＋基本設定
	 */
	private function createCurlObj(){
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch,CURLOPT_FOLLOWLOCATION,true);
		curl_setopt($ch,CURLOPT_CRLF,true);
		curl_setopt($ch,CURLOPT_MAXREDIRS,3);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_FAILONERROR,true);
		curl_setopt($ch,CURLOPT_HTTPGET,true);
		$this->curl = $ch;
		return $this;
	}


	/**
	 * APIリクエストパラメータパース
	 */
	private function parseParam($params){
		$getParameters = array();
		foreach($params as $key=>$value){
			$getParameters[]=$key."=".urlencode($value);
		}
		return join("&",$getParameters);
	}


}

