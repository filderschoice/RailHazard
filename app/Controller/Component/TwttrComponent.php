<?PHP

App::uses('tmhOAuth','Vendor/tmhOAuth');

class TwttrComponent extends Component {
	protected $twitter;

	public function initialize(Controller $controller) {
		parent::initialize($controller);
		$consumer = Configure::read('APIConsumer.twttr_api');
		$this->twitter = new tmhOAuth($consumer);
	}

	/**
	 * レスポンスパース
	 */
	public function extractParams(){
		$twitter = $this->twitter;
		return $twitter->extract_params($twitter->response['response']);
	}


	/**
	 * tmhOAuthのインスタンスを出力
	 * @return [type] [description]
	 */
	public function twttr(){
		return $this->twitter;
	}

	/**
	 * トークンをセットする
	 * @param [type] $token [description]
	 */
	public function setToken($token,$secret){
		$twitter = $this->twitter;
		$twitter->config['user_token'] = $token;
		$twitter->config['user_secret'] = $secret;
		return $this;
	}

}