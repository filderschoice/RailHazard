<?PHP

/**
 * ID自動生成クラス
 * ※このコンポーネントはIDが存在しないデータをハッシュにしてIDを生成するコンポーネント
 */
class GenerateId {

	/**
	 * ID生成
	 * @param  string $value 生成したいIDに対応する文字列
	 * @static
	 * @return string        生成したID情報(入力がない場合はnull出力)
	 */
	static public function generate($value){
		if(!is_string($value)){return null;}
		$salt = Configure::read('GenerateId.salt');
		$md5 = MD5($salt.$value);
		$sha = sha1($md5);
		return $sha;
	}
}