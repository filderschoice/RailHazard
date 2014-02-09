<?PHP

App::uses('TwttrComponent', 'Controller/Component');

class TwttrUsersComponent extends TwttrComponent {

	/**
	 * 自分の情報を取得する
	 */
	public function getMyData(){
		$url = $this->twitter->url('1.1/account/verify_credentials.json','');
		$code =  $this->twitter->request('GET',$url);
		if($code !== 200){
			throw new BadRequestException($this->twitter->response['error']);
		}
		$response = $this->twitter->response['response'];
		return json_decode($response,true);
	}

}