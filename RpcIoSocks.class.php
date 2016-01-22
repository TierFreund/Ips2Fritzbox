<?
class uRpcIoSocks extends uRpcIo{
	protected function _Connect($Port=0){
		parent::_Connect($Port);
		if(!$this->_IOSock){
			$this->_IOSock = @stream_socket_client("tcp://".$this->_HOST.":".$this->_IOPort, $errorNumber, $errorString, $this->_TimeOut);
            if(!$this->_IOSock) throw new uRcpIoException(__CLASS__ . "=>Could not open socket. Host: ".$this->_HOST." Port: ".$this->_PORT." Error: $errorString ($errorNumber)");
            if($this->_boUseSsl) {
                stream_set_blocking($this->_IOSock, true);
                stream_context_set_option($this->_IOSock, 'ssl', 'SNI_enabled', true);
                if($this->_caFile) stream_context_set_option($this->_IOSock, 'ssl', 'cafile', $this->_caFile);
                stream_context_set_option($this->_IOSock, 'ssl', 'verify_peer', $this->sslVerifyPeer);
                $secure = stream_socket_enable_crypto($this->_IOSock, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
                if(!$secure) {
                    $this->_Disconnect();
                    throw new uRcpIoException(__CLASS__ ."=>Failed to enable SSL.");
                }
                stream_set_blocking($this->_IOSock, false);
            }
        }
    }
	protected function _Disconnect(){
		if($this->_IOSock)fclose($this->_IOSock);
		parent::_Disconnect();
	}	
    protected function _SendRequest($request, $requestUrl='/',$service='',$action=''){
		$response = '';
        $retries = 0;
        $startTime = time();
        while(!$response && $retries < 20) {
            if(!$this->_IOSock) $this->_Connect();
            $response = '';
			if(!$requestUrl)
				$query = "POST / HTTP/1.1\r\n";
			else
				$query = "POST $requestUrl HTTP/1.1\r\n";
			if($service&&$action)$query.="SOAPACTION: \"$service#$action\"\r\n";
			$query.="USER_AGENT: uPNP-XMLRPC-Client\nHOST: {$this->_HOST}:{$this->_IOPort}\nCONTENT-TYPE: {$this->_contentType}\nCONNECTION: Keep-Alive\n";
            if($this->_USER)$query .= "Authorization: Basic ".base64_encode($this->_USER.":".$this->_PASS)."\n";
            $query .= "Content-Length: ".strlen($request)."\n\n".$request."\n";
            $bytesWritten = 0;
            $continueLoop = false;
            $querySize = strlen($query);
            while($bytesWritten < $querySize) {
                $result = @fputs($this->_IOSock, $query, 1024);
                if (!$result) {
                    if($retries == 19) throw new uRcpIoException(__CLASS__ ."=>Error sending data to server.");
                    else {
                        $this->_Diconnect();
                        $retries++;
                        usleep(50);
                        $continueLoop = true;
                        break;
                    }
                }
                $bytesWritten += $result;
                $query = substr($query, $result);
            }
            if($continueLoop) continue;
            while (!feof($this->_IOSock) && (time() - $startTime) < 30){
                $response .= @fgets($this->_IOSock);
                //A little dirty, but it works. As the end always looks like this, I don't see a problem.
                if(substr($response, -3) == ">\r\n") break;
            }
            
            if(!$response)$this->_Diconnect();
            $retries++;
        }
	
		if(strncmp($response, "HTTP/1.1 200 OK", 15) === 0){
			$r=explode("\r\n\r\n",$response);
			return $r[1];
        }
		if($response) throw new uRcpIoException(__CLASS__ .'=>'.$response); else throw new uRcpIoException(__CLASS__ ."=>Response was empty.");
    }
}	
?>