<?PHP

App::uses('ApiController', 'Controller');

/**
 * ユーザコントローラ
 */
class UserController extends ApiController {
	var $uses = array('User');
	var $userInfo = null;

	public function beforeFilter(){
		parent::beforeFilter();
		if(!$this->Session->check('user')){
			throw new ForbiddenException();
		}
		$userInfo = $this->Session->read('user');
		$data = $this->User->getById($userInfo['_id']);
		if(empty($data)){
			throw new ForbiddenException();
		} else {
			$this->userInfo = $data['User'];
		}
	}
	/**
	 * ユーザデータを送信する
	 * @return [type] [description]
	 */
	public function index(){
		$data = $this->userInfo;

		//不要なデータ(画面に表示したくないデータを削除)
		unset($data['_id']);
		unset($data['twitter_id']);
		unset($data['modified']);
		unset($data['created']);
		$this->response($data);
		return $data;
	}

	/**
	 * マイルートを登録する
	 * @return [type] [description]
	 */
	public function save(){
		$this->getParameter('POST', array('odpt:trainInfoRailway'));
		$data = $this->userInfo;
		if(empty($data['myRoot'])){
			$data['myRoot'] = array();
		}
		$this->User->save($data);
		//更新後のデータ取得
		$this->index();
	}

}