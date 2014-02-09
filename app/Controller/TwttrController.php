<?PHP

App::uses('tmhOAuth','Vendor/tmhOAuth');
App::uses('BasicController','Controller');

class TwttrController extends BasicController {
	var $components = array('TwttrAuth', 'TwttrUsers');
	var $uses = array('User');
	var $autoRender = false;
	private $here;
	private $callbackUrl;

	public function beforeFilter(){
		parent::beforeFilter();
		$this->here = Router::url($this->here,true);
		$this->callbackUrl = Router::url('/twttr/callback',true);
	}

	/**
	 * 認証ページへ飛ぶ
	 * @return [type] [description]
	 */
	public function authorize(){
		$this->twttrAuthorize();
	}

	/**
	 * ログアウト
	 */
	public function logout(){
		$this->Session->destroy();
	}

	/**
	 * 認証ページから戻ってきたときのコールバック
	 * @return function [description]
	 */
	public function callback(){
		try{
			//コールバックを解析してアクセストークンを取得する
			$this->parseCallback();
			//ユーザ情報を取得する
			$userData = $this->getMyData();
		} catch(BadRequestException $e){
			pr("エラー");
		}
	}

	/**
	 * 認証ページへリダイレクトする
	 * @return [type] [description]
	 */
	private function twttrAuthorize(){
		$code = $this->TwttrAuth->getRequestToken($this->callbackUrl);
		if($code !== 200){throw new BadRequestException('Twitterにアクセスできませんでした。');}
		$tokens = $this->TwttrAuth->extractParams();

		//セッションに登録
		$this->Session->write('request_token',$tokens);
		//認証画面にリダイレクト
		extract($tokens);
		$url = $this->TwttrAuth->getAuthUrl()."?oauth_token={$oauth_token}";
		$this->redirect($url);
	}

	/**
	 * コールバックした結果をセッションに登録する
	 * @return [type] [description]
	 */
	private function parseCallback(){
		//パラメータ取得
		$params = $this->request->query;
		//２つのパラメータが入っていなければ，401エラー出力
		if(empty($params["oauth_token"]) || empty($params["oauth_verifier"]) ||
			!$this->Session->check("request_token")){
			throw new BadRequestException("認証に失敗しました。",401);
		}
		//セッションからトークン情報を取得する。取得したセッション情報は削除する
		$reqTokens = $this->Session->read('request_token');
		$this->Session->delete('request_token');

		//コンフィグ設定
		$this->TwttrAuth->setToken($reqTokens["oauth_token"],$reqTokens["oauth_token_secret"]);

		//アクセストークン取得
		$code = $this->TwttrAuth->getAccessToken($params['oauth_verifier']);
		$access_token = $this->TwttrAuth->extractParams();

		//セッションにアクセストークン登録
		$this->Session->write('access_token',$access_token);
	}

	/**
	 * 自分の情報を取得してセッションに保存
	 */
	private function getMyData(){
		$access_token = $this->Session->read('access_token');
		extract($access_token);
		$this->TwttrUsers->setToken($oauth_token,$oauth_token_secret);
		$data = $this->TwttrUsers->getMyData();
		//必要なデータのみセッションに登録
		$userInfo = array(
			'_id'=>GenerateId::generate('Twitter'.$data['id_str']),	//プライマリーキーは暗号化する
			'twitter_id'=>$data['id_str'],
			'screen_name'=>$data['screen_name'],
			'name' => $data['name'],
			'image'=> $data['profile_image_url_https']
		);
		$this->Session->write('user',$userInfo);
		$this->User->save($userInfo);

		return $data;
	}

}