<?
class uRpcDeviceException extends Exception{
	function __toString(){
		return __CLASS__ . '=>'.$this->GetMessage();
	}	
}	

abstract class uRpcDevice {
	private $_io=null;
	private $_url='';
	private $_boIsOnline=null;
    
	public function __construct($url, $defaultPort=0, $requestType='socks', $responseMode=''){
		$this->_url=$url;	
		if(!self::GetOnlineState()) 
			throw new uRpcDeviceException(get_class($this)."=>Host '$url' is Offline!!");	
		switch ($requestType){
			case 'socks': self::SetIO(new uRpcIoSocks($url, $defaultPort)); break;
			case 'soap': self::SetIO(new uRpcIoSoap($url, $defaultPort)); break;
			case 'curl': self::SetIO(new uRpcIoCurl($url, $defaultPort)); break;
			default : throw new uRpcDeviceException (get_class($this)."=>No or Invalid ConnectionType '$type' ! Allowed : socks|curl|soap");
		}
		if($responseMode)$this->SetResponseMode($responseMode);
    }
	public function SetIO(uRpcIo $IO){ $this->_io=$IO; }	
	public function SetAuth($user,$pass){
		$this->_io->SetAuth($user,$pass);
	}	
	public function SetTimeout($newTimeout){
		$this->_io->SetTimeout($newTimeout);
	}
	public function SetResponseMode($mode){
		$this->_io->SetResponseMode($mode);
	}		
	public function BaseUrl($fullUrl=false){
		return self::IO()->BaseUrl($fullUrl);
	}
		
	protected abstract function GetServiceConnData($name); // Override This in Own Modules
	protected function Call($service,$action,$arguments,$filter=null){
		if(!$con=$this->GetServiceConnData($service)) 
			throw new uRpcDeviceException (get_class($this)."=>Invalid Service Name '$service' :: $action");
//echo __class__ . '::'. __function__ . "<nr>";
		return $this->IO()->Call($url=$con[2],$service=$con[1],$action,$arguments,$filter,$ReturnValue=null,$Port=$con[0]);	
	}	
	protected function GetOnlineState(){
	
		if(!is_null($this->_boIsOnline))return $this->_boIsOnline;
		$this->_boIsOnline=self::Sys_Ping();
   		return $this->_boIsOnline; 
	}
	protected function IO(){
		return $this->_io;
	}
	
	function Sys_Ping(){
		$p=parse_url($this->_url);
		$host=empty($p['host'])?$this->_url:$p['host'];
		return Sys_Ping($host,2000);
	}
}
?>