<?
class uRpcIoSoap extends uRpcIo {
	
	public function __construct($url, $defaultPort=0, $defaultUser='', $defaultPass=''){
			parent::__construct($url, $defaultPort, $defaultUser, $defaultPass);
			self::SetResponseMode('plain');
	}
	protected function _Connect($Port=0){
		parent::_Connect($Port);
		$this->_IOSock = true;
	}	
	protected function _SendRequest($Request, $requestUrl='',$service='',$action=''){
       	try {
           	$client = new SoapClient( null,	array(
                  	'location' 	 => "http://{$this->_HOST}:{$this->_IOPort}$requestUrl",
                  	'uri'		 => $service,
                  	'noroot'     => True,
                  	'login'      => $this->_USER,
                  	'password'   => $this->_PASS
            ));
			$params=array();
			if($Request)foreach($Request as $key=>$value)$params[]=new SoapParam($value, $key);
			$r = $client->__soapCall($action,$params);
//dumpvar($r);
			return is_soap_fault($r)?null:$r;
       	} catch (Exception $e){
			throw new uRcpIoException(__CLASS__ ."=>{$e->detail->UPnPError->errorDescription} '$action' !! \nCode: {$e->detail->UPnPError->errorCode}");
echo "Url: $requestUrl<br>Service:$service<br>Action: $action<br>";			
dumpvar($client);
			Echo "Fehler: ".nl2br($e->__toString())."<br>";	
           	Echo "LastReq:".nl2br($client->__getLastRequest ())."<br>";
			Echo "LastReqHead:".nl2br($client->__getLastRequestHeaders())."<br>"; 
           	Echo "LastResp:".nl2br($client->__getLastResponse ())."<br>";
			die();
        }	
    }
}
?>