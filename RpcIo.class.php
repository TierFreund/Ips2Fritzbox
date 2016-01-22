<?
class uRcpIoException extends Exception {
	public function __toString(){
		return __CLASS__ .'=>'. $this->GetMessage();
	}	
}
abstract class uRpcIo {
    protected $_HOST='';
    protected $_PORT=0;
	protected $_SCHEME='';
	protected $_USER='';
	protected $_PASS='';
	protected $_boUseSsl=false;
	protected $_caFile='';	

	protected $_IOSock=0;
	protected $_IOPort=0;
	protected $_TimeOut=2;
	protected $_responseMode='html';
	protected $_contentType="text/xml; charset='utf-8'";
	protected $_Connected=false;
	
	public function __construct($url, $defaultPort=0, $defaultUser='', $defaultPass=''){
		$p=parse_url($url);
        $this->_HOST=(isSet($p['host']))?$p['host']:$url;
        $this->_PORT=(isSet($p['port']))?$p['port']:$defaultPort;
		$this->_SCHEME=(isSet($p['scheme']))?$p['scheme']:'http';
		$this->_USER=(isSet($p['user']))?$p['user']:$defaultUser;
		$this->_PASS=(isSet($p['pass']))?$p['pass']:$defaultPass;
		$this->_boUseSsl=($this->_SCHEME=='https' || $this->_PORT==433);
	}
	public function __destruct(){
		$this->_Diconnect();
	}	
    public function SetAuth($User='', $Pass=''){
		$this->_USER=$User;
		$this->_PASS=$Pass;
	}
	public function IsAuthSet(){
		return !empty($this->_USER);
	}	
	public function SetTimeOut($newTimeout){
		$this->_TimeOut=$newTimeout;
	}	
	public function SetSSLcaFile($fileName){
		$this->_caFile=$fileName;
	}
	public function SetResponseMode($mode){
		switch($mode){
			case 'json'  : $this->_contentType="application/json; charset='utf-8'"; break;
			default: 	   $this->_contentType="text/xml; charset='utf-8'";
		}	
		$this->_responseMode=$mode;
	}	
	public function BaseUrl($fullUrl=false){
		$url=$fullUrl?$this->_SCHEME.'://':'';
		$url.=$this->_HOST;
		if($fullUrl&&$this->_PORT)$url.=':'.$this->_PORT;
		return $url;
	}
	public function GetPort(){
		return $this->_IOPort?$this->_IOPort:$this->_PORT;
	}		
	public function GetHost(){
		return $this->_HOST;
	}		
	public function Call($SERVICE_url,$SOAP_service,$SOAP_action,$SOAP_arguments=null,$XML_filter = '', $ReturnValue=null, $Port=0){
		$this->_Connect($Port);
		switch($this->_responseMode){
			case 'xmlrpc': $POST_xml=xmlrpc_encode_request($SOAP_action,$SOAP_arguments?array_values($SOAP_arguments):array(),array('encoding'=>'utf-8'));break;
			case 'json'  : 
				array_walk_recursive($SOAP_arguments,function($key, &$item){if(is_string($item))$item=utf8_encode($item);});
				$id = round(fmod(microtime(true)*1000, 10000));
				$POST_xml=Array("jsonrpc" => "2.0","method" => $SOAP_action,"params" => $SOAP_arguments ,"id" => $id);
				$POST_xml=json_encode($POST_xml);
				$SOAP_action=$SOAP_service='';
				break;
			case 'values': $POST_xml=$SOAP_arguments?array_values($SOAP_arguments):[];break;
			case 'plain' : $POST_xml=$SOAP_arguments?$SOAP_arguments:array(); break;
			default	     : $POST_xml=self::rpc_encode_request($SOAP_service,$SOAP_action,$SOAP_arguments);
		}
        
		If (empty($r=$this->_SendRequest($POST_xml,$SERVICE_url,$SOAP_service,$SOAP_action)))return null;
		if($this->_responseMode=='plain')
			return $r;
		if($this->_responseMode=='json'){
			$r = json_decode($r, true);
			if (is_null($r)) throw new uRcpIoException('Request error: No response');
			array_walk_recursive($r,function($key, &$item){if(is_string($item))$item=utf8_decode($item);});
			if (isset($r['error']))
				throw new uRcpIoException(get_class($this).'=>'.($r['error']['message']));
			if (!isset($r['id'])) {
				throw new uRcpIoException('No response id');
			} elseif ($r['id'] != $id) {
				throw new uRcpIoException('Incorrect response id (request id: ' . $id . ', response id: ' . $r['id'] . ')');
			}		
			return $r['result'];
		}	
        if ($this->_responseMode=='xmlrpc'){
	        $r=xmlrpc_decode($r);
			if (is_array($r) && xmlrpc_is_fault($r)){
				echo "Fehler: ".$r['faultString']."<br>";
				throw new uRcpIoException(get_class($this).'=>'.$r['faultString'],$r['faultCode']);
			}
		}	
		if (is_array($r))return $r;
		if (!empty($XML_filter)) return self::Filter($r,$XML_filter);
        If ($ReturnValue)return $ReturnValue;
		return $r;
	}	
    /***************************************************************************
    /* Funktion : sendPacket
    /* 
    /*  Benoetigt:
    /*    @content (string)
    /*
    /*  Liefert als Ergebnis:
    /*    @result (array)
    /*
    /****************************************************************************/
    public function sendPacket( $content ){
		$fp = fsockopen($this->BaseUrl(), $this->GetPort(), $errno, $errstr, 3);
        if (!$fp)throw new uRcpIoException("Error opening socket: ".$errstr." (".$errno.")");
        fputs ($fp,$content);$ret = "";
        while (!feof($fp))$ret.= fgetss($fp,128); // filters xml answer
        fclose($fp);
		if(strpos($ret, "200 OK") === false)throw new uRcpIoException("Error sending command: ".$ret);
        foreach(preg_split("/\n/", $ret) as $v)if(trim($v)&&(strpos($v,"200 OK")===false))$array[]=trim($v);
        return $array;
    }
    public function getContent($url){
		return file_get_contents($this->BaseUrl(true).$url);
    }
	protected function _Connect($Port=0){
		if(!$Port)$Port=$this->_PORT;
		if($this->_IOPort!=$Port && $this->_Connected)$this->_Disconnect();
		$this->_IOPort=$Port;
		$this->_Connected=true;
	}
	protected function _Diconnect(){
		$this->_Connected=false;
		$this->_IOSock=null;
	}
	protected abstract function _SendRequest($Request,$requestUrl='',$service='',$action='');
	public static function rpc_encode_request($service, $action, $arguments=null){
		if(is_array($arguments)&&count($arguments)>0){
			foreach($arguments as $k=>$v)$o[]="<$k>$v</$k>";
			$arguments=implode('',$o);
		}else if(!is_string($arguments))$arguments='';
		return "<s:Envelope xmlns:s=\"http://schemas.xmlsoap.org/soap/envelope/\" s:encodingStyle=\"http://schemas.xmlsoap.org/soap/encoding/\"><s:Body><u:$action xmlns:u=\"$service\">$arguments</u:$action></s:Body></s:Envelope>";
 	}
    public static function Filter($subject,$pattern){
        if(!is_array($pattern))$pattern=explode(',',$pattern);
		$multi=(count($pattern)>1);	
        foreach($pattern as $pat){
            if(!$pat)continue;
            preg_match('/\<'.$pat.'\>(.+)\<\/'.$pat.'\>/',$subject,$matches);
            if($multi){
				if(isSet($matches[1])) {
					if(is_numeric($matches[1])){
						if(is_float($matches[1]))
							$matches[1]=floatval($matches[1]);
						else if(is_double($matches[1]))
							$matches[1]=floatval($matches[1]);
						else $matches[1]=intval($matches[1]);
					}	
					$n[$pat]=$matches[1];
				}else
					$n[$pat]=false;
			} else {
				if(!isSet($matches[1]))return false;	
				if(is_numeric($matches[1])){
					if(is_float($matches[1]))
						$matches[1]=floatval($matches[1]);
					else if(is_double($matches[1]))
						$matches[1]=floatval($matches[1]);
					else $matches[1]=intval($matches[1]);
				}	
				return $matches[1];
			}
		}	
        return $n;
    }
}

?>