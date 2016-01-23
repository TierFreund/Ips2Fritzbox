<?
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 |  Class           :rpc2fritzbox extends uRpcBase                                |
 |  Version         :2.2                                                          |
 |  BuildDate       :Tue 19.01.2016 11:21:28                                      |
 |  Publisher       :(c)2016 Xaver Bauer                                          |
 |  Contact         :xaver65@gmail.com                                            |
 |  Desc            :PHP Classes to Control FRITZ!Box Fon WLAN 7390               |
 |  port            :49000                                                        |
 |  base            :http://192.168.112.254:49000                                 |
 |  scpdurl         :/tr64desc.xml                                                |
 |  modelName       :FRITZ!Box Fon WLAN 7390                                      |
 |  deviceType      :urn:dslforum-org:device:InternetGatewayDevice:1              |
 |  friendlyName    :gateway                                                      |
 |  manufacturer    :AVM                                                          |
 |  manufacturerURL :www.avm.de                                                   |
 |  modelNumber     : - avm                                                       |
 |  modelURL        :www.avm.de                                                   |
 |  UDN             :uuid:739f2409-bccb-40e7-8e6c-9CC7A6BC2DEB                    |
 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
require_once( __DIR__ . '/../RpcBaseModule.class.php');
require_once( __DIR__ . '/../RpcIoSoap.class.php');

class fritzbox extends RpcBaseModule {
	private $CONFIGTMP_FILE = '';
	private $LOCAL_IMG_PATH = '';
	private $IMAGE_PATH		= '';
	private $PHONEBOOK_PATH = '';
	private $TEMPLATE_PATH = '';

	
	private $_aPBItems=null;
	private $_sMsnNumbers='';
	public function __construct($InstanceID){
		$this->CONFIGTMP_FILE 	= IPS_GetKernelDir().'/webfront/user/fritzbox/lastcall.tmp';
		$this->PHONEBOOK_PATH	= IPS_GetKernelDir().'/webfront/user/fritzbox/';
		$this->LOCAL_IMG_PATH	= IPS_GetKernelDir().'/webfront/user/fritzbox/images/';
		$this->IMAGE_PATH		= 'user/fritzbox/images/';
		$this->TEMPLATE_PATH 	= __DIR__ . '/templates/';
		parent::__construct($InstanceID);
	}	
	
	public function Create(){
		parent::Create();
		$this->RegisterPropertyString("PhonebookFile", "phonebook.serialized");
		$this->RegisterPropertyBoolean("PhonebookImages", true);
		$this->RegisterPropertyString("MsnNumbers", "");
		$this->RegisterPropertyInteger("Lines", 2);
		$this->RegisterPropertyBoolean("CallerInfo", true);
		$this->RegisterPropertyBoolean("CallerList", true);
		$this->RegisterPropertyInteger("CallerListMaxEntrys", 20);
		$this->RegisterPropertyBoolean("PhonebookList", false);
//		$this->RegisterPropertyInteger('IntervallRefresh', 60);
//		$this->RegisterTimer('Refresh_All', 0, 'rpc2fritzbox_Update($_IPS[\'TARGET\']);');
		$this->SetProperty('Port',49000 );
		$this->SetProperty('ConnectionType','soap');
		$this->SetProperty('Timeout',2);
	}
	protected function MkDir($dir){
		if(file_exists($dir)) return $dir;
		$ndir='';
		foreach(explode('/',$dir) as $d){
			if(!file_exists($ndir.$d))mkdir($ndir.$d);
			$ndir.=$d.'/';
		}
		return $ndir;	
	}	
	
	public function ApplyChanges(){
		parent::ApplyChanges();
		$this->RegisterVariableString('LastFrom','Letzter Anrufer',"",1);
		$this->RegisterVariableString('LastTo','Letzter Anruf',"",2);
		$this->RegisterVariableString('State','Status',"",3);
		if($this->ReadPropertyBoolean("CallerInfo")){
			$this->RegisterVariableString('LastCaller','Letzter Anrufer',"~HTMLBox",30);
			$this->RegisterVariableString('LastCalled','Letzter Anruf',"~HTMLBox",31);
		}else{
			$this->UnRegisterVariable('LastCaller');
			$this->UnRegisterVariable('LastCalled');
		}	
		if($this->ReadPropertyBoolean("CallerList"))
			$this->RegisterVariableString('CallerList','Anrufer Liste',"~HTMLBox",40);
		else 		
			$this->UnRegisterVariable('CallerList');
		if($this->ReadPropertyBoolean("PhonebookList"))
			$this->RegisterVariableString('PhonebookList','Telefonbuch',"~HTMLBox",41);
		else 		
			$this->UnRegisterVariable('PhonebookList');

		$lines=$this->ReadPropertyInteger('Lines');
		if($lines<1) { $lines=1; $this->SetProperty('Lines',1); }
		for($j=1;$j<=$lines;$j++)
			SetValueString($this->RegisterVariableString('Line_'.$j,"Leitung $j",'',10+$j),'Bereit');
		for($j=$lines+1;$j<11;$j++)@$this->UnregisterVariable('Line_'.$j);

		if($this->CheckConfig()){
			// Copy Files Only at First Start when Dir not exist 
			if(!file_exists($this->IMAGE_PATH)){
				$dir=self::MkDir($this->IMAGE_PATH);
				
				$files=array('noimage.jpg','unknownimage.jpg','anonym.jpg','callin.gif','callout.gif','callinfailed.gif','photoicon.gif','blank.gif');
				foreach($files as $file){
					if(file_exists($dir.$file))break;
					$tmp=file_get_contents(__DIR__ .'/images/'.$file);
					file_put_contents($dir.$file,$tmp);
				}	
			}
			// Check If local Phonebook Exist , create it when not
			$file=$this->ReadPropertyString('PhonebookFile');
			if(strpos($file,'/')===false)
				$file=self::MkDir($this->PHONEBOOK_PATH).$file;
						
			
			if(!file_exists($file))
				self::BuildPhonebook(true);
			
			if($this->ReadPropertyBoolean("PhonebookList")){
				if(!$this->GetValueString('PhonebookList'))
					$this->SetValueString('PhonebookList',self::BuildPhonebookList());
			}	
			if(!$this->ReadPropertyString('MsnNumbers')){
				if(!$this->IsAuthSet())
					$this->SetStatus(ERR_NOAUTH);
				elseif(self::BuildMsnNumbers()){
					$this->IsCreating=true;
					$this->SetProperty('MsnNumbers',$this->_sMsnNumbers);
				}	
			}
			$host=$this->ReadPropertyString('Host');
			if(strpos($host,':'))$host=parse_url($host)['host'];
			self::SetParentData($host,1012);
		}
	}
	public function ReceiveData($JSONString){
		$Data = json_decode($JSONString);
		$evData =(string) $Data->Buffer;
		$evIdent=(string) $Data->DeviceID;
 		if(!$evData)return false;
		return self::Decode_Call($evData);
    }
	public function TestCall(string $nr=null,string $msn=null){
		if(empty($nr))$nr='anonym';
		if(empty($msn))$msn='1122';
		$data=date('d.m.y H:i:s').";RING;0;$nr;$msn;SIP6;";
		if(!$r=self::Decode_Call($data)){
			$this->SetStatus(ERR_TESTCALL);
			return false;
		}
		Echo $r;	
		return true;
	}
	public function PhonebookSearch(string $SearchNr){
		if(empty($SearchNr))throw new Exception('No Number to search!'); 
		if(!$this->_aPBItems && !self::PhonebookLoadLocal())return null;
		$f=null;
		foreach($this->_aPBItems['numbers'] as $nr=>$attr)
			if(stripos($nr,$SearchNr)!==false){
				list($name,$image)=$this->_aPBItems['names'][$attr[1]];
				$f[]=array(
					'number'=>$nr,
					'prefix'=>$this->_aPBItems['types'][$attr[0]],
					'name'=>$name,
					'image'=>$image
				);
			}	
		return !$f?null:count($f)>1?$f:$f[0];		
	}
	public function PhonebookLoadLocal(string $fileName=null){
		if(empty($fileName))$fileName=$this->ReadPropertyString('PhonebookFile');
		if(empty($fileName))throw new Exception('Empty filename for local PhonebookFile!!');
		if(strpos($fileName,'/')===false)$fileName=$this->PHONEBOOK_PATH.$fileName;
		$this->_aPBItems=unserialize(file_get_contents($fileName));
		return !is_null($this->_aPBItems);
	}
	public function PhonebookSaveLocal(string $fileName=null){
		if(empty($fileName))$fileName=$this->ReadPropertyString('PhonebookFile');
		if(empty($fileName))throw new Exception('Empty filename for local PhonebookFile!!');
		if(strpos($fileName,'/')===false)$fileName=$this->PHONEBOOK_PATH.$fileName;
		file_put_contents($fileName,serialize($this->_aPBItems));
		return $fileName;
	}
	public function BuildPhonebook(boolean $saveLocal=null){
		if(!$this->IsAuthSet()) throw new Exception('You must set auth User and Password to call '.__FUNCTION__);
		IPS_LogMessage(__CLASS__ ,"Build local phonebook");
		$r=$this->API()->GetPhonebook(0);
		if(preg_match('/sid=(\w*)/i',$r['NewPhonebookURL'],$m))$sid=$m[1];
		$xml=simplexml_load_file($r['NewPhonebookURL']);
		$this->_aPBItems=['names'=>[],'numbers'=>[],'types'=>[]];

		$imgpath=$this->ReadPropertyBoolean('PhonebookImages')?$this->LOCAL_IMG_PATH:'';
		$ukey=0;
		foreach($xml->phonebook->contact as $c){
			$nr='';
			$name=(string)$c->person->realName;
			foreach($c->telephony->number as $num){
				$n=(array)$num->attributes();
				$nr=(string)$num;
				if($nr[0]=='*'){$nr='';	continue;}	
				$type=$n['@attributes']['type'];
				if($tkey=array_search($type,$this->_aPBItems['types'])===false){
					$tkey=count($this->_aPBItems['types']);
					$this->_aPBItems['types'][]=$type;
				}	
				$this->_aPBItems['numbers'][$nr]=array($tkey, $ukey);
			}
			if(!$nr)continue;
			$name=(string)$c->person->realName;
			if($imgpath && ($img=(string)$c->person->imageURL)){
				$img=$this->API()->BaseUrl(true).$img.'&sid='.$sid;
				$imgName=md5($img).'.jpg';
				if(!file_exists($imgpath.$imgName)){
					if($i=@file_get_contents($img))file_put_contents($imgpath.$imgName,$i);else $imgName='';
				}		
			}else $imgName='';				
			$this->_aPBItems['names'][]=array((string)$c->person->realName,$imgName);
			$ukey++;
		}
		if($this->ReadPropertyBoolean("PhonebookList"))
			$this->SetValueString('PhonebookList',self::BuildPhonebookList());
		if(!empty($saveLocal)){
			self::PhonebookSaveLocal();
			Echo "Telefonbuch erstellt";
		}	
		return true;
	}	
	public function BuildMsnNumbers(){
		if(!$this->IsAuthSet())
			throw new Exception('You must set auth User and Password to call '.__FUNCTION__);
		$out=json_decode(json_encode(simplexml_load_string($this->API()->X_AVM_DE_GetNumbers())),true)['Item'];
		foreach($out as &$o){
			if(is_array($o['Name']))$o['Name']=implode(' ',$o['Name']);
			$msns[]=$o['Number'].'='.($o['Name']?$o['Name']:'intern');	
		}	
		$this->_sMsnNumbers=implode(',',$msns);
		return !empty($this->_sMsnNumbers);
	}		
	public function BuildCallerList(){
		if(!$this->IsAuthSet())
			throw new Exception('You must set auth User and Password to call '.__FUNCTION__);
		if(!$r=$this->API()->GetCallList()) 
			throw new Exception('Error getting CallList form Device');
		$template=self::GetTemplate('CallerList');
		if(!preg_match('/<tbody>(.*)<\/tbody>/si',$template,$m)) throw new Exception('Invalid Template for '.__FUNCTION__);
		$body=$m[1];
		$out=[];
		$icons=['','callin.gif','callinfailed.gif','callout.gif'];
		$imgpath= 'user/fritzbox/images/';
		if(!$max=$this->ReadPropertyInteger('CallerListMaxEntrys'))$max=20;
		if($max>99)$max=99;
		$xml=simplexml_load_file($r);
		foreach($xml->Call as $key=>$call){
			switch((int)$call->Type){
				case 1 : // Eingehend
				case 2 : // Nicht angenommen
					$caller=(string)$call->Caller;
					if($s=(string)$call->Name)$caller.=" ($s)";
					$called=(string)$call->CalledNumber;
					if($s=(string)$call->Device)$called.=" ($s)";
					break;
				case 3 : // Ausgehend
					$caller=(string)$call->CallerNumber;
					if($s=(string)$call->Device)$caller.=" ($s)";
					$called=(string)$call->Called;
					if($s=(string)$call->Name)$called.=" ($s)";
					break;
				case 10 : // ????
					$caller=(string)$call->Caller;
					if($s=(string)$call->Name)$caller=$s;
					$called=(string)$call->CalledNumber;
					if($s=(string)$call->Device)$called.=" ($s)";
					break;	
				default : continue; 
			}
			$type=(int)$call->Type;
			if($type<0||$type>3)$type=0;
			$icon=$imgpath.$icons[$type];
			$date=(string)$call->Date;
			$time=(string)$call->Duration;
			$out[]=str_ireplace(
				array('#icon','#date','#caller','#called','#duration','#device','#port'),
				array($icon,$date,$caller,$called,$time,(string)$call->Device,(string)$call->Port),
				$body
			);
			if(--$max<0)break;
		}		
		return preg_replace('/<tbody>(.*)<\/tbody>/si',"<tbody>".implode($out)."</tbody>",$template);
	}	
	public function BuildPhonebookList(){
		if(!$template=self::GetTemplate('PhonebookList'))throw new Exception('Template for '.__FUNCTION__.' not found');
		if(!$this->_aPBItems && !self::PhonebookLoadLocal())throw new Exception('Please Build Phonebook first and then call '.__FUNCTION__); 
		if(!preg_match('/<tbody>(.*)<\/tbody>/si',$template,$m)) throw new Exception('Invalid Template for '.__FUNCTION__);
		$body=$m[1];$out=[];
		$photoicon='photoicon.gif';		
		foreach($this->_aPBItems['names'] as $uk=>$n){
			list($name,$image)=$n;
			$lname='';
			foreach($this->_aPBItems['numbers'] as $number=>$n){
				if($n[1]<>$uk)continue;
				if($lname==$name){$name='';$icon='blank.gif';}
				else $icon=$image?$image:$photoicon;
				$type=$this->_aPBItems['types'][$n[0]];
				$out[]=str_ireplace(
					array('#icon','#name','#type','#number'),
					array($this->IMAGE_PATH.$icon,$name,$type,$number),
					$body
				);	
				$lname=$name;
			}	
		}
		return preg_replace('/<tbody>(.*)<\/tbody>/si','<tbody>'.implode($out).'</tbody>', $template);
	}	

	protected function SetParentData($host,$port){
        $instance = @IPS_GetInstance($this->InstanceID);
        if ($instance['ConnectionID'] > 0){
            IPS_SetProperty($instance['ConnectionID'], 'Host', $host);
            IPS_SetProperty($instance['ConnectionID'], 'Port', $port);
	    }
    }
	protected function CheckConfig(){
		if(!parent::CheckConfig())return false;
		if(!$this->ReadPropertyString('PhonebookFile'))
			$this->SetStatus(ERR_NOPBNAME);
		else {
			$this->SetStatus(STATUS_OK);
			return true;
		}	
		return false;
	}
	protected function CreateApi($url, $port, $type){
		require_once('rpc2fritzbox.class.php');
		return new rpc2fritzbox($url,$port,$type);
	}		
	protected function PhonebookNr2Name($nr){
		if($p=self::PhonebookSearch($nr)){
			$p['info']=$p['name'].($p['prefix']?' - '.$p['prefix']:'');
			return $p;
		}
		return $nr;	
	}	
	protected function MsnNumbers2Name($nr){
		if(!$smsn=$this->ReadPropertyString('MsnNumbers'))return $nr;
		$smsn.=',';
		if(($p=strpos($smsn,$nr))===false)return $nr;
		if(!$tmp=substr($smsn,$p+strlen($nr)))return $nr;
		if($tmp[0]=='='){
			$tmp=substr($tmp,1,strpos($tmp,',')-1);
			return array(
			'number'=>$nr,
			'name'=>$tmp);
		}
		return $nr;
	}
	protected function Decode_Call($data){
		$cfgfn=$this->CONFIGTMP_FILE;
		$cfg=@unserialize(file_get_contents($cfgfn));
		$arr=explode(';',$data.';');
		$date=array_shift($arr); 
		$cmd=array_shift($arr);
		$line=array_shift($arr);
		$intern=$cmd!='RING'?array_shift($arr):'';
		$format='';
		switch($cmd){
			case 'RING':
				$format="Anruf von %s für %s";
			case 'CALL':	
				if(empty($format))$format="Anruf von %s zu %s";
				$caller=array_shift($arr);
				$called=array_shift($arr);
				$a=$caller;$b=$called;
				if($cmd=='RING'){
					if(($nameInfo=self::PhonebookNr2Name($caller))!=$caller)$a.=" ({$nameInfo['info']})";
					if(($msnInfo=self::MsnNumbers2Name($called))!=$called)$b.=" ({$msnInfo['name']})";
				}else{
					if(($msnInfo=self::MsnNumbers2Name($caller))!=$caller)$a.=" ({$msnInfo['name']})";
					if(($nameInfo=self::PhonebookNr2Name($called))!=$called)$b.=" ({$nameInfo['info']})";
				}	
				$cfg[$line]=[$caller,$called,$cmd=='RING', $nameInfo, $msnInfo];
				break;
			case 'CONNECT':
				$format="%s verbunden mit %s";
				$a=empty($cfg[$line][3])?$cfg[$line][0]:$cfg[$line][3]['info'];
				$b=empty($cfg[$line][4])?$cfg[$line][1]:$cfg[$line][4]['name'];
				break;
			case 'DISCONNECT':
				$format="Verbindung %s mit %s beendet";
				$a=empty($cfg[$line][3])?$cfg[$line][0]:$cfg[$line][3]['info'];
				$b=empty($cfg[$line][4])?$cfg[$line][1]:$cfg[$line][4]['name'];
				unset($cfg[$line]);
				break;
			default : $values=null;	
		}		
		file_put_contents($cfgfn,serialize($cfg));
		$r=sprintf($format,$a,$b);
		$maxLines=$this->ReadPropertyInteger('Lines');
		if($line<$maxLines)$this->SetValueString('Line_'.($line+1),$r);
		$this->SetValueString('State',$r);
		if(($cmd=='RING'||$cmd=='CALL') && $this->ReadPropertyBoolean('CallerInfo')){	
			if(!is_array($nameInfo))
				$img=$this->IMAGE_PATH.(is_numeric($caller)?'unknownimage.jpg':'anonym.jpg');
			else
				$img=$this->IMAGE_PATH.(empty($nameInfo['image'])?'noimage.jpg':$nameInfo['image']);
			$name='Unbekannt';
			$number=$caller;
			if(is_array($nameInfo)){
				$name=$nameInfo['name'];
				$number=$nameInfo['number'].' ('.$nameInfo['prefix'].')';
			}
			if(is_array($msnInfo))
				$called="{$msnInfo['number']} ({$msnInfo['name']})";
			$h=self::GetTemplate('Caller');
			$h=str_ireplace(array('#img','#name','#number','#called'),array($img,$name,$number,$called),$h);		
			$this->SetValueString($cmd=='RING'?'LastCaller':'LastCalled',$h);
		}
		if($this->ReadPropertyBoolean('CallerList'))
			$this->SetValueString('CallerList',self::BuildCallerList());
		return $r;
	}	
	protected function GetTemplate($ident){
		if(file_exists($this->TEMPLATE_PATH ."$ident.htm"))
			return file_get_contents($this->TEMPLATE_PATH ."$ident.htm");
		if($ident=='CallerList'){
			return '<table style="width: 100%">
<thead>
	<tr>
		<td>&nbsp;</td>
		<td>Datum/Zeit</td>
		<td>Anrufer</td>
		<td>Ziel</td>
		<td>Dauer</td>
		<td>Angenommen</td>
		<td>Port</td>
	</tr>
</thead>
<tbody>
	<tr>
		<td><img height="16" src="#icon" width="16"></td>
		<td>#date</td>
		<td>#caller</td>
		<td>#called</td>
		<td>#duration</td>
		<td>#device</td>
		<td>#port</td>
	</tr>
</tbody>
</table>';
		} elseif ($ident=='Caller') {
			return '<img src="#img" height="80" width="80" style="margin-left:5px;margin-right:5px;float:left">
<a>#name</a><br />
<a>#number</a><br />
<a>Ziel</a><br />
<a>#called</a>';
		} elseif ($ident=='PhonebookList'){
			return '<table style="width: 100%">
<thead>
	<tr>
		<td>&nbsp;</td>
		<td>Name</td>
		<td>Type</td>
		<td>Rufnummer</td>
	</tr>
</thead>
<tbody>
	<tr>
		<td><img height="16" src="#icon" width="16"></td>
		<td>#name</td>
		<td>#type</td>
		<td>#number</td>
	</tr>
</tbody>
</table>';
		}			
		return null;
	}	
}
?>