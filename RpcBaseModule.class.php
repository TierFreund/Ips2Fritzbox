<?
define ('STATUS_ERR',  101);
define ('STATUS_OK',   102);
define ('ERR_NOHOST',  201);
define ('ERR_ONLINE',  202);
define ('ERR_NOPBNAME',301);
define ('ERR_TESTCALL',302);
define ('ERR_NOAUTH',  303);
require_once( __DIR__ . '/RpcIo.class.php');
require_once( __DIR__ . '/RpcDevice.class.php');

abstract class RpcBaseModule extends IPSModule{
	private $_oAPI=null;
	private $_boIsOnline=null;
	
	public function Create(){
        parent::Create();
        $this->RegisterPropertyString("Host", "");
        $this->RegisterPropertyInteger("Port", 0);
        $this->RegisterPropertyInteger("Timeout", 5);
        $this->RegisterPropertyString("ConnectionType", "soap");
		$this->RegisterPropertyString("Username", "");
        $this->RegisterPropertyString("Password", "");
 	}
    public function ApplyChanges(){
        parent::ApplyChanges();
//		$suffix=str_ireplace(array('module','_'),'',get_class($this));
        $this->RegisterProfileBooleanEx("RPC.OnlineState", "Information", "", "", Array(
                                             Array(false, "offline",  "", -1),
                                             Array(true, "online",  "", -1)
        ));
        $this->RegisterVariableBoolean("OnlineState", "Online Status","RPC.OnlineState",9);
		$this->CheckConfig();
	}

	public function Test(){
		if($this->GetOnlineState())return true;
		$this->SetStatus(ERR_ONLINE);
		return false;
	}	
	protected function CheckConfig(){
		if(!$url=$this->ReadPropertyString("Host"))
			$this->SetStatus(ERR_NOHOST);
		else if((!$port=$this->ReadPropertyString("Port"))||$port<0)
			$this->SetStatus(101);
	    else return true;
	}
	protected function CreateApi($url, $port, $type){
		return null;
	}		
	protected function IsAuthSet(){
		return !empty($this->ReadPropertyString("Username"));
	}		
	protected function GetOnlineState(){
		if(!is_null($this->_boIsOnline))return $this->_boIsOnline;
		if(!$host=$this->ReadPropertyString("Host"))throw new Exception ("No Hostname");
		if($test=@parse_url($host)['host'])$host=$test;
		$this->_boIsOnline=Sys_Ping($host, 2000);
    	$this->SetValueBoolean('OnlineState',$this->_boIsOnline);
   		return $this->_boIsOnline; 
	}
    protected function SetValueBoolean($Ident, $Value){
        $ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        if (GetValueBoolean($ID) <> $Value){
            SetValueBoolean($ID, boolval($Value));
            return true;
        }
        return false;
    }
    protected function SetValueInteger($Ident, $Value){
		$ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        if (GetValueInteger($ID) <> $Value){
            SetValueInteger($ID, intval($Value));
            return true;
        }
        return false;
    }
    protected function SetValueFloat($Ident, $Value){
        $ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        if (GetValueFloat($ID) <> $Value){
            SetValueFloat($ID, intval($Value));
            return true;
        }
        return false;
    }
    protected function SetValueString($Ident, $Value){
        $ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        if (GetValueString($ID) <> $Value){
            SetValueString($ID, strval($Value));
            return true;
        }
        return false;
    }
    protected function GetValueBoolean($Ident){
        $ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        return GetValueBoolean($ID);
    }
	protected function GetValueInteger($Ident){
		$ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        return GetValueInteger($ID);
    }
    protected function GetValueFloat($Ident){
        $ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        return GetValueFloat($ID);
    }
    protected function GetValueString($Ident){
        $ID = is_numeric($Ident)?$Ident:$this->GetIDForIdent($Ident);
        return GetValueString($ID);
    }
	protected function SetProperty($ident, $value){
		IPS_SetProperty($this->InstanceID,$ident,$value);
		IPS_LogMessage(get_class($this),"SetProperty($ident,$value)");
			
	}	
	
    protected function RegisterProfileBoolean($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize) {
        if(!IPS_VariableProfileExists($Name))
            IPS_CreateVariableProfile($Name, 0);
        else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 0)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
    }
    protected function RegisterProfileBooleanEx($Name, $Icon, $Prefix, $Suffix, $Associations) {
        if ( sizeof($Associations) === 0 ){$MinValue = 0;$MaxValue = 0;} 
		else {$MinValue = $Associations[0][0];$MaxValue = $Associations[sizeof($Associations)-1][0];}
        $this->RegisterProfileBoolean($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, 0);
        foreach($Associations as $Association)
            IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
	}
    protected function RegisterProfileString($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize) {
        if(!IPS_VariableProfileExists($Name))
            IPS_CreateVariableProfile($Name, 3);
        else {
            $profile = IPS_GetVariableProfile($Name);
            if($profile['ProfileType'] != 3)
            throw new Exception("Variable profile type does not match for profile ".$Name);
        }
        IPS_SetVariableProfileIcon($Name, $Icon);
        IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
        IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
    }
    protected function RegisterProfileStringEx($Name, $Icon, $Prefix, $Suffix, $Associations) {
        if ( sizeof($Associations) === 0 ){ $MinValue = 0; $MaxValue = 0;} 
		else {$MinValue = $Associations[0][0]; $MaxValue = $Associations[sizeof($Associations)-1][0];}
        $this->RegisterProfileString($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, 0);
        foreach($Associations as $Association)
            IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
    }
    protected function RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize){
		if (!IPS_VariableProfileExists($Name))
      		IPS_CreateVariableProfile($Name, 1);
      	else {
      		$profile = IPS_GetVariableProfile($Name);
            if ($profile['ProfileType'] != 1)
            	throw new Exception("Variable profile type does not match for profile " . $Name);
      	}
      	IPS_SetVariableProfileIcon($Name, $Icon);
      	IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
      	IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
		}
    protected function RegisterProfileIntegerEx($Name, $Icon, $Prefix, $Suffix, $Associations) {
        if ( sizeof($Associations) === 0 ){ $MinValue = 0; $MaxValue = 0;} 
		else { $MinValue = $Associations[0][0]; $MaxValue = $Associations[sizeof($Associations)-1][0];}
        $this->RegisterProfileInteger($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, 0);
        foreach($Associations as $Association)
            IPS_SetVariableProfileAssociation($Name, $Association[0], $Association[1], $Association[2], $Association[3]);
    }
    protected function RegisterProfileFloat($Name, $Icon, $Prefix, $Suffix, $MinValue, $MaxValue, $StepSize){
		if (!IPS_VariableProfileExists($Name))
      		IPS_CreateVariableProfile($Name, 2);
      	else{
      		$profile = IPS_GetVariableProfile($Name);
            if ($profile['ProfileType'] != 2)
            	throw new Exception("Variable profile type does not match for profile " . $Name);
      	}
      	IPS_SetVariableProfileIcon($Name, $Icon);
      	IPS_SetVariableProfileText($Name, $Prefix, $Suffix);
      	IPS_SetVariableProfileValues($Name, $MinValue, $MaxValue, $StepSize);
	}
    protected function RegisterTimer($Name, $Interval, $Script) {
        $id = @IPS_GetObjectIDByIdent($Name, $this->InstanceID);
        if ($id === false)$id = 0;
        if ($id > 0){
            if (!IPS_EventExists($id))
                throw new Exception("Ident with name " . $Name . " is used for wrong object type", E_USER_WARNING);
            if (IPS_GetEvent($id)['EventType'] <> 1){
                IPS_DeleteEvent($id);
                $id = 0;
            }
        }
        if ($id == 0){
            $id = IPS_CreateEvent(1);
            IPS_SetParent($id, $this->InstanceID);
            IPS_SetIdent($id, $Name);
        }
        IPS_SetName($id, $Name);
        IPS_SetHidden($id, true);
        IPS_SetEventScript($id, $Script);
        if ($Interval > 0){
            IPS_SetEventCyclic($id, 0, 0, 0, 0, 1, $Interval);
            IPS_SetEventActive($id, true);
        } else{
            IPS_SetEventCyclic($id, 0, 0, 0, 0, 1, 1);
            IPS_SetEventActive($id, false);
        }
    }
    protected function UnregisterTimer($Name) {
        $id = @IPS_GetObjectIDByIdent($Name, $this->InstanceID);
        if ($id > 0){
            if (!IPS_EventExists($id))
                throw new Exception('Timer not present', E_USER_NOTICE);
            IPS_DeleteEvent($id);
        }
    }
	protected function API(){
		if(!$this->_oAPI){
			if(!$this->GetOnlineState())return null;
			if(!$host=$this->ReadPropertyString("Host"))throw new Exception ("No Hostname",E_USER_WARNING);
			if(!$port=$this->ReadPropertyString("Port"))throw new Exception ("Invalid Port",E_USER_WARNING);
			if (!$type=$this->ReadPropertyString("ConnectionType"))throw new Exception ("No Conetion Type",E_USER_WARNING);
			$this->_oAPI=$this->CreateApi($host,$port,$type);
			if(!$this->_oAPI)throw new Exception ("API Creation Error",E_USER_WARNING);
			$this->_oAPI->SetAuth($this->ReadPropertyString('Username'),$this->ReadPropertyString('Password'));
		}
		return $this->_oAPI;
	}
	
}
?>