<?PHP

App::uses('TwttrComponent', 'Controller/Component');

class TwttrAuthComponent extends TwttrComponent{

	/**
	 * リクエストトークン取得
	 */
	public function getRequestToken($callbackUrl){
		$twitter = $this->twitter;
		return $twitter->request(
			'POST',
			$twitter->url('oauth/request_token', ''),
			array('oauth_callback'=>$callbackUrl));
	}

	/**
	 * 認証ページURLを取得する
	 */
	public function getAuthUrl(){
		return $this->twitter->url('oauth/authenticate', '');
	}

	/**
	 * アクセストークン取得
	 */
	public function getAccessToken($verifier){
		$twitter = $this->twitter;
		return $twitter->request(
			'POST',
			$twitter->url('oauth/access_token', ''),
			array('oauth_verifier'=>$verifier)
		);
	}

}