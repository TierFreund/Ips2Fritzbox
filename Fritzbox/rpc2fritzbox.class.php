<?
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
 |  Class           :rpc2fritzbox extends uRpcDevice                              |
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

class rpc2fritzbox extends uRpcDevice {
  // Name:string
  protected function GetServiceConnData($name){
    switch($name){
      case                 'DeviceInfo' : return [49000,"urn:dslforum-org:service:DeviceInfo:1","/upnp/control/deviceinfo","/upnp/control/deviceinfo","/deviceinfoSCPD.xml"];
      case               'DeviceConfig' : return [49000,"urn:dslforum-org:service:DeviceConfig:1","/upnp/control/deviceconfig","/upnp/control/deviceconfig","/deviceconfigSCPD.xml"];
      case           'Layer3Forwarding' : return [49000,"urn:dslforum-org:service:Layer3Forwarding:1","/upnp/control/layer3forwarding","/upnp/control/layer3forwarding","/layer3forwardingSCPD.xml"];
      case          'LANConfigSecurity' : return [49000,"urn:dslforum-org:service:LANConfigSecurity:1","/upnp/control/lanconfigsecurity","/upnp/control/lanconfigsecurity","/lanconfigsecuritySCPD.xml"];
      case           'ManagementServer' : return [49000,"urn:dslforum-org:service:ManagementServer:1","/upnp/control/mgmsrv","/upnp/control/mgmsrv","/mgmsrvSCPD.xml"];
      case                       'Time' : return [49000,"urn:dslforum-org:service:Time:1","/upnp/control/time","/upnp/control/time","/timeSCPD.xml"];
      case              'UserInterface' : return [49000,"urn:dslforum-org:service:UserInterface:1","/upnp/control/userif","/upnp/control/userif","/userifSCPD.xml"];
      case                     'X_VoIP' : return [49000,"urn:dslforum-org:service:X_VoIP:1","/upnp/control/x_voip","/upnp/control/x_voip","/x_voipSCPD.xml"];
      case           'X_AVM_DE_Storage' : return [49000,"urn:dslforum-org:service:X_AVM-DE_Storage:1","/upnp/control/x_storage","/upnp/control/x_storage","/x_storageSCPD.xml"];
      case             'X_AVM_DE_OnTel' : return [49000,"urn:dslforum-org:service:X_AVM-DE_OnTel:1","/upnp/control/x_contact","/upnp/control/x_contact","/x_contactSCPD.xml"];
      case      'X_AVM_DE_WebDAVClient' : return [49000,"urn:dslforum-org:service:X_AVM-DE_WebDAVClient:1","/upnp/control/x_webdav","/upnp/control/x_webdav","/x_webdavSCPD.xml"];
      case              'X_AVM_DE_UPnP' : return [49000,"urn:dslforum-org:service:X_AVM-DE_UPnP:1","/upnp/control/x_upnp","/upnp/control/x_upnp","/x_upnpSCPD.xml"];
      case      'X_AVM_DE_RemoteAccess' : return [49000,"urn:dslforum-org:service:X_AVM-DE_RemoteAccess:1","/upnp/control/x_remote","/upnp/control/x_remote","/x_remoteSCPD.xml"];
      case           'X_AVM_DE_MyFritz' : return [49000,"urn:dslforum-org:service:X_AVM-DE_MyFritz:1","/upnp/control/x_myfritz","/upnp/control/x_myfritz","/x_myfritzSCPD.xml"];
      case               'X_AVM_DE_TAM' : return [49000,"urn:dslforum-org:service:X_AVM-DE_TAM:1","/upnp/control/x_tam","/upnp/control/x_tam","/x_tamSCPD.xml"];
      case          'WLANConfiguration' : return [49000,"urn:dslforum-org:service:WLANConfiguration:3","/upnp/control/wlanconfig3","/upnp/control/wlanconfig3","/wlanconfigSCPD.xml"];
      case                      'Hosts' : return [49000,"urn:dslforum-org:service:Hosts:1","/upnp/control/hosts","/upnp/control/hosts","/hostsSCPD.xml"];
      case 'LANEthernetInterfaceConfig' : return [49000,"urn:dslforum-org:service:LANEthernetInterfaceConfig:1","/upnp/control/lanethernetifcfg","/upnp/control/lanethernetifcfg","/ethifconfigSCPD.xml"];
      case    'LANHostConfigManagement' : return [49000,"urn:dslforum-org:service:LANHostConfigManagement:1","/upnp/control/lanhostconfigmgm","/upnp/control/lanhostconfigmgm","/lanhostconfigmgmSCPD.xml"];
      case   'WANCommonInterfaceConfig' : return [49000,"urn:dslforum-org:service:WANCommonInterfaceConfig:1","/upnp/control/wancommonifconfig1","/upnp/control/wancommonifconfig1","/wancommonifconfigSCPD.xml"];
      case      'WANDSLInterfaceConfig' : return [49000,"urn:dslforum-org:service:WANDSLInterfaceConfig:1","/upnp/control/wandslifconfig1","/upnp/control/wandslifconfig1","/wandslifconfigSCPD.xml"];
    }
    return null;
  }
  // url:string, defaultPort:ui4, requestType:string
  public function __construct($url, $defaultPort=49000, $requestType='soap'){
    parent::__construct($url,$defaultPort,$requestType);
    self::SetResponseMode('plain');
  }
  // NewType:string, NewDestIPAddress:string, NewDestSubnetMask:string, NewSourceIPAddress:string, NewSourceSubnetMask:string, NewGatewayIPAddress:string, NewInterface:string, NewForwardingMetric:i4
  public function AddForwardingEntry($NewType,$NewDestIPAddress,$NewDestSubnetMask,$NewSourceIPAddress,$NewSourceSubnetMask,$NewGatewayIPAddress,$NewInterface,$NewForwardingMetric){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewType'=>$NewType,'NewDestIPAddress'=>$NewDestIPAddress,'NewDestSubnetMask'=>$NewDestSubnetMask,'NewSourceIPAddress'=>$NewSourceIPAddress,'NewSourceSubnetMask'=>$NewSourceSubnetMask,'NewGatewayIPAddress'=>$NewGatewayIPAddress,'NewInterface'=>$NewInterface,'NewForwardingMetric'=>$NewForwardingMetric);
    return self::Call('Layer3Forwarding','AddForwardingEntry',$args,null);
  }
  // NewPhonebookExtraID:string, NewPhonebookName:string
  public function AddPhonebook($NewPhonebookExtraID,$NewPhonebookName){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPhonebookExtraID'=>$NewPhonebookExtraID,'NewPhonebookName'=>$NewPhonebookName);
    return self::Call('X_AVM_DE_OnTel','AddPhonebook',$args,null);
  }

  public function ConfigurationFinished(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewStatus');
    return self::Call('DeviceConfig','ConfigurationFinished',null,$filter);
  }
  // NewSessionID:string
  public function ConfigurationStarted($NewSessionID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewSessionID'=>$NewSessionID);
    return self::Call('DeviceConfig','ConfigurationStarted',$args,null);
  }
  // NewIndex:ui2
  public function DeleteByIndex($NewIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex);
    return self::Call('X_AVM_DE_OnTel','DeleteByIndex',$args,null);
  }
  // NewDestIPAddress:string, NewDestSubnetMask:string, NewSourceIPAddress:string, NewSourceSubnetMask:string
  public function DeleteForwardingEntry($NewDestIPAddress,$NewDestSubnetMask,$NewSourceIPAddress,$NewSourceSubnetMask){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDestIPAddress'=>$NewDestIPAddress,'NewDestSubnetMask'=>$NewDestSubnetMask,'NewSourceIPAddress'=>$NewSourceIPAddress,'NewSourceSubnetMask'=>$NewSourceSubnetMask);
    return self::Call('Layer3Forwarding','DeleteForwardingEntry',$args,null);
  }
  // NewIndex:ui2, NewMessageIndex:ui2
  public function DeleteMessage($NewIndex,$NewMessageIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex,'NewMessageIndex'=>$NewMessageIndex);
    return self::Call('X_AVM_DE_TAM','DeleteMessage',$args,null);
  }
  // NewPhonebookID:ui2, NewPhonebookExtraID:string
  public function DeletePhonebook($NewPhonebookID,$NewPhonebookExtraID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPhonebookID'=>$NewPhonebookID,'NewPhonebookExtraID'=>$NewPhonebookExtraID);
    return self::Call('X_AVM_DE_OnTel','DeletePhonebook',$args,null);
  }
  // NewPhonebookID:ui2, NewPhonebookEntryID:ui4
  public function DeletePhonebookEntry($NewPhonebookID,$NewPhonebookEntryID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPhonebookID'=>$NewPhonebookID,'NewPhonebookEntryID'=>$NewPhonebookEntryID);
    return self::Call('X_AVM_DE_OnTel','DeletePhonebookEntry',$args,null);
  }
  // NewIndex:ui4
  public function DeleteServiceByIndex($NewIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex);
    return self::Call('X_AVM_DE_MyFritz','DeleteServiceByIndex',$args,null);
  }

  public function FactoryReset(){
    if (!$this->GetOnlineState()) return null;
    return self::Call('DeviceConfig','FactoryReset',null,null);
  }

  public function GetAddressRange(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewMinAddress','NewMaxAddress');
    return self::Call('LANHostConfigManagement','GetAddressRange',null,$filter);
  }

  public function GetBSSID(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewBSSID');
    return self::Call('WLANConfiguration','GetBSSID',null,$filter);
  }

  public function GetBasBeaconSecurityProperties(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewBasicEncryptionModes','NewBasicAuthenticationMode');
    return self::Call('WLANConfiguration','GetBasBeaconSecurityProperties',null,$filter);
  }

  public function GetBeaconAdvertisement(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewBeaconAdvertisementEnabled');
    return self::Call('WLANConfiguration','GetBeaconAdvertisement',null,$filter);
  }

  public function GetBeaconType(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewBeaconType');
    return self::Call('WLANConfiguration','GetBeaconType',null,$filter);
  }

  public function GetCallList(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewCallListURL');
    return self::Call('X_AVM_DE_OnTel','GetCallList',null,$filter);
  }

  public function GetChannelInfo(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewChannel','NewPossibleChannels');
    return self::Call('WLANConfiguration','GetChannelInfo',null,$filter);
  }

  public function GetCommonLinkProperties(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewWANAccessType','NewLayer1UpstreamMaxBitRate','NewLayer1DownstreamMaxBitRate','NewPhysicalLinkStatus');
    return self::Call('WANCommonInterfaceConfig','GetCommonLinkProperties',null,$filter);
  }

  public function GetDDNSInfo(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewEnabled','NewProviderName','NewUpdateURL','NewDomain','NewStatusIPv4','NewStatusIPv6','NewUsername','NewMode','NewServerIPv4','NewServerIPv6');
    return self::Call('X_AVM_DE_RemoteAccess','GetDDNSInfo',null,$filter);
  }

  public function GetDDNSProviders(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewProviderList');
    return self::Call('X_AVM_DE_RemoteAccess','GetDDNSProviders',null,$filter);
  }
  // NewDectID:ui2
  public function GetDECTHandsetInfo($NewDectID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDectID'=>$NewDectID);
    $filter=array('NewHandsetName','NewPhonebookID');
    return self::Call('X_AVM_DE_OnTel','GetDECTHandsetInfo',$args,$filter);
  }

  public function GetDECTHandsetList(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewDectIDList');
    return self::Call('X_AVM_DE_OnTel','GetDECTHandsetList',null,$filter);
  }

  public function GetDNSServers(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewDNSServers');
    return self::Call('LANHostConfigManagement','GetDNSServers',null,$filter);
  }

  public function GetDefaultConnectionService(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewDefaultConnectionService');
    return self::Call('Layer3Forwarding','GetDefaultConnectionService',null,$filter);
  }

  public function GetDefaultWEPKeyIndex(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewDefaultWEPKeyIndex');
    return self::Call('WLANConfiguration','GetDefaultWEPKeyIndex',null,$filter);
  }

  public function GetDeviceLog(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewDeviceLog');
    return self::Call('DeviceInfo','GetDeviceLog',null,$filter);
  }

  public function GetExistingVoIPNumbers(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewExistingVoIPNumbers');
    return self::Call('X_VoIP','GetExistingVoIPNumbers',null,$filter);
  }

  public function GetForwardNumberOfEntries(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewForwardNumberOfEntries');
    return self::Call('Layer3Forwarding','GetForwardNumberOfEntries',null,$filter);
  }
  // NewAssociatedDeviceIndex:ui2
  public function GetGenericAssociatedDeviceInfo($NewAssociatedDeviceIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewAssociatedDeviceIndex'=>$NewAssociatedDeviceIndex);
    $filter=array('NewAssociatedDeviceMACAddress','NewAssociatedDeviceIPAddress','NewAssociatedDeviceAuthState','NewX_AVM-DE_Speed','NewX_AVM-DE_SignalStrength');
    return self::Call('WLANConfiguration','GetGenericAssociatedDeviceInfo',$args,$filter);
  }
  // NewForwardingIndex:ui2
  public function GetGenericForwardingEntry($NewForwardingIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewForwardingIndex'=>$NewForwardingIndex);
    $filter=array('NewEnable','NewStatus','NewType','NewDestIPAddress','NewDestSubnetMask','NewSourceIPAddress','NewSourceSubnetMask','NewGatewayIPAddress','NewInterface','NewForwardingMetric');
    return self::Call('Layer3Forwarding','GetGenericForwardingEntry',$args,$filter);
  }
  // NewIndex:ui2
  public function GetGenericHostEntry($NewIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex);
    $filter=array('NewIPAddress','NewAddressSource','NewLeaseTimeRemaining','NewMACAddress','NewInterfaceType','NewActive','NewHostName');
    return self::Call('Hosts','GetGenericHostEntry',$args,$filter);
  }

  public function GetHostNumberOfEntries(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewHostNumberOfEntries');
    return self::Call('Hosts','GetHostNumberOfEntries',null,$filter);
  }

  public function GetIPInterfaceNumberOfEntries(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewIPInterfaceNumberOfEntries');
    return self::Call('LANHostConfigManagement','GetIPInterfaceNumberOfEntries',null,$filter);
  }

  public function GetIPRoutersList(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewIPRouters');
    return self::Call('LANHostConfigManagement','GetIPRoutersList',null,$filter);
  }

  public function GetInfoWANDSLInterfaceConfig(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewEnable','NewStatus','NewDataPath','NewUpstreamCurrRate','NewDownstreamCurrRate','NewUpstreamMaxRate','NewDownstreamMaxRate','NewUpstreamNoiseMargin','NewDownstreamNoiseMargin','NewUpstreamAttenuation','NewDownstreamAttenuation','NewATURVendor','NewATURCountry','NewUpstreamPower','NewDownstreamPower');
    return self::Call('WANDSLInterfaceConfig','GetInfo',null,$filter);
  }
  // NewIndex:ui2
  public function GetInfoByIndex($NewIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex);
    $filter=array('NewEnable','NewStatus','NewLastConnect','NewUrl','NewServiceId','NewUsername','NewName');
    return self::Call('X_AVM_DE_OnTel','GetInfoByIndex',$args,$filter);
  }

  public function GetInfoEx(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewVoIPNumberMinChars','NewVoIPNumberMaxChars','NewVoIPNumberAllowedChars','NewVoIPUsernameMinChars','NewVoIPUsernameMaxChars','NewVoIPUsernameAllowedChars','NewVoIPPasswordMinChars','NewVoIPPasswordMaxChars','NewVoIPPasswordAllowedChars','NewVoIPRegistrarMinChars','NewVoIPRegistrarMaxChars','NewVoIPRegistrarAllowedChars','NewVoIPSTUNServerMinChars','NewVoIPSTUNServerMaxChars','NewVoIPSTUNServerAllowedChars');
    return self::Call('X_VoIP','GetInfoEx',null,$filter);
  }

  public function GetMaxVoIPNumbers(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewMaxVoIPNumbers');
    return self::Call('X_VoIP','GetMaxVoIPNumbers',null,$filter);
  }
  // NewIndex:ui2
  public function GetMessageList($NewIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex);
    $filter=array('NewURL');
    return self::Call('X_AVM_DE_TAM','GetMessageList',$args,$filter);
  }

  public function GetNumberOfEntries(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewOnTelNumberOfEntries');
    return self::Call('X_AVM_DE_OnTel','GetNumberOfEntries',null,$filter);
  }

  public function GetNumberOfServices(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewNumberOfServices');
    return self::Call('X_AVM_DE_MyFritz','GetNumberOfServices',null,$filter);
  }

  public function GetPacketStatistics(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewTotalPacketsSent','NewTotalPacketsReceived');
    return self::Call('WLANConfiguration','GetPacketStatistics',null,$filter);
  }

  public function GetPersistentData(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewPersistentData');
    return self::Call('DeviceConfig','GetPersistentData',null,$filter);
  }
  // NewPhonebookID:ui2
  public function GetPhonebook($NewPhonebookID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPhonebookID'=>$NewPhonebookID);
    $filter=array('NewPhonebookName','NewPhonebookExtraID','NewPhonebookURL');
    return self::Call('X_AVM_DE_OnTel','GetPhonebook',$args,$filter);
  }
  // NewPhonebookID:ui2, NewPhonebookEntryID:ui4
  public function GetPhonebookEntry($NewPhonebookID,$NewPhonebookEntryID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPhonebookID'=>$NewPhonebookID,'NewPhonebookEntryID'=>$NewPhonebookEntryID);
    $filter=array('NewPhonebookEntryData');
    return self::Call('X_AVM_DE_OnTel','GetPhonebookEntry',$args,$filter);
  }

  public function GetPhonebookList(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewPhonebookList');
    return self::Call('X_AVM_DE_OnTel','GetPhonebookList',null,$filter);
  }

  public function GetSSID(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewSSID');
    return self::Call('WLANConfiguration','GetSSID',null,$filter);
  }

  public function GetSecurityKeys(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewWEPKey0','NewWEPKey1','NewWEPKey2','NewWEPKey3','NewPreSharedKey','NewKeyPassphrase');
    return self::Call('WLANConfiguration','GetSecurityKeys',null,$filter);
  }

  public function GetSecurityPort(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewSecurityPort');
    return self::Call('DeviceInfo','GetSecurityPort',null,$filter);
  }
  // NewIndex:ui4
  public function GetServiceByIndex($NewIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex);
    $filter=array('NewEnabled','NewName','NewScheme','NewPort','NewURLPath','NewType','NewIPv4ForwardingWarning','NewIPv4Addresses','NewIPv6Addresses','NewIPv6InterfaceIDs','NewMACAddress','NewHostName','NewDynDnsLabel','NewStatus');
    return self::Call('X_AVM_DE_MyFritz','GetServiceByIndex',$args,$filter);
  }
  // NewAssociatedDeviceMACAddress:string
  public function GetSpecificAssociatedDeviceInfo($NewAssociatedDeviceMACAddress){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewAssociatedDeviceMACAddress'=>$NewAssociatedDeviceMACAddress);
    $filter=array('NewAssociatedDeviceIPAddress','NewAssociatedDeviceAuthState','NewX_AVM-DE_Speed','NewX_AVM-DE_SignalStrength');
    return self::Call('WLANConfiguration','GetSpecificAssociatedDeviceInfo',$args,$filter);
  }
  // NewDestIPAddress:string, NewDestSubnetMask:string, NewSourceIPAddress:string, NewSourceSubnetMask:string
  public function GetSpecificForwardingEntry($NewDestIPAddress,$NewDestSubnetMask,$NewSourceIPAddress,$NewSourceSubnetMask){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDestIPAddress'=>$NewDestIPAddress,'NewDestSubnetMask'=>$NewDestSubnetMask,'NewSourceIPAddress'=>$NewSourceIPAddress,'NewSourceSubnetMask'=>$NewSourceSubnetMask);
    $filter=array('NewGatewayIPAddress','NewEnable','NewStatus','NewType','NewInterface','NewForwardingMetric');
    return self::Call('Layer3Forwarding','GetSpecificForwardingEntry',$args,$filter);
  }
  // NewMACAddress:string
  public function GetSpecificHostEntry($NewMACAddress){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewMACAddress'=>$NewMACAddress);
    $filter=array('NewIPAddress','NewAddressSource','NewLeaseTimeRemaining','NewInterfaceType','NewActive','NewHostName');
    return self::Call('Hosts','GetSpecificHostEntry',$args,$filter);
  }

  public function GetStatisticsLANEthernetInterfaceConfig(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewBytesSent','NewBytesReceived','NewPacketsSent','NewPacketsReceived');
    return self::Call('LANEthernetInterfaceConfig','GetStatistics',null,$filter);
  }

  public function GetStatisticsTotal(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewReceiveBlocks','NewTransmitBlocks','NewCellDelin','NewLinkRetrain','NewInitErrors','NewInitTimeouts','NewLossOfFraming','NewErroredSecs','NewSeverelyErroredSecs','NewFECErrors','NewATUCFECErrors','NewHECErrors','NewATUCHECErrors','NewCRCErrors','NewATUCCRCErrors');
    return self::Call('WANDSLInterfaceConfig','GetStatisticsTotal',null,$filter);
  }

  public function GetSubnetMask(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewSubnetMask');
    return self::Call('LANHostConfigManagement','GetSubnetMask',null,$filter);
  }

  public function GetTotalAssociations(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewTotalAssociations');
    return self::Call('WLANConfiguration','GetTotalAssociations',null,$filter);
  }

  public function GetTotalBytesReceived(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewTotalBytesReceived');
    return self::Call('WANCommonInterfaceConfig','GetTotalBytesReceived',null,$filter);
  }

  public function GetTotalBytesSent(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewTotalBytesSent');
    return self::Call('WANCommonInterfaceConfig','GetTotalBytesSent',null,$filter);
  }

  public function GetTotalPacketsReceived(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewTotalPacketsReceived');
    return self::Call('WANCommonInterfaceConfig','GetTotalPacketsReceived',null,$filter);
  }

  public function GetTotalPacketsSent(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewTotalPacketsSent');
    return self::Call('WANCommonInterfaceConfig','GetTotalPacketsSent',null,$filter);
  }

  public function GetUserInfo(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewEnable','NewUsername','NewX_AVM-DE_NetworkAccessReadOnly');
    return self::Call('X_AVM_DE_Storage','GetUserInfo',null,$filter);
  }

  public function GetVoIPCommonAreaCode(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewVoIPAreaCode');
    return self::Call('X_VoIP','GetVoIPCommonAreaCode',null,$filter);
  }

  public function GetVoIPCommonCountryCode(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewVoIPCountryCode');
    return self::Call('X_VoIP','GetVoIPCommonCountryCode',null,$filter);
  }
  // NewVoIPAccountIndex:ui2
  public function GetVoIPEnableAreaCode($NewVoIPAccountIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAccountIndex'=>$NewVoIPAccountIndex);
    $filter=array('NewVoIPEnableAreaCode');
    return self::Call('X_VoIP','GetVoIPEnableAreaCode',$args,$filter);
  }
  // NewVoIPAccountIndex:ui2
  public function GetVoIPEnableCountryCode($NewVoIPAccountIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAccountIndex'=>$NewVoIPAccountIndex);
    $filter=array('NewVoIPEnableCountryCode');
    return self::Call('X_VoIP','GetVoIPEnableCountryCode',$args,$filter);
  }
  // NewIndex:ui2, NewMessageIndex:ui2
  public function MarkMessage($NewIndex,$NewMessageIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex,'NewMessageIndex'=>$NewMessageIndex);
    return self::Call('X_AVM_DE_TAM','MarkMessage',$args,null);
  }

  public function Reboot(){
    if (!$this->GetOnlineState()) return null;
    return self::Call('DeviceConfig','Reboot',null,null);
  }
  // NewMinAddress:string, NewMaxAddress:string
  public function SetAddressRange($NewMinAddress,$NewMaxAddress){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewMinAddress'=>$NewMinAddress,'NewMaxAddress'=>$NewMaxAddress);
    return self::Call('LANHostConfigManagement','SetAddressRange',$args,null);
  }
  // NewBasicEncryptionModes:string, NewBasicAuthenticationMode:string
  public function SetBasBeaconSecurityProperties($NewBasicEncryptionModes,$NewBasicAuthenticationMode){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewBasicEncryptionModes'=>$NewBasicEncryptionModes,'NewBasicAuthenticationMode'=>$NewBasicAuthenticationMode);
    return self::Call('WLANConfiguration','SetBasBeaconSecurityProperties',$args,null);
  }
  // NewBeaconAdvertisementEnabled:boolean
  public function SetBeaconAdvertisement($NewBeaconAdvertisementEnabled){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewBeaconAdvertisementEnabled'=>$NewBeaconAdvertisementEnabled);
    return self::Call('WLANConfiguration','SetBeaconAdvertisement',$args,null);
  }
  // NewBeaconType:string
  public function SetBeaconType($NewBeaconType){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewBeaconType'=>$NewBeaconType);
    return self::Call('WLANConfiguration','SetBeaconType',$args,null);
  }
  // NewChannel:ui1
  public function SetChannel($NewChannel){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewChannel'=>$NewChannel);
    return self::Call('WLANConfiguration','SetChannel',$args,null);
  }
  // NewMaxBitRate:string, NewChannel:ui1, NewSSID:string, NewBeaconType:string, NewMACAddressControlEnabled:boolean, NewBasicEncryptionModes:string, NewBasicAuthenticationMode:string
  public function SetConfigWLANConfiguration($NewMaxBitRate,$NewChannel,$NewSSID,$NewBeaconType,$NewMACAddressControlEnabled,$NewBasicEncryptionModes,$NewBasicAuthenticationMode){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewMaxBitRate'=>$NewMaxBitRate,'NewChannel'=>$NewChannel,'NewSSID'=>$NewSSID,'NewBeaconType'=>$NewBeaconType,'NewMACAddressControlEnabled'=>$NewMACAddressControlEnabled,'NewBasicEncryptionModes'=>$NewBasicEncryptionModes,'NewBasicAuthenticationMode'=>$NewBasicAuthenticationMode);
    return self::Call('WLANConfiguration','SetConfig',$args,null);
  }
  // NewIndex:ui2, NewEnable:boolean, NewUrl:string, NewServiceId:string, NewUsername:string, NewPassword:string, NewName:string
  public function SetConfigByIndex($NewIndex,$NewEnable,$NewUrl,$NewServiceId,$NewUsername,$NewPassword,$NewName){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex,'NewEnable'=>$NewEnable,'NewUrl'=>$NewUrl,'NewServiceId'=>$NewServiceId,'NewUsername'=>$NewUsername,'NewPassword'=>$NewPassword,'NewName'=>$NewName);
    return self::Call('X_AVM_DE_OnTel','SetConfigByIndex',$args,null);
  }
  // NewPassword:string
  public function SetConfigPassword($NewPassword){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPassword'=>$NewPassword);
    return self::Call('LANConfigSecurity','SetConfigPassword',$args,null);
  }
  // NewConnectionRequestUsername:string, NewConnectionRequestPassword:string
  public function SetConnectionRequestAuthentication($NewConnectionRequestUsername,$NewConnectionRequestPassword){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewConnectionRequestUsername'=>$NewConnectionRequestUsername,'NewConnectionRequestPassword'=>$NewConnectionRequestPassword);
    return self::Call('ManagementServer','SetConnectionRequestAuthentication',$args,null);
  }
  // NewEnabled:boolean, NewProviderName:string, NewUpdateURL:string, NewDomain:string, NewUsername:string, NewMode:string, NewServerIPv4:string, NewServerIPv6:string, NewPassword:string
  public function SetDDNSConfig($NewEnabled,$NewProviderName,$NewUpdateURL,$NewDomain,$NewUsername,$NewMode,$NewServerIPv4,$NewServerIPv6,$NewPassword){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewEnabled'=>$NewEnabled,'NewProviderName'=>$NewProviderName,'NewUpdateURL'=>$NewUpdateURL,'NewDomain'=>$NewDomain,'NewUsername'=>$NewUsername,'NewMode'=>$NewMode,'NewServerIPv4'=>$NewServerIPv4,'NewServerIPv6'=>$NewServerIPv6,'NewPassword'=>$NewPassword);
    return self::Call('X_AVM_DE_RemoteAccess','SetDDNSConfig',$args,null);
  }
  // NewDectID:ui2, NewPhonebookID:ui2
  public function SetDECTHandsetPhonebook($NewDectID,$NewPhonebookID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDectID'=>$NewDectID,'NewPhonebookID'=>$NewPhonebookID);
    return self::Call('X_AVM_DE_OnTel','SetDECTHandsetPhonebook',$args,null);
  }
  // NewDHCPServerEnable:boolean
  public function SetDHCPServerEnable($NewDHCPServerEnable){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDHCPServerEnable'=>$NewDHCPServerEnable);
    return self::Call('LANHostConfigManagement','SetDHCPServerEnable',$args,null);
  }
  // NewDefaultConnectionService:string
  public function SetDefaultConnectionService($NewDefaultConnectionService){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDefaultConnectionService'=>$NewDefaultConnectionService);
    return self::Call('Layer3Forwarding','SetDefaultConnectionService',$args,null);
  }
  // NewDefaultWEPKeyIndex:ui1
  public function SetDefaultWEPKeyIndex($NewDefaultWEPKeyIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDefaultWEPKeyIndex'=>$NewDefaultWEPKeyIndex);
    return self::Call('WLANConfiguration','SetDefaultWEPKeyIndex',$args,null);
  }
  // NewEnable:boolean
  public function SetEnableLANEthernetInterfaceConfig($NewEnable){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewEnable'=>$NewEnable);
    return self::Call('LANEthernetInterfaceConfig','SetEnable',$args,null);
  }
  // NewIndex:ui2, NewEnable:boolean
  public function SetEnableByIndex($NewIndex,$NewEnable){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex,'NewEnable'=>$NewEnable);
    return self::Call('X_AVM_DE_OnTel','SetEnableByIndex',$args,null);
  }
  // NewFTPEnable:boolean
  public function SetFTPServer($NewFTPEnable){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewFTPEnable'=>$NewFTPEnable);
    return self::Call('X_AVM_DE_Storage','SetFTPServer',$args,null);
  }
  // NewDestIPAddress:string, NewDestSubnetMask:string, NewSourceIPAddress:string, NewSourceSubnetMask:string, NewEnable:boolean
  public function SetForwardingEntryEnable($NewDestIPAddress,$NewDestSubnetMask,$NewSourceIPAddress,$NewSourceSubnetMask,$NewEnable){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewDestIPAddress'=>$NewDestIPAddress,'NewDestSubnetMask'=>$NewDestSubnetMask,'NewSourceIPAddress'=>$NewSourceIPAddress,'NewSourceSubnetMask'=>$NewSourceSubnetMask,'NewEnable'=>$NewEnable);
    return self::Call('Layer3Forwarding','SetForwardingEntryEnable',$args,null);
  }
  // NewEnable:boolean, NewIPAddress:string, NewSubnetMask:string, NewIPAddressingType:string
  public function SetIPInterface($NewEnable,$NewIPAddress,$NewSubnetMask,$NewIPAddressingType){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewEnable'=>$NewEnable,'NewIPAddress'=>$NewIPAddress,'NewSubnetMask'=>$NewSubnetMask,'NewIPAddressingType'=>$NewIPAddressingType);
    return self::Call('LANHostConfigManagement','SetIPInterface',$args,null);
  }
  // NewIPRouters:string
  public function SetIPRouter($NewIPRouters){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIPRouters'=>$NewIPRouters);
    return self::Call('LANHostConfigManagement','SetIPRouter',$args,null);
  }
  // NewPassword:string
  public function SetManagementServerPassword($NewPassword){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPassword'=>$NewPassword);
    return self::Call('ManagementServer','SetManagementServerPassword',$args,null);
  }
  // NewURL:string
  public function SetManagementServerURL($NewURL){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewURL'=>$NewURL);
    return self::Call('ManagementServer','SetManagementServerURL',$args,null);
  }
  // NewUsername:string
  public function SetManagementServerUsername($NewUsername){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewUsername'=>$NewUsername);
    return self::Call('ManagementServer','SetManagementServerUsername',$args,null);
  }
  // NewNTPServer1:string, NewNTPServer2:string
  public function SetNTPServers($NewNTPServer1,$NewNTPServer2){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewNTPServer1'=>$NewNTPServer1,'NewNTPServer2'=>$NewNTPServer2);
    return self::Call('Time','SetNTPServers',$args,null);
  }
  // NewPeriodicInformEnable:boolean, NewPeriodicInformInterval:ui4, NewPeriodicInformTime:dateTime
  public function SetPeriodicInform($NewPeriodicInformEnable,$NewPeriodicInformInterval,$NewPeriodicInformTime){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPeriodicInformEnable'=>$NewPeriodicInformEnable,'NewPeriodicInformInterval'=>$NewPeriodicInformInterval,'NewPeriodicInformTime'=>$NewPeriodicInformTime);
    return self::Call('ManagementServer','SetPeriodicInform',$args,null);
  }
  // NewPersistentData:string
  public function SetPersistentData($NewPersistentData){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPersistentData'=>$NewPersistentData);
    return self::Call('DeviceConfig','SetPersistentData',$args,null);
  }
  // NewPhonebookID:ui2, NewPhonebookEntryID:ui4, NewPhonebookEntryData:string
  public function SetPhonebookEntry($NewPhonebookID,$NewPhonebookEntryID,$NewPhonebookEntryData){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewPhonebookID'=>$NewPhonebookID,'NewPhonebookEntryID'=>$NewPhonebookEntryID,'NewPhonebookEntryData'=>$NewPhonebookEntryData);
    return self::Call('X_AVM_DE_OnTel','SetPhonebookEntry',$args,null);
  }
  // NewProvisioningCode:string
  public function SetProvisioningCode($NewProvisioningCode){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewProvisioningCode'=>$NewProvisioningCode);
    return self::Call('DeviceInfo','SetProvisioningCode',$args,null);
  }
  // NewSMBEnable:boolean
  public function SetSMBServer($NewSMBEnable){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewSMBEnable'=>$NewSMBEnable);
    return self::Call('X_AVM_DE_Storage','SetSMBServer',$args,null);
  }
  // NewSSID:string
  public function SetSSID($NewSSID){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewSSID'=>$NewSSID);
    return self::Call('WLANConfiguration','SetSSID',$args,null);
  }
  // NewWEPKey0:string, NewWEPKey1:string, NewWEPKey2:string, NewWEPKey3:string, NewPreSharedKey:string, NewKeyPassphrase:string
  public function SetSecurityKeys($NewWEPKey0,$NewWEPKey1,$NewWEPKey2,$NewWEPKey3,$NewPreSharedKey,$NewKeyPassphrase){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewWEPKey0'=>$NewWEPKey0,'NewWEPKey1'=>$NewWEPKey1,'NewWEPKey2'=>$NewWEPKey2,'NewWEPKey3'=>$NewWEPKey3,'NewPreSharedKey'=>$NewPreSharedKey,'NewKeyPassphrase'=>$NewKeyPassphrase);
    return self::Call('WLANConfiguration','SetSecurityKeys',$args,null);
  }
  // NewIndex:ui4, NewEnabled:boolean, NewName:string, NewScheme:string, NewPort:ui4, NewURLPath:string, NewType:string, NewIPv4Address:string, NewIPv6Address:string, NewIPv6InterfaceID:string, NewMACAddress:string, NewHostName:string
  public function SetServiceByIndex($NewIndex,$NewEnabled,$NewName,$NewScheme,$NewPort,$NewURLPath,$NewType,$NewIPv4Address,$NewIPv6Address,$NewIPv6InterfaceID,$NewMACAddress,$NewHostName){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex,'NewEnabled'=>$NewEnabled,'NewName'=>$NewName,'NewScheme'=>$NewScheme,'NewPort'=>$NewPort,'NewURLPath'=>$NewURLPath,'NewType'=>$NewType,'NewIPv4Address'=>$NewIPv4Address,'NewIPv6Address'=>$NewIPv6Address,'NewIPv6InterfaceID'=>$NewIPv6InterfaceID,'NewMACAddress'=>$NewMACAddress,'NewHostName'=>$NewHostName);
    return self::Call('X_AVM_DE_MyFritz','SetServiceByIndex',$args,null);
  }
  // NewSubnetMask:string
  public function SetSubnetMask($NewSubnetMask){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewSubnetMask'=>$NewSubnetMask);
    return self::Call('LANHostConfigManagement','SetSubnetMask',$args,null);
  }
  // NewUpgradesManaged:boolean
  public function SetUpgradeManagement($NewUpgradesManaged){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewUpgradesManaged'=>$NewUpgradesManaged);
    return self::Call('ManagementServer','SetUpgradeManagement',$args,null);
  }
  // NewEnable:boolean, NewPassword:string, NewX_AVM_DE_NetworkAccessReadOnly:boolean
  public function SetUserConfig($NewEnable,$NewPassword,$NewX_AVM_DE_NetworkAccessReadOnly){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewEnable'=>$NewEnable,'NewPassword'=>$NewPassword,'NewX_AVM-DE_NetworkAccessReadOnly'=>$NewX_AVM_DE_NetworkAccessReadOnly);
    return self::Call('X_AVM_DE_Storage','SetUserConfig',$args,null);
  }
  // NewVoIPAreaCode:string
  public function SetVoIPCommonAreaCode($NewVoIPAreaCode){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAreaCode'=>$NewVoIPAreaCode);
    return self::Call('X_VoIP','SetVoIPCommonAreaCode',$args,null);
  }
  // NewVoIPCountryCode:string
  public function SetVoIPCommonCountryCode($NewVoIPCountryCode){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPCountryCode'=>$NewVoIPCountryCode);
    return self::Call('X_VoIP','SetVoIPCommonCountryCode',$args,null);
  }
  // NewVoIPAccountIndex:ui2, NewVoIPEnableAreaCode:boolean
  public function SetVoIPEnableAreaCode($NewVoIPAccountIndex,$NewVoIPEnableAreaCode){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAccountIndex'=>$NewVoIPAccountIndex,'NewVoIPEnableAreaCode'=>$NewVoIPEnableAreaCode);
    return self::Call('X_VoIP','SetVoIPEnableAreaCode',$args,null);
  }
  // NewVoIPAccountIndex:ui2, NewVoIPEnableCountryCode:boolean
  public function SetVoIPEnableCountryCode($NewVoIPAccountIndex,$NewVoIPEnableCountryCode){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAccountIndex'=>$NewVoIPAccountIndex,'NewVoIPEnableCountryCode'=>$NewVoIPEnableCountryCode);
    return self::Call('X_VoIP','SetVoIPEnableCountryCode',$args,null);
  }
  // NewVoIPAccountIndex:ui2, NewVoIPRegistrar:string, NewVoIPNumber:string, NewVoIPUsername:string, NewVoIPPassword:string, NewVoIPOutboundProxy:string, NewVoIPSTUNServer:string
  public function X_AVM_DE_AddVoIPAccount($NewVoIPAccountIndex,$NewVoIPRegistrar,$NewVoIPNumber,$NewVoIPUsername,$NewVoIPPassword,$NewVoIPOutboundProxy,$NewVoIPSTUNServer){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAccountIndex'=>$NewVoIPAccountIndex,'NewVoIPRegistrar'=>$NewVoIPRegistrar,'NewVoIPNumber'=>$NewVoIPNumber,'NewVoIPUsername'=>$NewVoIPUsername,'NewVoIPPassword'=>$NewVoIPPassword,'NewVoIPOutboundProxy'=>$NewVoIPOutboundProxy,'NewVoIPSTUNServer'=>$NewVoIPSTUNServer);
    return self::Call('X_VoIP','X_AVM-DE_AddVoIPAccount',$args,null);
  }
  // NewX_AVM_DE_LaborVersion:string
  public function X_AVM_DE_CheckUpdate($NewX_AVM_DE_LaborVersion){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_LaborVersion'=>$NewX_AVM_DE_LaborVersion);
    return self::Call('UserInterface','X_AVM-DE_CheckUpdate',$args,null);
  }

  public function X_AVM_DE_CreateUrlSID(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_UrlSID');
    return self::Call('DeviceConfig','X_AVM-DE_CreateUrlSID',null,$filter);
  }
  // NewVoIPAccountIndex:ui2
  public function X_AVM_DE_DelVoIPAccount($NewVoIPAccountIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAccountIndex'=>$NewVoIPAccountIndex);
    return self::Call('X_VoIP','X_AVM-DE_DelVoIPAccount',$args,null);
  }
  // NewX_AVM_DE_ClientIndex:ui2
  public function X_AVM_DE_DeleteClient($NewX_AVM_DE_ClientIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_ClientIndex'=>$NewX_AVM_DE_ClientIndex);
    return self::Call('X_VoIP','X_AVM-DE_DeleteClient',$args,null);
  }

  public function X_AVM_DE_DialGetConfig(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_PhoneName');
    return self::Call('X_VoIP','X_AVM-DE_DialGetConfig',null,$filter);
  }

  public function X_AVM_DE_DialHangup(){
    if (!$this->GetOnlineState()) return null;
    return self::Call('X_VoIP','X_AVM-DE_DialHangup',null,null);
  }
  // NewX_AVM_DE_PhoneNumber:string
  public function X_AVM_DE_DialNumber($NewX_AVM_DE_PhoneNumber){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_PhoneNumber'=>$NewX_AVM_DE_PhoneNumber);
    return self::Call('X_VoIP','X_AVM-DE_DialNumber',$args,null);
  }
  // NewX_AVM_DE_PhoneName:string
  public function X_AVM_DE_DialSetConfig($NewX_AVM_DE_PhoneName){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_PhoneName'=>$NewX_AVM_DE_PhoneName);
    return self::Call('X_VoIP','X_AVM-DE_DialSetConfig',$args,null);
  }
  // NewX_AVM_DE_AllowDowngrade:boolean, NewX_AVM_DE_DownloadURL:string
  public function X_AVM_DE_DoManualUpdate($NewX_AVM_DE_AllowDowngrade,$NewX_AVM_DE_DownloadURL){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_AllowDowngrade'=>$NewX_AVM_DE_AllowDowngrade,'NewX_AVM-DE_DownloadURL'=>$NewX_AVM_DE_DownloadURL);
    return self::Call('UserInterface','X_AVM-DE_DoManualUpdate',$args,null);
  }

  public function X_AVM_DE_DoPrepareCGI(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_CGI','NewX_AVM-DE_SessionID');
    return self::Call('UserInterface','X_AVM-DE_DoPrepareCGI',null,$filter);
  }

  public function X_AVM_DE_DoUpdate(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewUpgradeAvailable','NewX_AVM-DE_UpdateState');
    return self::Call('UserInterface','X_AVM-DE_DoUpdate',null,$filter);
  }

  public function X_AVM_DE_GetAnonymousLogin(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_AnonymousLoginEnabled');
    return self::Call('LANConfigSecurity','X_AVM-DE_GetAnonymousLogin',null,$filter);
  }
  // NewMACAddress:string
  public function X_AVM_DE_GetAutoWakeOnLANByMACAddress($NewMACAddress){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewMACAddress'=>$NewMACAddress);
    $filter=array('NewAutoWOLEnabled');
    return self::Call('Hosts','X_AVM-DE_GetAutoWakeOnLANByMACAddress',$args,$filter);
  }

  public function X_AVM_DE_GetChangeCounter(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_ChangeCounter');
    return self::Call('Hosts','X_AVM-DE_GetChangeCounter',null,$filter);
  }
  // NewX_AVM_DE_ClientIndex:ui2
  public function X_AVM_DE_GetClient($NewX_AVM_DE_ClientIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_ClientIndex'=>$NewX_AVM_DE_ClientIndex);
    $filter=array('NewX_AVM-DE_ClientUsername','NewX_AVM-DE_ClientRegistrar','NewX_AVM-DE_PhoneName','NewX_AVM-DE_OutGoingNumber');
    return self::Call('X_VoIP','X_AVM-DE_GetClient',$args,$filter);
  }
  // NewX_AVM_DE_ClientIndex:ui2
  public function X_AVM_DE_GetClient2($NewX_AVM_DE_ClientIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_ClientIndex'=>$NewX_AVM_DE_ClientIndex);
    $filter=array('NewX_AVM-DE_ClientUsername','NewX_AVM-DE_ClientRegistrar','NewX_AVM-DE_PhoneName','NewX_AVM-DE_ClientId','NewX_AVM-DE_OutGoingNumber');
    return self::Call('X_VoIP','X_AVM-DE_GetClient2',$args,$filter);
  }
  // NewX_AVM_DE_ClientIndex:ui2
  public function X_AVM_DE_GetClient3($NewX_AVM_DE_ClientIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_ClientIndex'=>$NewX_AVM_DE_ClientIndex);
    $filter=array('NewX_AVM-DE_ClientUsername','NewX_AVM-DE_ClientRegistrar','NewX_AVM-DE_PhoneName','NewX_AVM-DE_ClientId','NewX_AVM-DE_OutGoingNumber','NewX_AVM-DE_InComingNumbers','NewX_AVM-DE_ExternalRegistration');
    return self::Call('X_VoIP','X_AVM-DE_GetClient3',$args,$filter);
  }

  public function X_AVM_DE_GetClients(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_ClientList');
    return self::Call('X_VoIP','X_AVM-DE_GetClients',null,$filter);
  }
  // NewX_AVM_DE_Password:string
  public function X_AVM_DE_GetConfigFile($NewX_AVM_DE_Password){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_Password'=>$NewX_AVM_DE_Password);
    $filter=array('NewX_AVM-DE_ConfigFileUrl');
    return self::Call('DeviceConfig','X_AVM-DE_GetConfigFile',$args,$filter);
  }

  public function X_AVM_DE_GetCurrentUser(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_CurrentUsername','NewX_AVM-DE_CurrentUserRights');
    return self::Call('LANConfigSecurity','X_AVM-DE_GetCurrentUser',null,$filter);
  }

  public function X_AVM_DE_GetIPTVOptimized(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_IPTVoptimize');
    return self::Call('WLANConfiguration','X_AVM-DE_GetIPTVOptimized',null,$filter);
  }

  public function X_AVM_DE_GetInternationalConfig(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_Language','NewX_AVM-DE_Country','NewX_AVM-DE_Annex','NewX_AVM-DE_LanguageList','NewX_AVM-DE_CountryList','NewX_AVM-DE_AnnexList');
    return self::Call('UserInterface','X_AVM-DE_GetInternationalConfig',null,$filter);
  }

  public function X_AVM_DE_GetNightControl(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewNightControl','NewNightTimeControlNoForcedOff');
    return self::Call('WLANConfiguration','X_AVM-DE_GetNightControl',null,$filter);
  }

  public function X_AVM_DE_GetNumberOfClients(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_NumberOfClients');
    return self::Call('X_VoIP','X_AVM-DE_GetNumberOfClients',null,$filter);
  }

  public function X_AVM_DE_GetNumberOfNumbers(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewNumberOfNumbers');
    return self::Call('X_VoIP','X_AVM-DE_GetNumberOfNumbers',null,$filter);
  }

  public function X_AVM_DE_GetNumbers(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewNumberList');
    return self::Call('X_VoIP','X_AVM-DE_GetNumbers',null,$filter);
  }
  // NewSyncGroupIndex:ui4
  public function X_AVM_DE_GetOnlineMonitor($NewSyncGroupIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewSyncGroupIndex'=>$NewSyncGroupIndex);
    $filter=array('NewTotalNumberSyncGroups','NewSyncGroupName','NewSyncGroupMode','Newmax_ds','Newmax_us','Newds_current_bps','Newmc_current_bps','Newus_current_bps','Newprio_realtime_bps','Newprio_high_bps','Newprio_default_bps','Newprio_low_bps');
    return self::Call('WANCommonInterfaceConfig','X_AVM-DE_GetOnlineMonitor',$args,$filter);
  }
  // NewIndex:ui2
  public function X_AVM_DE_GetPhonePort($NewIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewIndex'=>$NewIndex);
    $filter=array('NewX_AVM-DE_PhoneName');
    return self::Call('X_VoIP','X_AVM-DE_GetPhonePort',$args,$filter);
  }

  public function X_AVM_DE_GetTR069FirmwareDownloadEnabled(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewTR069FirmwareDownloadEnabled');
    return self::Call('ManagementServer','X_AVM-DE_GetTR069FirmwareDownloadEnabled',null,$filter);
  }
  // NewVoIPAccountIndex:ui2
  public function X_AVM_DE_GetVoIPAccount($NewVoIPAccountIndex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewVoIPAccountIndex'=>$NewVoIPAccountIndex);
    $filter=array('NewVoIPRegistrar','NewVoIPNumber','NewVoIPUsername','NewVoIPPassword','NewVoIPOutboundProxy','NewVoIPSTUNServer');
    return self::Call('X_VoIP','X_AVM-DE_GetVoIPAccount',$args,$filter);
  }

  public function X_AVM_DE_GetWLANExtInfo(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_APEnabled','NewX_AVM-DE_APType','NewX_AVM-DE_TimeoutActive','NewX_AVM-DE_Timeout','NewX_AVM-DE_TimeRemain','NewX_AVM-DE_NoForcedOff','NewX_AVM-DE_UserIsolation','NewX_AVM-DE_EncryptionMode','NewX_AVM-DE_LastChangedStamp');
    return self::Call('WLANConfiguration','X_AVM-DE_GetWLANExtInfo',null,$filter);
  }

  public function X_AVM_DE_GetWLANHybridMode(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewEnable','NewBeaconType','NewKeyPassphrase','NewSSID','NewBSSID','NewTrafficMode','NewManualSpeed','NewMaxSpeedDS','NewMaxSpeedUS');
    return self::Call('WLANConfiguration','X_AVM-DE_GetWLANHybridMode',null,$filter);
  }

  public function X_AVM_DE_GetWPSInfo(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewX_AVM-DE_WPSMode','NewX_AVM-DE_WPSStatus');
    return self::Call('WLANConfiguration','X_AVM-DE_GetWPSInfo',null,$filter);
  }
  // NewMACAddress:string, NewAutoWOLEnabled:boolean
  public function X_AVM_DE_SetAutoWakeOnLANByMACAddress($NewMACAddress,$NewAutoWOLEnabled){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewMACAddress'=>$NewMACAddress,'NewAutoWOLEnabled'=>$NewAutoWOLEnabled);
    return self::Call('Hosts','X_AVM-DE_SetAutoWakeOnLANByMACAddress',$args,null);
  }
  // NewX_AVM_DE_ClientIndex:ui2, NewX_AVM_DE_ClientPassword:string, NewX_AVM_DE_PhoneName:string, NewX_AVM_DE_OutGoingNumber:string
  public function X_AVM_DE_SetClient($NewX_AVM_DE_ClientIndex,$NewX_AVM_DE_ClientPassword,$NewX_AVM_DE_PhoneName,$NewX_AVM_DE_OutGoingNumber){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_ClientIndex'=>$NewX_AVM_DE_ClientIndex,'NewX_AVM-DE_ClientPassword'=>$NewX_AVM_DE_ClientPassword,'NewX_AVM-DE_PhoneName'=>$NewX_AVM_DE_PhoneName,'NewX_AVM-DE_OutGoingNumber'=>$NewX_AVM_DE_OutGoingNumber);
    return self::Call('X_VoIP','X_AVM-DE_SetClient',$args,null);
  }
  // NewX_AVM_DE_ClientIndex:ui2, NewX_AVM_DE_ClientPassword:string, NewX_AVM_DE_ClientId:string, NewX_AVM_DE_PhoneName:string, NewX_AVM_DE_OutGoingNumber:string
  public function X_AVM_DE_SetClient2($NewX_AVM_DE_ClientIndex,$NewX_AVM_DE_ClientPassword,$NewX_AVM_DE_ClientId,$NewX_AVM_DE_PhoneName,$NewX_AVM_DE_OutGoingNumber){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_ClientIndex'=>$NewX_AVM_DE_ClientIndex,'NewX_AVM-DE_ClientPassword'=>$NewX_AVM_DE_ClientPassword,'NewX_AVM-DE_ClientId'=>$NewX_AVM_DE_ClientId,'NewX_AVM-DE_PhoneName'=>$NewX_AVM_DE_PhoneName,'NewX_AVM-DE_OutGoingNumber'=>$NewX_AVM_DE_OutGoingNumber);
    return self::Call('X_VoIP','X_AVM-DE_SetClient2',$args,null);
  }
  // NewX_AVM_DE_ClientIndex:ui2, NewX_AVM_DE_ClientPassword:string, NewX_AVM_DE_ClientId:string, NewX_AVM_DE_PhoneName:string, NewX_AVM_DE_OutGoingNumber:string, NewX_AVM_DE_InComingNumbers:string, NewX_AVM_DE_ExternalRegistration:boolean
  public function X_AVM_DE_SetClient3($NewX_AVM_DE_ClientIndex,$NewX_AVM_DE_ClientPassword,$NewX_AVM_DE_ClientId,$NewX_AVM_DE_PhoneName,$NewX_AVM_DE_OutGoingNumber,$NewX_AVM_DE_InComingNumbers,$NewX_AVM_DE_ExternalRegistration){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_ClientIndex'=>$NewX_AVM_DE_ClientIndex,'NewX_AVM-DE_ClientPassword'=>$NewX_AVM_DE_ClientPassword,'NewX_AVM-DE_ClientId'=>$NewX_AVM_DE_ClientId,'NewX_AVM-DE_PhoneName'=>$NewX_AVM_DE_PhoneName,'NewX_AVM-DE_OutGoingNumber'=>$NewX_AVM_DE_OutGoingNumber,'NewX_AVM-DE_InComingNumbers'=>$NewX_AVM_DE_InComingNumbers,'NewX_AVM-DE_ExternalRegistration'=>$NewX_AVM_DE_ExternalRegistration);
    return self::Call('X_VoIP','X_AVM-DE_SetClient3',$args,null);
  }
  // NewX_AVM_DE_Password:string, NewX_AVM_DE_ConfigFileUrl:string
  public function X_AVM_DE_SetConfigFile($NewX_AVM_DE_Password,$NewX_AVM_DE_ConfigFileUrl){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_Password'=>$NewX_AVM_DE_Password,'NewX_AVM-DE_ConfigFileUrl'=>$NewX_AVM_DE_ConfigFileUrl);
    return self::Call('DeviceConfig','X_AVM-DE_SetConfigFile',$args,null);
  }
  // NewMACAddress:string, NewHostName:string
  public function X_AVM_DE_SetHostNameByMACAddress($NewMACAddress,$NewHostName){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewMACAddress'=>$NewMACAddress,'NewHostName'=>$NewHostName);
    return self::Call('Hosts','X_AVM-DE_SetHostNameByMACAddress',$args,null);
  }
  // NewX_AVM_DE_IPTVoptimize:boolean
  public function X_AVM_DE_SetIPTVOptimized($NewX_AVM_DE_IPTVoptimize){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_IPTVoptimize'=>$NewX_AVM_DE_IPTVoptimize);
    return self::Call('WLANConfiguration','X_AVM-DE_SetIPTVOptimized',$args,null);
  }
  // NewX_AVM_DE_Language:string, NewX_AVM_DE_Country:string, NewX_AVM_DE_Annex:string
  public function X_AVM_DE_SetInternationalConfig($NewX_AVM_DE_Language,$NewX_AVM_DE_Country,$NewX_AVM_DE_Annex){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_Language'=>$NewX_AVM_DE_Language,'NewX_AVM-DE_Country'=>$NewX_AVM_DE_Country,'NewX_AVM-DE_Annex'=>$NewX_AVM_DE_Annex);
    return self::Call('UserInterface','X_AVM-DE_SetInternationalConfig',$args,null);
  }
  // NewStickSurfEnable:boolean
  public function X_AVM_DE_SetStickSurfEnable($NewStickSurfEnable){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewStickSurfEnable'=>$NewStickSurfEnable);
    return self::Call('WLANConfiguration','X_AVM-DE_SetStickSurfEnable',$args,null);
  }
  // NewTR069FirmwareDownloadEnabled:boolean
  public function X_AVM_DE_SetTR069FirmwareDownloadEnabled($NewTR069FirmwareDownloadEnabled){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewTR069FirmwareDownloadEnabled'=>$NewTR069FirmwareDownloadEnabled);
    return self::Call('ManagementServer','X_AVM-DE_SetTR069FirmwareDownloadEnabled',$args,null);
  }
  // NewAccessType:string
  public function X_AVM_DE_SetWANAccessType($NewAccessType){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewAccessType'=>$NewAccessType);
    return self::Call('WANCommonInterfaceConfig','X_AVM-DE_SetWANAccessType',$args,null);
  }
  // NewEnable:boolean, NewBeaconType:string, NewKeyPassphrase:string, NewSSID:string, NewBSSID:string, NewTrafficMode:string, NewManualSpeed:boolean, NewMaxSpeedDS:ui4, NewMaxSpeedUS:ui4
  public function X_AVM_DE_SetWLANHybridMode($NewEnable,$NewBeaconType,$NewKeyPassphrase,$NewSSID,$NewBSSID,$NewTrafficMode,$NewManualSpeed,$NewMaxSpeedDS,$NewMaxSpeedUS){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewEnable'=>$NewEnable,'NewBeaconType'=>$NewBeaconType,'NewKeyPassphrase'=>$NewKeyPassphrase,'NewSSID'=>$NewSSID,'NewBSSID'=>$NewBSSID,'NewTrafficMode'=>$NewTrafficMode,'NewManualSpeed'=>$NewManualSpeed,'NewMaxSpeedDS'=>$NewMaxSpeedDS,'NewMaxSpeedUS'=>$NewMaxSpeedUS);
    return self::Call('WLANConfiguration','X_AVM-DE_SetWLANHybridMode',$args,null);
  }
  // NewX_AVM_DE_WPSMode:string, NewX_AVM_DE_WPSClientPIN:string
  public function X_AVM_DE_SetWPSConfig($NewX_AVM_DE_WPSMode,$NewX_AVM_DE_WPSClientPIN){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewX_AVM-DE_WPSMode'=>$NewX_AVM_DE_WPSMode,'NewX_AVM-DE_WPSClientPIN'=>$NewX_AVM_DE_WPSClientPIN);
    $filter=array('NewX_AVM-DE_WPSAPPIN','NewX_AVM-DE_WPSStatus');
    return self::Call('WLANConfiguration','X_AVM-DE_SetWPSConfig',$args,$filter);
  }
  // NewMACAddress:string
  public function X_AVM_DE_WakeOnLANByMACAddress($NewMACAddress){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewMACAddress'=>$NewMACAddress);
    return self::Call('Hosts','X_AVM-DE_WakeOnLANByMACAddress',$args,null);
  }

  public function X_GenerateUUID(){
    if (!$this->GetOnlineState()) return null;
    $filter=array('NewUUID');
    return self::Call('DeviceConfig','X_GenerateUUID',null,$filter);
  }
  // NewEnableHighFrequency:boolean
  public function X_SetHighFrequencyBand($NewEnableHighFrequency){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewEnableHighFrequency'=>$NewEnableHighFrequency);
    return self::Call('WLANConfiguration','X_SetHighFrequencyBand',$args,null);
  }
  // NewTR069Enabled:boolean
  public function X_SetTR069Enable($NewTR069Enabled){
    if (!$this->GetOnlineState()) return null;
    $args=array('NewTR069Enabled'=>$NewTR069Enabled);
    return self::Call('ManagementServer','X_SetTR069Enable',$args,null);
  }
}
?>