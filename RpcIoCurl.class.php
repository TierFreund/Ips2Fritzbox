<?
class uRpcIoCurl extends uRpcIo {
	protected function _Connect($Port=0){
		parent::_Connect($Port);
		$this->_IOSock = curl_init();
	}	
	protected function _Diconnect(){
		if($this->_IOSock)curl_close($this->_IOSock);
		parent::_Diconnect();
	}
	protected function _SendRequest($Request, $requestUrl='',$service='',$action=''){
		if(!$this->_IOSock)$this->_Connect();
		$POST_url = $this->BaseUrl(false).':'.$this->_IOPort.$requestUrl;
//dumpvar($Request,'TO => '.$POST_url);		
		if(!empty($this->_USER)) {
			curl_setopt($this->_IOSock, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($this->_IOSock, CURLOPT_USERPWD, $this->_USER . ":" . $this->_PASS);
		}
		if($this->_caFile && $this->_boUseSsl){
			curl_setopt($this->_IOSock, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($this->_IOSock, CURLOPT_CAINFO,$this->_caFile);
			
		}else {	
			curl_setopt($this->_IOSock, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($this->_IOSock, CURLOPT_SSL_VERIFYHOST, 0);
		}	
        curl_setopt($this->_IOSock, CURLOPT_URL, $POST_url);
        curl_setopt($this->_IOSock, CURLOPT_HEADER, 0);
        curl_setopt($this->_IOSock, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->_IOSock, CURLOPT_TIMEOUT, $this->_TimeOut);
        $header=array("CONTENT-TYPE: {$this->_contentType}");
		if($service&&$action)$header[]="SOAPAction: ".$service."#".$action;
		curl_setopt($this->_IOSock, CURLOPT_HTTPHEADER, $header);
        curl_setopt($this->_IOSock, CURLOPT_POST, 1);
        curl_setopt($this->_IOSock, CURLOPT_POSTFIELDS, $Request);
        $r = curl_exec($this->_IOSock);
//		dumpvar($r);
		$this->_Diconnect();
		return $r;
    }
}
?>