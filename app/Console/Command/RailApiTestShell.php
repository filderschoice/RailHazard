<?PHP
App::uses("HttpSocket","Network/Http");

class RailApiTestShell extends AppShell {
	public function main(){
		$consumer = Configure::read('APIConsumer.rail_api');
		$socket = new HttpSocket();
		$url = "https://api.odpt.org/api/v2/datapoints";
		$data = $socket->get($url,array(
			"rdf:type"=>"odpt:TrainInfo",
			"acl:accessTarget"=>"Tobu",
			"acl:consumerKey"=>$consumer
		));
		var_dump($data);
	}

}